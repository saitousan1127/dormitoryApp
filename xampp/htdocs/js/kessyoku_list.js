function clickChild() {
  console.log('停止');
  event.stopPropagation();
}

function clickSFBtn(sort, grade, reason) {
  if (sort !== "") {
    console.log("ソート設定");
    document.getElementById('subA').checked = false;
    document.getElementById(sort).checked = true;
  } else {
    document.getElementById('subA').checked = true;
  }
  if (grade !== "") {
    console.log("学年設定");
    console.log(grade);
    document.getElementById('all_grade').selected = false;
    document.getElementById('grade_' + grade).selected = true;
  } else {
    document.getElementById('all_grade').selected = true;
  }

  if (reason !== "") {
    console.log("欠食理由設定");
    document.getElementById('all_reason').selected = false;
    document.getElementById(reason).selected = true;
  } else {
    document.getElementById('all_reason').selected = true;
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

function clickAppBtn(class_name) {
  const overElements = document.getElementsByClassName(class_name);
  const row = document.getElementById(class_name);
  if (overElements[1].value === "却下" || overElements[1].value === "受理or却下") {
    row.style.backgroundColor = "#b0c4de";
    overElements[0].style.backgroundColor = "#b0c4de";
    overElements[1].value = "受理";
    //row[1].style.backgroundColor = "#b0c4de";
  } else if (overElements[1].value === "受理") {
    row.style.backgroundColor = "#ff7f50";
    overElements[0].style.backgroundColor = "#ff7f50";
    overElements[1].value = "却下";
    //row[1].style.backgroundColor = "#ff7f50";
  }
}

function clickSendBtn(group_id) {

  const overElements = document.getElementsByClassName(group_id);
  const row = document.getElementById(group_id);
  const comment = document.getElementById(group_id + 'text');

  var fd = new FormData();
  fd.append('type', 'kessyoku');
  fd.append('group_id', group_id);
  fd.append('app', overElements[1].value);
  fd.append('comment', comment.value);
  console.log(group_id);
  console.log(overElements[1].value);
  console.log(comment.value);

  if (overElements[1].value == '受理' || (overElements[1].value == '却下' && comment.value != "")) {
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
  } else if (overElements[1].value == '受理or却下') {
    const error = document.getElementById('error');
    const errorInOverlay = document.getElementById(group_id + 'error');
    error.innerHTML = "受理/却下を決定してください．";
    errorInOverlay.innerHTML = "左にあるボタンで受理/却下を決定してください．";
  } else {
    const error = document.getElementById('error');
    const errorInOverlay = document.getElementById(group_id + 'error');
    error.innerHTML = "却下の場合はコメントを記入してください．";
    errorInOverlay.innerHTML = "却下の場合はコメントを記入してください．";
  }

}