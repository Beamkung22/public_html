function onchangeChampions(dataInput) {
    if (dataInput.value.length == 6) {
        var h3 = dataInput.value.substring(3);
        document.getElementById("H3_1").value = h3;

        this.onchangeT('', h3);

        var h2 = dataInput.value.substring(4);
        document.getElementById("H2_1").value = h2;
        this.onchangeOne(h3);
    }
}

function onchangeT(dataInput, datachange) {
    var ss = '';
    var h3 = '';
    if (dataInput != '' && dataInput.value != '') {
        h3 = dataInput.value;
    } else if (datachange != '') {
        h3 = datachange;
    }
    if (h3.length == 3) {
        var number1 = h3.substring(0, 1);
        var number2 = h3.substring(1, 2);
        var number3 = h3.substring(2, 3);
        var t0 = number1 + number2 + number3
        var t1 = number1 + number3 + number2
        var t2 = number2 + number3 + number1
        var t3 = number3 + number2 + number1
        var t4 = number2 + number1 + number3
        var t5 = number3 + number1 + number2
        if (t0 == t1 && t0 == t2 &&
            t0 == t3 && t0 == t4 &&
            t0 == t5) {
            document.getElementById("T3_1").value = t0;
            document.getElementById("T3_2").setAttribute("type", "hidden");
            document.getElementById("T3_2").value = '';
            document.getElementById("T3_3").setAttribute("type", "hidden");
            document.getElementById("T3_3").value = '';
            document.getElementById("T3_4").setAttribute("type", "hidden");
            document.getElementById("T3_4").value = '';
            document.getElementById("T3_5").setAttribute("type", "hidden");
            document.getElementById("T3_5").value = '';
            document.getElementById("T3_6").setAttribute("type", "hidden");
            document.getElementById("T3_6").value = '';
        } else if (t0 == t1 && t2 == t3 &&
            t4 == t5 && t1 != t2 &&
            t3 != t4) {
            document.getElementById("T3_1").value = t0;
            document.getElementById("T3_2").value = t2;
            document.getElementById("T3_3").value = t4;
            document.getElementById("T3_4").setAttribute("type", "hidden");
            document.getElementById("T3_4").value = '';
            document.getElementById("T3_5").setAttribute("type", "hidden");
            document.getElementById("T3_5").value = '';
            document.getElementById("T3_6").setAttribute("type", "hidden");
            document.getElementById("T3_6").value = '';
        } else if (t0 == t4 && t1 == t2 &&
            t3 == t5 && t4 != t1 &&
            t2 != t3) {
            document.getElementById("T3_1").value = t0;
            document.getElementById("T3_2").value = t1;
            document.getElementById("T3_3").value = t3;
            document.getElementById("T3_4").setAttribute("type", "hidden");
            document.getElementById("T3_4").value = '';
            document.getElementById("T3_5").setAttribute("type", "hidden");
            document.getElementById("T3_5").value = '';
            document.getElementById("T3_6").setAttribute("type", "hidden");
            document.getElementById("T3_6").value = '';
        } else if (t0 == t3 && t1 == t5 &&
            t2 == t4 && t3 != t1 &&
            t5 != t2) {
            document.getElementById("T3_1").value = t0;
            document.getElementById("T3_2").value = t1;
            document.getElementById("T3_3").value = t2;
            document.getElementById("T3_4").setAttribute("type", "hidden");
            document.getElementById("T3_5").setAttribute("type", "hidden");
            document.getElementById("T3_6").setAttribute("type", "hidden");
        } else {
            document.getElementById("T3_1").value = t0;
            document.getElementById("T3_2").setAttribute("type", "text");
            document.getElementById("T3_2").value = t1;
            document.getElementById("T3_3").setAttribute("type", "text");
            document.getElementById("T3_3").value = t2;
            document.getElementById("T3_4").setAttribute("type", "text");
            document.getElementById("T3_4").value = t3;
            document.getElementById("T3_5").setAttribute("type", "text");
            document.getElementById("T3_5").value = t4;
            document.getElementById("T3_6").setAttribute("type", "text");
            document.getElementById("T3_6").value = t5;
        }
    }
}

function onchangeOne(datachange) {
    var h3 = '';
    if (datachange != '') {
        h3 = datachange;
    }
    if (h3.length == 3) {
        var number1 = h3.substring(0, 1);
        var number2 = h3.substring(1, 2);
        var number3 = h3.substring(2, 3);
        if (number1 == number2 && number2 == number3 && number1 == number3) {
            document.getElementById("H1_1").value = number1;
            document.getElementById("H1_2").setAttribute("type", "hidden");
            document.getElementById("H1_2").value = '';
            document.getElementById("H1_3").setAttribute("type", "hidden");
            document.getElementById("H1_3").value = '';
        } else if (number1 == number2 && number1 != number3 && number2 != number3) {
            document.getElementById("H1_1").value = number1;
            document.getElementById("H1_2").value = number3;
            document.getElementById("H1_3").setAttribute("type", "hidden");
            document.getElementById("H1_3").value = '';
        } else if (number1 == number3 && number1 != number2 && number2 != number3) {
            document.getElementById("H1_1").value = number1;
            document.getElementById("H1_2").value = number2;
            document.getElementById("H1_3").setAttribute("type", "hidden");
            document.getElementById("H1_3").value = '';
        } else if (number2 == number3 && number2 != number1 && number3 != number1) {
            document.getElementById("H1_1").value = number1;
            document.getElementById("H1_2").value = number2;
            document.getElementById("H1_3").setAttribute("type", "hidden");
            document.getElementById("H1_3").value = '';
        } else {
            document.getElementById("H1_1").value = number1;
            document.getElementById("H1_2").value = number2;
            document.getElementById("H1_3").setAttribute("type", "text");
            document.getElementById("H1_3").value = number3;
        }
    }
}

function onchangeOneLow(dataInput) {
    if (dataInput.value.length == 2) {
        var l2 = dataInput.value;
        var number1 = l2.substring(0, 1);
        var number2 = l2.substring(1, 2);
        if (number1 == number2) {
            document.getElementById("L1_1").value = number1;
            document.getElementById("L1_2").setAttribute("type", "hidden");
            document.getElementById("L1_2").value = '';
        } else {
            document.getElementById("L1_1").value = number1;
            document.getElementById("L1_2").setAttribute("type", "text");
            document.getElementById("L1_2").value = number2;
        }
    }
}