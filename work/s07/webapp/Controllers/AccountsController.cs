using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using System.Text.Json;
using webapp.Models;
using webapp.Services;
using System.Linq;

namespace webapp.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class AccountsController : ControllerBase
    {
        public AccountsController(JsonFileAccountService accountService)
        {
            AccountService = accountService;
        }

        public JsonFileAccountService AccountService { get; }

        [HttpGet]
        public IEnumerable<Account> Get()
        {
            return AccountService.GetAccounts();
        }

        [HttpGet("{id}")]
        public string Get(int id)
        {
            var accounts = AccountService.GetAccounts().ToList();

            foreach(var a in accounts){
                if(id == a.Number){
                    List<Account> aList = new List<Account>();
                    aList.Add(a);
                    var json = JsonSerializer.Serialize<IEnumerable<Account>>(aList);
                    return json;
                }
            }
            return "[{\"error\":\"Account does not exist\"}]";
        }
    }
}
