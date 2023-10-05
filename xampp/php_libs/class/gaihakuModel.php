<?php

/**
 * Description of gaihakuModel
 *
 * @author nagatayorinobu
 */
class gaihakuModel extends BaseModel
{

    //----------------------------------------------------
    // 外泊願登録処理
    //----------------------------------------------------
    public function regist_gaihaku($id, $gaihaku)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT  INTO gaihaku (id, group_id, sub_date, class, roomnum, psCode1, psCode2, address,
            last_name2 ,first_name2, tel, s_day, s_time, f_day, f_time, reason, riyuu, state, auth, app)
            VALUES (:id, :group_id, now(), :class, :roomnum, :psCode1, :psCode2, :address,
            :last_name2 ,:first_name2, :tel, :s_day, :s_time, :f_day, :f_time, :reason, :riyuu, now(), :auth, :app)";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT); //ユーザデータのIDを格納する
            $stmh->bindValue(':group_id', $gaihaku['group_id'], PDO::PARAM_INT);
            $stmh->bindValue(':class', $gaihaku['class'], PDO::PARAM_STR);
            $stmh->bindValue(':roomnum', $gaihaku['roomnum'], PDO::PARAM_STR);
            $stmh->bindValue(':psCode1', $gaihaku['psCode1'], PDO::PARAM_INT);
            $stmh->bindValue(':psCode2', $gaihaku['psCode2'], PDO::PARAM_INT);
            $stmh->bindValue(':address', $gaihaku['address'], PDO::PARAM_STR);
            $stmh->bindValue(':last_name2', $gaihaku['last_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name2', $gaihaku['first_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':tel', $gaihaku['tel'], PDO::PARAM_STR);
            $stmh->bindValue(':s_day', $gaihaku['s_day'], PDO::PARAM_STR);
            $stmh->bindValue(':s_time', $gaihaku['s_time'], PDO::PARAM_STR);
            $stmh->bindValue(':f_day', $gaihaku['f_day'], PDO::PARAM_STR);
            $stmh->bindValue(':f_time', $gaihaku['f_time'], PDO::PARAM_STR);
            $stmh->bindValue(':reason', $gaihaku['dest']['reason'], PDO::PARAM_STR);
            $stmh->bindValue(':riyuu', $gaihaku['riyuu'], PDO::PARAM_STR);
            $stmh->bindValue(':auth', $gaihaku['auth'], PDO::PARAM_INT);
            $stmh->bindValue(':app', $gaihaku['app'], PDO::PARAM_STR);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 外泊願情報を外泊願IDで検索
    //----------------------------------------------------
    public function get_data_gid($gaihaku_id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM gaihaku JOIN member ON gaihaku.id = member.id AND gaihaku.gaihaku_id = :gaihaku_id  limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }


    //----------------------------------------------------
    //外泊願のロック
    //----------------------------------------------------
    public function close($gaihaku_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  gaihaku
                      SET 
                        state = :state
                      WHERE gaihaku_id = :gaihaku_id limit 1";

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':state', date("Y-m-d H:i:s", strtotime("+5 minute")), PDO::PARAM_STR);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT); //外泊願IDを格納する
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    //外泊願の開放
    //----------------------------------------------------
    public function open($gaihaku_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  gaihaku
                      SET 
                        state = now()
                      WHERE gaihaku_id = :gaihaku_id limit 1";

            $stmh = $this->pdo->prepare($sql);
            //$stmh->bindValue(':state',   'open',   PDO::PARAM_STR );
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT); //外泊願IDを格納する
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    //すべての外泊願の開放
    //----------------------------------------------------
    public function all_open($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  gaihaku
                      SET 
                        state = now()
                      WHERE id = :id";

            $stmh = $this->pdo->prepare($sql);
            //$stmh->bindValue(':state',   'open',   PDO::PARAM_STR );
            $stmh->bindValue(':id', $id, PDO::PARAM_INT); //外泊願IDを格納する
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    //外泊願idによる情報の更新処理
    //----------------------------------------------------
    public function modifyBygaihaku_id($gaihaku_id, $gaihaku)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE  gaihaku
                      SET
                        class       = :class,
                        roomnum     = :roomnum,
                        psCode1     = :psCode1,
                        psCode2     = :psCode2,
                        address     = :address,
                        last_name2  = :last_name2,
                        first_name2 = :first_name2,
                        tel         = :tel,
                        s_day       = :s_day,
                        s_time      = :s_time,
                        f_day       = :f_day,
                        f_time      = :f_time,
                        reason      = :reason,
                        riyuu       = :riyuu,
                        ryoukan     = :ryoukan,
                        teacher     = :teacher,
                        app         = :app,
                        app_date    = :app_date,
                        comment     = :comment
                      WHERE gaihaku_id = :gaihaku_id limit 1";

            //if(!isset($gahaku['reason'])){
            //$gaihaku['reason'] = $gaihaku['dest']['reason'];
            //}

            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':class', $gaihaku['class'], PDO::PARAM_STR);
            $stmh->bindValue(':roomnum', $gaihaku['roomnum'], PDO::PARAM_STR);
            $stmh->bindValue(':psCode1', $gaihaku['psCode1'], PDO::PARAM_INT);
            $stmh->bindValue(':psCode2', $gaihaku['psCode2'], PDO::PARAM_INT);
            $stmh->bindValue(':address', $gaihaku['address'], PDO::PARAM_STR);
            $stmh->bindValue(':last_name2', $gaihaku['last_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':first_name2', $gaihaku['first_name2'], PDO::PARAM_STR);
            $stmh->bindValue(':tel', $gaihaku['tel'], PDO::PARAM_STR);
            $stmh->bindValue(':s_day', $gaihaku['s_day'], PDO::PARAM_STR);
            $stmh->bindValue(':s_time', $gaihaku['s_time'], PDO::PARAM_STR);
            $stmh->bindValue(':f_day', $gaihaku['f_day'], PDO::PARAM_STR);
            $stmh->bindValue(':f_time', $gaihaku['f_time'], PDO::PARAM_STR);
            $stmh->bindValue(':reason', $gaihaku['reason'], PDO::PARAM_STR);
            $stmh->bindValue(':riyuu', $gaihaku['riyuu'], PDO::PARAM_STR);
            $stmh->bindValue(':ryoukan', $gaihaku['ryoukan'], PDO::PARAM_STR);
            $stmh->bindValue(':teacher', $gaihaku['teacher'], PDO::PARAM_STR);
            $stmh->bindValue(':app', $gaihaku['app'], PDO::PARAM_STR);
            $stmh->bindValue(':app_date', $gaihaku['app_date'], PDO::PARAM_STR);
            if ($gaihaku["comment"] == "") {
                $gaihaku["comment"] = NULL;
            }
            $stmh->bindValue(':comment', $gaihaku['comment'], PDO::PARAM_STR);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT); //ユーザデータのIDを格納する
            $stmh->execute();
            $this->pdo->commit();
            //print "データを" . $stmh->rowCount() . "件、更新しました。<br>";
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }


    //----------------------------------------------------
    // 同じidで外泊期間が重なっている外泊願があればtrueを返す
    //----------------------------------------------------
    public function check_term($id, $s_day, $f_day)
    {
        try {
            $sql = "SELECT * FROM gaihaku WHERE id = :id AND ( (s_day BETWEEN :s_day AND :f_day) OR (f_day BETWEEN :s_day2 AND :f_day2) )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->bindValue(':s_day', $s_day, PDO::PARAM_STR);
            $stmh->bindValue(':f_day', $f_day, PDO::PARAM_STR);
            $stmh->bindValue(':s_day2', $s_day, PDO::PARAM_STR);
            $stmh->bindValue(':f_day2', $f_day, PDO::PARAM_STR);
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
    // 同じidで外泊期間が重なっている外泊願があればtrueを返す
    //----------------------------------------------------
    public function check_other_term($id, $gaihaku_id, $s_day, $f_day)
    {
        try {
            $sql = "SELECT * FROM gaihaku WHERE id = :id AND (gaihaku_id != :gaihaku_id) AND ( (s_day BETWEEN :s_day AND :f_day) OR (f_day BETWEEN :s_day2 AND :f_day2) )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT);
            $stmh->bindValue(':s_day', $s_day, PDO::PARAM_STR);
            $stmh->bindValue(':f_day', $f_day, PDO::PARAM_STR);
            $stmh->bindValue(':s_day2', $s_day, PDO::PARAM_STR);
            $stmh->bindValue(':f_day2', $f_day, PDO::PARAM_STR);
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
    // その日に該当する外泊願が提出されていればtrueを返す
    //----------------------------------------------------
    public function check_todays($id)
    {
        try {
            $sql = "SELECT * FROM gaihaku WHERE id = :id AND ( :today BETWEEN s_day AND f_day )";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
            $stmh->bindValue(':today', date('Y-m-d'), PDO::PARAM_STR);
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
    // gaihakuテーブル内に同じidが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_id($id)
    {
        try {
            $sql = "SELECT * FROM gaihaku WHERE id = :id ";
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
    // gaihakuテーブル内に同じgaihaku_idが1個以上あればtrueが返ります。
    //----------------------------------------------------
    public function check_gid($gaihaku_id)
    {
        try {
            $sql = "SELECT * FROM gaihaku WHERE gaihaku_id = :gaihaku_id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT);
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
    // gaihakuテーブル内に同じgaihaku_idが1個以上あり、app="未閲覧"だったらtureを返す
    //----------------------------------------------------
    public function checkAppBygid($gaihaku_id)
    {
        try {
            $sql = "SELECT * FROM gaihaku WHERE gaihaku_id = :gaihaku_id AND app='未閲覧'";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT);
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
    // gaihaku_idに該当する外泊願のstateが現時刻を確認
    //----------------------------------------------------
    public function getStateBygid($gaihaku_id)
    {
        $state = "";
        try {
            $sql = "SELECT state FROM gaihaku WHERE gaihaku_id = :gaihaku_id  limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT);
            $stmh->execute();
            $state = $stmh->fetch(PDO::FETCH_ASSOC);
            $state = $state['state'];
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $state;
    }




    //----------------------------------------------------
    // gaihakuテーブル内に未処理の外泊願があるならtrueを返す
    //----------------------------------------------------
    public function check_outstanding($id)
    {
        try {
            $sql = 'SELECT * FROM gaihaku WHERE id = :id AND( app != "承認"  AND  app != "非承認")';
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
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
    // 渡された$idの外泊願を削除
    //----------------------------------------------------
    public function delete_gaihaku($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM gaihaku WHERE id = :id";
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
    // 渡された$idの外泊願を削除
    //----------------------------------------------------
    public function deleteGaihakuByGid($gaihaku_id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM gaihaku WHERE gaihaku_id = :gaihaku_id";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //----------------------------------------------------
    // 外泊願をユーザーIDで検索
    //----------------------------------------------------
    public function get_data_id($id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM gaihaku WHERE id = :id  limit 1";
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
    // 外泊願を外泊願IDで検索
    //----------------------------------------------------
    public function get_data_gaihaku_id($gaihaku_id)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM gaihaku WHERE gaihaku_id = :gaihaku_id  limit 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':gaihaku_id', $gaihaku_id, PDO::PARAM_INT);
            $stmh->execute();
            $data = $stmh->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return $data;
    }


    //------------------------------------------------------------------
    // 承認/非承認以外で外泊願の開始日・開始時間が過去になった外泊願を削除する
    //------------------------------------------------------------------
    public function delete_old()
    {
        $sql = "DELETE FROM gaihaku WHERE app != '承認' AND app != '非承認' AND ( s_day < :date OR (s_day = :date2 AND s_time < :hour ) )";
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql);
            $stmh->bindValue(':date', date('Y-m-d'), PDO::PARAM_STR);
            $stmh->bindValue(':date2', date('Y-m-d'), PDO::PARAM_STR);
            $stmh->bindValue(':hour', date('H'), PDO::PARAM_INT);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }



    //----------------------------------------------------------------------
    // 外泊願一覧取得処理※教員が担当しているクラスの未処理の外泊願リストを受け取る
    //----------------------------------------------------------------------
    public function get_list($id, $case, $name, $room, $sub_day, $day, $sort, $class, $sel_class, $tou, $floor)
    //$classが担任するクラスで、$sel_classが選択されたクラス
    {
        $sql1 = "";
        $sql2 = "";
        $sql1 = <<<EOS
        SELECT * FROM gaihaku JOIN member ON gaihaku.id = member.id AND gaihaku.teacher IS NULL AND gaihaku.ryoukan IS NULL AND ( gaihaku.app = "未閲覧" OR gaihaku.app = :id ) AND gaihaku.state <= :now AND member.ban = 0
        EOS;
        /*
        var_dump($id);
        var_dump($case);
        var_dump($name);
        var_dump($room);
        var_dump($sub_day);
        var_dump($day);
        var_dump($sort);
        var_dump($class);
        var_dump($sel_class);
        var_dump($tou);
        var_dump($floor);
        */

        if ($name != "") {
            $sql1 .= " AND (member.last_name like :last_name OR member.first_name like :first_name OR member.h_last_name like :h_last_name OR member.h_first_name like :h_first_name OR member.k_last_name like :k_last_name OR member.k_first_name like :k_first_name)";
        }

        switch ($case) {
            case 0: //役職、担任するクラスがなく、寮監でもない場合
                if ($class != "") {
                    $sql1 .= " AND gaihaku.auth = 0"; //なにも見せない
                }
                break;

            case 1: //担任が教員アカウントでログインしている場合
                if ($class != "") {
                    $sql1 .= " AND gaihaku.class = :class";
                }
                break;

            case 2: //寮務主事または担当主事補の場合
                $sql1 .= " AND ( gaihaku.auth = 2 OR gaihaku.auth = 3 )";
                if ($sel_class != "") {
                    $sql1 .= " AND gaihaku.class = :sel_class";
                }
                break;

            case 3: //担任が寮監になった場合
                if ($sel_class != "") {
                    if ($sel_class == $class) {
                        $sql1 .= " AND gaihaku.class = :class";
                    } else {
                        $sql1 .= " AND gaihaku.class = :sel_class AND gaihaku.auth = 3";
                    }
                } else {
                    $sql1 .= " AND (gaihaku.auth = 3 || gaihaku.class = :class )";
                }
                break;

            case 4: //担任でもなく寮務主事、担当主事補でもない教員が寮監になった場合
                $sql1 .= " AND gaihaku.auth = 3";
                if ($sel_class != "") {
                    $sql1 .= " AND gaihaku.class = :sel_class";
                }
                break;

            default:
        }

        if ($room != "") {
            $sql1 .= " AND gaihaku.roomnum=:room";
        }

        if ($sub_day != "") {
            $sql1 .= " AND gaihaku.sub_date BETWEEN :first AND :last";
        }

        if ($day != "") {
            $sql1 .= " AND :day BETWEEN gaihaku.s_day AND gaihaku.f_day";
        }

        if ($tou != "") {
            $sql1 .= " AND gaihaku.roomnum like :tou";
        }

        if ($floor != "") {
            $sql1 .= " AND( gaihaku.roomnum like :nfloor OR gaihaku.roomnum like :efloor  OR gaihaku.roomnum like :sfloor)";
        }

        if ($sort != "") {
            $AorD = substr($sort, -1);
            $column = substr($sort, 0, -1);
            if ($AorD == 'A') {
                switch ($column) {
                    case "name":
                        $sql1 .= " ORDER BY member.k_last_name ASC, member.k_first_name ASC";
                        break;

                    case "sub":
                        $sql1 .= " ORDER BY gaihaku.sub_date ASC";
                        break;

                    case "start":
                        $sql1 .= " ORDER BY gaihaku.s_day ASC, gaihaku.s_time ASC";
                        break;

                    case "between":
                        $sql1 .= " ORDER BY datediff(gaihaku.s_day,gaihaku.f_day) ASC";
                        break;

                    case "grade":
                        $sql1 .= " ORDER BY member.class ASC";
                        break;
                    default:
                }
            } else {
                if ($AorD == 'D') {
                    switch ($column) {
                        case "name":
                            $sql1 .= " ORDER BY member.k_last_name DESC, member.k_first_name DESC";
                            break;

                        case "sub":
                            $sql1 .= " ORDER BY gaihaku.sub_date DESC";
                            break;

                        case "start":
                            $sql1 .= " ORDER BY gaihaku.s_day DESC, gaihaku.s_time DESC";
                            break;

                        case "between":
                            $sql1 .= " ORDER BY datediff(gaihaku.s_day,gaihaku.f_day) DESC";
                            break;

                        case "grade":
                            $sql1 .= " ORDER BY member.class DESC";
                            break;
                        default:
                    }
                }

            }
        }
        //var_dump($sql1);
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

            switch ($case) {
                case 0: //役職、担任するクラスがなく、寮監でもない場合
                    break;

                case 1: //担任が教員アカウントでログインしている場合
                    if ($class != "") {
                        $stmh->bindValue(':class', $class, PDO::PARAM_STR);
                    }
                    break;

                case 2: //寮務主事または担当主事補の場合
                    if ($sel_class != "") {
                        $stmh->bindValue(':sel_class', $sel_class, PDO::PARAM_STR);
                    }
                    break;

                case 3: //担任が寮監になった場合
                    if ($sel_class != "") {
                        if ($sel_class == $class) {
                            $stmh->bindValue(':class', $class, PDO::PARAM_STR);
                        } else {
                            $stmh->bindValue(':sel_class', $sel_class, PDO::PARAM_STR);
                        }
                    } else {
                        $stmh->bindValue(':class', $class, PDO::PARAM_STR);
                    }
                    break;

                case 4: //担任でもなく寮務主事、担当主事補でもない教員が寮監になった場合
                    if ($sel_class != "") {
                        $stmh->bindValue(':sel_class', $sel_class, PDO::PARAM_STR);
                    }
                    break;

                default:
            }

            if ($room != "") {
                $stmh->bindValue(':room', $room, PDO::PARAM_STR);
            }

            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }

            if ($day != "") {
                $stmh->bindValue(':day', $day, PDO::PARAM_STR);
            }

            if ($tou != "") {
                $stmh->bindValue(':tou', $tou . "%", PDO::PARAM_STR);
            }

            if ($floor != "") {
                $stmh->bindValue(':nfloor', "N" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':efloor', "E" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':sfloor', "S" . $floor . "%", PDO::PARAM_STR);
            }

            $stmh->bindValue(':now', date("Y/m/d H:i:s"), PDO::PARAM_STR);
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
                switch (substr($row['roomnum'], 0, 1)) {
                    case "E":
                        $row['tou'] = "東寮";
                        break;

                    case "N":
                        $row['tou'] = "北寮";
                        break;

                    case "S":
                        $row['tou'] = "南寮";
                        break;

                    default:
                }
                foreach ($row as $key => $value) {
                    $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }

        $sql2 = <<<EOS
UPDATE gaihaku JOIN member ON gaihaku.id = member.id SET app = :id WHERE gaihaku.app = '未閲覧' AND gaihaku.teacher IS NULL AND gaihaku.ryoukan IS NULL AND gaihaku.state <= :now
EOS;


        if ($name != "") {
            $sql2 .= " AND(member.last_name like :last_name OR member.first_name like :first_name OR member.h_last_name like :h_last_name OR member.h_first_name like :h_first_name OR member.k_last_name like :k_last_name OR member.k_first_name like :k_first_name)";
        }

        switch ($case) {
            case 0: //役職、担任するクラスがなく、寮監でもない場合
                if ($class != "") {
                    $sql2 .= " AND gaihaku.auth = 0"; //なにも見せない
                }
                break;

            case 1: //担任が教員アカウントでログインしている場合
                if ($class != "") {
                    $sql2 .= " AND member.class = :class";
                }
                break;

            case 2: //寮務主事または担当主事補の場合
                $sql2 .= " AND ( gaihaku.auth = 2 OR gaihaku.auth = 3 )";
                if ($sel_class != "") {
                    $sql2 .= " AND member.class = :sel_class";
                }
                break;

            case 3: //担任が寮監になった場合
                if ($sel_class != "") {
                    if ($sel_class == $class) {
                        $sql2 .= " AND member.class = :class";
                    } else {
                        $sql2 .= " AND member.class = :sel_class AND gaihaku.auth = 3";
                    }
                } else {
                    $sql2 .= " AND gaihaku.auth = 3 || member.class=:class";
                }
                break;

            case 4: //担任でもなく寮務主事、担当主事補でもない教員が寮監になった場合
                $sql2 .= " AND gaihaku.auth = 3";
                if ($sel_class != "") {
                    $sql2 .= " AND member.class = :sel_class";
                }
                break;

            default:
        }

        if ($room != "") {
            $sql2 .= " AND gaihaku.roomnum=:room";
        }

        if ($sub_day != "") {
            $sql2 .= " AND gaihaku.sub_date BETWEEN :first AND :last";
        }

        if ($day != "") {
            $sql2 .= " AND :day BETWEEN gaihaku.s_day AND gaihaku.f_day";
        }

        if ($tou != "") {
            $sql2 .= " AND gaihaku.roomnum like :tou";
        }

        if ($floor != "") {
            $sql2 .= " AND( gaihaku.roomnum like :nfloor OR gaihaku.roomnum like :efloor  OR gaihaku.roomnum like :sfloor)";
        }
        //var_dump($sql2);
        try {
            $this->pdo->beginTransaction();
            $stmh = $this->pdo->prepare($sql2);
            //$stmh->bindValue(':app', "未閲覧",   PDO::PARAM_STR );

            if ($name != "") {
                $name = '%' . $name . '%';
                $stmh->bindValue(':last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':h_first_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_last_name', $name, PDO::PARAM_STR);
                $stmh->bindValue(':k_first_name', $name, PDO::PARAM_STR);
            }

            switch ($case) {
                case 0: //役職、担任するクラスがなく、寮監でもない場合
                    break;

                case 1: //担任が教員アカウントでログインしている場合
                    if ($class != "") {
                        $stmh->bindValue(':class', $class, PDO::PARAM_STR);
                    }
                    break;

                case 2: //寮務主事または担当主事補の場合
                    if ($sel_class != "") {
                        $stmh->bindValue(':sel_class', $sel_class, PDO::PARAM_STR);
                    }
                    break;

                case 3: //担任が寮監になった場合
                    if ($sel_class != "") {
                        if ($sel_class == $class) {
                            $stmh->bindValue(':class', $class, PDO::PARAM_STR);
                        } else {
                            $stmh->bindValue(':sel_class', $sel_class, PDO::PARAM_STR);
                        }
                    } else {
                        $stmh->bindValue(':class', $class, PDO::PARAM_STR);
                    }
                    break;

                case 4: //担任でもなく寮務主事、担当主事補でもない教員が寮監になった場合
                    if ($sel_class != "") {
                        $stmh->bindValue(':sel_class', $sel_class, PDO::PARAM_STR);
                    }
                    break;

                default:
            }

            if ($room != "") {
                $stmh->bindValue(':room', $room, PDO::PARAM_STR);
            }

            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }

            if ($day != "") {
                $stmh->bindValue(':day', $day, PDO::PARAM_STR);
            }

            if ($tou != "") {
                $stmh->bindValue(':tou', $tou . "%", PDO::PARAM_STR);
            }

            if ($floor != "") {
                $stmh->bindValue(':nfloor', "N" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':efloor', "E" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':sfloor', "S" . $floor . "%", PDO::PARAM_STR);
            }
            $stmh->bindValue(':now', date("Y/m/d H:i:s"), PDO::PARAM_STR);
            $stmh->bindValue(':id', $id, PDO::PARAM_INT);
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
    // 提出した外泊願の履歴を見る
    //----------------------------------------------------
    public function get_log($id, $sub_day, $day, $sort, $app, $comment, $attend)
    {
        $sql = <<<EOS
        SELECT * FROM gaihaku JOIN member ON gaihaku.id = member.id AND member.id = :id
        EOS;

        if ($sub_day != "") {
            $sql .= " AND gaihaku.sub_date BETWEEN :first AND :last";
        }

        if ($day != "") {
            $sql .= " AND :day BETWEEN gaihaku.s_day AND gaihaku.f_day";
        }

        if ($app != "") {
            $sql .= " AND gaihaku.app = :app";
        }

        if ($comment != "") {
            if ($comment == "with_comment") {
                $sql .= " AND gaihaku.comment IS NOT NULL  ";
            } else if ($comment == "without_comment") {
                $sql .= " AND( gaihaku.comment IS NULL )";
            }
        }

        if ($attend != "") {
            $sql .= " AND gaihaku.attend = :attend";
        }


        if ($sort != "") {
            $AorD = substr($sort, -1);
            $column = substr($sort, 0, -1);
            if ($AorD == 'A') {
                switch ($column) {
                    case "sub":
                        $sql .= " ORDER BY gaihaku.sub_date ASC";
                        break;

                    case "start":
                        $sql .= " ORDER BY gaihaku.s_day ASC, gaihaku.s_time ASC";
                        break;

                    case "between":
                        $sql .= " ORDER BY datediff(gaihaku.s_day,gaihaku.f_day) ASC";
                        break;

                    default:
                }
            } else {
                if ($AorD == 'D') {
                    switch ($column) {

                        case "sub":
                            $sql .= " ORDER BY gaihaku.sub_date DESC";
                            break;

                        case "start":
                            $sql .= " ORDER BY gaihaku.s_day DESC, gaihaku.s_time DESC";
                            break;

                        case "between":
                            $sql .= " ORDER BY datediff(gaihaku.s_day,gaihaku.f_day) DESC";
                            break;
                    }
                }

            }
        } else {
            $sql .= " ORDER BY gaihaku.sub_date DESC";
        }

        try {
            $stmh = $this->pdo->prepare($sql);

            if ($day != "") {
                $stmh->bindValue(':day', $day, PDO::PARAM_STR);
            }
            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }
            if ($app != "") {
                $stmh->bindValue(':app', $app, PDO::PARAM_STR);
            }
            if ($attend != "") {
                $stmh->bindValue(':attend', $attend, PDO::PARAM_STR);
            }
            $stmh->bindValue(':id', $id, PDO::PARAM_STR);
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
                switch (substr($row['roomnum'], 0, 1)) {
                    case "E":
                        $row['tou'] = "東寮";
                        break;

                    case "N":
                        $row['tou'] = "北寮";
                        break;

                    case "S":
                        $row['tou'] = "南寮";
                        break;

                    default:
                }
                foreach ($row as $key => $value) {
                    $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data, $count, $sql];
    }
    /*
    //------------------------------------------------------------------
    // 外泊願一覧取得処理※教員が担当しているクラスの外泊願リストを受け取る
    //------------------------------------------------------------------
    public function get_list_offset($class,$offset){
    $sql = <<<EOS
    SELECT * FROM gaihaku WHERE class=:class AND teacher IS NULL OFFSET :offset
    EOS;
    try {
    $stmh = $this->pdo->prepare($sql);
    $stmh->bindValue(':class',  $class, PDO::PARAM_STR);
    $stmh->bindValue(':offset',  $offset, PDO::PARAM_INT);
    $stmh->execute();
    // 検索件数を取得
    $count = $stmh->rowCount();
    // 検索結果を多次元配列で受け取る
    if(!isset($count)){
    $count = 0;
    }
    $i=0;
    $data = [];
    while ($row = $stmh->fetch(PDO::FETCH_ASSOC)){
    foreach( $row as $key => $value){
    $data[$i][$key] = $value;
    }
    $i++;
    }
    } catch (PDOException $Exception) {
    print "エラー：" . $Exception->getMessage();
    }
    return [$data, $count];
    }
    */

    //----------------------------------------------------
    // 処理した外泊願の履歴を見る
    //----------------------------------------------------
    public function get_applog($teacher, $name, $room, $app_day, $day, $sub_day, $sort, $class, $tou, $floor, $app, $comment, $attend)
    {
        $sql = <<<EOS
        SELECT * FROM gaihaku JOIN member ON gaihaku.id = member.id WHERE (gaihaku.teacher = :teacher OR gaihaku.ryoukan = :ryoukan)
        EOS;

        if ($name != "") {
            $sql .= " AND (member.last_name like :last_name OR member.first_name like :first_name OR member.h_last_name like :h_last_name OR member.h_first_name like :h_first_name OR member.k_last_name like :k_last_name OR member.k_first_name like :k_first_name)";
        }

        if ($room != "") {
            $sql .= " AND gaihaku.roomnum=:room";
        }

        if ($sub_day != "") {
            $sql .= " AND gaihaku.sub_date BETWEEN :first AND :last";
        }

        if ($day != "") {
            $sql .= " AND :day BETWEEN gaihaku.s_day AND gaihaku.f_day";
        }

        if ($app_day != "") {
            $sql .= " AND gaihaku.app_date BETWEEN :first2 AND :last2";
        }

        if ($class != "") {
            $sql .= " AND member.class=:class";
        }

        if ($tou != "") {
            $sql .= " AND gaihaku.roomnum like :tou";
        }

        if ($floor != "") {
            $sql .= " AND( gaihaku.roomnum like :nfloor OR gaihaku.roomnum like :efloor  OR gaihaku.roomnum like :sfloor)";
        }

        if ($app != "") {
            $sql .= " AND gaihaku.app = :app";
        }

        if ($comment != "") {
            if ($comment == "with_comment") {
                $sql .= " AND gaihaku.comment IS NOT NULL  ";
            } else if ($comment == "without_comment") {
                $sql .= " AND( gaihaku.comment IS NULL )";
            }
        }

        if ($attend != "") {
            $sql .= " AND gaihaku.attend = :attend";
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
                        $sql .= " ORDER BY gaihaku.sub_date ASC";
                        break;

                    case "start":
                        $sql .= " ORDER BY gaihaku.s_day ASC, gaihaku.s_time ASC";
                        break;

                    case "between":
                        $sql .= " ORDER BY datediff(gaihaku.s_day,gaihaku.f_day) ASC";
                        break;

                    case "grade":
                        $sql .= " ORDER BY member.class ASC";
                        break;

                    case "process":
                        $sql .= " ORDER BY gaihaku.app_date ASC";
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
                            $sql .= " ORDER BY gaihaku.sub_date DESC";
                            break;

                        case "start":
                            $sql .= " ORDER BY gaihaku.s_day DESC, gaihaku.s_time DESC";
                            break;

                        case "between":
                            $sql .= " ORDER BY datediff(gaihaku.s_day,gaihaku.f_day) DESC";
                            break;

                        case "grade":
                            $sql .= " ORDER BY member.class DESC";
                            break;

                        case "process":
                            $sql .= " ORDER BY gaihaku.app_date DESC";
                            break;

                        default:
                    }
                }

            }
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

            if ($room != "") {
                $stmh->bindValue(':room', $room, PDO::PARAM_STR);
            }

            if ($sub_day != "") {
                $stmh->bindValue(':first', substr($sub_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last', substr($sub_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }

            if ($day != "") {
                $stmh->bindValue(':day', $day, PDO::PARAM_STR);
            }

            if ($app_day != "") {
                $stmh->bindValue(':first2', substr($app_day, 0, 10) . " " . "00:00:00", PDO::PARAM_STR);
                $stmh->bindValue(':last2', substr($app_day, 0, 10) . " " . "23:59:59", PDO::PARAM_STR);
            }

            if ($class != "") {
                $stmh->bindValue(':class', $class, PDO::PARAM_STR);
            }

            if ($tou != "") {
                $stmh->bindValue(':tou', $tou . "%", PDO::PARAM_STR);
            }

            if ($floor != "") {
                $stmh->bindValue(':nfloor', "N" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':efloor', "E" . $floor . "%", PDO::PARAM_STR);
                $stmh->bindValue(':sfloor', "S" . $floor . "%", PDO::PARAM_STR);
            }

            if ($app != "") {
                $stmh->bindValue(':app', $app, PDO::PARAM_STR);
            }

            if ($attend != "") {
                $stmh->bindValue(':attend', $attend, PDO::PARAM_STR);
            }

            $stmh->bindValue(':teacher', $teacher, PDO::PARAM_STR);
            $stmh->bindValue(':ryoukan', $teacher, PDO::PARAM_STR);
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
                switch (substr($row['roomnum'], 0, 1)) {
                    case "E":
                        $row['tou'] = "東寮";
                        break;

                    case "N":
                        $row['tou'] = "北寮";
                        break;

                    case "S":
                        $row['tou'] = "南寮";
                        break;

                    default:
                }
                foreach ($row as $key => $value) {
                    $data[$i][$key] = $value;
                }
                $i++;
            }
        } catch (PDOException $Exception) {
            print "エラー：" . $Exception->getMessage();
        }
        return [$data, $count, $sql];
    }

    //----------------------------------------------------
    // 渡された日付より前に提出された外泊願を削除する
    //----------------------------------------------------
    public function delete_old_gaihaku($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM gaihaku WHERE date < :date";
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
    // 渡された日付より前の日付に登録された寮生の提出した外泊願を削除する
    //--------------------------------------------------------------
    public function delete_old_member_gaihaku($date)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE gaihaku FROM gaihaku JOIN member ON gaihaku.id = member.id WHERE member.reg_date <= :date";
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
    // BANされている寮生の提出した外泊願を全削除
    //--------------------------------------------------------------
    public function delete_ban_member_gaihaku()
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE gaihaku FROM gaihaku JOIN member ON gaihaku.id = member.id WHERE member.ban = 1";
            $stmh = $this->pdo->prepare($sql);
            $stmh->execute();
            $this->pdo->commit();
        } catch (PDOException $Exception) {
            $this->pdo->rollBack();
            print "エラー：" . $Exception->getMessage();
        }
    }

    //--------------------------------------------------------------
    // 渡されたIDの寮生の提出した外泊願を全削除
    //--------------------------------------------------------------
    public function all_delete_member_id($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM gaihaku WHERE id = :id";
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