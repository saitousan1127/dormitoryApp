<?php

/**
 * Description of tplModel
 *
 * @author nagatayorinobu
 */
class tplModel extends BaseModel
{

    //----------------------------------------------------
    // テンプレート登録処理
    //----------------------------------------------------
    public function regist_tpl($id, $gaihaku)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO tpl (id, psCode1, psCode2, address,
            last_name2 ,first_name2, tel, reason, riyuu)
            VALUES (:id, :psCode1, :psCode2, :address,
            :last_name2 ,:first_name2, :tel, :reason, :riyuu )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT); //ユーザデータのIDを格納する
            $stmh->bindValue(':psCode1', $gaihaku['psCode1'], PDO::PARAM_INT);
            $stmh->bindValue(':psCode2', $gaihaku['psCode2'], PDO::PARAM_INT);
            $stmh->bindValue(':address', $gaihaku['address'], PDO::PARAM_STR);
            $stmh->bindValue(':last_name2', $gaihaku['last_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name2', $gaihaku['first_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':tel', $gaihaku['tel'], PDO::PARAM_STR);
            $stmh->bindValue(':reason', $gaihaku['dest']['reason'], PDO::PARAM_STR);
            $stmh->bindValue(':riyuu', $gaihaku['riyuu'], PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    //外泊願テンプレート情報の更新処理
    //----------------------------------------------------
    public function modify_tpl($id, $gaihaku)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  tpl
                      SET 
                        psCode1     = :psCode1,
                        psCode2     = :psCode2,
                        address     = :address,
                        last_name2  = :last_name2,
                        first_name2 = :first_name2,
                        tel         = :tel,
                        reason      = :reason,
                        riyuu       = :riyuu
                      WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':psCode1', $gaihaku['psCode1'], PDO::PARAM_INT);
            $stmh->bindValue(':psCode2', $gaihaku['psCode2'], PDO::PARAM_INT);
            $stmh->bindValue(':address', $gaihaku['address'], PDO::PARAM_STR);
            $stmh->bindValue(':last_name2', $gaihaku['last_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name2', $gaihaku['first_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':tel', $gaihaku['tel'], PDO::PARAM_STR);
            $stmh->bindValue(':reason', $gaihaku['dest']['reason'], PDO::PARAM_STR);
            $stmh->bindValue(':riyuu', $gaihaku['riyuu'], PDO::PARAM_STR);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT); //ユーザデータのIDを格納する
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // tplテーブル内に同じidが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_id($id)
    {
        try {
            $sql = "SELECT * FROM tpl WHERE id = :id ";
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
    // 渡された$idのテンプレートを削除
    //----------------------------------------------------
    public function delete_tpl($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM tpl WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // テンプレート情報をユーザーIDで検索
    //----------------------------------------------------
    public function get_tpl_data_id($id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM tpl WHERE id = :id  limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }

    //--------------------------------------------------------------
    // 渡された日付より前の日付に登録された寮生の外泊願テンプレートを全削除する
    //--------------------------------------------------------------
    public function delete_old_member_tpl($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE tpl FROM tpl JOIN member ON tpl.id = member.id WHERE member.reg_date <= :date";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //--------------------------------------------------------------
    // BANされている寮生の提出した外泊願テンプレートを全削除
    //--------------------------------------------------------------
    public function delete_ban_member_tpl()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE tpl FROM tpl JOIN member ON tpl.id = member.id WHERE member.ban = 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //--------------------------------------------------------------
    // 渡されたIDの寮生の作成した外泊願テンプレートを全削除
    //--------------------------------------------------------------
    public function all_delete_member_id($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM tpl WHERE id = :id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


}