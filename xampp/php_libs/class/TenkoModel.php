<?php
/**
 * Description of TenkoModel
 *
 * @author nagatayorinobu
 */
class TenkoModel extends BaseModel
{
    //----------------------------------------------------
    // 点呼出席処理
    //----------------------------------------------------
    public function regist_tenko($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO tenko (id, date) VALUES ( :id, now() )";
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
    // その日に点呼に出席していたならTRUEを返す
    //----------------------------------------------------
    public function check_todays($id)
    {
        try {
            $sql = "SELECT * FROM tenko WHERE id = :id AND ( date BETWEEN :s_time AND :f_time )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->bindValue(':s_time', date('Y-m-d') . ' ' . '00:00:00', PDO::PARAM_STR);
            $stmh->bindValue(':f_time', date('Y-m-d') . ' ' . '23:59:59', PDO::PARAM_STR);
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
    // 渡された日付より前に登録された点呼情報を削除する
    //----------------------------------------------------
    public function delete_old_tenko($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM tenko WHERE date < :date";
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
    // 渡された日付より前の日付に登録された寮生の点呼履歴を削除する
    //--------------------------------------------------------------
    public function delete_old_member_tenko($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE tenko FROM tenko JOIN member ON tenko.id = member.id WHERE member.reg_date <= :date";
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
    // BANされている寮生の点呼履歴を全削除
    //--------------------------------------------------------------
    public function delete_ban_member_tenko()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE tenko FROM tenko JOIN member ON tenko.id = member.id WHERE member.ban = 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //--------------------------------------------------------------
    // 渡されたIDの寮生の点呼履歴を全削除
    //--------------------------------------------------------------
    public function all_delete_member_id($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM tenko WHERE id = :id";
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