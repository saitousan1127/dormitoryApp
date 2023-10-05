<?php
/**
 * Description of MemberModel
 *
 * @author nagatayorinobu
 */
class MemberModel extends BaseModel
{
    //----------------------------------------------------
    // 会員登録処理
    //----------------------------------------------------
    public function regist_member($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO member (username, password, last_name, first_name, h_last_name, h_first_name, k_last_name, k_first_name, class, birthday, reg_date, ban)
            VALUES ( :username, :password, :last_name, :first_name, :h_last_name, :h_first_name, :k_last_name, :k_first_name, :class, :birthday, now(), 0 )";
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


    //----------------------------------------------------
    // 会員のユーザ名（メールアドレス）と同じものがないか調べる。
    //----------------------------------------------------
    public function check_username($username)
    {
        try {
            $sql = "SELECT * FROM member WHERE username = :username ";
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
    // 会員情報をユーザー名（メールアドレス）で検索
    //----------------------------------------------------
    public function get_authinfo($username)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM member LEFT JOIN room ON member.username = room.room_username WHERE member.username = :username limit 1";
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
    // 会員情報をユーザーIDで検索
    //----------------------------------------------------
    public function get_member_data_id($id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM member LEFT JOIN room ON member.username = room.room_username WHERE member.id = :id limit 1";
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
    // 会員情報の更新処理
    //----------------------------------------------------
    public function modify_member($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  member
                      SET 
                        username   = :username,
                        password   = :password,
                        last_name  = :last_name,
                        first_name = :first_name,
                        h_last_name = :h_last_name,
                        h_first_name = :h_first_name,
                        k_last_name = :k_last_name,
                        k_first_name = :k_first_name,
                        class       = :class,
                        birthday   = :birthday
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
            $stmh->bindValue(':birthday', $userdata['birthday'], PDO::PARAM_STR);
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
    // 会員情報を完全に削除する
    //----------------------------------------------------
    public function delete_member($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM member WHERE id = :id";
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
    // idに該当するユーザのBAN状態を切り替える
    //----------------------------------------------------
    public function swich_ban($id)
    {

        if ($this->check_ban($id)) {
            $sql = <<<EOS
            UPDATE member SET ban = 0 WHERE id = :id
            EOS;
        } else {
            $sql = <<<EOS
            UPDATE member SET ban = 1 WHERE id = :id
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
    // 渡された日付よりも前に登録された寮生アカウントを凍結する
    //----------------------------------------------------
    public function ban_old_member($date)
    {

        $sql = <<<EOS
        UPDATE member SET ban = 1 WHERE ban = 0 AND reg_date<:date
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
    // 渡された日付よりも前に登録された寮生アカウントを削除する
    //----------------------------------------------------
    public function delete_old_member($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM member WHERE reg_date < :date";
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
    // BANされている寮生アカウントを全削除する
    //----------------------------------------------------
    public function delete_ban_member()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM member WHERE ban = 1";
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
    // アカウントがBANされていたらTRUEを返す
    //----------------------------------------------------
    public function check_ban($id)
    {
        try {
            $sql = "SELECT * FROM member WHERE id = :id AND ban = 1 ";
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
    // 会員一覧取得処理
    //----------------------------------------------------
    public function get_member_list($search_key)
    {
        $sql = <<<EOS
        SELECT * FROM member LEFT JOIN room ON member.username = room.room_username WHERE (id>0)
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
    // 誕生日が今日の人を取得
    //----------------------------------------------------
    public function get_same_birthday()
    {
        $sql = <<<EOS
        SELECT last_name, first_name, birthday FROM member WHERE SUBSTRING(birthday,5,4) = :today
        EOS;

        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':today', date('md'), PDO::PARAM_STR);
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
        return $data;
    }

    //----------------------------------------------------
    // 全寮制のidを返す
    //----------------------------------------------------
    public function get_all_id()
    {
        $sql = <<<EOS
        SELECT id FROM member
        EOS;

        try {
            $stmh = $this->pdo->prepare($sql);
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
        return $data;
    }


}