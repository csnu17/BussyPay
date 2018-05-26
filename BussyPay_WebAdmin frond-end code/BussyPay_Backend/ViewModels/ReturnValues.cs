using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BussyPay_Backend.ViewModel
{
    public class ReturnValues<T>
    {
        public List<T> Data { get; set; }
        public int Size { get; set; }
        public int TotalRecord { get; set; }  
    }
}
