var formatTel = "^[0-9]{10}$";
var formatEmail = "^[\\w-_\\.+]*[\\w-_\\.]\\@([\\w]+\\.)+[\\w]+[\\w]$";
function checkDate() {
    var element1 = document.getElementById("promo_datestart").value;
    var element2 = document.getElementById("promo_dateend").value;
    if(element1 != '' && element2 != '' && element1>element2){
            alert("คุณกรอกวันที่ไม่ถูกต้อง");
            document.getElementById("promo_dateend").value = '';
        }
}

function checkemail(){
    var email = document.getElementById("admin_email").value;
    if(!email.match(formatEmail)){
        alert('ท่ายังไม่ได้กรอกข้อมูล อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
        document.getElementById("admin_email").value = '';
        document.getElementById("admin_email").focus();
        return false;    
    }
}

function checktel(){
    var tel = document.getElementById("admin_tel").value;
    if(!tel.match(formatTel)){
        alert('ท่ายังไม่ได้กรอกข้อมูล เบอร์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
        document.getElementById("admin_tel").value = '';
        document.getElementById("admin_tel").focus();
        return false;
    }
}

function checkemail_vet(){
    var email = document.getElementById("vet_email").value;
    if(!email.match(formatEmail)){
        alert('ท่ายังไม่ได้กรอกข้อมูล อีเมล์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
        document.getElementById("vet_email").value = '';
        document.getElementById("vet_email").focus();
        return false;    
    }
}

function checktel_vet(){
    var tel = document.getElementById("vet_tel").value;
    if(!tel.match(formatTel)){
        alert('ท่ายังไม่ได้กรอกข้อมูล เบอร์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
        document.getElementById("vet_tel").value = '';
        document.getElementById("vet_tel").focus();
        return false;
    }
}

function checktel_hos1(){
    var tel = document.getElementById("hos_tel").value;
    if(!tel.match(formatTel)){
        alert('ท่ายังไม่ได้กรอกข้อมูล เบอร์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
        document.getElementById("hos_tel").value = '';
        document.getElementById("hos_tel").focus();
        return false;
    }
}

function checktel_hos2(){
    var tel = document.getElementById("hos_tel2").value;
    if(!tel.match(formatTel)){
        alert('ท่ายังไม่ได้กรอกข้อมูล เบอร์ไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง');
        document.getElementById("hos_tel2").value = '';
        document.getElementById("hos_tel2").focus();
        return false;
    }
}

