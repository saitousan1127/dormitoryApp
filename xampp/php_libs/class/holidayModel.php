<?php

/**
 * Description of holidayModel
 *
 * @author nagatayorinobu
 */
class holidayModel extends BaseModel
{
    //----------------------------------------------------
    // 祝日登録処理
    //----------------------------------------------------
    public function regist_holiday($holiday)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO holiday ( name, date)
            VALUES ( :name, :date)";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':name', $holiday['name'], PDO::PARAM_STR);
            $stmh->bindValue(':date', $holiday['date'], PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 同じ日付の祝日が登録されているかをチェックする
    //----------------------------------------------------
    public function check_same_date($holiday)
    {
        try {
            $sql = 'SELECT * FROM holiday WHERE date = :date';
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', $holiday, PDO::PARAM_STR);
            $stmh->execute();
            $count = 0;
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
    // 期間中に祝日が登録されていればtrueを返す
    //----------------------------------------------------
    public function checkByTerm($first_date, $last_date)
    {
        try {
            $sql = 'SELECT * FROM holiday WHERE date BETWEEN :first_date AND :last_date';
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':first_date', $first_date, PDO::PARAM_STR);
            $stmh->bindValue(':last_date', $last_date, PDO::PARAM_STR);
            $stmh->execute();
            $count = 0;
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
    // 祝日の一覧を取得
    //----------------------------------------------------
    public function get_holiday_list()
    {
        $sql = <<<EOS
        SELECT * FROM holiday
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
        return [$data, $count];
    }


    //----------------------------------------------------
    // 渡された$idの祝日を削除
    //----------------------------------------------------
    public function delete_holiday($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM holiday WHERE id = :id";
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
    // 過去の日付の祝日を削除
    //----------------------------------------------------
    public function delete_past_holiday()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM holiday WHERE date < :date";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', date("Y-m-d 00:00:00"), PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }



}