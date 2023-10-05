<?php
/**
 * Description of TenkoModel
 *
 * @author nagatayorinobu
 */
class AbsenteeModel extends BaseModel
{
    //----------------------------------------------------
    // 点呼欠席者登録席処理
    //----------------------------------------------------
    public function regist_absentee($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO absentee (id, date) VALUES ( :id, now() )";
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
    // 点呼欠席者をリストにして返す(日付指定可)
    //----------------------------------------------------
    public function get_absentee_list($date)
    {
        $sql = <<<EOS
        SELECT * FROM absentee JOIN member ON absentee.id = member.id
        EOS;

        if ($date != '') {
            $sql .= ' WHERE absentee.date BETWEEN :s_time AND :f_time';
        }

        $sql .= ' ORDER BY absentee.date DESC';

        try {
            $stmh = $this->pdo->prepare($sql);
            if ($date != '') {
                $stmh->bindValue(':s_time', $date . ' ' . '00:00:00', PDO::PARAM_STR);
                $stmh->bindValue(':f_time', $date . ' ' . '23:59:59', PDO::PARAM_STR);
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
    // 渡された日付より前に登録された点呼欠席者情報を削除する
    //----------------------------------------------------
    public function delete_old_absentee($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM absentee WHERE date < :date";
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
    // 渡された日付より前の日付に登録された寮生の点呼欠席履歴を削除する
    //--------------------------------------------------------------
    public function delete_old_member_absentee($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE absentee FROM absentee JOIN member ON absentee.id = member.id WHERE member.reg_date <= :date";
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
    // BANされている寮生の点呼欠席履歴を全削除
    //--------------------------------------------------------------
    public function delete_ban_member_absentee()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE absentee FROM absentee JOIN member ON absentee.id = member.id WHERE member.ban = 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //--------------------------------------------------------------
    // 渡されたIDの寮生の点呼欠席履歴を全削除
    //--------------------------------------------------------------
    public function all_delete_member_id($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM absentee WHERE id = :id";
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