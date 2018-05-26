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
    public class TopupController : ControllerBase
    {
        // GET: Topup
        public ActionResult Index()
        {
            return View();
        }


        /// <summary>   
        /// ค้นหา SearchHistory
        /// </summary>
        public JsonDataTableResult SearchAsync(FormCollection formcollection)
        {
            ReturnValues<TopupViewModels> returnData = new ReturnValues<TopupViewModels>();
            DataTableJSON<TopupViewModels> dataTable = new DataTableJSON<TopupViewModels>();
            DataTableProperty dataTableProperty = DataTableProperty.Get(formcollection);
            List<TopupViewModels> data = new List<TopupViewModels>();

            try
            {

                int total = 0;
                int skip = dataTableProperty.StartRecord;
                int limit = dataTableProperty.EndRecord;
                string path = "http://122.155.202.166/api/controller/wallet_controller.php?";

                string wallet_id = formcollection["wallet_id"].ToString();
                if (!string.IsNullOrEmpty(wallet_id))
                {
                    path = "http://122.155.202.166/api/controller/wallet_controller.php?wallet_id=" + wallet_id;
                }

                JObject result = Request(wallet_id, path);
                if (result != null)
                {
                    if (result["data"] != null)
                    {
                        data = JsonConvert.DeserializeObject<List<TopupViewModels>>(result["data"].ToString());
                        total = data.Count;
                        data = data.Skip(dataTableProperty.StartRecord).Take(dataTableProperty.EndRecord).ToList();
                    }
                }



                returnData = new ReturnValues<TopupViewModels>();
                returnData.Data = data;
                returnData.TotalRecord = total;
                returnData.Size = total;

            }
            catch (Exception ex)
            {
                notifyMsg(NotifyMsgType.Error, ex.Message);
                returnData = new ReturnValues<TopupViewModels>();
                returnData.Data = new List<TopupViewModels>();
                returnData.TotalRecord = 0;
                returnData.Size = 0;
            }

            dataTable.Echo = dataTableProperty.Echo;
            dataTable.TotalDisplayRecords = returnData.TotalRecord;
            dataTable.TotalRecords = returnData.TotalRecord;
            dataTable.Data = returnData.Data;

            return new JsonDataTableResult(dataTable, JsonRequestBehavior.AllowGet);
        }
          
    }
}