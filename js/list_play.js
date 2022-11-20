function deletelisyplay(numberNo){
    if(confirm("ท่านจะต้องการลบข้อมูล การเดิมพันนี้หรือไม่")){
      $.ajax({
         url:"../functions/mange_listplay/delete_listplay.php",
         method:"POST",
         data:"numberNo="+numberNo,
         success:function(data)
         {
           if(data == "Error"){
            alert("ไม่สามารถยกเลิกการเดิมพันได้");
           }else if(data == "Success"){
            alert("ยกเลิกสำเร็จ");
           }    
           location.reload();
         }
        })
    }
}