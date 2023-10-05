<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemModel
 *
 * @author nagatayorinobu
 */
class SystemModel extends BaseModel
{
    //----------------------------------------------------
    // 管理者情報をユーザー名で検索
    //----------------------------------------------------
    public function get_authinfo($username)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM system WHERE username = :username limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $username, PDO::PARAM_STR);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    //----------------------------------------------------
    // systemのメンテナンス状態を返す
    //----------------------------------------------------
    public function check_maint()
    {
        try {
            $sql = "SELECT * FROM system WHERE maint = 1";
            $stmh = $this->pdo->prepare($sql);
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

    //----------------------------------------------------
    // user情報をユーザーIDで検索
    //----------------------------------------------------
    public function get_user_data_id($id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM system WHERE id = :id limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }


    //----------------------------------------------------
    // 管理者情報の更新処理
    //----------------------------------------------------
    public function modify_user($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  system
                      SET 
                        username   = :username,
                        password   = :password
                        WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $userdata['username'], PDO::PARAM_STR);
            $stmh->bindValue(':password', $userdata['password'], PDO::PARAM_STR);
            $stmh->bindValue(':id', $userdata['id'], PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //-------------------------------------------------------------------------------------
    // メンテナンス状態を切り替え、メンテナンスモードに移行する場合は$maint_timeを20分後に設定する
    //--------------------------------------------------------------------------------------
    public function switch_maint()
    {

        if ($this->check_maint()) {
            $sql = <<<EOS
            UPDATE system SET maint = FALSE
            EOS;
        } else {
            $sql = <<<EOS
            UPDATE system SET maint = TRUE, maint_time = :time 
            EOS;
        }

        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':time', date("Y-m-d H:i:s", strtotime("+20 minute")), PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }
}