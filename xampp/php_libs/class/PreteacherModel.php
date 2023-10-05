<?php

/**
 * Description of PreteacherModel
 *
 * @author nagatayorinobu
 */
class PreteacherModel extends BaseModel
{
    //----------------------------------------------------
    // 仮教員登録処理
    //----------------------------------------------------
    public function regist_preteacher($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO preteacher (username, password, last_name, first_name, h_last_name, h_first_name, k_last_name, k_first_name, class, link_pass, reg_date )
            VALUES ( :username, :password, :last_name, :first_name, :h_last_name, :h_first_name, :k_last_name, :k_first_name, :class, :link_pass, now() )";
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
            $sql = "DELETE FROM preteacher WHERE reg_date < DATE_SUB(NOW(),INTERVAL 24 HOUR)";
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
            $sql = "SELECT * FROM preteacher WHERE username = :username ";
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
    // 仮登録テーブル内にclassが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_class($class)
    {
        try {
            $sql = "SELECT * FROM preteacher WHERE class = :class ";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':class', $class, PDO::PARAM_STR);
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
    public function check_preteacher($username, $link_pass)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM preteacher WHERE username = :username AND link_pass = :link_pass limit 1 ";
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
    public function delete_preteacher_and_regist_teacher($userdata)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM preteacher WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $userdata['id'], PDO::PARAM_INT);
            $stmh->execute();
            $sql = "INSERT  INTO teacher (username, password, last_name, first_name, h_last_name, h_first_name, k_last_name, k_first_name, class, reg_date, ban )
            VALUES ( :username, :password, :last_name, :first_name, :h_last_name, :h_first_name, :k_last_name, :k_first_name, :class , now(), 0 )";
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
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    //IDが大きい順で$i個のデータを取得する
    //----------------------------------------------------
    public function get_preteacher_data_bigid($i)
    {
        $sql = <<<EOS
         SELECT * FROM preteacher where id > ((select max(id) from preteacher) - :i);
        EOS;
        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':i', $i, PDO::PARAM_INT);
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            $y = 0;
            $data = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $key => $value) {
                    $data[$y][$key] = $value;
                }
                $y++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    //----------------------------------------------------
    //IDが大きい順で$i個のデータを削除する
    //----------------------------------------------------
    public function reset_preteacher_data_bigid($i)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE  FROM preteacher where id > ((select max(id) from preteacher) - :i);";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':i', $i, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }
}