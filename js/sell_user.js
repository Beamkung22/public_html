var oldsearch = "";
this.onchecklenNumber(2);

function onchecklenNumber(lennumber){
    this.firstlogic();
    var clear = document.getElementById('clearcast');
    var searchfirst = document.getElementById('searchnumber');
    if(lennumber == 2){
        $.ajax({
            type: 'POST',
            data: "lennumber=2",
            url: '../functions/selluser/query_len_type_number_all.php',
            dataType: 'html',
            success: function(data) {
                $('#numbertype').html(data);
            }
        })
        if(searchfirst.value == ''){
        oncheckdataNumber(2,'H',1);
        }else{
        searchnumberpage(searchfirst.value,'H',2,1);
        }
        pagecurrent('1','H','2');
        clear.setAttribute("onclick", "clearcast('1','H','2')");  
        searchfirst.setAttribute("onchange", "searchnumber(this,'H','2')");
    }else if(lennumber == 3){
        $.ajax({
            type: 'POST',
            data: "lennumber=3",
            url: '../functions/selluser/query_len_type_number_all.php',
            dataType: 'html',
            success: function(data) {
                $('#numbertype').html(data);
            }
        })   
        if(searchfirst.value == ''){
        oncheckdataNumber(3,'H',1);
        }else{
        searchnumberpage(searchfirst.value,'H',3,1);
        }
        pagecurrent('1','H','3');
        clear.setAttribute("onclick", "clearcast('1','H','3')");
        searchfirst.setAttribute("onchange", "searchnumber(this,'H','3')");
    }else if(lennumber == 1){
        $.ajax({
            type: 'POST',
            data: "lennumber=1",
            url: '../functions/selluser/query_len_type_number_all.php',
            dataType: 'html',
            success: function(data) {
                $('#numbertype').html(data);
            }
        })
        if(searchfirst.value == ''){
        oncheckdataNumber(1,'H',1);
        }else{
        searchnumberpage(searchfirst.value,'H',1,1);
        }
        pagecurrent('1','H','1');
        clear.setAttribute("onclick", "clearcast('1','H','1')");
        searchfirst.setAttribute("onchange", "searchnumber(this,'H','1')");
    }
}

function oncheckdataNumber(lennumber,typenumber,page){    
    pagecurrent(page,typenumber,lennumber);
    if(document.getElementById("searchnumber").value == ''){
    $.ajax({
            type: 'POST',
            data: "lennumber="+lennumber+"&typenumber="+typenumber+"&pagenum="+page,
            url: '../functions/selluser/query_type_number_all.php',
            dataType: 'html',
            success: function(data) {
                $('#datanumber').html(data);
                var searchbox = document.getElementById('searchnumber');
                searchbox.setAttribute("onchange", "searchnumber(this,'"+typenumber+"','"+lennumber+"')");
                firstlogic();
            }
        })
    }else{
    searchnumberpage(document.getElementById("searchnumber").value,typenumber.substring(0, 1),lennumber,page);
    }
}

function oncheckNumber(datainput,typenumber,page){
if(datainput.checked == true){
    $.ajax({
        url:"../functions/selluser/check_number.php",
        method:"POST",
        data:"number="+datainput.value+
        "&typenumber="+typenumber,
        success:function(data)
        {
          var res = data.split("|");
          var flagfix = res[0];
          var pricefix = res[1];
          var type = res[2];
          var flagprice = res[3];
          var price = res[4];
          //res[0] = flagfix;
          //res[1] = pricefix;
          //res[2] = Type;
          //res[3] = flagprice;
          //res[4] = price;
          var messageAlert;
          var checkfix = false;
          var checkprice = false;
          
          if(flagfix == "Y"){
            if(parseInt(pricefix) < parseInt(document.getElementById("pricesell").value)){
                alert("จำนวนเงินคงเหลือที่สามารถเดิมพันได้ "+pricefix+" บาท ");
                datainput.checked = false;
            }else{
                checkfix = true;
            }
          }else{
            checkfix = true;
          }
          if(flagprice == "Y"){
            messageAlert = "ตัวเลขที่คุณเดิมพัน จ่ายบาทละ "+price+" บาท ";
            checkprice = true;
          }
          if(checkfix){
            if(checkprice){
                if(confirm(messageAlert)){
                  $.ajax({
                      type: 'POST',
                      data: "action=add&number="+datainput.value+
                      "&typenumber="+typenumber+
                      "&price="+document.getElementById("pricesell").value,
                      url: '../functions/selluser/cast_number.php',
                      dataType: 'html',
                      success: function(data) {
                          $('#cast_market').html(data);
                          if(document.getElementById("searchnumber").value == ''){
                          oncheckdataNumber(datainput.value.length,typenumber.substring(0, 1),page);
                          }else{
                          searchnumberpage(document.getElementById("searchnumber").value,typenumber.substring(0, 1),datainput.value.length,page);
                          }
                          counttotalall();
                      }
                  })
                }else{
                  datainput.checked = false;
                }
            }else{
                $.ajax({
                    type: 'POST',
                    data: "action=add&number="+datainput.value+
                    "&typenumber="+typenumber+
                    "&price="+document.getElementById("pricesell").value,
                    url: '../functions/selluser/cast_number.php',
                    dataType: 'html',
                    success: function(data) {
                        $('#cast_market').html(data);
                        if(document.getElementById("searchnumber").value == ''){
                        oncheckdataNumber(datainput.value.length,typenumber.substring(0, 1),page);
                        }else{
                        searchnumberpage(document.getElementById("searchnumber").value,typenumber.substring(0, 1),datainput.value.length,page);
                        }
                        counttotalall();
                    }
                })
            }
          }
        }
        })
}else if(datainput.checked == false){
    $.ajax({
            type: 'POST',
            data: "action=del&number="+datainput.value+
            "&typenumber="+typenumber+
            "&price="+document.getElementById("pricesell").value,
            url: '../functions/selluser/cast_number.php',
            dataType: 'html',
            success: function(data) {
                $('#cast_market').html(data);
                if(document.getElementById("searchnumber").value == ''){
                oncheckdataNumber(datainput.value.length,typenumber.substring(0, 1),page);
                }else{
                searchnumberpage(document.getElementById("searchnumber").value,typenumber.substring(0, 1),datainput.value.length,page);
                }
                counttotalall();
            }
        })
}
}

function changetotalprice(datainput,number,typenumber){
    $.ajax({
        url:"../functions/selluser/check_number.php",
        method:"POST",
        data:"number="+number+
        "&typenumber="+typenumber,
        success:function(data)
        {
          var res = data.split("|");
          var flagfix = res[0];
          var pricefix = res[1];
          //res[0] = flagfix;
          //res[1] = pricefix;
          //res[2] = Type;
          //res[3] = flagprice;
          if(flagfix == "Y"){
            if(parseInt(pricefix) < parseInt(datainput.value)){
                alert("จำนวนเงินคงเหลือที่สามารถเดิมพันได้ "+pricefix+" บาท ");
                datainput.value = 0;
            }
          }
            $.ajax({
                type: 'POST',
                data: "action=count&price="+datainput.value+
                "&typenumber="+typenumber+
                "&number="+number,
                url: '../functions/selluser/cast_number.php',
                dataType: 'html',
                success: function(data) {
                    $('#cast_market').html(data);
                    counttotalall();
                }
            })
            }
        })
}

function changenumber(data,curtype,curlen,page){
    $.ajax({
            type: 'POST',
            data: "action="+data,
            url: '../functions/selluser/change_number_data.php',
            dataType: 'html',
            success: function(data) {
                $('#changenumber').html(data); 
                var searchfirst = document.getElementById('searchnumber');
                if(searchfirst.value == ''){
                searchfirst.value = oldsearch;
                }
                searchfirst.setAttribute("onchange", "searchnumber(this,'"+curtype.substring(0, 1)+"','"+curlen+"')");
            }
        })
}

function firstlogic(){
    $.ajax({
    url: '../functions/selluser/cast_number.php',
    success: function(data) {
        $('#cast_market').html(data);
        counttotalall();
    }
    })
}

function counttotalall(){
    $.ajax({
            url: '../functions/selluser/total_selluser.php',
            success: function(data) {
                $('#total_sell').html(data);
            }
        })
}

function clearcast(page,typecur,lennum){
    $.ajax({
            url: '../../functions/selluser/clear_cast.php',
            success: function(data) {
            //location.reload();
            if(document.getElementById("searchnumber").value == ''){
                oncheckdataNumber(lennum,typecur.substring(0, 1),page);
            }else{
                searchnumberpage(document.getElementById("searchnumber").value,typecur.substring(0, 1),lennum,page);
            }
            firstlogic();
            }
        })
}

function clearonecast(datacast,typenumber,typepage,numberlen,page){
    $.ajax({
            type: 'POST',
            data: "action=delone"+
            "&typenumber="+typenumber+
            "&rownumber="+datacast,
            url: '../functions/selluser/cast_number.php',
            dataType: 'html',
            success: function(data) {
                $('#cast_market').html(data);
                if(document.getElementById("searchnumber").value == ''){
                oncheckdataNumber(numberlen,typepage.substring(0, 1),page);
                }else{
                searchnumberpage(document.getElementById("searchnumber").value,typepage.substring(0, 1),numberlen,page);
                }
                counttotalall();
            }
        })
}

function pagecurrent(page,typecur,lennum){
    var clearfirst = document.getElementById('clearcast');
    clearfirst.setAttribute("onclick", "clearcast('"+page+"','"+typecur+"','"+lennum+"')");
    $.ajax({
            type: 'POST',
            data: "pagenum="+page+
            "&typecurrent="+typecur+
            "&lennum="+lennum,
            url: '../functions/selluser/currentdata.php',
            dataType: 'html',
            success: function(data) {
            firstlogic();
            }
        })
}

function searchnumber(datasearch,typenumber,lennumber){
    oldsearch = datasearch.value;
    $.ajax({
            type: 'POST',
            data: "lennumber="+lennumber+"&typenumber="+typenumber+"&pagenum=1&numberdata="+datasearch.value,
            url: '../functions/selluser/query_type_number_all.php',
            dataType: 'html',
            success: function(data) {
                $('#datanumber').html(data);
                firstlogic();
            }
        })
}

function searchnumberpage(datasearch,typenumber,lennumber,page){
    oldsearch = datasearch;
    $.ajax({
            type: 'POST',
            data: "lennumber="+lennumber+"&typenumber="+typenumber+"&pagenum="+page+"&numberdata="+datasearch,
            url: '../functions/selluser/query_type_number_all.php',
            dataType: 'html',
            success: function(data) {
                $('#datanumber').html(data);
                firstlogic();
            }
        })
}

function submitcase(){
    if(confirm("ยืนยันการลงเดิ่มพัน หากลงเดิมพันแล้วจะไม่สามารถย้อนกลับได้")){
    $.ajax({
            url: '../functions/selluser/submit_case.php',
            dataType: 'html',
            success: function(data) {
                if(data == "Success"){
                alert("ลงเดิมพันสำเร็จ");
                location.reload();
                }else if(data == "Error1"){
                alert("ท่านกรอกข้อมูลไม่ครบถ้วน");
                }else if(data == "Error2"){
                alert("จำนวนเงินที่ท่านมีไม่พอที่จะลงเดิมพัน");
                }else if(data.includes("Error3")){
                var dat = data.split("|");
                alert("จำนวนเงินที่ซื้อได้ ท่านซื้อเกินจำนวน\n เลข "+dat[1]+" "+dat[2]+" เล่นได้จำนวน : "+dat[3]+" บาท");
                }else if(data == "Error4"){
                alert("ร้านปิดแล้วกรุณารองวดถัดไป");
                window.location.href="page_listplay.php";
                }
            }
        })
    }
}
