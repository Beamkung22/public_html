var rowIdMemberUpdate = null;
var nameMember = null;
var credit = null;
//Main Manu
function mainmenu(rowId){
  $.ajax({
        url:"../functions/showMember/manage_member.php",
        method:"POST",
        data:"idMember="+rowId,
        success:function(data)
        {
          var res = data.split("|");
          rowIdMemberUpdate = res[0];
          nameMember = res[1];
          credit = res[2];
          document.getElementById("editProfile").setAttribute("onclick", "editProfile('"+rowIdMemberUpdate+"')");
          document.getElementById("editChangePassword").setAttribute("onclick", "editChangePassword()");
          document.getElementById("addCredit").setAttribute("onclick", "addCredit()");
          document.getElementById("delCredit").setAttribute("onclick", "delCredit()");
          document.getElementById("delProfile").setAttribute("onclick", "delProfile()");
          $('#name').html(nameMember);
          $("#myModal").modal('show');
        }
        })
}
function backmamu(name){
    $("#"+name).modal('hide');
    $("#myModal").modal('show');
}
//Edit Profile
function editProfile(rowId){
    $.ajax({
        url:"../functions/showMember/manage_edit_member.php",
        method:"POST",
        data:"idMember="+rowId,
        success:function(data)
        {
          var res = data.split("|");
          rowIdMemberUpdate = res[0];
   
          $(".modal-body #newname").val(res[1]);
          $(".modal-body #newemail").val(res[2]);
          $(".modal-body #newtel").val(res[3]);
          editstatus(res[4]);
          if(res[6] == "customer"){
            document.getElementById("classChange").style.display = "none";
          }else{
            document.getElementById("classChange").style.display = "block";
            editclass(res[5]);
          }
          $(".modal-body #newaccountno").val(res[7]);
          $('#editname').html(nameMember);
          $("#myModalEdit").modal('show');
          $("#myModal").modal('hide');
        }
        })

}
function editstatus(status){
  $.ajax({
    type: 'POST',
    data: "oldstatus="+status,
    url: '../functions/showMember/edit_status.php',
    success: function(data) {
        $('#newstatus').html(data);
    }
});
}
function editclass(oldclass){
  $.ajax({
    type: 'POST',
    data: "oldclass="+oldclass,
    url: '../functions/showMember/edit_class.php',
    success: function(data) {
        $('#newclass').html(data);
    }
});
}
function submitEditProfile(){
  if(confirm("คุณต้องการจะบันทึกค่าใช่หรือไม่")){
        $.ajax({
          url:"../functions/showMember/submit_manage_profile.php",
          method:"POST",
          data:"idMember="+rowIdMemberUpdate+
          "&newname="+document.getElementById("newname").value+
          "&newemail="+document.getElementById("newemail").value+
          "&newtel="+document.getElementById("newtel").value+
          "&newstatus="+document.getElementById("newstatus").value+
          "&newclass="+document.getElementById("newclass").value+
          "&newaccountno="+document.getElementById("newaccountno").value,
          success:function(data)
          {
            $("#myModalEdit").modal('toggle');
            location.reload();
          }
          })
  }
}
// Edit ChangePassword
function editChangePassword(){
  $('#changeName').html(nameMember);
  $("#myModalChangePassword").modal('show');
  $("#myModal").modal('hide');
}
function submitChangePassword(){
  if(document.getElementById("passwordnew").value == ""){
    alert("newPassword คุณยังไม่ได้กรอกกรุณากรอก");
  }else if(document.getElementById("passwordnew2").value == ""){
    alert("Confirm Password คุณยังไม่ได้กรอกกรุณากรอก");
  }else if(document.getElementById("passwordnew").value != document.getElementById("passwordnew2").value){
    alert("คุณกรอก Confirm Password ไม่ตรงกัน");
  }else{
    if(confirm("คุณต้องการแก้ไขรหัสผ่านหรือไม่")){
          $.ajax({
            url:"../functions/showMember/change_password.php",
            method:"POST",
            data:"idMember="+rowIdMemberUpdate+
            "&passwordnew="+document.getElementById("passwordnew").value,
            success:function(data)
            {
              if(data == "Success"){
                alert("บันทึกข้อมูลสำเร็จ");
              }else if(data == "Error"){
                alert("บันทึกข้อมูลไม่สำเร็จ");
              }
              $("#myModalChangePassword").modal('toggle');
              location.reload();
            }
            })
    }
  }
}
// Edit AddCredit
function addCredit(){
  $('#creditupName').html(nameMember);
  $("#myModalAddCredit").modal('show');
  $("#myModal").modal('hide');
}
function submitAddCredit(){
  if(document.getElementById("creditAdd").value == ""){
    alert("คุณยังไม่ได้กรอก จำนวนเงิน กรุณากรอก");
  }else if(document.getElementById("creditAdd").value.substr(0, 1) == "-"){
    alert("คุณกรอก จำนวนเงิน ติดลบไม่ได้กรุณากรอกใหม่");
  }else{
    if(confirm("คุณต้องการเพิ่มจำนวนเงินหรือไม่")){
          $.ajax({
            url:"../functions/showMember/credit_member.php",
            method:"POST",
            data:"idMember="+rowIdMemberUpdate+
            "&creditAdd="+document.getElementById("creditAdd").value+
            "&creditOld="+credit+
            "&action=add",
            success:function(data)
            {
              if(data == "Success"){
                alert("บันทึกข้อมูลสำเร็จ");
              }else if(data == "Error"){
                alert("บันทึกข้อมูลไม่สำเร็จ");
              }
              $("#myModalAddCredit").modal('toggle');
              location.reload();
            }
            })
    }
  }
}
// Edit DelCredit
function delCredit(){
  $('#creditDownName').html(nameMember);
  $("#myModalDelCredit").modal('show');
  $("#myModal").modal('hide');
}
function submitdelCredit(){
  if(document.getElementById("creditDelete").value == ""){
    alert("คุณยังไม่ได้กรอก จำนวนเงิน กรุณากรอก");
  }else if(document.getElementById("creditDelete").value.substr(0, 1) == "-"){
    alert("คุณกรอก จำนวนเงิน ติดลบไม่ได้กรุณากรอกใหม่");
  }else{
    if(confirm("คุณต้องการลดจำนวนเงินหรือไม่")){
          $.ajax({
            url:"../functions/showMember/credit_member.php",
            method:"POST",
            data:"idMember="+rowIdMemberUpdate+
            "&creditDelete="+document.getElementById("creditDelete").value+
            "&creditOld="+credit+
            "&action=del",
            success:function(data)
            {
              if(data == "Success"){
                alert("บันทึกข้อมูลสำเร็จ");
              }else if(data == "Error"){
                alert("บันทึกข้อมูลไม่สำเร็จ");
              }
              $("#myModalDelCredit").modal('toggle');
              location.reload();
            }
            })
    }
  }
}
// Edit DeleteProfile
function delProfile(){
  if(confirm("คุณต้องการลบข้อมูลบุคคลากรคนนี้ใช่หรือไม่")){
          $.ajax({
            url:"../functions/showMember/del_member.php",
            method:"POST",
            data:"idMember="+rowIdMemberUpdate,
            success:function(data)
            {
              if(data == "Success"){
                alert("ลบข้อมูลสำเร็จ");
              }else if(data == "Error"){
                alert("ลบข้อมูลไม่สำเร็จ");
              }
              $("#myModal").modal('toggle');
              location.reload();
            }
            })
  }
}