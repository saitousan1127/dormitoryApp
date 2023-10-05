F<?php
    header('Content-Type: application/json; charset=UTF-8');

    $dsn = "mysql:host=localhost;dbname=shoindb;charset=utf8";
    $user = 'root';
    $password = 'sotu-ken';
    

    if(isset($_GET["username"])){
        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $Exception) {
            die('エラー :' . $Exception->getMessage());
        }

        $data = [];
        $sql = 'SELECT id,password FROM member WHERE username = :username limit 1';
        try {
            $stmh = $dbh->prepare($sql);
            $stmh->bindValue(':username',  $_GET["username"], PDO::PARAM_STR );
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        $array = [ 'id'=>$data['id'], 'password'=>$data['password'] ];
        print json_encode($array);
   }
?>