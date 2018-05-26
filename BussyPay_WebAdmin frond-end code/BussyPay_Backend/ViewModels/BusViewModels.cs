using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace BussyPay_Backend.ViewModels
{
    public class BusViewModels
    {
        public int id { get; set; }
        public string bus_name { get; set; }
        public string source { get; set; }
        public string terminal { get; set; }
    }
}