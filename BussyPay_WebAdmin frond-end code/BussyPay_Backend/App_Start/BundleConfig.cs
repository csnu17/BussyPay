using System.Web;
using System.Web.Optimization;

namespace BussyPay_Backend
{
    public class BundleConfig
    {
        // For more information on bundling, visit http://go.microsoft.com/fwlink/?LinkId=301862
        public static void RegisterBundles(BundleCollection bundles)
        {
            bundles.Add(new ScriptBundle("~/bundles/jquery").Include(
                        "~/Scripts/jquery-{version}.js"));

            bundles.Add(new ScriptBundle("~/bundles/jqueryval").Include(
                        "~/Scripts/jquery.validate*"));

            // Use the development version of Modernizr to develop with and learn from. Then, when you're
            // ready for production, use the build tool at http://modernizr.com to pick only the tests you need.
            bundles.Add(new ScriptBundle("~/bundles/modernizr").Include(
                        "~/Scripts/modernizr-*"));

            bundles.Add(new ScriptBundle("~/bundles/bootstrap").Include(
                      "~/Scripts/bootstrap.js",
                      "~/Scripts/respond.js")); 

            bundles.Add(new StyleBundle("~/Content/css").Include(
                   "~/Content/bootstrap.css",
                   "~/Content/preloader.css",
                 "~/Content/Site.css"));

            bundles.Add(new StyleBundle("~/bundles/style").Include(
                      "~/Assets/themes/Notebook/css/app.css",
                      "~/Content/layout.css",
                      "~/Assets/themes/Notebook/js/toastr/toastr.css"));
            bundles.Add(new ScriptBundle("~/bundles/notebook").Include(
                      "~/Scripts/layout.js",
                       "~/Assets/themes/Notebook/js/app.js",
                       "~/Assets/themes/Notebook/js/app.plugin.js",
                        "~/Assets/themes/Notebook/js/slimscroll/jquery.slimscroll.min.js",
                       "~/Assets/themes/Notebook/js/toastr/toastr.min.js",
                       "~/Scripts/base.js"));

            bundles.Add(new ScriptBundle("~/bundles/notebook/dataTable").Include(
                      "~/Assets/themes/Notebook/js/datatables/jquery.dataTables.min.js",
                      "~/Assets/themes/Notebook/js/datatables/plugins/datatable.fnFilterClear.js",
                      "~/Assets/themes/Notebook/js/datatables/plugins/date-eu.js",
                      "~/Assets/themes/Notebook/js/datatables/plugins/rowReordering.js"
                      ));

            bundles.Add(new ScriptBundle("~/bundles/style/dataTable").Include(
                      "~/Assets/themes/Notebook/js/datatables/datatables.css"));

        }
    }
}
