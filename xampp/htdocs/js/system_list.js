function clickChild() {
  console.log('停止');
  event.stopPropagation();
}

function dispOverlay(id) {
  const overlay = document.getElementById(id);
  overlay.classList.remove('back-overlay-off');
  overlay.classList.add('back-overlay-on');
}

function closeOverlay(id) {
  const overlay = document.getElementById(id);
  overlay.classList.remove('back-overlay-on');
  overlay.classList.add('back-overlay-off');
}

function ban_member(id) {

  var fd = new FormData();
  fd.append('type', 'swich_ban_member');
  fd.append('id', id);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        const ban_btn = document.getElementById(id + 'ban_btn');
        location.reload();
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}
