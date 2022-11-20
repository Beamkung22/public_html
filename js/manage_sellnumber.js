var rowIdNumberUpdate = null;
    function editSetting(rowIdNumber){
          $.ajax({
            url:"../functions/showNumberSell/manage_number.php",
            method:"POST",
            data:"idNumber="+rowIdNumber,
            success:function(data)
            {
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
              $(".modal-body #price_fix").val(res[4]);
              if(res[3] == "N"){
                $(".modal-body #testN").addClass("active");
                $(".modal-body #testY").removeClass("active");
                document.getElementById("Y").checked = false;
                document.getElementById("N").checked = true;
                //$(".modal-body #N").attr("checked","");
                //$(".modal-body #Y").removeAttr("checked");
                document.getElementById("price_fix").disabled = true;
              }else{ 
                $(".modal-body #testY").addClass("active");
                $(".modal-body #testN").removeClass("active");
                //$(".modal-body #Y").attr("checked","");
                //$(".modal-body #N").removeAttr("checked");
                document.getElementById("N").checked = false;
                document.getElementById("Y").checked = true;
                document.getElementById("price_fix").disabled = false;
              }
              $("#myModal").modal('show');
            }
            })
    }
    function myDisabledInput(TypeCheck) {
      if(TypeCheck == 'Y'){
        document.getElementById("price_fix").disabled = false;
      }else{
        document.getElementById("price_fix").disabled = true;
      }
    }
    function submitEditNumber(){
      if(confirm("คุณต้องการจะบันถทึกค่าใช่หรือไม่")){
        var flagfix = 'N';
        if(document.getElementById("Y").checked){
          flagfix = document.getElementById("Y").value;
        }else if(document.getElementById("N").checked){
          flagfix = document.getElementById("N").value;
        }
            $.ajax({
              url:"../functions/showNumberSell/submit_manage_number.php",
              method:"POST",
              data:"idNumber="+rowIdNumberUpdate+
              "&flagfix="+flagfix+
              "&pricefix="+document.getElementById("price_fix").value,
              success:function(data)
              {
                $("#myModal").modal('toggle');
                location.reload();
              }
              })
      }
    }
