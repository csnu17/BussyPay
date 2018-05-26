using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace BussyPay_Backend.ViewModels
{
    public class TopupViewModels
    {
        public int id { get; set; }
        public string wallet_id { get; set; }
        public string balance { get; set; }
        public string wallet_own { get; set; }
        public string first_name { get; set; }
        public string last_name { get; set; }
    }
}