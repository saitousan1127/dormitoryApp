<?php

/**
 * Description of PrememberModel
 *
 * @author nagatayorinobu
 */
class PrememberModel extends BaseModel
{
    //----------------------------------------------------
    // 仮会員登録処理
    //----------------------------------------------------
    public function regist_premember($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO premember (username, password, last_name, first_name, h_last_name, h_first_name, k_last_name, k_first_name, class, roomnum, birthday, link_pass, reg_date )
            VALUES ( :username, :password, :last_name, :first_name, :h_last_name, :h_first_name, :k_last_name, :k_first_name, :class, :roomnum, :birthday, :link_pass, now() )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $userdata['username'], PDO::PARAM_STR);
            $stmh->bindValue(':password', $userdata['password'], PDO::PARAM_STR);
            $stmh->bindValue(':last_name', $userdata['last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name', $userdata['first_name'], PDO::PARAM_STR);
            $stmh->bindValue(':h_last_name', $userdata['h_last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':h_first_name', $userdata['h_first_name'], PDO::PARAM_STR);
            $stmh->bindValue(':k_last_name', $userdata['k_last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':k_first_name', $userdata['k_first_name'], PDO::PARAM_STR);
            $stmh->bindValue(':class', $userdata['class'], PDO::PARAM_STR);
            $stmh->bindValue(':roomnum', $userdata['roomnum'], PDO::PARAM_STR);
            $stmh->bindValue(':birthday', $userdata['birthday'], PDO::PARAM_STR);
            $stmh->bindValue(':link_pass', $userdata['link_pass'], PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }



    //----------------------------------------------------
    // ２４時間以上前にされた仮登録を削除する
    //----------------------------------------------------
    public function delete_old()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM premember WHERE reg_date < DATE_SUB(NOW(),INTERVAL 24 HOUR)";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 仮登録テーブル内にusernameが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_username($username)
    {
        $this->delete_old();
        try {
            $sql = "SELECT * FROM premember WHERE username = :username ";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $username, PDO::PARAM_STR);
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
    // 仮登録テーブル内に同じ部屋番号が1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_roomnum($roomnum)
    {
        $sql = "SELECT * FROM premember WHERE roomnum = :roomnum ";
        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':roomnum', $roomnum, PDO::PARAM_STR);
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
    // 登録確認のメールで送られたリンクをクリックしてアクセスしたときの処理
    //----------------------------------------------------
    public function check_premember($username, $link_pass)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM premember WHERE username = :username AND link_pass = :link_pass limit 1 ";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $username, PDO::PARAM_STR);
            $stmh->bindValue(':link_pass', $link_pass, PDO::PARAM_STR);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    //----------------------------------------------------
    // 仮登録会員の削除＆会員への登録
    //----------------------------------------------------
    public function delete_premember_and_regist_member($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM premember WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $userdata['id'], PDO::PARAM_INT);
            $stmh->execute();
            $sql = "INSERT  INTO member (username, password, last_name, first_name, h_last_name, h_first_name, k_last_name, k_first_name, class, birthday, reg_date, ban )
            VALUES ( :username, :password, :last_name, :first_name, :h_last_name, :h_first_name, :k_last_name, :k_first_name, :class, :birthday , now(), 0 )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $userdata['username'], PDO::PARAM_STR);
            $stmh->bindValue(':password', $userdata['password'], PDO::PARAM_STR);
            $stmh->bindValue(':last_name', $userdata['last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name', $userdata['first_name'], PDO::PARAM_STR);
            $stmh->bindValue(':h_last_name', $userdata['h_last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':h_first_name', $userdata['h_first_name'], PDO::PARAM_STR);
            $stmh->bindValue(':k_last_name', $userdata['k_last_name'], PDO::PARAM_STR);
            $stmh->bindValue(':k_first_name', $userdata['k_first_name'], PDO::PARAM_STR);
            $stmh->bindValue(':class', $userdata['class'], PDO::PARAM_STR);
            $stmh->bindValue(':birthday', $userdata['birthday'], PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

}