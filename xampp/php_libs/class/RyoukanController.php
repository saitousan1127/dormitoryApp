<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RyoukanController
 *
 * @author nagatayorinobu
 */
class RyoukanController extends BaseController
{
    //----------------------------------------------------
    // 管理者用メニュー
    //----------------------------------------------------
    public function run()
    {
        // セッション開始　認証に利用します。
        $this->auth = new Auth();
        $this->auth->set_authname(_RYOUKAN_AUTHINFO);
        $this->auth->set_sessname(_RYOUKAN_SESSNAME);
        $this->auth->start();

        $SystemModel = new SystemModel;
        if (!$SystemModel->check_maint()) {
            if ($this->auth->check()) {
                $TeacherModel = new TeacherModel;
                if (isset($_SESSION[_RYOUKAN_AUTHINFO]) && !$TeacherModel->check_ban($_SESSION[_RYOUKAN_AUTHINFO]['id'])) {
                    // 認証済み
                    $this->menu_ryoukan();
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
    //　寮監用メニュー
    //----------------------------------------------------
    public function menu_ryoukan()
    {
        // 共用のテンプレートなどをこのフラグで管理用に切り替えます。
        $this->is_ryoukan = true;
        $TeacherController = new TeacherController($this->is_ryoukan);
        switch ($this->type) {
            case "login":
                $this->screen_login();
                break;
            case "logout":
                $this->auth->logout();
                $this->screen_login();
                break;
            case "modify":
                $TeacherController->screen_pass_modify($this->auth, $_SESSION[_RYOUKAN_AUTHINFO]['id']);
                break;
            case "list":
                $TeacherController->screen_list($this->auth, $_SESSION[_RYOUKAN_AUTHINFO]['id']);
                break;
            case "app_log":
                $TeacherController->screen_app_log($this->auth, $_SESSION[_RYOUKAN_AUTHINFO]['id']);
                break;
            case "tenko":
                $this->screen_tenko();
                break;
            case "absentee_list":
                $TeacherController->screen_absentee_list();
                break;
            case "authenticate":
                $this->do_authenticate();
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
        $this->form->addElement('text', 'username', ['size' => 15, 'maxlength' => 50], ['label' => 'ユーザ名']);
        $this->form->addElement('password', 'password', ['size' => 15, 'maxlength' => 50], ['label' => 'パスワード']);
        $this->form->addElement('submit', 'submit', ['value' => 'ログイン']);
        $this->caution1 = '教員用アカウントでログインしてください．';
        $this->next_type = 'authenticate';
        $this->title = '寮監用ログイン画面';
        $this->state = "寮監";
        if ($maint) {
            $this->message = $maint;
        }
        $this->file = "teacher_login.tpl";
        $this->view_display();
    }

    public function do_authenticate()
    {
        // データベースを操作します。
        $TeacherModel = new TeacherModel();
        $userdata = $TeacherModel->get_authinfo($_POST['username']);
        if (!empty($userdata['password']) && $this->auth->check_password($_POST['password'], $userdata['password'])) {
            $now = new DateTime(date('H:i:s'));
            $start = new DateTime("17:10:00");
            $end = new DateTime("08:40:00");
            if (!($end < $now && $now < $start)) {
                $RyoukanlogModel = new RyoukanlogModel();
                if (!$RyoukanlogModel->check_other_id($userdata['id'])) {
                    if ($userdata['ban'] == 0) {
                        session_regenerate_id(true);
                        $this->auth->auth_ok($userdata);
                        $RyoukanlogModel->regist_log($userdata['id']);
                        //$_SESSION[_RYOUKAN_AUTHINFO]['logintime'] = time();
                        $this->screen_top();
                    } else {
                        $this->auth_error_mess = "このアカウントは凍結されています。";
                        $this->screen_login();
                    }
                } else {
                    $this->auth_error_mess = "別の教員アカウントにログインされています．事務室にご相談ください．";
                    $this->screen_login();
                }
            } else {
                $this->auth_error_mess = "只今の時間帯は寮監ページにログインできません．";
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

        $this->view->assign('last_name', $_SESSION[_RYOUKAN_AUTHINFO]['last_name']);
        $this->view->assign('first_name', $_SESSION[_RYOUKAN_AUTHINFO]['first_name']);
        $this->caution1 = '寮監ページ';
        $this->title = '寮監 - トップ画面';
        $this->view->assign('ryoukan', TRUE);
        $this->view->assign('class', $_SESSION[_RYOUKAN_AUTHINFO]['class']);
        $this->file = 'teacher_top.tpl';
        $this->view_display();
    }


    //----------------------------------------------------
    // 点呼機能　type=tenko
    //----------------------------------------------------
    private function screen_tenko()
    {

        $now = new DateTime(date('H:i:s'));
        $start = new DateTime("21:30:00");
        $end = new DateTime("23:59:59");
        if (!($end < $now && $now < $start)) {
            $MemberModel = new MemberModel();
            $gaihakuModel = new gaihakuModel();
            $TenkoModel = new TenkoModel();
            if ($this->action == "list") {
                $ids = $MemberModel->get_all_id();
                $data = [];
                $i = 0;
                $count = 0;
                foreach ($ids as $key => $value) {
                    if (!$TenkoModel->check_todays($value['id'])) { //今日の点呼に出席していなかったらTRUE
                        if (!$gaihakuModel->check_todays($value['id'])) { //今日の外泊願が提出されていなかったらTRUE
                            $data[$i] = $MemberModel->get_member_data_id($value['id']);
                            $count++;
                        }
                    }
                    $i++;
                }
                $this->view->assign('count', $count);
                $this->view->assign('data', $data);
                $this->title = 'まだ点呼を完了していない寮生一覧';
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                $this->file = 'tenko_result.tpl';
                $this->next_type = 'tenko';
                $this->next_action = 'complete';
            } else {
                if (isset($_POST['submit']) && $_POST['submit'] === '確定する' && $this->action == "complete" && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                    $AbsenteeModel = new AbsenteeModel;
                    $ids = $MemberModel->get_all_id();
                    $data = [];
                    $i = 0;
                    $count = 0;
                    foreach ($ids as $key => $value) {
                        if (!$TenkoModel->check_todays($value['id'])) { //今日の点呼に出席していなかったらTRUE
                            if (!$gaihakuModel->check_todays($value['id'])) { //今日の外泊願が提出されていなかったらTRUE
                                $AbsenteeModel->regist_absentee($value['id']); //点呼欠席者のテーブルに登録                
                            }
                        }
                        $i++;
                    }
                    $this->title = '点呼欠席者登録完了画面';
                    unset($_SESSION['rand']);
                    $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                    $this->message = '点呼に欠席した寮生を登録しました。';
                    $this->file = "message.tpl";
                } else {
                    $this->title = '不正アクセス検知';
                    $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                    $this->message = '不正なアクセスを検知しました．';
                    $this->file = "message.tpl";
                }
            }
        } else {
            $this->title = 'Error';
            $this->message = 'この機能は21時30分～23時59分の間に使用できます．';
            $this->file = "message.tpl";
        }

        $this->view_display();
    }


    //-------------------------------------------------
    //点呼欠席者を送信
    //------------------------------------------------
    private function mail_result_of_tenko($gaihaku)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $TeacherModel = new TeacherModel();
        var_dump($gaihaku['class']);
        $teacher = $TeacherModel->get_teacher_data_class($gaihaku['class']);

        if (isset($teacher)) {
            $to = $teacher['username'] . '@sendai-nct.ac.jp';
            $subject = "【松韻寮】" . $gaihaku['class'] . "に所属する寮生が外泊願を提出しました";
            $reg_date = date('Y-m-d H:i:s');
            $s_day = substr($gaihaku['s_day'], 0, 10);
            $f_day = substr($gaihaku['f_day'], 0, 10);
            $message = <<<EOM
            {$teacher['last_name']} {$teacher['first_name']}　様

            {$_SESSION[_MEMBER_AUTHINFO]['last_name']} {$_SESSION[_MEMBER_AUTHINFO]['first_name']}さんが外泊願を提出しました。
            下のURLにアクセスし、外泊願を処理してください。

            http://{$_SERVER['SERVER_NAME']}/teacher/teacher.php?type=list


            このメールに覚えがない場合はメールを削除してください。

            -----------------------------------------------------------------------------------------------
            提出日時：{$reg_date}
            提出者：{$_SESSION[_MEMBER_AUTHINFO]['last_name']} {$_SESSION[_MEMBER_AUTHINFO]['last_name']}
            日程：{$s_day} {$gaihaku['s_time']}時　～　{$f_day} {$gaihaku['f_time']}時

            ----------------------------------
            松韻寮 外泊願・欠食届処理システム

            EOM;
            $add_header = "";

            //$add_header .= "From: s1801063@sendai-nct.jp\n";

            //mb_send_mail($to, $subject, $message, $add_header);
            var_dump($to);
            var_dump($subject);
            var_dump($message);
            if (mail($to, $subject, $message)) {
                echo "メール送信は成功しました!!!";
            } else {
                echo "メールは送信できませんでした。。。";
            }

        } else {
            echo "クラス担任が登録されていないようです。。。";
        }
    }

}