using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace BussyPay_Backend.ViewModels
{
    public class UserViewModels
    {
        public int id { get; set; }
        public string username { get; set; }
        public string first_name { get; set; }
        public string last_name { get; set; }
        public string email { get; set; }
        public string phone { get; set; }
        public int wallet_id { get; set; }
    }
}