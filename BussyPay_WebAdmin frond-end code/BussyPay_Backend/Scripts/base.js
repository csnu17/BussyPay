if (typeof jQuery === 'undefined') { console.error('base script requires jQuery support') }

/* js cookie */
function setCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function updateCookie(name, value) {
    setCookie(name, value, 1);
}

function delCookie(name) {
    setCookie(name, "", -1);
}

 
/* set delay */
var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

/* notify msg */
function calert(cname) {
    var cvalue = getCookie(cname);
    if (cvalue != undefined && cvalue != "") {
        delCookie(cname);
        var obj = JSON.parse(cvalue);
        if (cname == "alertcookie") {
            notify(obj.type, obj.msg);
        } else {
            notiSweetAlert(obj.type, obj.msg);
        }
       
    }
    else {
        // calert not found
    }
}

function calert() {
    var cname = "alertcookie";
    var cvalue = getCookie(cname);
    if (cvalue != undefined && cvalue != "") {
        delCookie(cname);
        var obj = JSON.parse(cvalue);
        notify(obj.type, obj.msg);
    }
    else {
        cname = "sweetalertcookie";
        cvalue = getCookie(cname);
        if (cvalue != undefined && cvalue != "") {
            delCookie(cname);
            var obj = JSON.parse(cvalue);
            notiSweetAlert(obj.type, obj.msg); 
        } else {
            // calert not found
        }
    }
}

function notify(type, msg) {

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    if (type == 'danger') {
        type = 'error';
    }


    toastr[type](decodeURIComponent(msg));

}
  

function notiSweetAlert(type, msg) {
    if (type == 'danger') {
        type = 'error';
    }

    swal({
        title: decodeURIComponent(msg),
        icon: type,
        showCancelButton: false,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        button: "ตกลง",
    });
}