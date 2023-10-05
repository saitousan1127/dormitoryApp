window.onload = function () {
    console.log('読み込み完了');
}


function clickDeleteBtn(roomnum) {
    console.log(roomnum);
    // 追加で送信するパラメータ
    var newValue = document.createElement('input');
    // 画面に表示されてしまうので、隠す
    newValue.type = "hidden";
    // パラメータ名
    newValue.name = "delete[" + roomnum + "]";
    // パラメータ値
    newValue.value = roomnum;

    // フォームの要素に加えることで、submit時に追加したパラメータも送信される
    document.forms[0].appendChild(newValue);

    const row = document.getElementById(roomnum);
    row.remove();
}