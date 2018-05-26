﻿using BussyPay_Backend.Helpers;
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
    public class BusController : ControllerBase
    {
        // GET: Bus
        public ActionResult Index()
        {
            return View();
        }


        /// <summary>   
        /// ค้นหา SearchHistory
        /// </summary>
        public JsonDataTableResult SearchAsync(FormCollection formcollection)
        {
            ReturnValues<BusViewModels> returnData = new ReturnValues<BusViewModels>();
            DataTableJSON<BusViewModels> dataTable = new DataTableJSON<BusViewModels>();
            DataTableProperty dataTableProperty = DataTableProperty.Get(formcollection);
            List<BusViewModels> data = new List<BusViewModels>();

            try
            {

                int total = 0;
                int skip = dataTableProperty.StartRecord;
                int limit = dataTableProperty.EndRecord;
                string path = "http://122.155.202.166/api/controller/bus_information_controller.php?";

                string search = formcollection["search"].ToString();
                if (!string.IsNullOrEmpty(search))
                {
                    path = "http://122.155.202.166/api/controller/bus_information_controller.php?search=" + search;
                }

                JObject result = Request(search, path);
                if (result != null)
                {
                    if (result["data"] != null)
                    {
                        data = JsonConvert.DeserializeObject<List<BusViewModels>>(result["data"].ToString());
                        total = data.Count;
                        data = data.Skip(dataTableProperty.StartRecord).Take(dataTableProperty.EndRecord).ToList();
                    } 
                }



                returnData = new ReturnValues<BusViewModels>();
                returnData.Data = data;
                returnData.TotalRecord = total;
                returnData.Size = total;
            }
            catch (Exception ex)
            {
                notifyMsg(NotifyMsgType.Error, ex.Message);
                returnData = new ReturnValues<BusViewModels>();
                returnData.Data = new List<BusViewModels>();
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