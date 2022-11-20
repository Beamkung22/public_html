function insertChampions(rowIdTime){
    var validateInput = this.validateDataInput();
    if(!validateInput){
      if(confirm("Press a button!")){
        $.ajax({
           url:"../functions/manage_award/insert_champions.php",
           method:"POST",
           data:"champions="+document.getElementById("champions").value+
           "&H3_1="+document.getElementById("H3_1").value+
           "&L3_1="+document.getElementById("L3_1").value+
           "&L3_2="+document.getElementById("L3_2").value+
           "&L3_3="+document.getElementById("L3_3").value+
           "&L3_4="+document.getElementById("L3_4").value+
           
           "&T3_1="+document.getElementById("T3_1").value+
           "&T3_2="+document.getElementById("T3_2").value+
           "&T3_3="+document.getElementById("T3_3").value+
           "&T3_4="+document.getElementById("T3_4").value+
           "&T3_5="+document.getElementById("T3_5").value+
           "&T3_6="+document.getElementById("T3_6").value+
  
           "&H2_1="+document.getElementById("H2_1").value+
           "&L2_1="+document.getElementById("L2_1").value+
           "&H1_1="+document.getElementById("H1_1").value+
           "&H1_2="+document.getElementById("H1_2").value+
           "&H1_3="+document.getElementById("H1_3").value+
           "&L1_1="+document.getElementById("L1_1").value+
           "&L1_2="+document.getElementById("L1_2").value+
           "&rowIdTime="+rowIdTime,
           beforeSend:function()
           {
            document.getElementById("myNav").style.width = "100%";
           },
           success:function(data)
           {
             alert(data);
            document.getElementById("myNav").style.width = "0%";
           }
          })
      }
    }
  }
  function validateDataInput(){
    var booleanvalidate = false;
    if(document.getElementById("champions").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("champions").focus();
      booleanvalidate = true;
    }else if(document.getElementById("H3_1").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("H3_1").focus();
      booleanvalidate = true;
    }else if(document.getElementById("L3_1").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("L3_1").focus();
      booleanvalidate = true;
    }else if(document.getElementById("L3_2").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("L3_2").focus();
      booleanvalidate = true;
    }else if(document.getElementById("L3_3").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("L3_3").focus();
      booleanvalidate = true;
    }else if(document.getElementById("L3_4").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("L3_4").focus();
      booleanvalidate = true;
    }else if(document.getElementById("H2_1").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("H2_1").focus();
      booleanvalidate = true;
    }else if(document.getElementById("L2_1").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("L2_1").focus();
      booleanvalidate = true;
    }else if(document.getElementById("H1_1").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("H1_1").focus();
      booleanvalidate = true;
    }else if(document.getElementById("L1_1").value == ''){
      alert("กรุณากรอกรางวัลให้ครบถ้วน");
      document.getElementById("L1_1").focus();
      booleanvalidate = true;
    }
    return booleanvalidate;
  }