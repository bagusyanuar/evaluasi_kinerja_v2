var url = window.location.pathname.split("/");
var lok2 = url[2];
var lok1 = url[1];
var lok3 = url[3];
$(document).ready(function () {
    // $(".dropdown-toggle").dropdown();
    setAktiv();
    $("#tambahdata").modal({
        backdrop: "static",
        keyboard: false,
    });
});

function setAktiv() {
    if (lok1 === undefined || lok1 === "") {
        $("#sidebar #dashboard").addClass("active");
    } else {
        $("#sidebar #" + lok1).addClass("active");
    }
}

function getParameter(param) {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    return urlParams.get(param);
}

function removeParam(key) {
    var rtn = window.location.href.split("?")[0],
        param,
        params_arr = [],
        queryString = (window.location.href.indexOf("?") !== -1) ? window.location.href.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

// NOTIFDROPDOWN

