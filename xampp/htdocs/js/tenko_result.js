function clickChild() {
  console.log('停止');
  event.stopPropagation();
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

function clickAttendBtn(id) {

  var fd = new FormData();
  fd.append('type', 'tenko');
  fd.append('id', id);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        const row = document.getElementById(id);
        console.log(id);
        console.log('実行');
        row.remove();
      }
    }
  }
  request.open('POST', '../asyn/app.php');
  request.send(fd);
}

function send_mail() {

  var fd = new FormData();
  fd.append('type', 'send_tenko_mail');

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        document.getElementById('sent').innerHTML = 'メールは送信されました';
      }
    }
  }
  request.open('POST', '../asyn/app.php');
  request.send(fd);
}
