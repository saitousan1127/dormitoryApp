
function check2() {
    console.log("起動2");
    const k_reason = document.getElementById('k_reason');
    if (k_reason.value == "") {
        error.innerHTML = "";
        error.innerHTML = "欠食理由が入力されていません．";
        return false;
    } else {
        return true;
    }
}


function check() {
    console.log("起動");
    var message = "";
    const s = Date.parse(document.getElementById("s_day").value);
    const f = Date.parse(document.getElementById("f_day").value);
    var today = new Date();
    today = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0, 0, 0);

    if (isNaN(s) || isNaN(f)) {
        message += "日付が入力されていません．<br>";
    }

    if (message == "" && s > f) {
        message += "日付の順序が正しくありません．<br>";
    }

    if (today.getTime() > s) {
        message += "過去の日付が入力されています<br>";
    }

    /*if(message==""&&three > f){
        message += "三日後の日付から有効です．<br>";
    }*/

    if (message) {
        const error = document.getElementById("error");
        error.innerHTML = "";
        error.innerHTML = message;
        return false;
    } else {
        return true;
    }


}