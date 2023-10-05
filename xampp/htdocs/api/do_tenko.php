<?php
header('Content-Type: application/json; charset=UTF-8');

$dsn = "mysql:host=localhost;dbname=shoindb;charset=utf8";
$user = 'root';
$password = 'sotu-ken';


if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    try {
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $Exception) {
        die('エラー :' . $Exception->getMessage());
    }

    $data = [];
    $sql = "INSERT  INTO tenko (id, date)
        VALUES ( :id, now())";
    try {
        $dbh->beginTransaction();
        $stmh = $dbh->prepare($sql);
        $stmh->bindValue(':id', $id, PDO::PARAM_INT);
        $stmh->execute();
        $dbh->commit();
    } catch (PDOException $Exception) {
        print "エラー：" . $Exception->getMessage();
    }
}
?>