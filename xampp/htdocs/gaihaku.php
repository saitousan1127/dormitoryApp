<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

 <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
 
  <meta name="theme-color" content="#fafafa">
</head>

<body>

<div class="container">
  <div class="mt-3 alert alert-success" role="alert">
    外泊届　作成/提出フォーム
  </div>
　
<p>情報を入力してください.</p>

  <form name = "form1" action="/kakunin.php" method="post">
    <label for="si">氏：</label><input id="si" type="text" name="lastName" placeholder="松韻">
    <label for="mei">名：</label><input id="mei" type="text" name="fastName"placeholder="太郎">
    <br>

    学年/クラス<br>
    <select name="grade">
        <option value="1-1">1-1</option>
        <option value="1-2">1-2</option>
        <option value="1-3">1-3</option>
        <option value="IS2">IS2</option>
        <option value="IE2">IE2</option>
        <option value="IT2">IT2</option>
        <option value="IS3">IS3</option>
        <option value="IE3">IE3</option>
        <option value="IT3">IT3</option>
        <option value="IS4">IS4</option>
        <option value="IE4">IE4</option>
        <option value="IT4">IT4</option>
        <option value="IS5">IS5</option>
        <option value="IE5">IE5</option>
        <option value="IT5">IT5</option>
    </select><br>
    
    棟<br>
    <select name="tou">
        <option value="北寮">北寮</option>
        <option value="南寮">南寮</option>
        <option value="女子寮">女子寮</option>
    </select><br>

    部屋番号<br>
    <input id="room" type="number" name="roomNumber">
    <select name="aorb">
        <option value="A">A</option>
        <option value="B">B</option>
    </select>号室<br>
    <label for="juusyo">宿泊先住所</label><br>
    <input id="juusyo" type="text" name="address"><br>
    <label for="aite">宿泊先の相手氏名</label><br>
    <label for="si2">氏：</label><input id="si2" type="text" name="lastName2" placeholder="松韻">
    <label for="mei2">名：</label><input id="mei2" type="text" name="fastName2"placeholder="一郎"><br>
   
    宿泊先電話番号<br>
    <input type="tel" name="telephone1">-<input type="tel" name="telephone2">-<input type="tel" name="telephone3"><br>
   
    開始日時～終了日時<br>
    <input type = "date" name = "date1">
    <input type = "time" name = "time1">
    ～
    <input type = "date" name = "date2">
    <input type = "time" name = "time2"><br>
    
    外泊理由<br>
    <input id="kisei" type="radio" name="why" value="帰省"><label for="kisei">帰省</label><br>
    <input id="sonota" type="radio" name="why" value="その他"><label for="sonota">その他</label><br>
    <textarea id = "riyuu" name="reason" rows="4" cols="60"  placeholder="その他の理由を記入してください" ></textarea><br>

    <input type="submit" value="確認画面へ">

  </form>
  <br>
</div>

</body>

</html>
