<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemController
 *
 * @author nagatayorinobu
 */
class SystemController extends BaseController
{
    //----------------------------------------------------
    // 管理者用メニュー
    //----------------------------------------------------
    public function run()
    {
        // セッション開始　認証に利用します。
        $this->auth = new Auth();
        $this->auth->set_authname(_SYSTEM_AUTHINFO);
        $this->auth->set_sessname(_SYSTEM_SESSNAME);
        $this->auth->start();

        if (!$this->auth->check() && $this->type != 'authenticate') {
            // 未認証
            $this->type = 'login';
        }

        // 共用のテンプレートなどをこのフラグで管理用に切り替えます。
        $this->is_system = true;

        // 会員側の画面を表示するためMemberControllerを利用します。
        $MemberController = new MemberController($this->is_system);
        $TeacherController = new TeacherController($this->is_system);

        switch ($this->type) {
            case "login":
                $this->screen_login();
                break;
            case "logout":
                $this->auth->logout();
                $this->screen_login();
                break;
            case "pass_modify":
                $this->screen_pass_modify();
                break;
            case "delete_old":
                $this->screen_delete_old();
                break;
            case "modify":
                $MemberController->screen_modify($this->auth);
                break;
            case "delete":
                $MemberController->screen_delete();
                break;
            case "mlist":
                $this->screen_mlist();
                break;
            case "tlist":
                $this->screen_tlist();
                break;
            case "tregist":
                $TeacherController->screen_tregist($this->auth);
                break;
            case "tmodify":
                $TeacherController->screen_tmodify($this->auth);
                break;
            case "tdelete":
                $TeacherController->screen_tdelete();
                break;
            case "regist":
                $MemberController->screen_regist($this->auth);
                break;
            case "room":
                $this->screen_room_list();
                break;
            case "kessyoku_list":
                $this->screen_kessyoku_list();
                break;
            case "kessyoku_log":
                $this->screen_kessyoku_log();
                break;
            case "holiday":
                $this->screen_holiday_list();
                break;
            case "absentee_list":
                $TeacherController->screen_absentee_list();
                break;
            case "long_vacation":
                $this->screen_long_vacation_list();
                break;
            case "authenticate":
                $this->do_authenticate();
                break;
            default:
                $this->screen_top();
        }
    }

    //----------------------------------------------------
    // ログイン画面表示
    //----------------------------------------------------
    private function screen_login()
    {
        $this->form->addElement('text', 'username', ['size' => 15, 'maxlength' => 50], ['label' => 'ユーザ名']);
        $this->form->addElement('password', 'password', ['size' => 15, 'maxlength' => 50], ['label' => 'パスワード']);
        $this->form->addElement('submit', 'submit', ['value' => 'ログイン']);
        $this->caution1 = '管理者用アカウントでログインしてください';
        $this->next_type = 'authenticate';
        $this->title = '管理者用ログイン画面';
        $this->file = "system_login.tpl";
        $this->view_display();
    }

    public function do_authenticate()
    {
        // データベースを操作します。
        $SystemModel = new SystemModel();
        $userdata = $SystemModel->get_authinfo($_POST['username']);
        if (!empty($userdata['password']) && $this->auth->check_password($_POST['password'], $userdata['password'])) {
            session_regenerate_id(true);
            $this->auth->auth_ok($userdata);
            unset($_SESSION['_SYSTEM_AUTHINFO']['logintime']);
            $this->screen_top();
        } else {
            $this->auth_error_mess = $this->auth->auth_no();
            $this->screen_login();
        }
    }


    //----------------------------------------------------
    // パスワード変更（ユーザ側）type=pass_modify
    //----------------------------------------------------
    public function screen_pass_modify($auth = "")
    {
        $this->file = "pass_modify.tpl";

        $oldPass = $this->form->addElement('password', 'oldPass', ['size' => 15, 'maxlength' => 50], ['label' => '変更前のパスワード']);
        $newPass = $this->form->addElement('password', 'newPass', ['size' => 15, 'maxlength' => 50], ['label' => '変更後のパスワード']);
        $newPass2 = $this->form->addElement('password', 'newPass2', ['size' => 15, 'maxlength' => 50], ['label' => '変更後のパスワード(確認用)']);
        $this->form->addElement('submit', 'submit', ['value' => '変更']);
        $oldPass->addRule('required', '変更前のパスワードを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $newPass->addRule('required', '変更後のパスワードを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $newPass2->addRule('required', '変更後のパスワード(確認用)を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $newPass->addRule('length', 'パスワードは8文字から16文字の範囲で入力してください。', [8, 16], HTML_QuickForm2_Rule::SERVER);
        $newPass->addRule('regex', 'パスワードは半角の英数字、記号（ _ - ! ? # $ % & @ ）を使ってください。', '/^[a-zA-z0-9_\-!?#$%&@]*$/', HTML_QuickForm2_Rule::SERVER);
        $this->form->addRecursiveFilter('trim');

        if (!$this->form->validate()) {
            $this->action = 'form';
        }

        if ($this->action == "form") {
            $this->title = 'パスワード変更画面';
            $this->caution1 = 'パスワードの変更が完了すると自動的にトップページに戻ります';
            $this->next_type = 'pass_modify';
            $this->next_action = 'complete';
            $this->view_display();
        } else {
            if ($this->action == "complete") {
                $password = $this->form->getValue();
                if ($password['newPass'] !== $password['newPass2']) { //変更後のパスワードと変更後のパスワード(確認用)が同じか
                    $this->title = 'パスワード変更画面';
                    $this->caution1 = 'パスワードの変更が完了すると自動的にトップページに戻ります';
                    $this->next_type = 'pass_modify';
                    $this->next_action = 'form';
                    $this->auth_error_mess = '変更後のパスワードと変更後のパスワード(確認用)が一致していません' . "\n";
                    $this->view_display();
                } else {
                    $SystemModel = new SystemModel();
                    $userdata = $SystemModel->get_user_data_id($_SESSION[_SYSTEM_AUTHINFO]['id']); //前のユーザのデータ
                    if (!(!empty($userdata['password']) && $this->auth->check_password($password['oldPass'], $userdata['password']))) {
                        $this->title = 'パスワード変更画面';
                        $this->caution1 = 'パスワードの変更が完了すると自動的にトップページに戻ります';
                        $this->next_type = 'pass_modify';
                        $this->next_action = 'form';
                        $this->auth_error_mess = '変更前のパスワードが間違っています' . "\n";
                        $this->view_display();
                    } else {
                        if ($this->is_system && is_object($auth)) {
                            $newPass = $auth->get_hashed_password($password['newPass']);
                        } else {
                            $newPass = $this->auth->get_hashed_password($password['newPass']);
                        }
                        $userdata['password'] = $newPass;
                        $SystemModel->modify_user($userdata);
                        $this->screen_top();
                    }
                }
            }
        }
    }



    //----------------------------------------------------
    // トップ画面
    //----------------------------------------------------
    private function screen_top()
    {
        unset($_SESSION['search_key']);
        unset($_SESSION[_MEMBER_AUTHINFO]);
        unset($_SESSION['pageID']);

        $SystemModel = new SystemModel;
        if (isset($_POST['submit']) && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
            $system = $SystemModel->get_user_data_id($_SESSION[_SYSTEM_AUTHINFO]['id']);
            if (!($system['maint'] == 1 && time() <= strtotime($system['maint_time']))) {
                $SystemModel->switch_maint();
            } else {
                $this->view->assign('maint_time', $system['maint_time']);
            }
            unset($_SESSION['rand']);
        }

        $system = $SystemModel->get_user_data_id($_SESSION[_SYSTEM_AUTHINFO]['id']);
        if ($system['maint'] == 1) {
            $this->form->addElement('submit', 'submit', ['value' => "メンテナンス中"]);
        } else {
            $this->form->addElement('submit', 'submit', ['value' => "メンテナンスモードに移行"]);
        }
        $this->title = '管理 - トップ画面';
        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
        $this->file = 'system_top.tpl';
        $this->view_display();
    }


    //----------------------------------------------------
    // 古いデータの削除画面
    //----------------------------------------------------
    private function screen_delete_old()
    {
        $SystemModel = new SystemModel;
        if ($SystemModel->check_maint()) {
            $this->title = '古いデータの削除画面';
            $this->view->assign('today', date('Y-m-d'));
            $this->file = 'delete_old.tpl';
        } else {
            $this->file = 'message.tpl';
            $this->title = 'Error';
            $this->message = 'メンテナンスモードに移行してください．';
        }
        $this->view_display();
    }

    //----------------------------------------------------
    // 会員一覧画面
    //----------------------------------------------------
    private function screen_mlist()
    {
        $disp_search_key = "";
        $sql_search_key = "";
        // セッション変数の処理
        unset($_SESSION[_MEMBER_AUTHINFO]);
        if (isset($_POST['search_key']) && $_POST['search_key'] != "") {
            unset($_SESSION['pageID']);
            $_SESSION['search_key'] = $_POST['search_key'];
            $disp_search_key = htmlspecialchars($_POST['search_key'], ENT_QUOTES);
            $sql_search_key = $_POST['search_key'];
        } else {
            if (isset($_POST['submit']) && $_POST['submit'] == "検索する") {
                unset($_SESSION['search_key']);
            } else {
                if (isset($_SESSION['search_key'])) {
                    $disp_search_key = htmlspecialchars($_SESSION['search_key'], ENT_QUOTES);
                    $sql_search_key = $_SESSION['search_key'];
                }
            }
        }
        // データベースを操作します。
        $MemberModel = new MemberModel();
        list($data, $count) = $MemberModel->get_member_list($sql_search_key);
        list($data, $links) = $this->make_page_link($data);

        $SystemModel = new SystemModel;
        if ($SystemModel->check_maint()) {
            $this->view->assign('maint', TRUE);
        } else {
            $this->view->assign('maint', NULL);
        }
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('search_key', $disp_search_key);
        $this->view->assign('links', $links['all']);
        $this->title = '管理 - 寮生一覧画面';
        $this->file = 'system_list.tpl';
        $this->view_display();
    }


    //----------------------------------------------------
    // 教員一覧画面
    //----------------------------------------------------
    private function screen_tlist()
    {
        $disp_search_key = "";
        $sql_search_key = "";
        // セッション変数の処理
        unset($_SESSION[_MEMBER_AUTHINFO]);
        if (isset($_POST['search_key']) && $_POST['search_key'] != "") {
            unset($_SESSION['pageID']);
            $_SESSION['search_key'] = $_POST['search_key'];
            $disp_search_key = htmlspecialchars($_POST['search_key'], ENT_QUOTES);
            $sql_search_key = $_POST['search_key'];
        } else {
            if (isset($_POST['submit']) && $_POST['submit'] == "検索する") {
                unset($_SESSION['search_key']);
            } else {
                if (isset($_SESSION['search_key'])) {
                    $disp_search_key = htmlspecialchars($_SESSION['search_key'], ENT_QUOTES);
                    $sql_search_key = $_SESSION['search_key'];
                }
            }
        }
        // データベースを操作します。
        $TeacherModel = new TeacherModel();
        list($data, $count) = $TeacherModel->get_teacher_list($sql_search_key);

        $RyoukanlogModel = new RyoukanlogModel();
        //$ryoukan_id = $RyoukanlogModel->get_ryoukan_id();
        $this->view->assign('ryoukan_id', $RyoukanlogModel->get_ryoukan_id());
        $SystemModel = new SystemModel;
        if ($SystemModel->check_maint()) {
            $this->view->assign('maint', TRUE);
        } else {
            $this->view->assign('maint', NULL);
        }
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('search_key', $disp_search_key);
        $this->title = '管理 - 教員一覧画面';
        $this->file = 'system_tlist.tpl';
        $this->view_display();
    }


    //----------------------------------------------------
    //POSTされた条件を表示用とsql用にして返す
    //----------------------------------------------------
    private function rec_post($name)
    {
        $disp = "";
        $sql = "";

        if (isset($_POST["$name"]) && $_POST["$name"] != "") { //POSTがある場合
            unset($_SESSION['pageID']);
            $_SESSION["$name"] = $_POST["$name"];
            $disp = htmlspecialchars($_POST["$name"], ENT_QUOTES);
            $sql = $_POST["$name"];
        } else {
            if (isset($_POST['submit']) && $_POST['submit'] == "実行") { //postが空だった場合
                unset($_SESSION["$name"]);
            } else {
                if (isset($_SESSION["$name"])) { //まとめて送信が押されたとき
                    $disp = htmlspecialchars($_SESSION["$name"], ENT_QUOTES);
                    $sql = $_SESSION["$name"];
                }
            }
        }
        $this->view->assign("$name", $disp);
        return $sql;
    }


    //----------------------------------------------------
    // 居住可能部屋設定 type=room
    //----------------------------------------------------
    private function screen_room_list()
    {
        $SystemModel = new SystemModel();
        if ($SystemModel->check_maint()) {
            $roomModel = new roomModel();
            $this->message = "";

            if (isset($_POST['new_room']) && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                if ($_POST['new_room'] != "") {
                    if (preg_match('/^[E,N,S][1-5][0,1][0-9][A,B][a,b]$/', $_POST['new_room'])) {
                        if (!$roomModel->check_room($_POST['new_room'])) {
                            $this->message = $_POST['new_room'] . "を新しい部屋番号に追加しました．";
                            $roomModel->regist_room($_POST['new_room']);
                            unset($_SESSION['rand']);
                        } else {
                            $this->message .= "この部屋番号は登録済みです．<br>";
                        }
                    } else {
                        $this->message .= "この部屋番号は無効です．<br>";
                    }
                }
            }

            if (isset($_POST['drive_out']) && $_POST['drive_out'] == 'drive_out') {
                $this->message .= "全寮生の追い出しを実行しました.寮生に次に入居する部屋の部屋番号を登録させてください．";
                $roomModel->delete_all_username();
            }

            if (isset($_POST['delete'])) {
                foreach ($_POST['delete'] as $roomnum) {
                    $this->message .= $roomnum . "を削除しました";
                    $roomModel->delete_room($roomnum);
                }
            }

            $sql_tou = $this->rec_post('tou');
            $sql_floor = $this->rec_post('floor');
            list($Ndata, $Edata, $Sdata, $sql) = $roomModel->get_room_list($sql_tou, $sql_floor);

            $this->title = '居住可能部屋設定画面';
            //$this->view->assign('maint', $SystemModel->check_maint());
            $this->view->assign('Ndata', $Ndata);
            $this->view->assign('Edata', $Edata);
            $this->view->assign('Sdata', $Sdata);
            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
            $this->file = 'room_list.tpl';
            $this->next_type = 'room';
            $this->form->addElement('submit', 'submit', ['value' => "実行", 'onclick' => 'if(document.getElementById("drive_out").checked){return confirm("”全員部屋から追い出す”が選択されていますが実行してもよろしいでしょうか？");}']);
        } else {
            $this->file = 'message.tpl';
            $this->title = 'Error';
            $this->message = 'メンテナンスモードに移行してください．';
        }
        $this->view_display();
    }

    //----------------------------------------------------
    // 祝日設定 type=holiday
    //----------------------------------------------------
    private function screen_holiday_list()
    {
        $SystemModel = new SystemModel();
        if ($SystemModel->check_maint()) {

            $holidayModel = new holidayModel();
            $longVacationModel = new longVacationModel();
            if (isset($_POST['submit']) && $_POST['submit'] == "追加" && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                if (!$longVacationModel->check_during_term($_POST['holiday']['date'])) {
                    if (!$holidayModel->check_same_date($_POST['holiday']['date'])) {
                        $holidayModel->regist_holiday($_POST['holiday']);
                        unset($_SESSION['rand']);
                        $this->caution1 = "祝日を登録いたしました．";
                    } else {
                        $this->caution1 = "同じ日付の祝日は登録できません．";
                    }
                } else {
                    $this->caution1 = "この日付には長期休暇が設定されています．";
                }
            }
            $holidayModel->delete_past_holiday();
            $this->file = 'holiday_list.tpl';
            $this->title = '祝日設定画面';
            $this->view->assign('today', date("Y-m-d"));
            list($data, $count) = $holidayModel->get_holiday_list();
            $this->view->assign('data', $data);
            $this->view->assign('count', $count);
            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
            $this->next_type = 'holiday';

        } else {
            $this->file = 'message.tpl';
            $this->title = 'Error';
            $this->message = 'メンテナンスモードに移行してください．';
        }
        $this->view_display();
    }


    //----------------------------------------------------
    // 長期休暇設定 type=long_vacation
    //----------------------------------------------------
    private function screen_long_vacation_list()
    {
        $SystemModel = new SystemModel();
        if ($SystemModel->check_maint()) {
            $longVacationModel = new longVacationModel();
            $holidayModel = new holidayModel();
            if (isset($_POST['submit']) && $_POST['submit'] == "追加" && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                if (!$holidayModel->checkByTerm($_POST['vacation']['first_date'], $_POST['vacation']['last_date'])) {
                    if (!$longVacationModel->check_same_term($_POST['vacation'])) {
                        $longVacationModel->regist_longVacation($_POST['vacation']);
                        unset($_SESSION['rand']);
                        $this->caution1 = "長期休暇を登録いたしました．";
                    } else {
                        $this->caution1 = "既に登録された長期休暇と期間が重複しております．";
                    }
                } else {
                    $this->caution1 = "この期間には祝日が登録されております．";
                }
            }
            $longVacationModel->delete_past_vacation();
            $this->file = 'long_vacation_list.tpl';
            $this->title = '長期休暇設定画面';
            $this->view->assign('today', date("Y-m-d"));
            list($data, $count) = $longVacationModel->get_longVacation_list();
            $this->view->assign('data', $data);
            $this->view->assign('count', $count);
            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
            $this->next_type = 'long_vacation';
        } else {
            $this->file = 'message.tpl';
            $this->title = 'Error';
            $this->message = 'メンテナンスモードに移行してください．';
        }
        $this->view_display();
    }


    //----------------------------------------------------
    // 提出された欠食届一覧画面 type=kessyoku_list
    //----------------------------------------------------
    private function screen_kessyoku_list()
    {
        $KgroupModel = new KgroupModel();
        $kessyokuModel = new kessyokuModel();

        $sql_name_search_key = $this->rec_post('name_search_key');
        $sql_sub_day = $this->rec_post('sub_day');
        $sql_sort_key = $this->rec_post('sort');
        $sql_grade = $this->rec_post('grade');
        $sql_reason = $this->rec_post('reason');

        //欠食届の自動削除
        $now = time();
        $thirteen = mktime(13, 0, 0, date("m"), date("d"), date("Y"));
        if ($now < $thirteen) {
            $three_days_ago = date("Y-m-d", strtotime("+2 day"));
        } else {
            $three_days_ago = date("Y-m-d", strtotime("+3 day"));
        }
        $KgroupModel->auto_delete_Kgroup($three_days_ago); //初日が処理されずに３日後を過ぎた欠食届全体を削除する
        $kessyokuModel->auto_delete_kessyoku($three_days_ago); //３日後を過ぎた欠食申請単体を削除する AND 欠食申請が紐づけされていない欠食届を削除する

        list($groups, $count) = $KgroupModel->get_list($sql_name_search_key, $sql_sub_day, $sql_sort_key, $sql_grade, $sql_reason);
        list($groups, $links) = $this->make_page_link_10($groups);
        foreach ($groups as $key => $group) {
            $table = $kessyokuModel->getKessyokuByGroup($group['group_id']);
            $group_id = $group['group_id'];
            $this->view->assign("table" . $group_id, $table);
            $this->view->assign("first_day" . $group_id, $table[0]['date']);
            $last = array_key_last($table);
            $this->view->assign("last_day" . $group_id, $table[$last]['date']);
        }

        $this->view->assign('count', $count);
        $this->view->assign('groups', $groups);
        $this->view->assign('links', $links['all']);
        $this->title = '欠食届処理画面';
        $this->file = 'kessyoku_list.tpl';
        $this->next_type = 'kessyoku_list';
        $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
        $this->view_display();
    }


    //----------------------------------------------------
    // 処理した欠食届一覧画面 type=kessyoku_log
    //----------------------------------------------------
    private function screen_kessyoku_log()
    {
        $KgroupModel = new KgroupModel();
        $kessyokuModel = new kessyokuModel();

        $sql_name_search_key = $this->rec_post('name_search_key');
        $sql_sub_day = $this->rec_post('sub_day');
        $sql_app_day = $this->rec_post('app_day');
        $sql_sort_key = $this->rec_post('sort');
        $sql_grade = $this->rec_post('grade');
        $sql_app = $this->rec_post('app');
        $sql_reason = $this->rec_post('reason');
        $sql_comment = $this->rec_post('comment');

        list($groups, $count) = $KgroupModel->get_applog($sql_name_search_key, $sql_sub_day, $sql_app_day, $sql_sort_key, $sql_grade, $sql_app, $sql_reason, $sql_comment);
        list($groups, $links) = $this->make_page_link_10($groups);
        foreach ($groups as $key => $group) {
            $table = $kessyokuModel->getKessyokuByGroup($group['group_id']);
            $group_id = $group['group_id'];
            $this->view->assign("table" . $group_id, $table);
            $this->view->assign("first_day" . $group_id, $table[0]['date']);
            $last = array_key_last($table);
            $this->view->assign("last_day" . $group_id, $table[$last]['date']);
        }

        $this->view->assign('count', $count);
        $this->view->assign('groups', $groups);
        $this->view->assign('links', $links['all']);
        $this->title = '処理済欠食届履歴';
        $this->file = 'kessyoku_app_log.tpl';
        $this->next_type = 'kessyoku_log';
        $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
        $this->view_display();
    }

}