function clickChild() {
  console.log('停止');
  event.stopPropagation();
}

function check() {
  const Apps = document.getElementsByClassName('Apps');
  const Comments = document.getElementsByClassName('Comments');
  const error = document.getElementById('error2');

  flag = 'ok';
  for (let i = 0; i < Apps.length; i++) {
    if (Apps[i].value === "非承認" && Comments[i].value === "") {
      flag = 'non_comment';
    }
    if (Apps[i].value === "承認or非承認") {
      flag = 'non_app';
    }
  }

  console.log(flag);
  switch (flag) {
    case 'ok':
      return true;
    case 'non_comment':
      error.innerHTML = "非承認でコメントが入力されていない外泊申請があります．";
      return false;
    case 'non_app':
      error.innerHTML = "承認・非承認が選ばれていない外泊申請があります．";
      return false;

    default:
  }
}

function formCheck() {
  const form = document.getElementById('room_search_key');
  const error = document.getElementById('error');
  const button = document.getElementById('exe');
  const pattern = /^[2-5][0,1][1-4,6-9][A,B]$/;
  if (form.value.match(pattern) || form.value == "") {
    button.style.display = "block";
    error.innerHTML = "";
  } else {
    button.style.display = "none";
    error.innerHTML = "<font size='0.5' color='red'>正しい部屋番号を入力してください</font>";
  }
}


function clickAppBtn(gaihaku_id) {
  const appElements = document.getElementsByClassName(gaihaku_id);
  const row = document.getElementById(gaihaku_id);
  //const hidden = document.getElementById(gaihaku_id+"app");
  if (appElements[0].value === "非承認" || appElements[0].value === "承認or非承認") {
    row.style.backgroundColor = "#b0c4de";             //一つの申請の行
    appElements[0].value = "承認";                     //リストのボタン
    appElements[1].value = "承認";                     //hiddenのvalue
    appElements[2].style.backgroundColor = "#b0c4de"; //オーバーレイのinner
    appElements[3].value = "承認";                    //オーバーレイの中のボタン
  } else if (appElements[0].value === "承認") {
    row.style.backgroundColor = "#ff7f50";
    appElements[0].value = "非承認";
    appElements[1].value = "非承認";
    appElements[2].style.backgroundColor = "#ff7f50";
    appElements[3].value = "非承認";
  }
}

function clickSFBtn(sort, spe_class, tou, floor) {
  if (sort != "") {
    console.log("ソート設定");
    document.getElementById('subA').checked = false;
    document.getElementById(sort).checked = true;
  } else {
    document.getElementById('subA').checked = true;
  }
  if (spe_class != "") {
    if (spe_class != "normal") {
      console.log("クラス設定");
      document.getElementById('all_class').selected = false;
      document.getElementById(spe_class).selected = true;
    }
  } else {
    if (document.getElementById('all_class') != null) {
      document.getElementById('all_class').selected = true;
    }
  }
  if (tou != "") {
    console.log("棟設定");
    document.getElementById('all_tou').selected = false;
    switch (tou) {
      case "北寮":
        document.getElementById('north').selected = true;
        break;
      case "女子寮":
        document.getElementById('east').selected = true;
        break;
      case "南寮":
        document.getElementById('east').selected = true;
        break;
      default:
    }
  } else {
    document.getElementById('all_tou').selected = true;
  }
  if (floor != "") {
    console.log("階設定");
    document.getElementById('all_floor').selected = false;
    document.getElementById("floor" + floor).selected = true;
  } else {
    document.getElementById('all_floor').selected = true;
  }
  const overlay = document.getElementById('sf');
  overlay.classList.remove('back-overlay-off');
  overlay.classList.add('back-overlay-on');

}

function clickSendBtn(gaihaku_id, state) {
  const row = document.getElementById(gaihaku_id);
  const appElements = document.getElementsByClassName(gaihaku_id);

  const comment = document.getElementById(gaihaku_id + 'text1');

  var fd = new FormData();
  fd.append('type', 'gaihaku');
  fd.append('gaihaku_id', gaihaku_id);
  fd.append('app', appElements[0].value);
  fd.append('comment', comment.value);
  fd.append('state', state);
  console.log(appElements[0].value);
  if (appElements[0].value == '承認' || (appElements[0].value == '非承認' && comment.value != "")) {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      console.log("readyState:" + request.readyState);
      if (request.readyState == 4) {
        if (request.status == 200) {
          console.log('実行');
          row.remove();
        }
      }
    }
    request.open('POST', '../asyn/app.php');
    request.send(fd);
  } else if (appElements[0].value == '承認or非承認') {
    const error = document.getElementById('error2');
    const errorInOverlay = document.getElementById(gaihaku_id + 'error');
    error.innerHTML = "承認にするか非承認にするかを決定してください．";
    errorInOverlay.innerHTML = "左にあるボタンで承認にするか非承認にするかを決定してください．";
  } else {
    const error = document.getElementById('error2');
    const errorInOverlay = document.getElementById(gaihaku_id + 'error');
    error.innerHTML = "非承認にする場合はコメントを記入してください．";
    errorInOverlay.innerHTML = "非承認にする場合はコメントを記入してください．";
  }
}

function clickSendBtnInOverlay(gaihaku_id, state) {
  const row = document.getElementById(gaihaku_id);
  const appElements = document.getElementsByClassName(gaihaku_id);

  const comment = document.getElementById(gaihaku_id + 'text2');

  var fd = new FormData();
  fd.append('type', 'gaihaku');
  fd.append('gaihaku_id', gaihaku_id);
  fd.append('app', appElements[0].value);
  fd.append('comment', comment.value);
  fd.append('state', state);
  if (appElements[0].value == '承認' || (appElements[0].value == '非承認' && comment.value != "")) {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      console.log("readyState:" + request.readyState);
      if (request.readyState == 4) {
        if (request.status == 200) {
          console.log('実行');
          row.remove();
        }
      }
    }
    request.open('POST', '../asyn/app.php');
    request.send(fd);
  } else if (appElements[0].value == '承認or非承認') {
    const error = document.getElementById('error2');
    const errorInOverlay = document.getElementById(gaihaku_id + 'error');
    error.innerHTML = "承認にするか非承認にするかを決定してください．";
    errorInOverlay.innerHTML = "左にあるボタンで承認にするか非承認にするかを決定してください．";
  } else {
    const error = document.getElementById('error2');
    const errorInOverlay = document.getElementById(gaihaku_id + 'error');
    error.innerHTML = "非承認にする場合はコメントを記入してください．";
    errorInOverlay.innerHTML = "非承認にする場合はコメントを記入してください．";
  }
}

function clickClose(id) {
  const overlay = document.getElementById(id + 'overlay');
  const text1 = document.getElementById(id + 'text1');
  const text2 = document.getElementById(id + 'text2');
  overlay.classList.remove('back-overlay-on');
  overlay.classList.add('back-overlay-off');
  if (text2.value) {
    text1.value = text2.value;
  }
}

function clickSFClose() {
  const overlay = document.getElementById('sf');
  overlay.classList.remove('back-overlay-on');
  overlay.classList.add('back-overlay-off');
}

function dispOverlay(id) {
  const overlay = document.getElementById(id);
  overlay.classList.remove('back-overlay-off');
  overlay.classList.add('back-overlay-on');
}

function closeOverlay(gaihaku_id) {
  const overlay = document.getElementById(gaihaku_id + 'overlay');
  const text1 = document.getElementById(gaihaku_id + 'text1');
  const text2 = document.getElementById(gaihaku_id + 'text2');
  text1.value = text2.value;
  overlay.classList.remove('back-overlay-on');
  overlay.classList.add('back-overlay-off');
}
