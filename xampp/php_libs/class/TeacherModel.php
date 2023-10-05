<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TeacherModel
 *
 * @author nagatayorinobu
 */
class TeacherModel extends BaseModel
{

    //----------------------------------------------------
    // 教員情報をユーザーIDで検索
    //----------------------------------------------------
    public function get_teacher_data_id($id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM teacher WHERE id = :id  limit 1";
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
    // クラスの担任を検索
    //----------------------------------------------------
    public function get_teacher_data_class($class)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM teacher WHERE class = :class  limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':class', $class, PDO::PARAM_STR);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }


    //----------------------------------------------------
    // 教員のユーザ名（メールアドレス）と同じものがないか調べる。
    //----------------------------------------------------
    public function check_username($username)
    {
        try {
            $sql = "SELECT * FROM teacher WHERE username = :username ";
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
    // 会員情報を完全に削除する
    //----------------------------------------------------
    public function delete_teacher($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM teacher WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 会員がアクセスできないようにする
    //----------------------------------------------------
    public function ban_teacher($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE teacher SET ban = 1 WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // アカウントがBANされていたらTRUEを返す
    //----------------------------------------------------
    public function check_ban($id)
    {
        try {
            $sql = "SELECT * FROM teacher WHERE id = :id AND ban = 1 ";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
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
    // idに該当するユーザのBAN状態を切り替える
    //----------------------------------------------------
    public function swich_ban($id)
    {

        if ($this->check_ban($id)) {
            $sql = <<<EOS
            UPDATE teacher SET ban = 0 WHERE id = :id
            EOS;
        } else {
            $sql = <<<EOS
            UPDATE teacher SET ban = 1 WHERE id = :id
            EOS;
        }

        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }



    //----------------------------------------------------
    // 教員テーブル内にclassが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_class($class, $id = "")
    {
        $sql = "SELECT * FROM teacher WHERE class = :class";
        if ($id != "") {
            $sql .= " AND id != :id";
        }
        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':class', $class, PDO::PARAM_STR);
            if ($id != "") {
                $stmh->bindValue(':id', $id, PDO::PARAM_INT);
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


    //----------------------------------------------------
    // 教員ユーザの情報をユーザー名で検索
    //----------------------------------------------------
    public function get_authinfo($username)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM teacher WHERE username = :username limit 1";
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
    // 教員一覧取得処理
    //----------------------------------------------------
    public function get_teacher_list($search_key)
    {
        $sql = <<<EOS
            SELECT * FROM teacher WHERE (id>0)
        EOS;
        if ($search_key != "") {
            $sql .= " AND ( last_name  like :last_name OR first_name like :first_name ) ";
        }

        try {
            $stmh = $this->pdo->prepare($sql);
            if ($search_key != "") {
                $search_key = '%' . $search_key . '%';
                $stmh->bindValue(':last_name', $search_key, PDO::PARAM_STR);
                $stmh->bindValue(':first_name', $search_key, PDO::PARAM_STR);
            }
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            if (!isset($count)) {
                $count = 0;
            }
            $i = 0;
            $data = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {
                    $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data, $count];
    }

    //----------------------------------------------------
    // 教員情報の更新処理
    //----------------------------------------------------
    public function modify_teacher($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  teacher
                      SET 
                        username   = :username,
                        password   = :password,
                        last_name  = :last_name,
                        first_name = :first_name,
                        h_last_name = :h_last_name,
                        h_first_name = :h_first_name,
                        k_last_name = :k_last_name,
                        k_first_name = :k_first_name,
                        class   = :class
                      WHERE id = :id";
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
            $stmh->bindValue(':id', $userdata['id'], PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 教員とクラスの紐づけを全削除する
    //----------------------------------------------------
    public function call_off_class()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE teacher SET class = NULL";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 渡された日付よりも前に登録された教員アカウントを凍結する
    //----------------------------------------------------
    public function ban_old_teacher($date)
    {

        $sql = <<<EOS
        UPDATE teacher SET ban = 1 WHERE ban = 0 AND reg_date<:date
        EOS;

        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 渡された日付よりも前に登録された教員アカウントを削除する
    //----------------------------------------------------
    public function delete_old_teacher($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM teacher WHERE reg_date < :date";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // BANされている教員アカウントを全削除する
    //----------------------------------------------------
    public function delete_ban_teacher()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM teacher WHERE ban = 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、削除しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


}