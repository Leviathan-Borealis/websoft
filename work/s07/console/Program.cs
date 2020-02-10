using System;
using System.IO;
using System.Text.Json;
using System.Text.Json.Serialization;
using System.Collections.Generic ;

namespace s07
{
    class Program
    {
        static void Main(string[] args)
        {
            var accounts = ReadAccounts();
            int choice = -1;
            while (true){
                printMenu();
                choice = int.Parse(Console.ReadLine());

                if(choice == -1){
                    break;
                }

                switch(choice){
                    case 1:{
                            Console.WriteLine("Show all accounts (and add 1 money to their balance)");
                            foreach (var account in accounts) {
                                Console.WriteLine(account);
                            }
                        break;
                    }
                    case 2:{

                        break;
                    }
                    case 3:{

                        break;
                    }
                    case 4:{

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
            String file = "../data/account.json";

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
    }
}
