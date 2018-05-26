using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace BussyPay_Backend.ViewModels
{
    public class TransactionViewModels
    {
        public string transaction_number { get; set; }
        public string amount { get; set; }
        public string transaction_date { get; set; }
        public string first_name { get; set; }
        public string last_name { get; set; }

        private string _bus_name = "";
        public string bus_name
        {
            get
            {
                if (string.IsNullOrEmpty(_bus_name))
                {
                    return "-";
                }
                return _bus_name;
            }
            set
            {
                _bus_name = value;
            }
        }
        private string _source ="";
        public string source {
            get
            {
                if (string.IsNullOrEmpty(_source))
                {
                    return "-";
                }
                return _source;
            }
            set
            {
                _source = value;
            }
        }

        private string _terminal = "";
        public string terminal {
            get
            {
                if (string.IsNullOrEmpty(_terminal))
                {
                    return "-";
                }
                return _terminal;
            }
            set
            {
                _terminal = value;
            }
        }
        public string status { get; set; }  
    }
}