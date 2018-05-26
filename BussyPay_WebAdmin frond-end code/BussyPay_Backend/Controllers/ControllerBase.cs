using BussyPay_Backend.Models;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;

namespace BussyPay_Backend.Controllers
{
    public class ControllerBase : Controller
    {

        public JObject Request(string id, string path)
        {

            var request = (HttpWebRequest)WebRequest.Create(path);

            request.Method = "GET";
            request.UserAgent = "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36";
            request.AutomaticDecompression = DecompressionMethods.Deflate | DecompressionMethods.GZip;

            var response = (HttpWebResponse)request.GetResponse();

            string content = string.Empty;
            using (var stream = response.GetResponseStream())
            {
                using (var sr = new StreamReader(stream))
                {
                    content = sr.ReadToEnd();
                }
            }

            return JObject.Parse(content);
        }

        /// <summary>
        /// แสดง Alert แบบ Notofication
        /// </summary> 
        public void notifyMsg(NotifyMsgType type, string msg)
        {
            var cname = DefaultValues.ALERT_COOKIE;
            var cvalue = new
            {
                type = type.GetEnumStringValue(),
                msg = Uri.EscapeUriString(msg)
            };

            Response.Cookies.Add(new HttpCookie(cname, JsonConvert.SerializeObject(cvalue)));
        }


        /// <summary>
        /// แสดง Alert แบบ Dialog
        /// </summary> 
        public void notiSweetAlert(NotifyMsgType type, string msg)
        {
            var cname = DefaultValues.SWEET_ALERT_COOKIE;
            var cvalue = new
            {
                type = type.GetEnumStringValue(),
                msg = Uri.EscapeUriString(msg)
            };

            Response.Cookies.Add(new HttpCookie(cname, JsonConvert.SerializeObject(cvalue)));
        }

    }
}