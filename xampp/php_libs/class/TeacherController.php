<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TeacherController
 *
 * @author nagatayorinobu
 */
class TeacherController extends BaseController
{
    //----------------------------------------------------
    // 管理者用メニュー
    //----------------------------------------------------
    public function run()
    {
        // セッション開始　認証に利用します。
        $this->auth = new Auth();
        $this->auth->set_authname(_TEACHER_AUTHINFO);
        $this->auth->set_sessname(_TEACHER_SESSNAME);
        $this->auth->start();
        $SystemModel = new SystemModel;
        $TeacherModel = new TeacherModel;
        if (!$SystemModel->check_maint()) {
            if ($this->auth->check()) {
                if (isset($_SESSION[_TEACHER_AUTHINFO]) && !$TeacherModel->check_ban($_SESSION[_TEACHER_AUTHINFO]['id'])) {
                    // 認証済み
                    $this->menu_teacher();
                } else {
                    $this->auth->logout();
                    $this->screen_login("アカウントがBANされました．");
                }
            } else {
                // 未認証
                $this->menu_guest();
            }
        } else {
            $this->auth->logout();
            $this->screen_login("メンテナンス中です．");
        }
    }



    //----------------------------------------------------
    // 教員用メニュー
    //----------------------------------------------------
    public function menu_teacher()
    {

        switch ($this->type) {
            case "login":
                $this->screen_login();
                break;
            case "logout":
                $this->auth->logout();
                $this->screen_login();
                break;
            case "list":
                $this->screen_list();
                break;
            case "app_log":
                $this->screen_app_log();
                break;
            case "absentee_list":
                $this->screen_absentee_list();
                break;
            case "authenticate":
                $this->do_authenticate();
                break;
            case "modify":
                $this->screen_pass_modify();
                break;
            default:
                $this->screen_top();
        }

    }


    //----------------------------------------------------
    // ゲスト用メニュー
    //----------------------------------------------------
    public function menu_guest()
    {
        switch ($this->type) {
            case "regist":
                $this->screen_regist();
                break;
            case "authenticate":
                $this->do_authenticate();
                break;
            default:
                $this->screen_login();
        }
    }




    //----------------------------------------------------
    // ログイン画面表示
    //----------------------------------------------------
    private function screen_login($maint = "")
    {
        $this->form->addElement('text', 'username', ['size' => 15, 'maxlength' => 50], ['label' => 'メールアドレス']);
        $this->form->addElement('password', 'password', ['size' => 15, 'maxlength' => 50], ['label' => 'パスワード']);
        $this->form->addElement('submit', 'submit', ['value' => 'ログイン']);
        $this->caution1 = '教員用アカウントでログインしてください．';
        $this->next_type = 'authenticate';
        $this->title = '教員用ログイン画面';
        $this->state = "教員";
        if ($maint) {
            $this->message = $maint;
        }
        $this->file = "teacher_login.tpl";
        $this->view_display();
    }


    //----------------------------------------------------
    // ログイン前の認証
    //----------------------------------------------------
    public function do_authenticate()
    {
        // データベースを操作します。
        $TeacherModel = new TeacherModel();
        $userdata = $TeacherModel->get_authinfo($_POST['username']);
        if (!empty($userdata['password']) && $this->auth->check_password($_POST['password'], $userdata['password'])) {
            if ($userdata['ban'] == 0) {
                session_regenerate_id(true);
                $this->auth->auth_ok($userdata);
                //$_SESSION[_TEACHER_AUTHINFO]['logintime'] = time();
                $this->screen_top();
            } else {
                $this->auth_error_mess = "このアカウントは凍結されています。";
                $this->screen_login();
            }
        } else {
            $this->auth_error_mess = $this->auth->auth_no();
            $this->screen_login();
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

        unset($_SESSION['name_search_key']);
        unset($_SESSION['room_search_key']);
        unset($_SESSION['sub_day']);
        unset($_SESSION['app_day']);
        unset($_SESSION['sort']);
        unset($_SESSION['tou']);
        unset($_SESSION['floor']);
        unset($_SESSION['app']);
        unset($_SESSION['comment']);
        unset($_SESSION['attend']);

        $this->view->assign('last_name', $_SESSION[_TEACHER_AUTHINFO]['last_name']);
        $this->view->assign('first_name', $_SESSION[_TEACHER_AUTHINFO]['first_name']);
        $this->caution1 = '教員ページ';
        $this->title = '教員 - トップ画面';
        $this->view->assign('ryoukan', FALSE);
        $this->view->assign('class', $_SESSION[_TEACHER_AUTHINFO]['class']);
        $this->file = 'teacher_top.tpl';
        $this->view_display();
    }


    //----------------------------------------------------
    // パスワード変更（教員側）type=modify
    //----------------------------------------------------
    public function screen_pass_modify($auth = "", $id = "")
    {
        $TeacherModel = new TeacherModel();
        if ($this->is_ryoukan && $this->action == "form") {
            $_SESSION[_TEACHER_AUTHINFO] = $TeacherModel->get_teacher_data_id($id);
        }


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
            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
            $this->caution1 = 'パスワードの変更が完了すると自動的にトップページに戻ります';
            $this->next_type = 'modify';
            $this->next_action = 'complete';
            $this->view_display();
        } else {
            if ($this->action == "complete" && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                $password = $this->form->getValue();
                if ($password['newPass'] !== $password['newPass2']) { //変更後のパスワードと変更後のパスワード(確認用)が同じか
                    $this->title = 'パスワード変更画面';
                    $this->caution1 = 'パスワードの変更が完了すると自動的にトップページに戻ります';
                    $this->next_type = 'modify';
                    $this->next_action = 'form';
                    $this->auth_error_mess = '変更後のパスワードと変更後のパスワード(確認用)が一致していません' . "\n";
                    $this->view_display();
                } else {
                    $userdata = $TeacherModel->get_teacher_data_id($_SESSION[_TEACHER_AUTHINFO]['id']); //前のユーザのデータ
                    if ($this->is_ryoukan && is_object($auth)) {
                        $flag = $auth->check_password($password['oldPass'], $userdata['password']);
                    } else {
                        $flag = $this->auth->check_password($password['oldPass'], $userdata['password']);
                    }
                    if (!(!empty($userdata['password']) && $flag)) {
                        $this->title = 'パスワード変更画面';
                        $this->caution1 = 'パスワードの変更が完了すると自動的にトップページに戻ります';
                        $this->next_type = 'modify';
                        $this->next_action = 'form';
                        $this->auth_error_mess = '変更前のパスワードが間違っています' . "\n";
                        $this->view_display();
                    } else {
                        if ($this->is_ryoukan && is_object($auth)) {
                            $newPass = $auth->get_hashed_password($password['newPass']);
                        } else {
                            $newPass = $this->auth->get_hashed_password($password['newPass']);
                        }
                        $userdata['password'] = $newPass;
                        $TeacherModel->modify_teacher($userdata);
                        unset($_SESSION['rand']);
                        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                        $this->screen_top();
                    }
                }
            } else {
                $this->title = '不正アクセス検知';
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                $this->message = '不正なアクセス（リロードなど）を検知しました．';
                $this->file = "message.tpl";
                $this->view_display();
            }
        }
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
            if (isset($_POST['submit2']) && $_POST['submit2'] == "実行" || isset($_POST['submit']) && $_POST['submit'] == "まとめて送信") { //postが空だった場合
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
    // 外泊願一覧画面(10件ずつ) type=list
    //----------------------------------------------------
    public function screen_list($auth = "", $id = "")
    {
        $this->caution1 = "";
        if ($this->is_ryoukan) {
            $TeacherModel = new TeacherModel();
            $_SESSION[_TEACHER_AUTHINFO] = $TeacherModel->get_teacher_data_id($id);
            $_SESSION[_TEACHER_AUTHINFO]['class2'] = "寮監";
        } else {
            $_SESSION[_TEACHER_AUTHINFO]['class2'] = "一般";
        }
        $gaihakuModel = new gaihakuModel();
        $gaihakuModel->delete_old();

        if (isset($_POST['submit']) && $_POST['submit'] == 'まとめて送信' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
            foreach ($_POST['gaihaku_id'] as $gaihaku_id) {
                if ($gaihakuModel->check_gid($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id'])) {
                    $gaihaku = $gaihakuModel->get_data_gid($gaihaku_id);

                    if ($_SESSION[_TEACHER_AUTHINFO]['class'] == '寮監') {
                        $gaihaku['ryoukan'] = $_SESSION[_TEACHER_AUTHINFO]['last_name'] . ' ' . $_SESSION[_TEACHER_AUTHINFO]['first_name'];
                    } else {
                        $gaihaku['teacher'] = $_SESSION[_TEACHER_AUTHINFO]['last_name'] . ' ' . $_SESSION[_TEACHER_AUTHINFO]['first_name'];
                    }

                    $gaihaku['app'] = $_POST[$gaihaku_id . 'app'];
                    $gaihaku['app_date'] = date("Y/m/d H:i:s");
                    $gaihaku['comment'] = $_POST[$gaihaku_id . 'text'];
                    $gaihakuModel->modifyBygaihaku_id($gaihaku_id, $gaihaku);
                    $this->app_gaihaku_mail_to_member($gaihaku);
                }
            }
            unset($_SESSION['rand']);
            $this->rand = $_SESSION['rand'] = $this->create_rand_string();

            $this->caution1 .= 'まとめて送信を完了しました<br>';
        }

        $disp_class = "";
        $sql_class = "";

        $sql_name_search_key = $this->rec_post('name_search_key');
        $sql_room_search_key = $this->rec_post('room_search_key');
        $sql_sub_day = $this->rec_post('sub_day');
        $sql_day = $this->rec_post('day');
        $sql_sort_key = $this->rec_post('sort');
        $sql_tou = $this->rec_post('tou');
        $sql_floor = $this->rec_post('floor');

        $case = 0; //役職、担任するクラスがなく、寮監でもない場合
        $this->view->assign('spe_class', "normal");
        $class = "";
        if ($_SESSION[_TEACHER_AUTHINFO]['class'] === '寮務主事' || $_SESSION[_TEACHER_AUTHINFO]['class'] === '寮務主事補') {

            $sql_class = $this->rec_post('spe_class');
            $case = 2; //寮務主事または担当主事補の場合

        } else if ($_SESSION[_TEACHER_AUTHINFO]['class'] === 'その他' && $_SESSION[_TEACHER_AUTHINFO]['class2'] === '寮監') {

            $sql_class = $this->rec_post('spe_class');
            $case = 4; //担任でもなく寮務主事、担当主事補でもない教員が寮監になった場合

        } else {
            if ($_SESSION[_TEACHER_AUTHINFO]['class2'] === '寮監') {
                $sql_class = $this->rec_post('spe_class');
                $class = $_SESSION[_TEACHER_AUTHINFO]['class'];
                $case = 3; //担任が寮監になった場合
            } else {
                //$sql_class = $_SESSION[_TEACHER_AUTHINFO]['class'];
                $class = $_SESSION[_TEACHER_AUTHINFO]['class'];
                $case = 1; //担任が教員アカウントでログインしている場合
            }
        }
        $this->view->assign('class', $_SESSION[_TEACHER_AUTHINFO]['class']); //テンプレートに表示するクラス
        $this->view->assign('class2', $_SESSION[_TEACHER_AUTHINFO]['class2']);

        $gaihakuModel->delete_old();

        list($data, $count) = $gaihakuModel->get_list($_SESSION[_TEACHER_AUTHINFO]['id'], $case, $sql_name_search_key, $sql_room_search_key, $sql_sub_day, $sql_day, $sql_sort_key, $class, $sql_class, $sql_tou, $sql_floor);
        list($data, $links) = $this->make_page_link_10($data);

        $this->make_option_controle();
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('links', $links['all']);
        $this->title = '外泊願処理画面';
        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
        $this->caution1 .= '確認済みとなった外泊願は許可された外泊願一覧へ移動します。';
        $this->file = 'gaihaku_list.tpl';
        $this->link = "?type=do_app&action=app&id=";
        $this->next_type = 'list';
        $this->form->addElement('submit', 'submit2', ['value' => "実行", 'id' => 'exe']);
        $this->form->addElement('submit', 'submit', ['value' => "まとめて送信"]);

        $this->view_display();
    }

    //----------------------------------------------------
    // 処理した外泊願一覧画面 type=app_log
    //----------------------------------------------------
    public function screen_app_log($auth = "", $id = "")
    {
        $gaihakuModel = new gaihakuModel();
        if ($this->is_ryoukan) {
            $TeacherModel = new TeacherModel();
            $_SESSION[_TEACHER_AUTHINFO] = $TeacherModel->get_teacher_data_id($id);
            $_SESSION[_TEACHER_AUTHINFO]['class2'] = "寮監";
        } else {
            $_SESSION[_TEACHER_AUTHINFO]['class2'] = "一般";
        }

        $disp_class = "";
        $sql_class = "";

        $sql_name_search_key = $this->rec_post('name_search_key');
        $sql_room_search_key = $this->rec_post('room_search_key');
        $sql_sub_day = $this->rec_post('sub_day');
        $sql_day = $this->rec_post('day');
        $sql_app_day = $this->rec_post('app_day');
        $sql_sort_key = $this->rec_post('sort');
        $sql_class = $this->rec_post('spe_class');
        $sql_tou = $this->rec_post('tou');
        $sql_floor = $this->rec_post('floor');
        $sql_app = $this->rec_post('app');
        $sql_comment = $this->rec_post('comment');
        $sql_attend = $this->rec_post('attend');

        list($data, $count, $sql) = $gaihakuModel->get_applog($_SESSION[_TEACHER_AUTHINFO]['last_name'] . ' ' . $_SESSION[_TEACHER_AUTHINFO]['first_name'], $sql_name_search_key, $sql_room_search_key, $sql_sub_day, $sql_day, $sql_app_day, $sql_sort_key, $sql_class, $sql_tou, $sql_floor, $sql_app, $sql_comment, $sql_attend);
        list($data, $links) = $this->make_page_link_10($data);
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('links', $links['all']);
        $this->title = '処理履歴【外泊願】';
        $this->view->assign('teacher', $_SESSION[_TEACHER_AUTHINFO]['last_name'] . ' ' . $_SESSION[_TEACHER_AUTHINFO]['first_name']);
        $this->view->assign('class', $_SESSION[_TEACHER_AUTHINFO]['class']);
        $this->file = 'gaihaku_app_log.tpl';
        $this->next_type = 'app_log';
        $this->form->addElement('submit', 'submit2', ['value' => "実行", 'id' => 'exe']);
        $this->view_display();
    }


    //----------------------------------------------------
    // 点呼を欠席した寮生一覧画面
    //----------------------------------------------------
    public function screen_absentee_list()
    {
        $AbsenteeModel = new AbsenteeModel();
        $sql_date = $this->rec_post('date');

        list($data, $count) = $AbsenteeModel->get_absentee_list($sql_date);
        list($data, $links) = $this->make_page_link_10($data);
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('today', date('Y-m-d'));
        $this->view->assign('links', $links['all']);
        $this->title = '点呼欠席者一覧';
        $this->file = 'absentee_list.tpl';
        $this->next_type = 'absentee_list';
        $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
        $this->view_display();
    }


    //----------------------------------------------------
    // 教員情報登録画面 type=tregist
    //----------------------------------------------------
    public function screen_tregist($auth = "")
    {
        $btn = "";
        $btn2 = "";
        $this->file = "teacherinfo_form.tpl"; // デフォルト

        //$this->form->addDataSource(new HTML_QuickForm2_DataSource_Array(['birthday' => $date_defaults]));
        $username = $this->form->addElement('text', 'username', ['size' => 20], ['label' => '学内メールアドレス']);
        $last_name = $this->form->addElement('text', 'last_name', ['size' => 30, 'id' => 'last_name', 'onkeyup' => '(function() { let val="last_name";keyup(val); } )();']);
        $first_name = $this->form->addElement('text', 'first_name', ['size' => 30, 'id' => 'first_name', 'onkeyup' => '(function() { let val="first_name";keyup(val); } )();']);
        $h_last_name = $this->form->addElement('text', 'h_last_name', ['size' => 30, 'id' => 'h_last_name']);
        $h_first_name = $this->form->addElement('text', 'h_first_name', ['size' => 30, 'id' => 'h_first_name']);
        $classValue = [
            '' => '選択してください',
            '1-1' => '1-1',
            '1-2' => '1-2',
            '1-3' => '1-3',
            'IS2' => 'IS2',
            'IT2' => 'IT2',
            'IE2' => 'IE2',
            'IS3' => 'IS3',
            'IT3' => 'IT3',
            'IE3' => 'IE3',
            'IS4' => 'IS4',
            'IT4' => 'IT4',
            'IE4' => 'IE4',
            'IS5' => 'IS5',
            'IT5' => 'IT5',
            'IE5' => 'IE5',
            '寮務主事' => '寮務主事',
            '寮務主事補' => '寮務主事補',
            'その他' => 'その他'
        ];

        $class = $this->form->addElement('select', 'class', null, ['label' => '担任している学年/クラス', 'options' => $classValue]);

        $username->addRule('required', '岳寧メールアドレスを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $last_name->addRule('required', '氏を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $first_name->addRule('required', '名を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_last_name->addRule('required', '氏(ふりがな)を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_first_name->addRule('required', '名(ふりがな)を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_last_name->addRule('regex', 'ひらがなを入力してください。', '/^[ぁ-ゞ]+$/u', HTML_QuickForm2_Rule::SERVER);
        $h_first_name->addRule('regex', 'ひらがなを入力してください。', '/^[ぁ-ゞ]+$/u', HTML_QuickForm2_Rule::SERVER);
        $class->addRule('required', '学年／クラスを選択してください。', null, HTML_QuickForm2_Rule::SERVER);
        $this->form->addRecursiveFilter('trim');

        // フォームの妥当性検証
        if (!$this->form->validate()) {
            $this->action = "form";
        }

        if ($this->action == "form") {
            $this->title = '新規登録画面';
            $this->caution1 = 'taro@****.jpの時はtaroのみ入力';
            $this->next_type = 'tregist';
            $this->next_action = 'confirm';
            $btn = '入力完了';
        } else {
            if ($this->action == "confirm" && isset($_POST['submit']) && $_POST['submit'] == '入力完了') {
                $this->title = '新規登録画面';
                $this->caution1 = 'taro@****.jpの時はtaroのみ入力';
                $this->next_type = 'tregist';
                $this->next_action = 'complete';
                $this->form->toggleFrozen(true);
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                $btn = '仮登録';
                $btn2 = '戻る';
            } else {
                if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                    $this->title = '新規登録画面【仮登録】';
                    $this->caution1 = 'taro@****.jpの時はtaroのみ入力';
                    $this->next_type = 'tregist';
                    $this->next_action = 'confirm';
                    $btn = '入力完了';
                } else {
                    if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '仮登録' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                        $PreteacherModel = new PreteacherModel();
                        $TeacherModel = new TeacherModel();
                        $userdata = $this->form->getValue();
                        if ($TeacherModel->check_username($userdata['username']) || $PreteacherModel->check_username($userdata['username'])) {
                            $this->message = '入力されたメールアドレスは登録済みです．<br>';
                        }
                        if ($userdata['class'] !== '外注' && ($TeacherModel->check_class($userdata['class']) || $PreteacherModel->check_class($userdata['class']))) {
                            $this->message .= 'このクラスは他の教員に登録されています．<br>';
                        }
                        if (isset($this->message)) {
                            $this->title = '新規登録画面【仮登録】';
                            $this->caution1 = 'taro@****.jpの時はtaroのみ入力';
                            $this->next_type = 'tregist';
                            $this->next_action = 'confirm';
                            $btn = '入力完了';
                        } else {
                            $prePass = $this->create_rand_string();
                            // システム側から利用するときに利用
                            if ($this->is_system && is_object($auth)) {
                                $userdata['password'] = $auth->get_hashed_password($prePass); //パスワード"password"をハッシュ値に直す
                            } else {
                                $userdata['password'] = $this->auth->get_hashed_password($prePass);
                            }
                            $userdata['link_pass'] = hash('sha256', uniqid(rand(), 1));
                            $userdata['k_last_name'] = mb_convert_kana($userdata['h_last_name'], "C");
                            $userdata['k_first_name'] = mb_convert_kana($userdata['h_first_name'], "C");
                            $PreteacherModel->regist_preteacher($userdata);
                            unset($_SESSION['rand']);
                            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                            $this->caution1 = '仮登録が完了いたしました．';
                            $this->mail_to_premember($userdata, $prePass);
                            $this->title = '新規登録画面';
                            $this->caution1 = 'taro@****.jpの時はtaroのみ入力';
                            $this->next_type = 'tregist';
                            $this->next_action = 'confirm';
                            $btn = '入力完了';
                        }
                    } else {
                        $this->title = '不正アクセス検知';
                        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                        $this->message = '不正なアクセスを検知しました．';
                        $this->file = "message.tpl";
                    }
                }
            }
        }
        $this->form->addElement('submit', 'submit', ['value' => $btn]);
        $this->form->addElement('submit', 'submit2', ['value' => $btn2]);
        $this->form->addElement('reset', 'reset', ['value' => '取り消し']);
        $this->view_display();
    }


    //----------------------------------------------------
    // 教員情報の修正(管理者側)type=tmodify
    //----------------------------------------------------
    public function screen_tmodify($auth = "")
    {
        $btn = "";
        $btn2 = "";
        $this->file = "teacherinfo_form.tpl";

        // データベースを操作します。
        $TeacherModel = new TeacherModel();
        $PreteacherModel = new PreteacherModel();
        if ($this->is_system && $this->action == "form") {
            $_SESSION[_TEACHER_AUTHINFO] = $TeacherModel->get_teacher_data_id($_GET['id']);
        }
        // フォーム要素のデフォルト値を設定
        $this->form->addDataSource(
            new HTML_QuickForm2_DataSource_Array(
                [
                    'username' => $_SESSION[_TEACHER_AUTHINFO]['username'],
                    'last_name' => $_SESSION[_TEACHER_AUTHINFO]['last_name'],
                    'first_name' => $_SESSION[_TEACHER_AUTHINFO]['first_name'],
                    'h_last_name' => $_SESSION[_TEACHER_AUTHINFO]['h_last_name'],
                    'h_first_name' => $_SESSION[_TEACHER_AUTHINFO]['h_first_name'],
                    'class' => $_SESSION[_TEACHER_AUTHINFO]['class'],
                ]
            )
        );

        $last_name = $this->form->addElement('text', 'last_name', ['id' => 'last_name', 'size' => 30, 'onkeyup' => '(function() { let val="last_name";keyup(val); } )();']);
        $first_name = $this->form->addElement('text', 'first_name', ['id' => 'first_name', 'size' => 30, 'onkeyup' => '(function() { let val="last_name";keyup(val); } )();']);
        $h_last_name = $this->form->addElement('text', 'h_last_name', ['id' => 'h_last_name', 'size' => 30]);
        $h_first_name = $this->form->addElement('text', 'h_first_name', ['id' => 'h_first_name', 'size' => 30]);

        $classValue = [
            '' => '選択してください',
            '1-1' => '1-1',
            '1-2' => '1-2',
            '1-3' => '1-3',
            'IS2' => 'IS2',
            'IT2' => 'IT2',
            'IE2' => 'IE2',
            'IS3' => 'IS3',
            'IT3' => 'IT3',
            'IE3' => 'IE3',
            'IS4' => 'IS4',
            'IT4' => 'IT4',
            'IE4' => 'IE4',
            'IS5' => 'IS5',
            'IT5' => 'IT5',
            'IE5' => 'IE5',
            '寮務主事' => '寮務主事',
            '寮務主事補' => '寮務主事補',
            'その他' => 'その他'
        ];
        $class = $this->form->addElement('select', 'class', null, ['label' => '担任している学年/クラス', 'options' => $classValue]);

        $last_name->addRule('required', '氏を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $first_name->addRule('required', '名を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_last_name->addRule('required', '氏(ふりがな)を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_first_name->addRule('required', '名(ふりがな)を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_last_name->addRule('regex', 'ひらがなを入力してください', '/^[ぁ-ゞ]+$/u', HTML_QuickForm2_Rule::SERVER);
        $h_first_name->addRule('regex', 'ひらがなを入力してください', '/^[ぁ-ゞ]+$/u', HTML_QuickForm2_Rule::SERVER);
        $class->addRule('required', '学年／クラスを選択してください。', null, HTML_QuickForm2_Rule::SERVER);
        $this->form->addRecursiveFilter('trim');


        // フォームの妥当性検証
        if (!$this->form->validate()) {
            $this->action = "form";
        }

        if ($this->action == "form") {
            $this->title = '教員情報更新画面';
            $this->next_type = 'tmodify';
            $this->next_action = 'confirm';
            $btn = '確認画面へ';
        } else {
            if ($this->action == "confirm") {
                $this->title = '確認画面';
                $this->next_type = 'tmodify';
                $this->next_action = 'complete';
                $this->form->toggleFrozen(true);
                $btn = '更新する';
                $btn2 = '戻る';
            } else {
                if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                    $this->title = '教員情報更新画面';
                    $this->next_type = 'tmodify';
                    $this->next_action = 'confirm';
                    $btn = '確認画面へ';
                } else {
                    if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '更新する') {
                        $userdata = $this->form->getValue();
                        if ($TeacherModel->check_class($userdata['class'], $_SESSION[_TEACHER_AUTHINFO]['id']) || $PreteacherModel->check_class($userdata['class'])) {
                            $this->next_type = 'tmodify';
                            $this->next_action = 'confirm';
                            $this->title = '教員情報更新画面';
                            $this->message = "このクラスの担任は登録済みです。";
                            $btn = '確認画面へ';
                        } else {
                            $this->title = '更新完了画面';
                            $userdata['id'] = $_SESSION[_TEACHER_AUTHINFO]['id'];
                            $userdata['username'] = $_SESSION[_TEACHER_AUTHINFO]['username'];
                            $userdata['password'] = $_SESSION[_TEACHER_AUTHINFO]['password'];
                            $userdata['k_last_name'] = mb_convert_kana($userdata['h_last_name'], "C");
                            $userdata['k_first_name'] = mb_convert_kana($userdata['h_first_name'], "C");
                            $TeacherModel->modify_teacher($userdata);
                            $this->message = "教員情報を更新しました。";
                            $this->next_type = "tlist";
                            $this->file = "message.tpl";
                            if ($this->is_system) {
                                unset($_SESSION[_TEACHER_AUTHINFO]);
                            } else {
                                $_SESSION[_TEACHER_AUTHINFO] = $TeacherModel->get_teacher_data_id($_SESSION[_TEACHER_AUTHINFO]['id']);
                            }
                        }
                    }
                }
            }
        }

        $this->form->addElement('submit', 'submit', ['value' => $btn]);
        $this->form->addElement('submit', 'submit2', ['value' => $btn2]);
        $this->form->addElement('reset', 'reset', ['value' => '取り消し']);
        $this->view_display();
    }


    //----------------------------------------------------
    // 削除画面
    //----------------------------------------------------
    public function screen_tdelete()
    {
        $TeacherModel = new TeacherModel();
        if ($this->action == "confirm") {
            if ($this->is_system) {
                $_SESSION[_TEACHER_AUTHINFO] = $TeacherModel->get_teacher_data_id($_GET['id']);
                $this->message = "[削除する]をクリックすると　";
                $this->message .= htmlspecialchars($_SESSION[_TEACHER_AUTHINFO]['last_name'], ENT_QUOTES);
                $this->message .= htmlspecialchars($_SESSION[_TEACHER_AUTHINFO]['first_name'], ENT_QUOTES);
                $this->message .= "さん　の教員アカウントを削除します。";
            } else {
                $this->message = "[削除する]をクリックするとあなたの教員アカウントを削除して退会します。";
            }
            $this->form->addElement('submit', 'submit', ['value' => '削除する']);
            $this->title = '教員アカウント削除確認画面';
            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
            $this->next_type = 'tdelete';
            $this->next_action = 'complete';
            $this->file = 'delete_form.tpl';
        } else {
            if ($this->action == "complete" && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                $TeacherModel->delete_teacher($_SESSION[_MEMBER_AUTHINFO]['id']);

                unset($_SESSION['rand']);
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                if ($this->is_system) {
                    unset($_SESSION[_TEACHER_AUTHINFO]);
                } else {
                    $this->auth->logout();
                }
                $this->message = "教員アカウントを削除しました。";
                $this->title = '教員アカウント削除完了画面';
                $this->file = 'message.tpl';
            } else {
                $this->title = '不正アクセス検知';
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                $this->message = '不正なアクセス（リロードなど）を検知しました．';
                $this->file = "message.tpl";
            }
        }
        $this->view_display();
    }



    //----------------------------------------------------
    // メール関係
    //----------------------------------------------------
    //
    // 仮登録者へメール送信
    //
    private function mail_to_premember($userdata, $prePass)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $userdata['username'] . '@sendai-nct.ac.jp';
        $subject = "【松韻寮】会員登録の確認";
        $reg_date = date('Y-m-d H:i:s');
        $message = <<<EOM
    {$userdata['last_name']} {$userdata['first_name']}　様

    教員アカウントの仮会員登録が完了しました。
    下のリンクにアクセスして本登録を完了し、下の仮パスワードを使ってログインしてください。(24時間以内に本登録を完了されないと仮登録は無効化されます)
    なお、このリンクは矢島研究室のLAN内でないと、有効ではありません。

    http://{$_SERVER['SERVER_NAME']}{$path}/premember.php?username={$userdata['username']}&link_pass={$userdata['link_pass']}

    このメールに覚えがない場合はメールを削除してください。

    -----------------------------------------------------------------------------------------------
    登録日時：{$reg_date}
    メールアドレス：{$userdata['username']}@sendai-nct.ac.jp
    仮パスワード：{$prePass}
    氏：{$userdata['last_name']}
    名：{$userdata['first_name']}
    氏(ふりがな)：{$userdata['h_last_name']}
    名(ふりがな)：{$userdata['h_first_name']}
    担任している学年／クラス：{$userdata['class']}

    ----------------------------------
    松韻寮 外泊願・欠食届処理システム

EOM;
        $add_header = "";

        //$add_header .= "From: s1801063@sendai-nct.jp\n";

        //mb_send_mail($to, $subject, $message, $add_header);
        if (mail($to, $subject, $message)) {
            echo "メール送信は成功しました!!!";
        } else {
            echo "メールは送信できませんでした。。。";
        }
    }


    //-------------------------------------------------
    // 外泊願処理時に寮生にメールを送る
    //------------------------------------------------
    private function app_gaihaku_mail_to_member($gaihaku)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $gaihaku['username'] . '@sendai-nct.jp';
        if ($gaihaku['app'] === '承認') {
            $subject = "【松韻寮】提出した外泊願が承認されました";
        } else {
            $subject = "【松韻寮】提出した外泊願が非承認となりました";
        }
        $app_date = date('Y-m-d H:i:s');
        $s_day = substr($gaihaku['s_day'], 0, 10);
        $f_day = substr($gaihaku['f_day'], 0, 10);
        $message = <<<EOM
    {$gaihaku['last_name']} {$gaihaku['first_name']}　様

    提出した外泊願が{$_SESSION[_TEACHER_AUTHINFO]['last_name']} {$_SESSION[_TEACHER_AUTHINFO]['last_name']}先生によって
    ”{$gaihaku['app']}”にされました。
    詳細は下のURLにアクセスし、確認してください。

    http://{$_SERVER['SERVER_NAME']}/member/index.php?type=log&action=list


    このメールに覚えがない場合はメールを削除してください。

    -----------------------------------------------------------------------------------------------
    処理日時：{$app_date}
    日程：{$s_day} {$gaihaku['s_time']}時　～　{$f_day} {$gaihaku['f_time']}時
    教員氏名：{$_SESSION[_TEACHER_AUTHINFO]['last_name']} {$_SESSION[_TEACHER_AUTHINFO]['last_name']}
    承認／非承認：{$gaihaku['app']}
    コメント：{$gaihaku['comment']}

    ----------------------------------
    松韻寮 外泊願・欠食届処理システム

EOM;
        $add_header = "";

        //$add_header .= "From: s1801063@sendai-nct.jp\n";

        //mb_send_mail($to, $subject, $message, $add_header);
        mail($to, $subject, $message);

    }

}