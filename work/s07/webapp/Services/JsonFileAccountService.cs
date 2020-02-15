using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text.Json;
using System.Text.Json.Serialization;
using Microsoft.AspNetCore.Hosting;
using webapp.Models;

namespace webapp.Services
{
    public class JsonFileAccountService
    {
        public JsonFileAccountService(IWebHostEnvironment webHostEnvironment)
        {
            WebHostEnvironment = webHostEnvironment;
        }

        public IWebHostEnvironment WebHostEnvironment { get; }

        private string JsonFileName
        {
            get { return Path.Combine(WebHostEnvironment.ContentRootPath, "../console", "data", "account.json"); }
        }

        public IEnumerable<Account> GetAccounts()
        {
            using (var jsonFileReader = File.OpenText(JsonFileName))
            {
                return JsonSerializer.Deserialize<Account[]>(jsonFileReader.ReadToEnd(),
                    new JsonSerializerOptions
                    {
                        PropertyNameCaseInsensitive = true
                    });
            }
        }

        public void SaveAccountsShorter(IEnumerable<Account> accounts)
        {

            using (var outputStream = File.Open(JsonFileName,FileMode.Truncate))
            {
                JsonSerializer.Serialize<IEnumerable<Account>>(
                    new Utf8JsonWriter (
                        outputStream,
                        new JsonWriterOptions {
                            SkipValidation = true,
                            Indented = true
                        }
                    ),
                    accounts
                );
            }
        }

        public void SaveLog(string toLog)
        {
            using (StreamWriter outputFile = new StreamWriter(Path.Combine(WebHostEnvironment.ContentRootPath, "../console", "data", "test.txt")))
            {
                outputFile.WriteLine(toLog);
            }
        }

        public bool createAccount(int number,string label,int owner){
            IEnumerable<Account> accounts = GetAccounts();
            Account unsavedAccount = new Account();
            unsavedAccount.Number = number;
            unsavedAccount.Label = label;
            unsavedAccount.Owner = owner;

            foreach(var acc in accounts){
                while(unsavedAccount.isTheSame(acc)){
                    return false;
                }
            }
           
            accounts = accounts.Append(unsavedAccount);
            SaveAccountsShorter(accounts);
            return true;
        }

        public bool deleteAccount(int accountId){
            IEnumerable<Account> accounts = GetAccounts();
            List<Account> accountList = accounts.ToList();
            Account toRemove = null;
            foreach(var tempAcc in accounts){
                if(tempAcc.Number == accountId){
                    toRemove = tempAcc;
                }
            }

            if(toRemove != null){
                accountList.Remove(toRemove);
                SaveAccountsShorter(accountList);
                return true;
            }
            
            return false;
        }

        public List<Account> searchAccounts(string searchString){
            IEnumerable<Account> accounts = GetAccounts();
            List<Account> hits = new List<Account>();

            int numberLike = -1;

            int.TryParse(searchString,out numberLike);
            
            foreach(Account a in accounts){
                if(numberLike == a.Number || numberLike == a.Owner || a.Label.Contains(searchString)){
                    hits.Add(a);
                }
            }
            return hits;
        }

        public bool moveMoney(int fromAccount,int toAccount,int amount){
            IEnumerable<Account> accounts = GetAccounts();
            List<Account> listOfAccounts = accounts.ToList();

            Account withdrawAccount = null;
            Account depositAccount = null;

            foreach(Account a in accounts){
                if(a.Number == fromAccount){
                    withdrawAccount = a;
                } else if (a.Number == toAccount){
                    depositAccount = a;
                }
            }

            if(withdrawAccount.isTheSame(depositAccount)){
                return false;
            }

            if(withdrawAccount.Balance - amount < 0){
                return false;
            }

            withdrawAccount.Balance -= amount;
            depositAccount.Balance += amount;

            SaveAccountsShorter(listOfAccounts);
            return true;
        }
    }
}
