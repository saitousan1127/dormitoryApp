function changeState(gaihaku_id) {

  var fd = new FormData();
  fd.append('gaihaku_id', gaihaku_id);

  let request = new XMLHttpRequest();
  request.open('POST', '../open.php');
  request.send(fd);
}