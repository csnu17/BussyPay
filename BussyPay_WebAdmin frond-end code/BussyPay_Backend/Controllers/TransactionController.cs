using BussyPay_Backend.Helpers;
using BussyPay_Backend.Models;
using BussyPay_Backend.ViewModel;
using BussyPay_Backend.ViewModels;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Text;
using System.Web;
using System.Web.Mvc;
using System.Web.Script.Serialization;

namespace BussyPay_Backend.Controllers
{
    public class TransactionController : ControllerBase
    {
        // GET: Transaction
        public ActionResult Index()
        {
            return View();
        }
         /// <summary>   
         /// ค้นหา SearchHistory
         /// </summary>
        public JsonDataTableResult SearchAsync(FormCollection formcollection)
        {
            ReturnValues<TransactionViewModels> returnData = new ReturnValues<TransactionViewModels>();
            DataTableJSON<TransactionViewModels> dataTable = new DataTableJSON<TransactionViewModels>();
            DataTableProperty dataTableProperty = DataTableProperty.Get(formcollection);
            List<TransactionViewModels> data = new List<TransactionViewModels>();

            try
            {

                int total = 0;
                int skip = dataTableProperty.StartRecord;
                int limit = dataTableProperty.EndRecord;
                string type_transaction = formcollection["type_transaction"].ToString();
                string keyword = formcollection["keyword"].ToString();

                string path = "http://122.155.202.166/api/controller/transaction_controller.php?type=" + type_transaction;

                if (!string.IsNullOrEmpty(keyword))
                {
                    path = "http://122.155.202.166/api/controller/transaction_controller.php?keyword=" + keyword+"&type="+ type_transaction;
                }

                JObject result = Request(keyword, path);
                if (result != null)
                {
                    if (result["data"] != null)
                    {
                        data = JsonConvert.DeserializeObject<List<TransactionViewModels>>(result["data"].ToString());
                        total = data.Count;
                        data = data.Skip(dataTableProperty.StartRecord).Take(dataTableProperty.EndRecord).ToList();
                    }
                }



                returnData = new ReturnValues<TransactionViewModels>();
                returnData.Data = data;
                returnData.TotalRecord = total;
                returnData.Size = total;

            }
            catch (Exception ex)
            {
                notifyMsg(NotifyMsgType.Error, ex.Message);
                returnData = new ReturnValues<TransactionViewModels>();
                returnData.Data = new List<TransactionViewModels>();
                returnData.TotalRecord = 0;
                returnData.Size = 0;
            }

            dataTable.Echo = dataTableProperty.Echo;
            dataTable.TotalDisplayRecords = returnData.TotalRecord;
            dataTable.TotalRecords = returnData.TotalRecord;
            dataTable.Data = returnData.Data;

            return new JsonDataTableResult(dataTable, JsonRequestBehavior.AllowGet);
        }

        public ActionResult Create()
        {
            return View();
        }

    }
}