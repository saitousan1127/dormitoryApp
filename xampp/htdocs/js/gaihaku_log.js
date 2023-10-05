function clickChild() {
  console.log('停止');
  event.stopPropagation();
}

function clickSFBtn(sort, app, comment, attend) {
  if (sort !== "") {
    console.log("ソート設定");
    document.getElementById('subD').checked = false;
    document.getElementById(sort).checked = true;
  } else {
    document.getElementById('subD').checked = true;
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
    console.log("コメント設定");
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


function dispOverlay(id) {
  console.log(id);
  const overlay = document.getElementById(id);
  overlay.classList.remove('back-overlay-off');
  overlay.classList.add('back-overlay-on');
}

function closeOverlay(id) {
  const overlay = document.getElementById(id);
  overlay.classList.remove('back-overlay-on');
  overlay.classList.add('back-overlay-off');
}

function clickYesBtn(gaihaku_id) {

  var fd = new FormData();
  fd.append('type', 'gaihaku');
  fd.append('gaihaku_id', gaihaku_id);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        const row = document.getElementById(gaihaku_id);
        console.log(gaihaku_id);
        console.log('実行');
        row.remove();
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}
