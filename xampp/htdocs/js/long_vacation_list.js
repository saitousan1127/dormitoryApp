function clickChild() {
  console.log('停止');
  event.stopPropagation();
}

function check() {
  const f_date = document.getElementById('fd');
  const l_date = document.getElementById('ld');
  const name = document.getElementById('name');
  const error = document.getElementById('error');

  if (f_date.value != "" && l_date.value != "" && name.value != "") {
    return true;
  } else {
    error.innerHTML = "入力に不備があります．"
    return false;
  }
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


function clickYesBtn(id) {

  var fd = new FormData();
  fd.append('type', 'vacation');
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
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}