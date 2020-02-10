using System;
using System.IO;
using System.Text.Json;
using System.Text.Json.Serialization;
using System.Collections.Generic;
using System.Linq;

namespace s07
{
    class Program
    {
        static void Main(string[] args)
        {
            
            int choice = -1;
            bool runApp = true;
            while (runApp){
                var accounts = ReadAccounts();
                printMenu();
               
                choice = int.Parse(Console.ReadLine());
                
                switch(choice){
                    case 1:{
                            Console.WriteLine("Show all accounts");
                            foreach (var account in accounts) {
                                Console.WriteLine(account);
                            }
                        break;
                    }
                    case 2:{
                        createAccount(accounts);
                        break;
                    }
                    case 3:{
                            int accountId;
                            Console.WriteLine("Enter account id to show:");
                            accountId = int.Parse(Console.ReadLine());
                            Console.WriteLine("Show account with id " + accountId);
                            bool notFound = true;
                            foreach (var account in accounts) {
                                if(account.Number == accountId){
                                    Console.WriteLine(account);
                                    notFound = false;
                                }
                            }

                            if(notFound){
                                Console.WriteLine("Did not find account with id " + accountId);
                            }
                        break;
                    }
                    case 4:{
                        deleteAccount(accounts);
                        break;
                    }
                    case 5:{
                        Console.WriteLine("Exiting the application");
                        runApp = false;
                        break;
                    }
                    default:{
                        Console.WriteLine("Invalid input. Exiting the application");
                        runApp = false;
                        break;
                    }
                }
            }
        }

        static void printMenu(){
            String menu = "1. List accounts\n" + 
                            "2. Add account\n" + 
                            "3. View account by id\n" + 
                            "4. Delete account\n" + 
                            "5. Exit";
            Console.WriteLine(menu);
        }

        static IEnumerable<Account> ReadAccounts()
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

        static void SaveAccounts(IEnumerable<Account> accounts)
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

        static void SaveAccountsShorter(IEnumerable<Account> accounts)
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

        static void createAccount(IEnumerable<Account> accounts){
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

        static void deleteAccount(IEnumerable<Account> accounts){
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

        
    }

    public class Account
    {
        public int Number { get; set; }
        public int Balance { get; set; }
        public string Label { get; set; }
        public int Owner { get; set; }
        
        public override string ToString() {
            return JsonSerializer.Serialize<Account>(this);
        }

        
        public bool isTheSame(Account obj)
        {
            if(this.Number == obj.Number){
                return true;
            }
            return false;
        }
    }
}
