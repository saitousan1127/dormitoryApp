<?php
/**
 * Description of KgroupModel
 *
 * @author nagatayorinobu
 */
class KgroupModel extends BaseModel
{
    //----------------------------------------------------
    // 欠食届登録処理
    //----------------------------------------------------
    public function registGroup($id, $grade, $reason, $auto_delete)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO Kgroup ( id, sub_date, grade, reason, app, state, auto_delete)
                VALUES ( :id, now(), :grade, :reason, '未閲覧' , now(), :auto_delete)";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->bindValue(':grade', $grade, PDO::PARAM_STR);
            $stmh->bindValue(':reason', $reason, PDO::PARAM_STR);
            $stmh->bindValue(':auto_delete', $auto_delete, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }

        try {
            $sql = "SELECT group_id FROM Kgroup  WHERE id = :id ORDER BY group_id DESC limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->execute();
            $group_id = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $group_id;
    }


    //----------------------------------------------------
    //$group_idによる欠食申請情報の更新処理
    //----------------------------------------------------
    public function modifyByGroup_id($group_id, $kessyoku)
    {
        $sql = "UPDATE  Kgroup
                      SET
                        grade       = :grade,
                        reason      = :reason,
                        app         = :app,
                        comment     = :comment,
                        app_date    = now()
                        WHERE group_id = :group_id limit 1";
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':grade', $kessyoku['grade'], PDO::PARAM_STR);
            $stmh->bindValue(':reason', $kessyoku['reason'], PDO::PARAM_STR);
            $stmh->bindValue(':app', $kessyoku['app'], PDO::PARAM_STR);
            $stmh->bindValue(':comment', $kessyoku['comment'], PDO::PARAM_STR);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT); //ユーザデータのIDを格納する
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // 欠食届グループ情報をgroup_idで検索
    //----------------------------------------------------
    public function get_data_group_id($group_id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM Kgroup WHERE group_id = :group_id limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }


    //----------------------------------------------------
    //すべての欠食届の開放
    //----------------------------------------------------
    public function all_open($group_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  Kgroup
                      SET 
                        state = now()
                      WHERE group_id = :group_id";

            $stmh = $this->pdo->prepare($sql);
            //$stmh->bindValue(':state',   'open',   PDO::PARAM_STR );
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT); //外泊願IDを格納する
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }



    //----------------------------------------------------
    //group_idによる欠食理由の更新処理
    //----------------------------------------------------
    public function modify_Kgroup($group_id, $reason, $auto_delete)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  Kgroup
                      SET
                        reason = :reason,
                        auto_delete = :auto_delete
                      WHERE group_id = :group_id limit 1";

            //if(!isset($gahaku['reason'])){
            //$gaihaku['reason'] = $gaihaku['dest']['reason'];
            //}

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':reason', $reason, PDO::PARAM_INT);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_STR);
            $stmh->bindValue(':auto_delete', $auto_delete, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }



    //----------------------------------------------------
    //欠食届のロック
    //----------------------------------------------------
    public function close($group_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  Kgroup
                      SET 
                        state = :state
                      WHERE group_id = :group_id limit 1";

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':state', date("Y-m-d H:i:s", strtotime("+5 minute")), PDO::PARAM_STR);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT); //外泊願IDを格納する
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }



    //----------------------------------------------------
    //欠食届の開放
    //----------------------------------------------------
    public function open($group_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  Kgroup
                      SET 
                        state = now()
                      WHERE group_id = :group_id limit 1";

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT); //外泊願IDを格納する
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // group_idに該当する欠食届のstateが現時刻を確認
    //----------------------------------------------------
    public function getStateByGroup($group_id)
    {
        $state = "";
        try {
            $sql = "SELECT state FROM Kgroup WHERE group_id = :group_id  limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT);
            $stmh->execute();
            $state = $stmh->fetch(PDO::FETCH_ASSOC);
            $state = $state['state'];
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $state;
    } //参考


    //----------------------------------------------------
    // Kgroupテーブル内に同じgroup_idが1個以上あり、app="未閲覧"だったらtureを返す
    //----------------------------------------------------
    public function checkAppByGroup($group_id)
    {
        try {
            $sql = "SELECT * FROM Kgroup WHERE group_id = :group_id AND app='未閲覧'";
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
    // Kgroupテーブル内に同じgroup_idが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_Gid($group_id)
    {
        try {
            $sql = "SELECT * FROM Kgroup WHERE group_id = :group_id";
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
    // 提出した欠食届の履歴を見る
    //----------------------------------------------------
    public function get_log($id, $sub_day, $group_id, $sort, $grade, $app, $reason, $comment)
    {
        $sql = <<<EOS
        SELECT * FROM Kgroup WHERE id = :id
        EOS;

        if ($sub_day != "") {
            $sql .= " AND sub_date BETWEEN :first AND :last";
        }

        if ($group_id != "") {
            $sql .= " AND group_id = :group_id";
        }

        if ($grade != "") {
            $sql .= " AND grade = :grade";
        }
        if ($app != "") {
            $sql .= " AND app = :app";

        }

        if ($reason != "") {
            if ($reason == "帰省以外") {
                $sql .= " AND reason != '帰省'";
            } else {
                $sql .= " AND reason = '帰省'";
            }
        }

        if ($comment != "") {
            if ($comment == "with_comment") {
                $sql .= " AND comment IS NOT NULL  ";
            } else if ($comment == "without_comment") {
                $sql .= " AND( comment IS NULL )";
            }
        }

        /*if($group_ids != ""){
        $i=0;
        $j=1;
        $sql .= " CASE group_id";
        foreach($group_ids as $item){
        $sql .= " WHEN $item THEN $j";
        $i++;
        $j++;
        }
        }*/

        if ($sort != "") {
            $AorD = substr($sort, -1);
            if ($AorD == 'A') {
                $sql .= " ORDER BY sub_date ASC";
            } else {
                if ($AorD == 'D') {
                    $sql .= " ORDER BY sub_date DESC";

                }
            }
        } else {
            $sql .= " ORDER BY sub_date DESC";
        }

        try {
            $stmh = $this->pdo->prepare($sql);
            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }
            if ($group_id != "") {
                $stmh->bindValue(':group_id', $group_id, PDO::PARAM_STR);
            }
            if ($grade != "") {
                $stmh->bindValue(':grade', $grade, PDO::PARAM_STR);
            }
            if ($app != "") {
                $stmh->bindValue(':app', $app, PDO::PARAM_STR);

            }
            /*if($group_ids != ""){
            $i=0;
            foreach($group_ids as $item){
            $stmh->bindValue(":id".$i,  $item, PDO::PARAM_INT);
            $i++;
            }
            }*/
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
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
    // 事務室が提出された欠食届のリストを見る
    //----------------------------------------------------
    public function get_list($name, $sub_day, $sort, $grade, $reason)
    {
        $sql1 = "";
        $sql2 = "";
        $sql1 = <<<EOS
        SELECT * FROM Kgroup JOIN member ON Kgroup.id = member.id AND ( Kgroup.app = "未閲覧" OR Kgroup.app = "閲覧") AND ( Kgroup.state <= :now ) AND member.ban = 0
        EOS;

        if ($name != "") {
            $sql1 .= " AND (member.last_name like :last_name OR member.first_name like :first_name OR member.h_last_name like :h_last_name OR member.h_first_name like :h_first_name OR member.k_last_name like :k_last_name OR member.k_first_name like :k_first_name)";
        }

        if ($sub_day != "") {
            $sql1 .= " AND Kgroup.sub_date BETWEEN :first AND :last";
        }

        if ($grade != "") {
            $sql1 .= " AND Kgroup.grade = :grade";
        }

        if ($reason != "") {
            if ($reason == "帰省以外") {
                $sql1 .= " AND Kgroup.reason != '帰省'";
            } else {
                $sql1 .= " AND Kgroup.reason = '帰省'";
            }
        }

        if ($sort != "") {
            $AorD = substr($sort, -1);
            $column = substr($sort, 0, -1);
            if ($AorD == 'A') {
                switch ($column) {
                    case "name":
                        $sql .= " ORDER BY member.k_last_name ASC, member.k_first_name ASC";
                        break;

                    case "sub":
                        $sql .= " ORDER BY Kgroup.sub_date ASC";
                        break;

                    case "grade":
                        $sql .= " ORDER BY Kgroup.grade ASC";
                        break;

                    default:
                }
            } else {
                if ($AorD == 'D') {
                    switch ($column) {
                        case "name":
                            $sql .= " ORDER BY member.k_last_name DESC, member.k_first_name DESC";
                            break;

                        case "sub":
                            $sql .= " ORDER BY Kgroup.sub_date DESC";
                            break;

                        case "grade":
                            $sql .= " ORDER BY Kgroup.grade DESC";
                            break;

                        default:
                    }
                }
            }
        } else {
            $sql1 .= " ORDER BY Kgroup.sub_date ASC";
        }

        try {
            $stmh = $this->pdo->prepare($sql1);
            if ($name != "") {
                $name = '%' . $name . '%';
                $stmh->bindValue(':last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_first_name', $name, PDO::PARAM_STR);
            }
            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }
            if ($grade != "") {
                $stmh->bindValue(':grade', $grade, PDO::PARAM_STR);
            }
            $stmh->bindValue(':now', date("Y/m/d H:i:s"), PDO::PARAM_STR);
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

        $sql2 = <<<EOS
        UPDATE Kgroup JOIN member ON Kgroup.id = member.id SET app = "閲覧" WHERE Kgroup.app = '未閲覧' AND( Kgroup.state <= :now )
        EOS;


        if ($name != "") {
            $sql1 .= " AND (member.last_name like :last_name OR member.first_name like :first_name OR member.h_last_name like :h_last_name OR member.h_first_name like :h_first_name OR member.k_last_name like :k_last_name OR member.k_first_name like :k_first_name)";
        }

        if ($sub_day != "") {
            $sql1 .= " AND Kgroup.sub_date BETWEEN :first AND :last";
        }

        if ($grade != "") {
            $sql1 .= " AND Kgroup.grade = :grade";
        }

        if ($reason != "") {
            if ($reason == "帰省以外") {
                $sql1 .= " AND Kgroup.reason != '帰省'";
            } else {
                $sql1 .= " AND Kgroup.reason = '帰省'";
            }
        }

        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql2);
            if ($name != "") {
                $name = '%' . $name . '%';
                $stmh->bindValue(':last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_first_name', $name, PDO::PARAM_STR);
            }
            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }
            if ($grade != "") {
                $stmh->bindValue(':grade', $grade, PDO::PARAM_STR);
            }

            $stmh->bindValue(':now', date("Y/m/d H:i:s"), PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }

        return [$data, $count];
    }


    //----------------------------------------------------
    // 処理した欠食届の履歴を見る
    //----------------------------------------------------
    public function get_applog($name, $sub_day, $app_day, $sort, $grade, $app, $reason, $comment)
    {
        $sql = <<<EOS
        SELECT * FROM Kgroup JOIN member ON Kgroup.id = member.id AND ( Kgroup.app = '受理' OR Kgroup.app = '却下' )
        EOS;

        if ($name != "") {
            $sql .= " AND (member.last_name like :last_name OR member.first_name like :first_name OR member.h_last_name like :h_last_name OR member.h_first_name like :h_first_name OR member.k_last_name like :k_last_name OR member.k_first_name like :k_first_name)";
        }

        if ($sub_day != "") {
            $sql .= " AND Kgroup.sub_date BETWEEN :first AND :last";
        }

        if ($app_day != "") {
            $sql .= " AND Kgroup.app_date BETWEEN :first2 AND :last2";
        }

        if ($grade != "") {
            $sql .= " AND Kgroup.grade = :grade";
        }

        if ($app != "") {
            $sql .= " AND Kgroup.app = :app";
        }

        if ($reason != "") {
            if ($reason == "帰省以外") {
                $sql .= " AND Kgroup.reason != '帰省'";
            } else {
                $sql .= " AND Kgroup.reason = '帰省'";
            }
        }

        if ($comment != "") {
            if ($comment == "with_comment") {
                $sql .= " AND Kgroup.comment IS NOT NULL  ";
            } else if ($comment == "without_comment") {
                $sql .= " AND( Kgroup.comment IS NULL )";
            }
        }

        if ($sort != "") {
            $AorD = substr($sort, -1);
            $column = substr($sort, 0, -1);
            if ($AorD == 'A') {
                switch ($column) {
                    case "name":
                        $sql .= " ORDER BY member.k_last_name ASC, member.k_first_name ASC";
                        break;

                    case "grade":
                        $sql .= " ORDER BY Kgroup.grade ASC";
                        break;

                    case "sub":
                        $sql .= " ORDER BY Kgroup.sub_date ASC";
                        break;

                    case "app":
                        $sql .= " ORDER BY Kgroup.app_date ASC";
                        break;

                    default:
                }
            } else {
                if ($AorD == 'D') {
                    switch ($column) {
                        case "name":
                            $sql .= " ORDER BY member.k_last_name DESC, member.k_first_name DESC";
                            break;

                        case "grade":
                            $sql .= " ORDER BY Kgroup.grade DESC";
                            break;

                        case "sub":
                            $sql .= " ORDER BY Kgroup.sub_date DESC";
                            break;

                        default:
                    }
                }
            }
        } else {
            $sql .= " ORDER BY Kgroup.app_date DESC";
        }

        try {
            $stmh = $this->pdo->prepare($sql);
            if ($name != "") {
                $name = '%' . $name . '%';
                $stmh->bindValue(':last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_first_name', $name, PDO::PARAM_STR);
            }
            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }
            if ($app_day != "") {
                $stmh->bindValue(':first2', substr($app_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last2', substr($app_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }
            if ($grade != "") {
                $stmh->bindValue(':grade', $grade, PDO::PARAM_STR);
            }
            if ($app != "") {
                $stmh->bindValue(':app', $app, PDO::PARAM_STR);
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
    // 渡された$group_idの欠食届グループを削除
    //----------------------------------------------------
    public function delete_group($group_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM Kgroup WHERE group_id = :group_id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 欠食届全体の自動削除機能
    //----------------------------------------------------
    public function auto_delete_Kgroup($three_days_ago)
    {
        $sql = <<<EOS
        SELECT Kgroup.group_id FROM Kgroup JOIN kessyoku ON Kgroup.group_id = kessyoku.group_id AND Kgroup.auto_delete = 1 AND kessyoku.date < :three AND ( Kgroup.app = '未閲覧' OR Kgroup.app = '閲覧' ) limit 1 
        EOS;

        $flag = true;
        while ($flag) {
            $group_id = "";
            try {
                $stmh = $this->pdo->prepare($sql);
                $stmh->bindValue(':three', $three_days_ago . " 23:59:59", PDO::PARAM_STR);
                $stmh->execute();
                // 検索件数を取得
                $count = $stmh->rowCount();
                // 検索結果を多次元配列で受け取る
                if ($count == 0) {
                    $flag = false;
                } else {
                    $group_id = $stmh->fetch(PDO::FETCH_ASSOC);
                    $group_id = $group_id['group_id'];
                }
            } catch (PDOException $Exception) {
                print "エラー：" . $Exception->getMessage();
            }

            if ($flag) {
                try {
                    $this->pdo->beginTransaction();
                    $sql2 = "DELETE FROM kessyoku WHERE group_id = :group_id";
                    $stmh = $this->pdo->prepare($sql2);
                    $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT);
                    $stmh->execute();
                    $this->pdo->commit();
                } catch (PDOException $Exception) {
                    $this->pdo->rollBack();
                    print "エラー：" . $Exception->getMessage();
                }

                try {
                    $this->pdo->beginTransaction();
                    $sql2 = "DELETE FROM Kgroup WHERE group_id = :group_id";
                    $stmh = $this->pdo->prepare($sql2);
                    $stmh->bindValue(':group_id', $group_id, PDO::PARAM_INT);
                    $stmh->execute();
                    $this->pdo->commit();
                } catch (PDOException $Exception) {
                    $this->pdo->rollBack();
                    print "エラー：" . $Exception->getMessage();
                }
            }
        }
    }


    //----------------------------------------------------------------------------------
    // 提出が指定された日付をよりも前の欠食届の削除&&欠食申請が紐づけされていない欠食グループの削除
    //----------------------------------------------------------------------------------
    public function delete_old_kessyoku($date)
    {
        $sql = <<<EOS
        DELETE kessyoku FROM kessyoku JOIN Kgroup ON kessyoku.group_id = Kgroup.group_id WHERE Kgroup.reg_date < :date
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
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


    //----------------------------------------------------------------------------------
    // 提出した寮生アカウントの登録日が指定された日付よりも前の欠食申請を削除&&欠食申請が紐づけされていない欠食グループの削除
    //----------------------------------------------------------------------------------
    public function delete_old_member_kessyoku($date)
    {
        $sql = <<<EOS
        DELETE kessyoku FROM kessyoku JOIN member ON kessyoku.id = member.id WHERE member.reg_date < :date
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', $date, PDO::PARAM_STR);
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

    //----------------------------------------------------------------------------------
    // BANされている寮生の提出した欠食申請の全削除&&欠食申請が紐づけされていない欠食グループの削除
    //----------------------------------------------------------------------------------
    public function delete_ban_member_kessyoku()
    {
        $sql = <<<EOS
        DELETE kessyoku FROM kessyoku JOIN member ON kessyoku.id = member.id WHERE member.ban = 1
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
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


    //----------------------------------------------------------------------------------
    // 渡された寮生idの欠食届を全削除&&欠食申請が紐づけされていない欠食グループの削除
    //----------------------------------------------------------------------------------
    public function all_delete_member_id($id)
    {
        $sql = <<<EOS
        DELETE FROM kessyoku WHERE id = :id
        EOS;
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
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



}