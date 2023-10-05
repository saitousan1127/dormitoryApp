<?php
/**
 * Description of kessyokuModel
 *
 * @author nagatayorinobu
 */
class kessyokuModel extends BaseModel
{
    //----------------------------------------------------
    // 欠食届登録処理
    //----------------------------------------------------
    public function regist_kessyoku($id, $group_id, $date, $checked)
    {
        try {
            $sql = "SELECT * FROM kessyoku WHERE id = :id AND date = :date";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
            $stmh->execute();
            $count = $stmh->rowCount();
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        if ($count == 0) {
            try {
                $this->pdo->beginTransaction();
                $sql = "INSERT  INTO kessyoku ( group_id, id, date, bre, lun, din)
                VALUES ( :group_id, :id, :date, :bre, :lun, :din)";
                $stmh = $this->pdo->prepare($sql);
                $stmh->bindValue(':group_id', $group_id, PDO::PARAM_STR);
                $stmh->bindValue(':id', $id, PDO::PARAM_INT);
                $stmh->bindValue(':date', $date, PDO::PARAM_STR);
                $stmh->bindValue(':bre', $checked[0], PDO::PARAM_INT);
                $stmh->bindValue(':lun', $checked[1], PDO::PARAM_INT);
                $stmh->bindValue(':din', $checked[2], PDO::PARAM_INT);
                $stmh->execute();
                $this->pdo->commit();
            } catch (PDOException $Exception) {
                $this->pdo->rollBack();
                print "エラー：" . $Exception->getMessage();
            }
            return true;
        } else {
            return false;
        }
    }



    //----------------------------------------------------
    //kessyoku_idによる情報の更新処理
    //----------------------------------------------------
    public function modify_kessyoku($kessyoku_id, $checked)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  kessyoku
                      SET
                        bre       = :bre,
                        lun       = :lun,
                        din       = :din
                      WHERE kessyoku_id = :kessyoku_id limit 1";

            //if(!isset($gahaku['reason'])){
            //$gaihaku['reason'] = $gaihaku['dest']['reason'];
            //}

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':bre', $checked[0], PDO::PARAM_INT);
            $stmh->bindValue(':lun', $checked[1], PDO::PARAM_INT);
            $stmh->bindValue(':din', $checked[2], PDO::PARAM_INT);
            $stmh->bindValue(':kessyoku_id', $kessyoku_id, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // kessyokuテーブル内に同じkessyoku_idが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_kid($kessyoku_id)
    {
        try {
            $sql = "SELECT * FROM kessyoku WHERE kessyou_id = :kessyoku_id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':kessyoku_id', $kessyoku_id, PDO::PARAM_INT);
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
    // グループに属する欠食を取りだす。
    //----------------------------------------------------
    public function getKessyokuByGroup($group_id)
    {
        $sql = <<<EOS
        SELECT * FROM kessyoku WHERE group_id = :group_id
        EOS;

        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_STR);
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
    // id,日付が同じである欠食グループの、group_idを一つだけ返す
    //----------------------------------------------------
    public function same_date($id, $date)
    {
        try {
            $sql = "SELECT group_id FROM kessyoku WHERE id = :id AND date = :date limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
            $stmh->execute();
            $group_id = $stmh->fetch(PDO::FETCH_ASSOC);
            $group_id = $group_id['group_id'];
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $group_id;
    }


    //----------------------------------------------------
    // dateでソートし、group_idでグループ化する
    //----------------------------------------------------
    public function getGroupByGroup($id, $AorD)
    {
        try {
            $sql = "SELECT group_id FROM kessyoku WHERE id = :id GROUP BY group_id ORDER BY date";
            if ($AorD == "A") {
                $sql .= " ASC";
            } else {
                $sql .= " DEC";
            }
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $group_ids = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row as $value) {
                    $group_ids[] = $value;
                }
            }
            //$group_ids = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $group_ids;
    }


    //----------------------------------------------------
    // kessyoku_idに該当する欠食申請の日付を取り出す
    //----------------------------------------------------
    public function getDateBykessyoku_id($kessyoku_id)
    {
        $state = "";
        try {
            $sql = "SELECT date FROM kessyoku WHERE kessyoku_id = :kessyoku_id  limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':kessyoku_id', $kessyoku_id, PDO::PARAM_INT);
            $stmh->execute();
            $date = $stmh->fetch(PDO::FETCH_ASSOC);
            $date = $date['date'];
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $date;
    }


    //----------------------------------------------------
    // 渡された$group_idに属する欠食申請を削除
    //----------------------------------------------------
    public function deleteKessyokuByGroup($group_id, $three_days_ago)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM kessyoku WHERE group_id = :group_id AND date>=:three_days_ago";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT);
            $stmh->bindValue(':three_days_ago', $three_days_ago, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // 渡された$kessyoku_idをもつ欠食申請を削除
    //----------------------------------------------------
    public function deleteKessyokuByKessyoku_id($kessyoku_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM kessyoku WHERE kessyoku_id = :kessyoku_id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':kessyoku_id', $kessyoku_id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //------------------------------------------------------------
    // 同じ$group_idに属する欠食申請が一つでも存在すればtrueを返します
    //------------------------------------------------------------
    public function checkGroup($group_id)
    {
        try {
            $sql = "SELECT * FROM kessyoku WHERE group_id = :group_id ";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT);
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
    // ３日後を過ぎた欠食申請単体の自動削除&&欠食申請が紐づけされていない欠食グループの削除
    //----------------------------------------------------
    public function auto_delete_kessyoku($three_days_ago)
    {
        $sql = <<<EOS
        DELETE kessyoku FROM kessyoku JOIN Kgroup ON kessyoku.group_id = Kgroup.group_id WHERE kessyoku.date < :three AND ( Kgroup.app = '未閲覧' OR Kgroup.app = '閲覧' )
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':three', $three_days_ago . " 23:59:59", PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE Kgroup FROM Kgroup LEFT OUTER JOIN kessyoku ON kessyoku.group_id = Kgroup.group_id WHERE kessyoku.group_id IS NULL";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }

    }

    //----------------------------------------------------
    // 指定された日の欠食申請をリストにして返す
    //----------------------------------------------------
    public function get_applist($date)
    {
        $sql = <<<EOS
        SELECT * FROM kessyoku JOIN Kgroup ON kessyoku.group_id = Kgroup.group_id JOIN member ON kessyoku.id = member.id WHERE kessyoku.date = :date AND Kgroup.app = '受理'
        EOS;

        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
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

}