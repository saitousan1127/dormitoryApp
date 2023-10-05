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
class CatererController extends BaseController
{
    //----------------------------------------------------
    // 管理者用メニュー
    //----------------------------------------------------
    public function run()
    {
        // セッション開始　認証に利用します。
        $this->auth = new Auth();
        $this->auth->set_authname(_CATERER_AUTHINFO);
        $this->auth->set_sessname(_CATERER_SESSNAME);
        $this->auth->start();

        if (!$this->auth->check() && $this->type != 'authenticate') {
            // 未認証
            $this->type = 'login';
        }

        // 共用のテンプレートなどをこのフラグで管理用に切り替えます。
        //$this->is_system = true;

        // 会員側の画面を表示するためMemberControllerを利用します。
        //$MemberController = new MemberController($this->is_system);
        //$TeacherController = new TeacherController($this->is_system);

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
            case "list":
                $this->screen_list();
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
        $this->caution1 = '給食業者用アカウントでログインしてください';
        $this->next_type = 'authenticate';
        $this->title = '給食業者用ログイン画面';
        $this->file = "system_login.tpl";
        $this->view_display();
    }

    public function do_authenticate()
    {
        // データベースを操作します。
        $CatererModel = new CatererModel();
        $userdata = $CatererModel->get_authinfo($_POST['username']);
        if (!empty($userdata['password']) && $this->auth->check_password($_POST['password'], $userdata['password'])) {
            session_regenerate_id(true);
            $this->auth->auth_ok($userdata);
            $_SESSION[_CATERER_AUTHINFO]['logintime'] = time();
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
                    $CatererModel = new CatererModel();
                    $userdata = $CatererModel->get_user_data_id($_SESSION[_CATERER_AUTHINFO]['id']); //前のユーザのデータ
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
                        $CatererModel->modify_user($userdata);
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
        //unset($_SESSION['search_key']);
        unset($_SESSION['pageID']);

        $this->title = '給食業者 - トップ画面';
        $this->file = 'caterer_top.tpl';
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
    // 欠食申請一覧表示   type=list
    //----------------------------------------------------
    private function screen_list()
    {
        $kessyokuModel = new kessyokuModel;

        $disp_class = "";
        $sql_class = "";

        $sql_date = $this->rec_post('date');

        $now = time();
        $thirteen = mktime(13, 0, 0, date("m"), date("d"), date("Y"));
        if ($now < $thirteen) {
            $this->view->assign('three_days_ago', date("Y-m-d", strtotime("+2 day")));
            if ($sql_date == "") {
                $sql_date = date("Y-m-d", strtotime("+2 day"));
                $this->view->assign('date', date("Y-m-d", strtotime("+2 day")));
            }
        } else {
            $this->view->assign('three_days_ago', date("Y-m-d", strtotime("+3 day")));
            if ($sql_date == "") {
                $sql_date = date("Y-m-d", strtotime("+3 day"));
                $this->view->assign('date', date("Y-m-d", strtotime("+3 day")));
            }
        }

        list($data, $count) = $kessyokuModel->get_applist($sql_date);
        list($data, $links) = $this->make_page_link_10($data);
        $this->view->assign('count', $count);
        $this->view->assign('data', $data);
        $this->view->assign('links', $links['all']);
        $this->title = '欠食申請覧画面';
        $this->file = 'kessyoku_app_list.tpl';
        $this->next_type = 'list';
        $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
        $this->view_display();
    }

}