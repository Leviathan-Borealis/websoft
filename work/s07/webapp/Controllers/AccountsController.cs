using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using System.Text.Json;
using webapp.Models;
using webapp.Services;
using System.Linq;
using Microsoft.AspNetCore.Http;


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

        [HttpGet("{idFrom:int}/{idTo:int}/{amount:int}")]
        public string Get(int idFrom,int idTo, int amount)
        {
            var accounts = AccountService.GetAccounts().ToList();

            foreach(var a in accounts){
                if(idFrom == a.Number){
                    List<Account> aList = new List<Account>();
                    aList.Add(a);
                    var json = JsonSerializer.Serialize<IEnumerable<Account>>(aList);
                    return json;
                }
            }
            return "[{\"error\":\"Account does not exist\"}]";
        }

        //Api method
        [HttpPost]
        [Route("transfer")]
        public IActionResult PostTransfer(Transfer data)
        {
            AccountService.moveMoney(data.idFrom,data.idTo,data.amount);
            return Ok();
        }
    
        //Form method
        [HttpPost]
        public IActionResult Post()
        {   
            var putMethod = Request.Form.AsEnumerable().ElementAt(0);
            if(putMethod.Value == "true"){
                var number = Request.Form.AsEnumerable().ElementAt(1);
                var label = Request.Form.AsEnumerable().ElementAt(2);
                var owner = Request.Form.AsEnumerable().ElementAt(3);
                AccountService.createAccount(int.Parse(number.Value),label.Value,int.Parse(owner.Value));
                return Redirect(Request.Headers["Referer"].ToString());
            } else {
                var idFrom = Request.Form.AsEnumerable().ElementAt(1);
                var idTo = Request.Form.AsEnumerable().ElementAt(2);
                var amount = Request.Form.AsEnumerable().ElementAt(3);
                AccountService.moveMoney(int.Parse(idFrom.Value),int.Parse(idTo.Value),int.Parse(amount.Value));
                return Redirect(Request.Headers["Referer"].ToString());
            }
        }       
    }
}
