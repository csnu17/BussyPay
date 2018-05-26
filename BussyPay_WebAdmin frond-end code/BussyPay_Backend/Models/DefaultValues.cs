using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Reflection;
using System.Web;
using System.Web.Mvc;

namespace BussyPay_Backend.Models
{
    public static class DefaultValues
    {
        public const string ALERT_COOKIE = "alertcookie";
        public const string SWEET_ALERT_COOKIE = "sweetalertcookie";
        public const string MODAL_COOKIE = "customcookie";
        public const string SHOW_INTRO_COOKIE = ".th.go.info.cookie.intro";
        public const string UNIT_TYPE_TIME_UNIT = "TIME_UNIT";
        public const string THAI_DATE_TIME = "dd/MM/yyyy , HH:mm น.";
        public const string US_DATE_TIME = "dd/MM/yyyy , HH:mm";
    }

    public enum NotifyMsgType
    {
        [StringValue("success")]
        Success,
        [StringValue("danger")]
        Error,
        [StringValue("warning")]
        Warning,
        [StringValue("info")]
        Info
    };


    public class StringValueAttribute : Attribute
    {
        #region Properties
        /// <summary>
        /// Holds the stringvalue for a value in an enum.
        /// </summary>
        public string StringValue { get; protected set; }
        #endregion

        #region Constructor
        /// <summary>
        /// Constructor used to init a StringValue Attribute
        /// </summary>
        /// <param name="value"></param>
        public StringValueAttribute(string value)
        {
            this.StringValue = value;
        }
        #endregion
    }

    public static class EnumUtils
    {
        public static String GetEnumName(this Enum value)
        {
            return Enum.GetName(value.GetType(), value);
        }

        public static String GetEnumDescription(this Enum value)
        {
            FieldInfo fieldInfo = value.GetType().GetField(value.ToString());
            DescriptionAttribute[] enumAttributes = (DescriptionAttribute[])fieldInfo.GetCustomAttributes(typeof(DescriptionAttribute), false);
            if (enumAttributes.Length > 0)
            {
                return enumAttributes[0].Description;
            }

            return value.ToString();
        }

        public static String GetEnumStringValue(this Enum value)
        {
            FieldInfo fieldInfo = value.GetType().GetField(value.ToString());
            StringValueAttribute[] enumAttributes = (StringValueAttribute[])fieldInfo.GetCustomAttributes(typeof(StringValueAttribute), false);
            if (enumAttributes.Length > 0)
            {
                return enumAttributes[0].StringValue;
            }

            return value.ToString();
        }

        public static T GetEnum<T>(object value, bool useStringValue = false) where T : struct, IConvertible
        {
            if (!typeof(T).IsEnum) throw new ArgumentException("T must be an enumerated type");

            Array values = Enum.GetValues(typeof(T));
            for (int i = 0; i < values.Length; i++)
            {
                Object obj = values.GetValue(i);
                if (useStringValue)
                {
                    if (((Enum)obj).GetEnumStringValue() == value.ToString())
                        return (T)obj;
                }
                else
                {
                    if (((int)obj).ToString() == value.ToString())
                        return (T)obj;
                }
            }
            throw new InvalidOperationException("Input value does not match the target type.");
        }

        public static T ToEnum<T>(this string value, T defaultValue)
        {
            if (!string.IsNullOrEmpty(value))
            {
                return defaultValue;
            }

            return (T)Enum.Parse(typeof(T), value, true);
        }

        public static List<SelectListItem> ToSelectList<TEnum>(this TEnum value, bool useStringvalue = false, bool useDescriptionToDisplayText = false)
        {
            List<SelectListItem> selectList = Enum.GetValues(typeof(TEnum))
                    .Cast<TEnum>()
                    .OrderBy(e => e)
                    .Select(e => new SelectListItem
                    {
                        Text = useDescriptionToDisplayText ? ((Enum)((object)e)).GetEnumDescription() : ((Enum)((object)e)).GetEnumStringValue(),
                        Value = useStringvalue ? ((Enum)((object)e)).GetEnumStringValue() : ((int)((object)e)).ToString()
                    }).OrderBy(e => e.Text).ToList();
            return selectList;
        }
    }
}