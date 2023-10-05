<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RyoukanModel
 *
 * @author nagatayorinobu
 */
class RyoukanlogModel extends BaseModel
{

    //----------------------------------------------------
    // ログ登録処理
    //----------------------------------------------------
    public function regist_log($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO ryoukanlog (ryoukan_id, login_date, invalid)
            VALUES ( :id, now(), 0 )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //---------------------------------------------------------------------
    // 本日の17:10から翌日の8:40の間に他の教員IDでのログインがあったらtrueを返す
    //--------------------------------------------------------------------
    public function check_other_id($id)
    {
        try {
            $sql = "SELECT * FROM ryoukanlog WHERE ryoukan_id != :id AND invalid = 0 AND login_date BETWEEN :first AND :last";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $H = (int) date('H');
            if ($H <= 8) {
                $stmh->bindValue(':first', date('Y-m-d') . ' 00:00:00', PDO::PARAM_STR);
                $stmh->bindValue(':last', date('Y-m-d') . ' 08:40:00', PDO::PARAM_STR);
            } else {
                $stmh->bindValue(':first', date('Y-m-d') . ' 17:10:00', PDO::PARAM_STR);
                $stmh->bindValue(':last', date('Y-m-d', strtotime("+1 day")) . ' 08:40:00', PDO::PARAM_STR);
            }
            $stmh->execute();
            $count = $stmh->rowCount();
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        if ($count >= 1) {
            return true;
        } else {
            return false;
        }
    }


    //---------------------------------------------------------------------
    // 本日の17:10から翌日の8:40の間に寮監ページにログイン履歴がある教員IDを返す
    //---------------------------------------------------------------------
    public function get_ryoukan_id()
    {
        $id = "";
        $sql = "SELECT ryoukan_id FROM ryoukanlog WHERE invalid = 0 AND login_date BETWEEN :first AND :last limit 1";
        try {
            $stmh = $this->pdo->prepare($sql);
            $H = (int) date('H');
            if ($H <= 8) {
                $stmh->bindValue(':first', date('Y-m-d') . ' 00:00:00', PDO::PARAM_STR);
                $stmh->bindValue(':last', date('Y-m-d') . ' 08:40:00', PDO::PARAM_STR);
            } else {
                $stmh->bindValue(':first', date('Y-m-d') . ' 17:10:00', PDO::PARAM_STR);
                $stmh->bindValue(':last', date('Y-m-d', strtotime("+1 day")) . ' 08:40:00', PDO::PARAM_STR);
            }
            $stmh->execute();
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            if ($count > 0) {
                $id = $stmh->fetch(PDO::FETCH_ASSOC);
                $id = $id['ryoukan_id'];
            } else {
                $id = false;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $id;
    }


    //---------------------------------------------------------------------
    // 本日の17:10から翌日の8:40の間にログイン履歴を無効化する
    //---------------------------------------------------------------------
    public function disable_log()
    { //ここから履歴を無効化する処理を書く
        $sql = "UPDATE ryoukanlog SET invalid = 1 WHERE invalid = 0 AND login_date BETWEEN :first AND :last";
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $H = (int) date('H');
            if ($H <= 8) {
                $stmh->bindValue(':first', date('Y-m-d') . ' 00:00:00', PDO::PARAM_STR);
                $stmh->bindValue(':last', date('Y-m-d') . ' 08:40:00', PDO::PARAM_STR);
            } else {
                $stmh->bindValue(':first', date('Y-m-d') . ' 17:10:00', PDO::PARAM_STR);
                $stmh->bindValue(':last', date('Y-m-d', strtotime("+1 day")) . ' 08:40:00', PDO::PARAM_STR);
            }
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


}