function clickChild() {
  console.log('停止');
  event.stopPropagation();
}

function clickSFBtn(sort, grade, app, reason, comment) {
  if (sort != "") {
    console.log("ソート設定");
    document.getElementById('appD').checked = false;
    document.getElementById(sort).checked = true;
  } else {
    document.getElementById('appD').checked = true;
  }
  if (grade != "") {
    console.log("学年設定");
    document.getElementById('all_grade').selected = false;
    document.getElementById('grade_' + grade).selected = true;
  } else {
    document.getElementById('all_grade').selected = true;
  }

  if (app != "") {
    console.log("状態設定");
    document.getElementById('all_app').selected = false;
    switch (app) {
      case '未閲覧':
        document.getElementById('unobserved').selected = true;
        break;
      case '閲覧':
        document.getElementById('observed').selected = true;
        break;
      case '受理':
        document.getElementById('accept').selected = true;
        break;
      case '却下':
        document.getElementById('reject').selected = true;
        break;

      default:
    }
  } else {
    document.getElementById('all_app').selected = true;
  }

  if (reason != "") {
    console.log("欠食理由設定");
    document.getElementById('all_reason').selected = false;
    document.getElementById(reason).selected = true;
  } else {
    document.getElementById('all_reason').selected = true;
  }

  if (comment != "") {
    console.log(comment);
    console.log("コメント設定");
    document.getElementById('all_comment').selected = false;
    document.getElementById(comment).selected = true;
  } else {
    document.getElementById('all_comment').selected = true;
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