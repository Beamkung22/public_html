var rowIdTimeUpdate = null;

function editSetting(rowIdTime) {
    $.ajax({
        url: "../functions/showlistTime/manage_time.php",
        method: "POST",
        data: "idTime=" + rowIdTime,
        success: function (data) {
            var res = data.split("|");
            rowIdTimeUpdate = res[0];
            //res[0] = rowid;
            //res[1] = Name;
            //res[2] = Type;
            //res[3] = flagfix;
            //res[4] = pricefix;
            //res[5] = price;
            $(".modal-body #timeopen").val(res[1]);
            $(".modal-body #timeclose").val(res[2]);

            $("#myModal").modal('show');
        }
    })
}

function submitEditTime() {
    if (new Date(document.getElementById("timeopen").value) >= new Date(document.getElementById("timeclose").value) ||
        new Date(document.getElementById("timeclose").value) <= new Date()) {
        alert("ใส่เวลาผิดพลาดกรุณาใส่ใหม่");
    } else {
        if (confirm("คุณต้องการจะบันทึกค่าใช่หรือไม่")) {
            $.ajax({
                url: "../functions/showlistTime/submit_manage_time.php",
                method: "POST",
                data: "idTime=" + rowIdTimeUpdate +
                    "&timeopen=" + document.getElementById("timeopen").value +
                    "&timeclose=" + document.getElementById("timeclose").value,
                success: function (data) {
                    $("#myModal").modal('toggle');
                    location.reload();
                }
            })
        }
    }
}

function delTime() {

    if (confirm("คุณต้องการจะลบเวลานี้ใช่หรือไม่")) {
        $.ajax({
            url: "../functions/showlistTime/delete_manage_time.php",
            method: "POST",
            data: "idTime=" + rowIdTimeUpdate,
            success: function (data) {
                $("#myModal").modal('toggle');
                location.reload();
            }
        })
    }
}