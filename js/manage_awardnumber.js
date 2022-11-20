var rowIdNumberUpdate = null;

function editSetting(rowIdNumber) {
    $.ajax({
        url: "../functions/showNumberSell/manage_number.php",
        method: "POST",
        data: "idNumber=" + rowIdNumber,
        success: function (data) {
            var res = data.split("|");
            rowIdNumberUpdate = res[0];
            //res[0] = rowid;
            //res[1] = Name;
            //res[2] = Type;
            //res[3] = flagfix;
            //res[4] = pricefix;
            //res[5] = price;
            $(".modal-body #name").val(res[1]);
            $(".modal-body #type").val(res[2]);
            $(".modal-body #price").val(res[5]);

            $("#myModal").modal('show');
        }
    })
}

function submitEditNumber() {
    if (confirm("คุณต้องการจะบันทึกค่าใช่หรือไม่")) {
        $.ajax({
            url: "../functions/showNumberSell/submit_manage_number.php",
            method: "POST",
            data: "idNumber=" + rowIdNumberUpdate +
                "&price=" + document.getElementById("price").value,
            success: function (data) {
                $("#myModal").modal('toggle');
                location.reload();
            }
        })
    }
}