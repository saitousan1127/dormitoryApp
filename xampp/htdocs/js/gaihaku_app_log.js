function clickChild() {
  console.log('停止');
  event.stopPropagation();
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


function clickSFBtn(sort, spe_class, tou, floor, app, comment, attend) {
  if (sort !== "") {
    console.log("ソート設定");
    document.getElementById('subA').checked = false;
    document.getElementById(sort).checked = true;
  } else {
    document.getElementById('subA').checked = true;
  }

  if (spe_class !== "") {
    console.log("クラス設定");
    document.getElementById('all_class').selected = false;
    document.getElementById(spe_class).selected = true;
  } else {
    if (document.getElementById('all_class') != null) {
      document.getElementById('all_class').selected = true;
    }
  }

  if (tou !== "") {
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

  if (floor !== "") {
    console.log("階設定");
    document.getElementById('all_floor').selected = false;
    document.getElementById("floor" + floor).selected = true;
  } else {
    document.getElementById('all_floor').selected = true;
  }

  if (app !== "") {
    console.log("承認非承認設定");
    document.getElementById('all_app').selected = false;
    if (app == "承認") {
      console.log("承認設定");
      document.getElementById("app").selected = true;
    } else {
      console.log("非承認設定");
      document.getElementById("non_app").selected = true;
    }
  } else {
    document.getElementById('all_app').selected = true;
  }

  if (comment !== "") {
    console.log("承認非承認設定");
    document.getElementById('all_comment').selected = false;
    document.getElementById(comment).selected = true;
  } else {
    document.getElementById('all_comment').selected = true;
  }

  if (attend !== "") {
    console.log("承認非承認設定");
    document.getElementById('all_attend').selected = false;
    switch (attend) {
      case "まだ":
        document.getElementById('yet').selected = true;
        break;
      case "出席":
        document.getElementById('attended').selected = true;
        break;
      case "欠席":
        document.getElementById('non_attended').selected = true;
        break;
      default:
    }
  } else {
    document.getElementById('all_attend').selected = true;
  }

  const overlay = document.getElementById('sf');
  overlay.classList.remove('back-overlay-off');
  overlay.classList.add('back-overlay-on');

}

function clickSFClose() {
  const overlay = document.getElementById('sf');
  overlay.classList.remove('back-overlay-on');
  overlay.classList.add('back-overlay-off');
}

function clickClose(id) {
  const overlay = document.getElementById(id + 'overlay');
  overlay.classList.remove('back-overlay-on');
  overlay.classList.add('back-overlay-off');
}

function dispEntire(id) {
  const overlay = document.getElementById(id + 'overlay');
  overlay.classList.remove('back-overlay-off');
  overlay.classList.add('back-overlay-on');
}

function dispEdit(id) {
  const overlay = document.getElementById(id + 'edit');
  overlay.classList.remove('back-overlay-off');
  overlay.classList.add('back-overlay-on');
}
