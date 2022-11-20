$('#check').click(function () {
    if ($(this).is(':checked')) {
        $('#save').removeClass("buttonDisabled");
    } else {
        $('#save').addClass("buttonDisabled");
    }
});

function insertNumber() {
    //if(confirm("Press a button!")){
    $.ajax({
        url: "../functions/setupproject/insert_product_1.php",
        method: "POST",
        data: "priceh1=" + document.getElementById("priceh1").value +
            "&pricel1=" + document.getElementById("pricel1").value +
            "&pricet=" + document.getElementById("pricet").value +
            "&pricel3=" + document.getElementById("pricel3").value +
            "&priceh3=" + document.getElementById("priceh3").value +
            "&pricel2=" + document.getElementById("pricel2").value +
            "&priceh2=" + document.getElementById("priceh2").value,
        beforeSend: function () {
            document.getElementById("myNav").style.width = "100%";
        },
        success: function (data) {
            document.getElementById("myNav").style.width = "0%";
        }
    })
    //}
}

function dateCompare(date1, date2, dateinput) {
    return new Date(dateinput) <= new Date(date2) && new Date(dateinput) >= new Date(date1);
}

function dateCompareCur(date1) {
    return new Date() > new Date(date1);
}
/* Change Number */
function changenumber() {
    $.ajax({
        type: 'POST',
        data: "action=" + document.getElementById("typechange").value,
        url: '../functions/setupproject/change_number_data.php',
        dataType: 'html',
        success: function () {
            document.getElementById(document.getElementById("typechange").value + "sell").selected = "true";
        }
    })
}

/* Number Fix */
$('#typenumber').change(function () {
    mainProcessEditNumber();
    return false;
});
$('#typechange').change(function () {
    changenumber();
    return false;
});

function editNumber(datainput, pagecurrent) {
    if (datainput.checked == true) {
        $.ajax({
            url: "../functions/setupproject/view_data_edit.php",
            method: "POST",
            data: "numberall=" + datainput.value +
                "&price=" + document.getElementById("price").value +
                "&typen=" + document.getElementById("typenumber").value +
                "&action=add",
            success: function (data) {
                $('#viewData').html(data);
                mainProcessEditNumber(pagecurrent);
            }
        })
    } else if (datainput.checked == false) {
        $.ajax({
            url: "../functions/setupproject/view_data_edit.php",
            method: "POST",
            data: "numberall=" + datainput.value +
                "&typen=" + document.getElementById("typenumber").value +
                "&action=del",
            success: function (data) {
                $('#viewData').html(data);
                mainProcessEditNumber(pagecurrent);
            }
        })
    }
}

function delNumber(rowId) {
    $.ajax({
        url: "../functions/setupproject/view_data_edit.php",
        method: "POST",
        data: "&IdDel=" + rowId +
            "&action=del",
        success: function (data) {
            $('#viewData').html(data);
            mainProcessEditNumber();
        }
    })

}

function mainProcessEditNumber(pagenumber) {
    if (pagenumber != null) {
        $.ajax({
            type: 'POST',
            data: "typenumber=" + document.getElementById("typenumber").value +
                "&pagenum=" + pagenumber,
            url: '../functions/setupproject/query_number_all.php',
            success: function (data) {
                $('#numberall').html(data);
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            data: "typenumber=" + document.getElementById("typenumber").value,
            url: '../functions/setupproject/query_number_all.php',
            success: function (data) {
                $('#numberall').html(data);
            }
        });
    }
}
/* End Process Number Fix */
/* Change Number */
function changenumbersell() {
    $.ajax({
        type: 'POST',
        data: "action=" + document.getElementById("typechangesell").value,
        url: '../functions/setupproject/change_number_data.php',
        dataType: 'html',
        success: function () {
            document.getElementById(document.getElementById("typechangesell").value + "edit").selected = "true";
        }
    })
}

/* Number Sell */
$('#typenumbersell').change(function () {
    mainProcessEditNumberSell();
    return false;
});
$('#typechangesell').change(function () {
    changenumbersell();
    return false;
});

function sellNumber(datainput, pagecurrent) {
    if (datainput.checked == true) {
        $.ajax({
            url: "../functions/setupproject/view_data_sell.php",
            method: "POST",
            data: "numberallsell=" + datainput.value +
                "&pricesell=" + document.getElementById("pricesell").value +
                "&typen=" + document.getElementById("typenumbersell").value +
                "&action=add",
            success: function (data) {
                $('#viewDataSell').html(data);
                mainProcessEditNumberSell(pagecurrent);
            }
        })
    } else if (datainput.checked == false) {
        $.ajax({
            url: "../functions/setupproject/view_data_sell.php",
            method: "POST",
            data: "numberallsell=" + datainput.value +
                "&typen=" + document.getElementById("typenumbersell").value +
                "&action=del",
            success: function (data) {
                $('#viewDataSell').html(data);
                mainProcessEditNumberSell(pagecurrent);
            }
        })
    }
}

function delSell(rowId) {
    $.ajax({
        url: "../functions/setupproject/view_data_sell.php",
        method: "POST",
        data: "&IdDelSell=" + rowId +
            "&action=del",
        success: function (data) {
            $('#viewDataSell').html(data);
            mainProcessEditNumberSell();
        }
    })

}

function mainProcessEditNumberSell(pagenumber) {
    if (pagenumber != null) {
        $.ajax({
            type: 'POST',
            data: "typenumber=" + document.getElementById("typenumbersell").value +
                "&pagenum=" + pagenumber,
            url: '../functions/setupproject/query_number_sell.php',
            success: function (data) {
                $('#numberdataSell').html(data);
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            data: "typenumber=" + document.getElementById("typenumbersell").value,
            url: '../functions/setupproject/query_number_sell.php',
            success: function (data) {
                $('#numberdataSell').html(data);
            }
        });
    }
}
/* End Process Number Sell */

$(document).ready(function () {

    $('#sample_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "../functions/setupproject/insert_product.php",
            method: "POST",
            data: $(this).serialize(),
            beforeSend: function () {
                document.getElementById("myNav").style.width = "100%";
            },
            success: function (data) {
                document.getElementById("myNav").style.width = "0%";
            }
        })
    });
});