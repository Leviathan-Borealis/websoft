using System;
using System.IO;
using System.Text.Json;
using System.Text.Json.Serialization;
using System.Collections.Generic;
using System.Linq;

namespace s07
{
    public class AccountHandler
    {
        static void printMenu(){
            String menu = "1. List accounts\n" + 
                            "2. Add account\n" + 
                            "3. View account by id\n" + 
                            "4. Delete account\n" + 
                            "5. Exit";
            Console.WriteLine(menu);
        }

        public static IEnumerable<Account> ReadAccounts()
        {
            String file = "work/s07/console/data/account.json";

            using (StreamReader r = new StreamReader(file))
            {
                string data = r.ReadToEnd();
                // Console.WriteLine(data);

                var json = JsonSerializer.Deserialize<Account[]>(
                    data,
                    new JsonSerializerOptions {
                        PropertyNameCaseInsensitive = true
                    }
                );

                return json;
            }
        }

        public static void SaveAccounts(IEnumerable<Account> accounts)
        {
            String file = "work/s07/console/data/account.json";

            using (var outputStream = File.OpenWrite(file))
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

        public static void SaveAccountsShorter(IEnumerable<Account> accounts)
        {
            String file = "work/s07/console/data/account.json";

            using (var outputStream = File.Open(file,FileMode.Truncate))
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

        public static void createAccount(IEnumerable<Account> accounts){
            int number;
            string label;
            int owner;

            Console.WriteLine("Enter account number:");
            number = int.Parse(Console.ReadLine());

            Console.WriteLine("Enter account label:");
            label = Console.ReadLine();

            Console.WriteLine("Enter account owner:");
            owner = int.Parse(Console.ReadLine());

            Account unsavedAccount = new Account();
            unsavedAccount.Number = number;
            unsavedAccount.Label = label;
            unsavedAccount.Owner = owner;

            bool noSimilarObj = true;
            do{
                noSimilarObj = true;
                foreach(var acc in accounts){
                    while(unsavedAccount.isTheSame(acc)){
                        noSimilarObj = false;
                        Console.WriteLine("Account number already present. Please enter another number");
                        unsavedAccount.Number = int.Parse(Console.ReadLine());
                    }
                }
            } while (!noSimilarObj);

            accounts = accounts.Append(unsavedAccount);
            SaveAccounts(accounts);
        
        }

        public static void deleteAccount(IEnumerable<Account> accounts){
            List<Account> accountList = accounts.ToList();
            int accountId;
            Console.WriteLine("Please enter account id to remove:");
            accountId = int.Parse(Console.ReadLine());
            Account toRemove = null;
            foreach(var tempAcc in accounts){
                if(tempAcc.Number == accountId){
                    toRemove = tempAcc;
                }
            }

            if(toRemove != null){
                accountList.Remove(toRemove);
            }
            
            SaveAccountsShorter(accountList);
        }

        public static List<Account> searchAccounts(string searchString,IEnumerable<Account> accounts){
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

        public static void moveMoney(IEnumerable<Account> accounts){
            List<Account> listOfAccounts = accounts.ToList();
            int fromAccount = -1;
            int toAccount = -1;
            int amount;

            Console.WriteLine("Please enter account number to withdraw funds from");
            fromAccount = int.Parse(Console.ReadLine());

            Console.WriteLine("Please enter account number to deposit funds in");
            toAccount = int.Parse(Console.ReadLine());

            Console.WriteLine("Please enter amount to transfer");
            amount = int.Parse(Console.ReadLine());

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
                Console.WriteLine("Cannot perform transfer. To and from accounts are the same");
                return;
            }

            if(withdrawAccount.Balance - amount < 0){
                Console.WriteLine("Not enough funds. Choose another account next time");
                return;
            }

            withdrawAccount.Balance -= amount;
            depositAccount.Balance += amount;

            SaveAccountsShorter(listOfAccounts);
        }
    }
}