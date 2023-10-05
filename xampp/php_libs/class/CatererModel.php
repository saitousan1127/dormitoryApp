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
class CatererModel extends BaseModel
{
    //----------------------------------------------------
    // 欠食業者情報をユーザー名で検索
    //----------------------------------------------------
    public function get_authinfo($username)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM caterer WHERE username = :username limit 1";
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
    // user情報をユーザーIDで検索
    //----------------------------------------------------
    public function get_user_data_id($id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM caterer WHERE id = :id limit 1";
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
            $sql = "UPDATE  caterer
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


}