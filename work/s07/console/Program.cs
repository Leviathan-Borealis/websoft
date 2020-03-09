using System;
using System.IO;
using System.Text.Json;
using System.Text.Json.Serialization;
using System.Collections.Generic;
using System.Linq;
using s07;
using ConsoleTables;

namespace s07
{
    class Program
    {
        static void Main(string[] args)
        {
            int choice = -1;
            bool runApp = true;
            while (runApp){
                var accounts = AccountHandler.ReadAccounts();
                //var accounts = ReadAccounts();
                printMenu();
               
                choice = int.Parse(Console.ReadLine());
                
                switch(choice){
                    case 1:{
                            Console.WriteLine("Show all accounts");
                            printAccounts(accounts.ToList());
                        break;
                    }
                    case 2:{
                        AccountHandler.createAccount(accounts);
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
                                    printAccount(account);
                                    notFound = false;
                                }
                            }

                            if(notFound){
                                Console.WriteLine("Did not find account with id " + accountId);
                            }
                        break;
                    }
                    case 4:{
                        string query;
                            Console.WriteLine("Enter search term");
                            query = Console.ReadLine();
                        List<Account> searchedAccounts = AccountHandler.searchAccounts(query,accounts);
                        Console.WriteLine("Found " + searchedAccounts.Count + " account that matches");
                        printAccounts(searchedAccounts);
                        break;
                    }
                    case 5:{
                        AccountHandler.moveMoney(accounts);
                        break;
                    }
                    case 6:{
                        AccountHandler.deleteAccount(accounts);
                        break;
                    }
                    case 7:{
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

        static void printAccount(Account account){
            var table = new ConsoleTable("Number","Balance","Label","Owner");
            table.AddRow(account.Number,account.Balance,account.Label,account.Owner);
            table.Write();
        }

        static void printAccounts(List<Account> accounts){
            var table = new ConsoleTable("Number","Balance","Label","Owner");
            foreach(Account account in accounts){
                table.AddRow(account.Number,account.Balance,account.Label,account.Owner);
            }
            table.Write();
        }

        static void printMenu(){
            String menu = "1. List accounts\n" + 
                            "2. Add account\n" + 
                            "3. View account by id\n" + 
                            "4. Search for account\n" + 
                            "5. Transfer money\n" + 
                            "6. Delete account\n" + 
                            "7. Exit";
            Console.WriteLine(menu);
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
