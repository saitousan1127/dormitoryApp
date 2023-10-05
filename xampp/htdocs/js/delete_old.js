function clickChild() {
  console.log('停止');
  event.stopPropagation();
}

function dispOverlay(id) {
  console.log(id);
  const overlay = document.getElementById(id);
  const date = document.getElementById(id + '_date');
  const text = document.getElementById(id + '_text');
  const error = document.getElementById(id + '_error');

  if (date.value !== '') {
    text.innerHTML = date.value;
    overlay.classList.remove('back-overlay-off');
    overlay.classList.add('back-overlay-on');
    error.innerHTML = '';
  } else {
    error.innerHTML = '日付が入力されていません．';
  }
}

function dispOverlay2(id) {
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


function delete_old_gaihaku() {

  var fd = new FormData();
  const date = document.getElementById('delete_old_gaihaku_date');
  fd.append('type', 'delete_old_gaihaku');
  fd.append('date', date.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('delete_old_gaihaku');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function delete_old_kessyoku() {

  var fd = new FormData();
  const date = document.getElementById('kessyoku_date');
  fd.append('type', 'delete_old_kessyoku');
  fd.append('date', date.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('delete_old_kessyoku');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function delete_old_tenko() {

  var fd = new FormData();
  const date = document.getElementById('tenko_date');
  fd.append('type', 'delete_old_tenko');
  fd.append('date', date.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('delete_old_tenko');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function ban_old_member() {

  var fd = new FormData();
  const date = document.getElementById('ban_old_member_date');
  fd.append('type', 'ban_old_member');
  fd.append('date', date.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('ban_old_member');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function delete_old_member() {

  var fd = new FormData();
  const date = document.getElementById('delete_old_member_date');
  fd.append('type', 'delete_old_member');
  fd.append('date', date.value);
  console.log(date.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('delete_old_member');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function delete_ban_member() {

  var fd = new FormData();
  fd.append('type', 'delete_ban_member');

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('delete_ban_member');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function ban_old_teacher() {

  var fd = new FormData();
  const date = document.getElementById('ban_old_teacher_date');
  fd.append('type', 'ban_old_teacher');
  fd.append('date', date.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('ban_old_teacher');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function delete_old_teacher() {

  var fd = new FormData();
  const date = document.getElementById('delete_old_teacher_date');
  fd.append('type', 'delete_old_teacher');
  fd.append('date', date.value);
  console.log(date.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('delete_old_teacher');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

function delete_ban_teacher() {

  var fd = new FormData();
  fd.append('type', 'delete_ban_teacher');

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    console.log("readyState:" + request.readyState);
    if (request.readyState == 4) {
      if (request.status == 200) {
        console.log('実行');
        closeOverlay('delete_ban_teacher');
      }
    }
  }
  request.open('POST', '../asyn/delete.php');
  request.send(fd);
}

