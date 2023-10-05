<?php

/**
 * Description of gaihakuModel
 *
 * @author nagatayorinobu
 */
class roomModel extends BaseModel
{

    //----------------------------------------------------
    // 外泊願登録処理
    //----------------------------------------------------
    public function regist_room($roomnum)
    {
        $sql = "INSERT  INTO room (roomnum, habitability, room_username) VALUES (:roomnum, TRUE, NULL)";
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':roomnum', $roomnum, PDO::PARAM_STR); //部屋番号格納
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 指定の部屋番号のusernameを変更
    //----------------------------------------------------
    public function regist_username($username, $roomnum)
    { //元
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE room SET room_username = :username WHERE roomnum = :roomnum";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $username, PDO::PARAM_STR);
            $stmh->bindValue(':roomnum', $roomnum, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 同じ部屋番号が存在する場合にTRUEが返る
    //----------------------------------------------------
    public function check_room($roomnum)
    {
        try {
            $sql = "SELECT * FROM room WHERE roomnum = :roomnum ";
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
    // 部屋番号が存在し、かつ居住可能の場合にTRUEが返る
    //----------------------------------------------------
    public function knock_room($roomnum)
    {
        try {
            $sql = "SELECT * FROM room WHERE roomnum = :roomnum AND habitability = 1";
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
    // usernameが既に登録済みでないかを調べる
    //----------------------------------------------------
    public function check_username($roomnum, $username = "")
    {
        $sql = "SELECT * FROM room WHERE roomnum = :roomnum AND room_username IS NOT NULL";
        if ($username != "") {
            $sql .= " AND room_username != :username";
        }
        try {
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':roomnum', $roomnum, PDO::PARAM_STR);
            if ($username != "") {
                $stmh->bindValue(':username', $username, PDO::PARAM_STR);
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
    // usernameが登録された部屋を返す
    //----------------------------------------------------
    public function getRoomByusername($username)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM room WHERE room_username = :username  limit 1";
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
    // usernameが登録された部屋のusernameをNULLにする
    //----------------------------------------------------
    public function delete_username($username)
    {

        $sql = <<<EOS
        UPDATE room SET room_username = NULL WHERE room_username = :username
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $username, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // roomテーブルに登録された全usernameを削除する
    //----------------------------------------------------
    public function delete_all_username()
    {

        $sql = <<<EOS
        UPDATE room SET room_username = NULL
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 渡されたroomnumの部屋を削除する
    //----------------------------------------------------
    public function delete_room($roomnum)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM room WHERE roomnum = :roomnum";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':roomnum', $roomnum, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // usernameが登録された部屋のusernameをNULLにして、部屋にusernameを登録する
    //----------------------------------------------------
    public function modify_username($username, $roomnum)
    { //新出
        $this->delete_username($username);
        $sql = <<<EOS
        UPDATE room SET room_username = :username WHERE roomnum = :roomnum
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':username', $username, PDO::PARAM_STR);
            $stmh->bindValue(':roomnum', $roomnum, PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // 部屋の一覧を取得
    //----------------------------------------------------
    public function get_room_list($tou, $floor)
    {
        $sql = <<<EOS
        SELECT * FROM room LEFT JOIN member ON room.room_username = member.username ORDER BY room.roomnum
        EOS;

        if ($floor != "") {
            $sql .= " WHERE( room.roomnum like :nfloor OR room.roomnum like :efloor OR room.roomnum like :sfloor)";
        }

        try {
            $stmh = $this->pdo->prepare($sql);

            if ($floor != "") {
                $stmh->bindValue(':nfloor', "N" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':efloor', "E" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':sfloor', "S" . $floor . "%", PDO::PARAM_STR);
            }
            $stmh->execute();
            // 検索件数を取得
            $count = $stmh->rowCount();
            // 検索結果を多次元配列で受け取る
            if (!isset($count)) {
                $count = 0;
            }
            $i = 0;
            $Ndata = [];
            $Edata = [];
            $Sdata = [];
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                if ($row['habitability']) {
                    $row['checkT'] = 'checked';
                    $row['checkF'] = '';
                } else {
                    $row['checkT'] = '';
                    $row['checkF'] = 'checked';
                }

                if ($tou != "") {
                    if (substr($row['roomnum'], 0, 1) == $tou) {
                        switch ($tou) {
                            case "E":
                                foreach ($row as $key => $value) {
                                    $Edata[$i][$key] = $value;
                                }
                                break;

                            case "N":
                                foreach ($row as $key => $value) {
                                    $Ndata[$i][$key] = $value;
                                }
                                break;

                            case "S":
                                foreach ($row as $key => $value) {
                                    $Sdata[$i][$key] = $value;
                                }
                                break;
                            default:
                        }
                    }

                } else {
                    switch (substr($row['roomnum'], 0, 1)) {
                        case "E":
                            foreach ($row as $key => $value) {
                                $Edata[$i][$key] = $value;
                            }
                            break;

                        case "N":
                            foreach ($row as $key => $value) {
                                $Ndata[$i][$key] = $value;
                            }
                            break;

                        case "S":
                            foreach ($row as $key => $value) {
                                $Sdata[$i][$key] = $value;
                            }
                            break;
                        default:
                    }
                }

                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$Ndata, $Edata, $Sdata, $sql];
    }

}