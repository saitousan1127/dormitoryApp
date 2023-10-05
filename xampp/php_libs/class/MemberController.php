<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemberController
 *
 * @author nagatayorinobu
 */
class MemberController extends BaseController
{
    //----------------------------------------------------
    // 会員用メニュー
    //----------------------------------------------------
    public function run()
    {
        // セッション開始　認証に利用します。
        $this->auth = new Auth;
        $this->auth->set_authname(_MEMBER_AUTHINFO);
        $this->auth->set_sessname(_MEMBER_SESSNAME);
        $this->auth->start();
        $SystemModel = new SystemModel;
        $MemberModel = new MemberModel;
        if (!$SystemModel->check_maint()) {
            if ($this->auth->check()) {
                if (isset($_SESSION[_MEMBER_AUTHINFO]) && !$MemberModel->check_ban($_SESSION[_MEMBER_AUTHINFO]['id'])) {
                    // 認証済み
                    $this->menu_member();
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
    // 会員用メニュー
    //----------------------------------------------------
    public function menu_member()
    {
        switch ($this->type) {
            case "logout":
                $this->auth->logout();
                $this->screen_login();
                break;
            case "regist":
                $this->screen_regist();
                break;
            case "modify":
                $this->screen_modify();
                break;
            case "pass_modify":
                $this->screen_pass_modify();
                break;
            case "delete":
                $this->screen_delete();
                break;
            case "tpl":
                $this->screen_tpl();
                break;
            case "gaihaku":
                $this->screen_gaihaku();
                break;
            case "kessyoku":
                $this->screen_kessyoku();
                break;
            case "log":
                $this->screen_gaihaku_log();
                break;
            case "kessyoku_log":
                $this->screen_kessyoku_log();
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
    public function screen_login($maint = "")
    {
        $this->form->addElement('text', 'username', ['size' => 15, 'maxlength' => 50], ['label' => 'メールアドレス']);
        $this->form->addElement('password', 'password', ['size' => 15, 'maxlength' => 50], ['label' => 'パスワード']);
        $this->form->addElement('submit', 'submit', ['value' => 'ログイン']);
        $this->title = '寮生用ログイン画面';
        if ($maint) {
            $this->message = $maint;
        }
        $this->state = 'member';
        $this->next_type = 'authenticate';
        $this->file = "login.tpl";
        $this->view_display();
    }


    //----------------------------------------------------
    // ログイン前の認証
    //----------------------------------------------------
    public function do_authenticate()
    {
        // データベースを操作します。
        $MemberModel = new MemberModel();
        $userdata = $MemberModel->get_authinfo($_POST['username']);
        if (!empty($userdata['password']) && $this->auth->check_password($_POST['password'], $userdata['password'])) {
            if ($userdata['ban'] == 0) {
                session_regenerate_id(true);
                $this->auth->auth_ok($userdata);
                $_SESSION[_MEMBER_AUTHINFO]['logintime'] = time();
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
    public function screen_top()
    {
        $MemberModel = new MemberModel();
        $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
        $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
        $this->title = '会員トップ画面';
        $H = date('H');
        $H = (int) $H;
        if (6 <= $H && $H <= 9) {
            $this->view->assign('greeting', 'おはようございます！(^O^)');
        } else if (10 <= $H && $H <= 16) {
            $this->view->assign('greeting', 'こんにちは！(⌒▽⌒)');
        } else if (1 <= $H && $H <= 3) {
            $this->view->assign('greeting', 'こんばんは！！！(☆∀☆)');
        } else {
            $this->view->assign('greeting', 'こんばんは！(￣∀￣)');
        }

        $data = $MemberModel->get_same_birthday();
        $i = 0;
        $year = (int) date('Y');
        foreach ($data as $item) {
            $data[$i]['birthday'] = substr($data[$i]['birthday'], 0, 4);
            $data[$i]['birthday'] = (int) $data[$i]['birthday'];
            $data[$i]['birthday'] = $year - $data[$i]['birthday'];
            $i++;
        }
        $this->view->assign('today', date('Y/m/d'));
        $this->view->assign('data', $data);
        $this->file = 'member_top.tpl';
        $this->view_display();
    }

    //----------------------------------------------------
    // 会員情報新規登録画面 type=regist
    //----------------------------------------------------
    public function screen_regist($auth = "")
    {
        $btn = "";
        $btn2 = "";
        $this->file = "memberinfo_form.tpl"; // デフォルト

        // フォーム要素のデフォルト値を設定
        $date_defaults = [
            'Y' => date('Y'),
            'm' => date('m'),
            'd' => date('d'),
        ];

        $this->form->addDataSource(new HTML_QuickForm2_DataSource_Array(['birthday' => $date_defaults]));
        $this->make_form_controle();
        // フォームの妥当性検証
        if (!$this->form->validate()) {
            $this->action = "form";
        }

        if ($this->action == "form") {
            $this->title = '新規登録画面【仮登録】';
            $this->next_type = 'regist';
            $this->next_action = 'confirm';
            $btn = '入力完了';
        } else {
            if ($this->action == "confirm" && isset($_POST['submit']) && $_POST['submit'] == '入力完了') {
                $this->title = '新規登録画面【仮登録】';
                $this->next_type = 'regist';
                $this->next_action = 'complete';
                $this->form->toggleFrozen(true);
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                $btn = '仮登録';
                $btn2 = '戻る';
            } else {
                if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                    $this->title = '新規登録画面【仮登録】';
                    $this->next_type = 'regist';
                    $this->next_action = 'confirm';
                    $btn = '入力完了';
                } else {
                    if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '仮登録' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                        $PrememberModel = new PrememberModel();
                        $MemberModel = new MemberModel();
                        $roomModel = new roomModel();
                        $userdata = $this->form->getValue();
                        if ($MemberModel->check_username($userdata['username']) || $PrememberModel->check_username($userdata['username'])) {
                            $this->message = '入力されたメールアドレスは登録済みです．<br>';
                        }
                        if (!$roomModel->knock_room($userdata['roomnum'])) {
                            $this->message .= '入力された部屋番号は居住できません．';
                        }
                        if ($roomModel->check_username($userdata['roomnum']) || $PrememberModel->check_roomnum($userdata['roomnum'])) {
                            $this->message .= '入力された部屋番号は他の寮生が登録済みです．';
                        }
                        if (isset($this->message)) {
                            $this->title = '新規登録画面【仮登録】';
                            $this->next_type = 'regist';
                            $this->next_action = 'confirm';
                            $btn = '入力完了';
                        } else {
                            $userdata['password'] = $this->auth->get_hashed_password($userdata['password']);
                            if ($userdata['dest']['regist'] == 'regist') {
                                $userdata['birthday'] = sprintf(
                                    "%04d%02d%02d",
                                    $userdata['birthday']['Y'],
                                    $userdata['birthday']['m'],
                                    $userdata['birthday']['d']
                                );
                            } else {
                                $userdata['birthday'] = "未登録";
                            }
                            $userdata['link_pass'] = hash('sha256', uniqid(rand(), 1));
                            $userdata['k_last_name'] = mb_convert_kana($userdata['h_last_name'], "C");
                            $userdata['k_first_name'] = mb_convert_kana($userdata['h_first_name'], "C");
                            $roomModel->delete_username($userdata['username']);
                            $PrememberModel->regist_premember($userdata);
                            unset($_SESSION['rand']);
                            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                            $this->caution1 = '仮登録が完了いたしました．';
                            $this->mail_to_premember($userdata); //port25が使えないので
                            $this->caution1 .= '[ <a href=http://192.168.11.69/ryousei/premember.php?username=' . $userdata['username'] . '&link_pass=' . $userdata['link_pass'] . '>本登録用URL</a> ]<br>';
                            $this->title = '新規登録画面【仮登録】';
                            $this->message = $userdata['username'] . "@sendai-nct.jpに本登録用のURLを送付しました．<br>";
                            $this->file = "message.tpl";
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
    // 寮生情報の修正(管理者側) type=modify
    //----------------------------------------------------
    public function screen_modify($auth = "")
    {
        $btn = "";
        $btn2 = "";
        $this->file = "memberinfo_form.tpl";

        // データベースを操作します。
        $MemberModel = new MemberModel();
        $PrememberModel = new PrememberModel();
        $roomModel = new roomModel();
        if ($this->is_system && $this->action == "form") {
            $_SESSION[_MEMBER_AUTHINFO] = $MemberModel->get_member_data_id($_GET['id']);
        }
        // フォーム要素のデフォルト値を設定
        if ($_SESSION[_MEMBER_AUTHINFO]['birthday'] === '未登録') {
            $date_defaults = [
                'Y' => (date('Y') - 15),
                'm' => date('m'),
                'd' => date('d')
            ];
        } else {
            $date_defaults = [
                'Y' => substr($_SESSION[_MEMBER_AUTHINFO]['birthday'], 0, 4),
                'm' => substr($_SESSION[_MEMBER_AUTHINFO]['birthday'], 4, 2),
                'd' => substr($_SESSION[_MEMBER_AUTHINFO]['birthday'], 6, 2),
            ];
        }

        $this->form->addDataSource(
            new HTML_QuickForm2_DataSource_Array(
                [
                    'last_name' => $_SESSION[_MEMBER_AUTHINFO]['last_name'],
                    'first_name' => $_SESSION[_MEMBER_AUTHINFO]['first_name'],
                    'h_last_name' => $_SESSION[_MEMBER_AUTHINFO]['h_last_name'],
                    'h_first_name' => $_SESSION[_MEMBER_AUTHINFO]['h_first_name'],
                    'class' => $_SESSION[_MEMBER_AUTHINFO]['class'],
                    'roomnum' => $_SESSION[_MEMBER_AUTHINFO]['roomnum'],
                    'birthday' => $date_defaults
                ]
            )
        );

        $this->make_form_controle($_SESSION[_MEMBER_AUTHINFO]['birthday']);

        // フォームの妥当性検証
        if (!$this->form->validate()) {
            $this->action = "form";
        }

        if ($this->action == "form") {
            $this->title = '寮生情報更新画面';
            $this->next_type = 'modify';
            $this->next_action = 'confirm';
            $btn = '確認画面へ';
        } else {
            if ($this->action == "confirm") {
                $this->title = '確認画面';
                $this->next_type = 'modify';
                $this->next_action = 'complete';
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                $this->form->toggleFrozen(true);
                $btn = '更新する';
                $btn2 = '戻る';
            } else {
                if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                    $this->title = '寮生情報更新画面';
                    $this->next_type = 'modify';
                    $this->next_action = 'confirm';
                    $btn = '確認画面へ';
                } else {
                    if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '更新する' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                        $userdata = $this->form->getValue();
                        if (!$roomModel->knock_room($userdata['roomnum'])) {
                            $this->message .= '入力された部屋番号は居住できません．';
                        }
                        if ($roomModel->check_username($userdata['roomnum'], $_SESSION[_MEMBER_AUTHINFO]['username']) || $PrememberModel->check_roomnum($userdata['roomnum'])) {
                            $this->message .= '入力された部屋番号は他の寮生が登録済みです．';
                        }
                        if (isset($this->message)) {
                            $this->title .= '寮生情報更新画面';
                            $this->next_type = 'modify';
                            $this->next_action = 'confirm';
                            $btn = '入力完了';
                        } else {
                            $this->title = '更新完了画面';
                            $userdata['id'] = $_SESSION[_MEMBER_AUTHINFO]['id'];
                            $userdata['username'] = $_SESSION[_MEMBER_AUTHINFO]['username'];
                            $userdata['password'] = $_SESSION[_MEMBER_AUTHINFO]['password'];
                            if ($userdata['dest']['regist'] == 'regist') {
                                $userdata['birthday'] = sprintf(
                                    "%04d%02d%02d",
                                    $userdata['birthday']['Y'],
                                    $userdata['birthday']['m'],
                                    $userdata['birthday']['d']
                                );
                            } else {
                                $userdata['birthday'] = "未登録";
                            }
                            $userdata['k_last_name'] = mb_convert_kana($userdata['h_last_name'], "C");
                            $userdata['k_first_name'] = mb_convert_kana($userdata['h_first_name'], "C");
                            $MemberModel->modify_member($userdata);
                            $roomModel->modify_username($_SESSION[_MEMBER_AUTHINFO]['username'], $userdata['roomnum']);
                            unset($_SESSION['rand']);
                            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                            $this->message = "寮生情報を修正しました。";
                            $this->file = "message.tpl";
                            if ($this->is_system) {
                                unset($_SESSION[_MEMBER_AUTHINFO]);
                            } else {
                                $_SESSION[_MEMBER_AUTHINFO] = $MemberModel->get_member_data_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                                $_SESSION[_MEMBER_AUTHINFO]['logintime'] = time();
                            }
                        }
                    } else {
                        $this->title = '不正アクセス検知';
                        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                        $this->message = '不正なアクセス（リロードなど）を検知しました．';
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
    // 外泊願テンプレート作成(会員側) type=tpl
    //----------------------------------------------------
    public function screen_tpl($auth = "")
    {
        $btn = "";
        $btn2 = "";
        $this->file = "gaihaku.tpl";

        // データベースを操作します。
        $tplModel = new tplModel();

        $this->make_gaihaku_controle();

        // フォームの妥当性検証
        if (!$this->form->validate()) {
            $this->action = "form";
        }

        if ($this->action == "form") {

            if (empty($_SESSION[_MEMBER_AUTHINFO]['roomnum'])) {
                $roomModel = new roomModel;
                $_SESSION[_MEMBER_AUTHINFO]['roomnum'] = $roomModel->getRoomByusername($_SESSION[_MEMBER_AUTHINFO]['username']);
            }

            $this->title = '外泊願テンプレート-作成画面';
            $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
            $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
            $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
            if (isset($_SESSION[_MEMBER_AUTHINFO]['roomnum'])) {
                switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                    case "E":
                        $this->view->assign('tou', '東寮');
                        break;
                    case "N":
                        $this->view->assign('tou', '北寮');
                        break;
                    case "S":
                        $this->view->assign('tou', '南寮');
                        break;
                    default:
                }
                $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
            } else {
                $this->view->assign('tou', '未登録');
                $this->view->assign('roomnum', '未登録');
            }
            $this->next_type = 'tpl';
            $this->next_action = 'confirm';
            $btn = '確認画面へ';
        } else {
            if ($this->action == "confirm") {
                $this->title = '外泊願テンプレート-確認画面';
                $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                if (isset($_SESSION[_MEMBER_AUTHINFO]['roomnum'])) {
                    switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                        case "E":
                            $this->view->assign('tou', '東寮');
                            break;
                        case "N":
                            $this->view->assign('tou', '北寮');
                            break;
                        case "S":
                            $this->view->assign('tou', '南寮');
                            break;
                        default:
                    }
                    $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                } else {
                    $this->view->assign('tou', '未登録');
                    $this->view->assign('roomnum', '未登録');
                }
                $this->next_type = 'tpl';
                $this->next_action = 'complete';
                $this->form->toggleFrozen(true);
                $btn = '保存する';
                $btn2 = '戻る';
            } else {
                if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                    $this->title = '外泊願テンプレート-作成画面';
                    $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                    $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                    $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                    if (isset($_SESSION[_MEMBER_AUTHINFO]['roomnum'])) {
                        switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                            case "E":
                                $this->view->assign('tou', '東寮');
                                break;
                            case "N":
                                $this->view->assign('tou', '北寮');
                                break;
                            case "S":
                                $this->view->assign('tou', '南寮');
                                break;
                            case "未":
                                $this->view->assign('tou', '未登録');
                                break;
                            default:
                        }
                        $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                    } else {
                        $this->view->assign('tou', '未登録');
                        $this->view->assign('roomnum', '未登録');
                    }
                    $this->next_type = 'tpl';
                    $this->next_action = 'confirm';
                    $btn = '確認画面へ';
                } else {
                    if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '保存する' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                        $gaihaku = $this->form->getValue();
                        if ($gaihaku['dest']['reason'] == 'その他' && empty($gaihaku['riyuu'])) {
                            $this->title = '外泊願テンプレート-作成画面';
                            $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                            $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                            $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                            if (isset($_SESSION[_MEMBER_AUTHINFO]['roomnum'])) {
                                switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                                    case "E":
                                        $this->view->assign('tou', '東寮');
                                        break;
                                    case "N":
                                        $this->view->assign('tou', '北寮');
                                        break;
                                    case "S":
                                        $this->view->assign('tou', '南寮');
                                        break;
                                    case "未":
                                        $this->view->assign('tou', '未登録');
                                        break;
                                    default:
                                }
                                $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                            } else {
                                $this->view->assign('tou', '未登録');
                                $this->view->assign('roomnum', '未登録');
                            }
                            $this->next_type = 'tpl';
                            $this->next_action = 'confirm';
                            $this->message = "外泊理由が『その他』の場合は理由を具体的に入力してください。";
                            $btn = '確認画面へ';
                        } else {
                            $this->title = '更新完了画面';
                            if ($tplModel->check_id($_SESSION[_MEMBER_AUTHINFO]['id'])) {
                                $this->title .= 'modify';
                                $tplModel->modify_tpl($_SESSION[_MEMBER_AUTHINFO]['id'], $gaihaku);
                            } else {
                                $this->title .= 'regist';
                                $tplModel->regist_tpl($_SESSION[_MEMBER_AUTHINFO]['id'], $gaihaku);
                            }
                            unset($_SESSION['rand']);
                            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                            $this->message = "テンプレートは保存されました";
                            $this->file = "message.tpl";
                        }
                    } else {
                        $this->title = '不正アクセス検知';
                        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                        $this->message = '不正なアクセス（リロードなど）を検知しました．';
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
    // 間の日付を取り出す(長期休暇の日付は抜く)
    //----------------------------------------------------
    public function meanwhile($s_day, $f_day)
    {
        $longVacationModel = new longVacationModel;
        for ($i = date('Ymd', strtotime($s_day)); $i <= date('Ymd', strtotime($f_day)); $i++) {
            //YYYY-mm-dd形式からそれぞれを取り出す
            $year = substr($i, 0, 4);
            $month = substr($i, 4, 2);
            $day = substr($i, 6, 2);

            //日付が正しいかをチェックする
            if (checkdate($month, $day, $year)) {
                $day = date('Y-m-d', strtotime($i));
                if (!$longVacationModel->check_during_term($day)) {
                    $days[] = $day;
                }
            }
        }
        return $days;
    }


    //----------------------------------------------------
    // 欠食届テーブルを作成
    //----------------------------------------------------
    public function create_kessyoku($s_day, $f_day, $s_time = "", $f_time = "")
    {
        //欠食届のチェックの確認方法を調べるところから
        $holidayModel = new holidayModel;
        $table = "";
        $now = time();
        $thirteen = mktime(13, 0, 0, date("m"), date("d"), date("Y"));
        if ($now < $thirteen) {
            $three_days_ago = date("Y-m-d", strtotime("+3 day"));
        } else {
            $three_days_ago = date("Y-m-d", strtotime("+4 day"));
        }
        if (strtotime($f_day) >= strtotime($three_days_ago)) {
            //開始時から終了日までの間の日数を取り出す
            $days = $this->meanwhile($s_day, $f_day);

            //欠食届の左端を準備
            $table = <<<EOT
                <td>
                <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
                <tr><td>　　</td><tr>
                <tr><td>朝食</td></tr>
                <tr><td>昼食</td></tr>
                <tr><td>夕食</td></tr>
                </table>
                </td>
                EOT;

            foreach ($days as $day) {
                if (
                    (strtotime($day) >= strtotime($three_days_ago))
                ) {
                    $datetime = new DateTime($day);
                    $week = array("日", "月", "火", "水", "木", "金", "土");
                    $w = (int) $datetime->format('w');
                    $app_day = sprintf("%s月%s日(%s)", substr($day, 5, 2), substr($day, 8, 2), $week[$w]);
                    if (!(date('w', strtotime($day)) == 0 || $holidayModel->check_same_date($day))) {
                        //平日(日曜・祝日でない)場合    
                        $table .= <<<EOT
                            <td>
                            <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
                            <tr><td>{$app_day}</td><tr>
                            <tr><td><input type="checkbox" name="{$day}bre" value="bre"%s></td></tr>
                            <tr><td><input type="checkbox" name="{$day}lun" value="lun"%s></td></tr>
                            <tr><td><input type="checkbox" name="{$day}din" value="din"%s></td></tr>
                            </table>
                            </td>
                            EOT;
                        if ($s_time != "" && $f_time != "") {
                            if ($day == $s_day) {
                                $table = sprintf(
                                    $table,
                                    ($this->s_time >= 9) ? '' : ' checked',
                                    ($this->s_time >= 14) ? '' : ' checked',
                                    ($this->s_time >= 20) ? '' : ' checked'
                                );
                            } else if ($day == $f_day) {
                                $table = sprintf(
                                    $table,
                                    ($this->f_time >= 9) ? ' checked' : '',
                                    ($this->f_time >= 14) ? ' checked' : '',
                                    ($this->f_time >= 20) ? ' checked' : ''
                                );
                            } else {
                                $table = sprintf(
                                    $table,
                                    ' checked',
                                    ' checked',
                                    ' checked'
                                );
                            }
                        } else {
                            $table = sprintf(
                                $table,
                                '',
                                '',
                                ''
                            );
                        }
                    } else {
                        //日曜祝日の場合    
                        $table .= <<<EOT
                            <td>
                            <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
                            <tr><td>{$app_day}</td><tr>
                            <tr><td><input type="checkbox" name="{$day}bre" value="bre"%s></td></tr>
                            <tr><td>　<input type="hidden" name="{$day}lun value=""></td></tr>
                            <tr><td><input type="checkbox" name="{$day}din" value="din"%s></td></tr>
                            </table>
                            </td>
                            EOT;
                        if ($s_time != "" && $f_time != "") {
                            if ($day == $s_day) {
                                $table = sprintf(
                                    $table,
                                    ($this->s_time >= 9) ? '' : ' checked',
                                    ($this->s_time >= 20) ? '' : ' checked'
                                );
                            } else if ($day == $f_day) {
                                $table = sprintf(
                                    $table,
                                    ($this->f_time >= 9) ? ' checked' : '',
                                    ($this->f_time >= 20) ? ' checked' : ''
                                );
                            } else {
                                $table = sprintf(
                                    $table,
                                    ' checked',
                                    ' checked'
                                );
                            }

                        } else {
                            $table = sprintf(
                                $table,
                                '',
                                ''
                            );
                        }
                    }
                }
            }
        }
        return $table;
    }


    //----------------------------------------------------
    // 欠食届修正テーブルを作成
    //----------------------------------------------------
    public function create_modify_kessyoku($data)
    {
        $holidayModel = new holidayModel;
        $table = "";
        $now = time();
        $thirteen = mktime(13, 0, 0, date("m"), date("d"), date("Y"));
        if ($now < $thirteen) {
            $three_days_ago = date("Y-m-d", strtotime("+3 day"));
        } else {
            $three_days_ago = date("Y-m-d", strtotime("+4 day"));
        }
        //欠食届の左端を準備
        $table = <<<EOT
            <td>
            <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
            <tr><td>　　</td><tr>
            <tr><td>朝食</td></tr>
            <tr><td>昼食</td></tr>
            <tr><td>夕食</td></tr>
            </table>
            </td>
            EOT;
        $i = 0;
        foreach ($data as $item) {
            $day = substr($item['date'], 0, 10);
            $id = $item['kessyoku_id'];
            if (
                (strtotime($day) >= strtotime($three_days_ago))
                //&&((strtotime($day)=strtotime($three_days_ago))&&($now<=$thirteen))
            ) {
                $datetime = new DateTime($day);
                $week = array("日", "月", "火", "水", "木", "金", "土");
                $w = (int) $datetime->format('w');
                $app_day = sprintf("%s月%s日(%s)", substr($day, 5, 2), substr($day, 8, 2), $week[$w]);
                if (!(date('w', strtotime($day)) == 0 || $holidayModel->check_same_date($day))) {
                    //平日(日曜・祝日でない)場合
                    $table .= <<<EOT
                        <td>
                        <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
                        <tr><td>{$app_day}</td><tr>
                        <tr><td><input type="checkbox" name="{$day}bre" value="bre"%s></td></tr>
                        <tr><td><input type="checkbox" name="{$day}lun" value="lun"%s></td></tr>
                        <tr><td><input type="checkbox" name="{$day}din" value="din"%s></td></tr>
                        <input type="hidden" name="id[$i]" value="$id">
                        </table>
                        </td>
                        EOT;

                    $table = sprintf(
                        $table,
                        ($item['bre']) ? ' checked' : '',
                        ($item['lun']) ? ' checked' : '',
                        ($item['din']) ? ' checked' : ''
                    );
                } else {
                    //日曜祝日の場合
                    $table .= <<<EOT
                        <td>
                        <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
                        <tr><td>{$app_day}</td><tr>
                        <tr><td><input type="checkbox" name="{$day}bre" value="bre"%s></td></tr>
                        <tr><td>　<input type="hidden" name="{$day}lun value=""></td></tr>
                        <tr><td><input type="checkbox" name="{$day}din" value="din"%s></td></tr>
                        <input type="hidden" name="id[$i]" value="$id">
                        </table>
                        </td>
                        EOT;
                    $table = sprintf(
                        $table,
                        ($item['bre']) ? ' checked' : '',
                        ($item['din']) ? ' checked' : ''
                    );
                }
            }
            $i++;
        }
        return $table;
    }



    //----------------------------------------------------
    // 欠食届の判定
    //----------------------------------------------------
    public function check_kessyoku($day)
    {
        //$three_days_ago = date("Y-m-d",strtotime("+3 day")); //本日から3日後 
        $now = time();
        $thirteen = mktime(13, 0, 0, date("m"), date("d"), date("Y")); //本日の13時
        if ($now < $thirteen) {
            $three_days_ago = date("Y-m-d", strtotime("+3 day"));
        } else {
            $three_days_ago = date("Y-m-d", strtotime("+4 day"));
        }
        $checked = [0, 0, 0];
        //一日ずつ3日前の13時かどうか判定して、データベースに保存するかどうかを決める。   
        if (
            (strtotime($day) >= strtotime($three_days_ago))
            //&&!((strtotime($day)=strtotime($three_days_ago))&&($now<=$thirteen))
        ) {
            if (isset($_POST["$day" . "bre"]) && $_POST["$day" . "bre"] == "bre") {
                $checked[0] = 1;
            }

            if (isset($_POST["$day" . "lun"]) && $_POST["$day" . "lun"] == "lun") {
                $checked[1] = 1;
            }

            if (isset($_POST["$day" . "din"]) && $_POST["$day" . "din"] == "din") {
                $checked[2] = 1;
            }
        } else {
            $checked = 'time_out';
        }
        if ($checked == [0, 0, 0]) {
            $checked = 'delete';
        }
        return $checked;
    }


    //----------------------------------------------------
    // 土日・祝日による外泊願のauthの判定
    //----------------------------------------------------
    public function check_auth($s_day, $s_time, $f_day, $f_time, $reason, $grade)
    {
        $holidayModel = new holidayModel;
        //$longVacationModel = new longVacationModel;
        $days = $this->meanwhile($s_day, $f_day);
        $flag = false;
        foreach ($days as $day) {
            $w = date('w', strtotime($day));
            if (!($w == 0 || $w == 6 || $holidayModel->check_same_date($day))) { //$dayが土日でもなく祝日でもない
                if (!($day == $s_day && ($w == 5 || $holidayModel->check_same_date(date('Y/m/d', strtotime("$day +1 day")))) && $s_time >= 17)) { //開始日が金曜日または祝日前日で開始時間が17時以降ではない
                    if (!($day == $f_day && ($w == 1 || $holidayModel->check_same_date(date('Y/m/d', strtotime("$day -1 day")))) && $f_time <= 8)) { //終了日が月曜日または祝日後日で終了時間が９時前ではない
                        $flag = true; //帰省機関に授業時間がある可能性がある場合は担任しか見れないように設定
                    }
                }
            }
        }
        if ($flag) {
            return 1;
        }
        if ($reason == "その他" && $grade < 4) {
            return 2;
        }
        return 3;
    }


    //----------------------------------------------------
    // 外泊願 作成/提出(会員側) type=gaihaku
    //----------------------------------------------------
    public function screen_gaihaku($auth = "")
    {

        if ($this->action == "form" && empty($_SESSION[_MEMBER_AUTHINFO]['roomnum'])) {
            $roomModel = new roomModel;
            $_SESSION[_MEMBER_AUTHINFO]['roomnum'] = $roomModel->getRoomByusername($_SESSION[_MEMBER_AUTHINFO]['username']);
        }

        if (empty($_SESSION[_MEMBER_AUTHINFO]['roomnum'])) { //エラー
            $this->title = "エラー出力";
            $this->message = "部屋番号が設定されておりません．トップ画面>プロフィール編集で設定してください．";
            $this->file = "message.tpl";
        } else {
            $btn = "";
            $btn2 = "";
            $this->file = "gaihaku.tpl";

            // データベースを操作します。
            $gaihakuModel = new gaihakuModel();

            if ($this->action == "form2") {
                $tplModel = new tplModel();
                if ($tplModel->check_id($_SESSION[_MEMBER_AUTHINFO]['id'])) {
                    $tpl = $tplModel->get_tpl_data_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                    $this->form->addDataSource(
                        new HTML_QuickForm2_DataSource_Array(
                            [
                                'psCode1' => $tpl['psCode1'],
                                'psCode2' => $tpl['psCode2'],
                                'address' => $tpl['address'],
                                'last_name2' => $tpl['last_name2'],
                                'first_name2' => $tpl['first_name2'],
                                'tel' => $tpl['tel'],
                                'dest' => $tpl['reason'],
                                'riyuu' => $tpl['riyuu'],
                            ]
                        )
                    );
                    $this->reason = $tpl['reason'];
                } else {
                    $this->message = "外泊願のテンプレートが存在しません";
                }
                $this->action = "form";
            }

            $this->make_gaihaku_controle(); //外泊願のフォーム作成

            //一番最初の初期値設定
            if ($this->action == 'form') {
                $this->s_day = date('Y-m-d');
                $this->f_day = date('Y-m-d');
                ;
            }

            // フォームの妥当性検証
            if (!$this->form->validate()) {
                //確認画面、やり直し時の初期値設定
                if (isset($_POST['s_day']) && isset($_POST['f_day'])) {
                    $this->s_day = $_POST['s_day'];
                    $this->f_day = $_POST['f_day'];
                }
                $this->action = "form";
            }

            if ($this->action == "form") {
                $this->title = '外泊願-作成画面';
                $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                    case "E":
                        $this->view->assign('tou', '東寮');
                        break;
                    case "N":
                        $this->view->assign('tou', '北寮');
                        break;
                    case "S":
                        $this->view->assign('tou', '南寮');
                        break;
                    default:
                }
                $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                $this->caution1 = '外泊願テンプレート呼び出し';
                $this->next_type = 'gaihaku';
                $this->next_action = 'confirm';
                $btn = '確認画面へ';
            } else {
                if ($this->action == "confirm") {
                    if (empty($_POST['s_day']) || empty($_POST['f_day'])) {
                        $this->message .= "日程が入力されていません<br>";
                    } else {
                        if (strtotime($_POST['s_day']) >= strtotime($_POST['f_day'])) {
                            $this->message .= "日程の順序が正しくありません．<br>";
                        }
                        $today = date('Y-m-d');
                        $now_time = (int) date('H');
                        $s_time = (int) $_POST['s_time'];
                        if (strtotime($today) > strtotime($_POST['s_day']) || (strtotime($today) == strtotime($_POST['s_day']) && $now_time > $s_time)) {
                            $this->message .= "日程に過去の日付が入力されています．<br>";
                        }
                        $longVacationModel = new longVacationModel;
                        if ($longVacationModel->check_during_term($_POST['s_day']) || $longVacationModel->check_during_term($_POST['f_day'])) {
                            $this->message .= "外泊開始日または、終了日が長期休暇期間中です．<br>";
                        }
                    }
                    $gaihaku = $this->form->getValue();
                    if ($gaihaku['dest']['reason'] == 'その他' && empty($gaihaku['riyuu'])) {
                        $this->message .= "外泊理由が『その他』の場合は理由を具体的に入力してください．<br>";
                    }
                    if (empty($this->message)) {
                        //messageがない場合
                        $this->title = '外泊願-確認画面';
                        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                        $gaihaku = $this->form->getValue();
                        if ($gaihaku['dest']['reason'] == '帰省') {
                            $this->value = '帰省';
                        } else if ($gaihaku['dest']['reason'] == 'その他') {
                            $this->value = $gaihaku['riyuu'];
                        }
                        $table = $this->create_kessyoku($_POST["s_day"], $_POST["f_day"], $gaihaku["s_time"], $gaihaku["f_time"]);
                        if ($table != "") {
                            $this->view->assign('table', $table);
                        }
                        $this->title = '外泊願-確認画面';
                        $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                        $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                        $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                        switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                            case "E":
                                $this->view->assign('tou', '東寮');
                                break;
                            case "N":
                                $this->view->assign('tou', '北寮');
                                break;
                            case "S":
                                $this->view->assign('tou', '南寮');
                                break;
                            default:
                        }
                        $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                        $this->next_type = 'gaihaku';
                        $this->next_action = 'complete';
                        $this->form->toggleFrozen(true);
                        $this->s_day = $_POST['s_day'];
                        $this->f_day = $_POST['f_day'];
                        $btn = '提出する';
                        $btn2 = '戻る';
                    } else {
                        //messageがある場合の処理
                        $this->title = '外泊願-作成画面';
                        $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                        $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                        $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                        switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                            case "E":
                                $this->view->assign('tou', '東寮');
                                break;
                            case "N":
                                $this->view->assign('tou', '北寮');
                                break;
                            case "S":
                                $this->view->assign('tou', '南寮');
                                break;
                            default:
                        }
                        $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                        $this->next_type = 'gaihaku';
                        $this->next_action = 'confirm';
                        $this->caution1 = '外泊願テンプレート呼び出し';
                        $btn = '確認画面へ';
                    }
                    $this->s_day = $_POST['s_day'];
                    $this->f_day = $_POST['f_day'];
                } else {
                    if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                        $this->title = '外泊願作成画面';
                        $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                        $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                        $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                        switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                            case "E":
                                $this->view->assign('tou', '東寮');
                                break;

                            case "N":
                                $this->view->assign('tou', '北寮');
                                break;

                            case "S":
                                $this->view->assign('tou', '南寮');
                                break;

                            default:
                        }
                        $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                        $this->next_type = 'gaihaku';
                        $this->next_action = 'confirm';
                        $this->s_day = $_POST['s_day'];
                        $this->f_day = $_POST['f_day'];
                        $btn = '確認画面へ';
                    } else {
                        if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '提出する' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                            $gaihaku = $this->form->getValue();
                            if (!$gaihakuModel->check_outstanding($_SESSION[_MEMBER_AUTHINFO]['id'])) {
                                //if (!$gaihakuModel->check_term($_SESSION[_MEMBER_AUTHINFO]['id'],$_POST['s_day'],$_POST['f_day'])){

                                //$days = $this->meanwhile($_POST['s_day'],$_POST['f_day']);
                                if (substr($_SESSION[_MEMBER_AUTHINFO]['class'], 0, 1) == "I") {
                                    $grade = substr($_SESSION[_MEMBER_AUTHINFO]['class'], 2, 1);
                                } else {
                                    $grade = "1";
                                }
                                $gaihaku['auth'] = $this->check_auth($_POST['s_day'], $gaihaku['s_time'], $_POST['f_day'], $gaihaku['f_time'], $gaihaku['dest']['reason'], $grade); //ここから始める
                                $this->title = '提出完了画面';
                                $gaihaku['class'] = $_SESSION[_MEMBER_AUTHINFO]['class'];
                                $gaihaku['roomnum'] = $_SESSION[_MEMBER_AUTHINFO]['roomnum'];
                                $gaihaku['s_day'] = $_POST['s_day'];
                                $gaihaku['f_day'] = $_POST['f_day'] . " 23:59:59";
                                $gaihaku['riyuu'] = isset($gaihaku['riyuu']) ? $gaihaku['riyuu'] : NULL;
                                $gaihaku['app'] = '未閲覧';
                                //$gaihakuModel->regist_gaihaku($_SESSION[_MEMBER_AUTHINFO]['id'],$gaihaku);
                                $this->message = "外泊願は提出されました．";

                                if (isset($_POST['kessyoku'])) {
                                    if (isset($_POST['auto_delete'])) {
                                        $auto_delete = 1;
                                    } else {
                                        $auto_delete = 0;
                                    }
                                    $kessyokuModel = new kessyokuModel();
                                    $KgroupModel = new KgroupModel();
                                    $group_id = $KgroupModel->registGroup($_SESSION[_MEMBER_AUTHINFO]['id'], $grade, $_POST['k_reason'], $auto_delete);
                                    $group_id = $group_id['group_id'];
                                    $days = $this->meanwhile($_POST['s_day'], $_POST['f_day']);
                                    $sub_days = [];
                                    foreach ($days as $day) {
                                        $checked = $this->check_kessyoku($day);
                                        if (is_array($checked)) {
                                            if ($kessyokuModel->regist_kessyoku($_SESSION[_MEMBER_AUTHINFO]['id'], $group_id, $day, $checked)) {
                                                $this->message .= "<br>{$day}の欠食の申請に成功しました．";
                                                array_push($sub_days, $day);
                                            } else {
                                                $this->message .= "<br>{$day}の欠食は既に申請されています．";
                                            }
                                        } else {
                                            if ($checked == 'time_out') {
                                                $this->message .= "<br>{$day}の欠食は3日後以内であるため申請できません．";
                                            } else if ($checked == 'delete') {
                                                $this->message .= "<br>{$day}の欠食申請は無効な申請となりました．";
                                            }
                                        }
                                    }
                                    if (!empty($sub_days)) {
                                        $this->kessyoku_mail_to_member($sub_days);
                                    }
                                } else {
                                    $this->message .= "<br>欠食届は提出されませんでした．";
                                    $group_id = 0;
                                }
                                $gaihaku['group_id'] = $group_id;
                                $gaihakuModel->regist_gaihaku($_SESSION[_MEMBER_AUTHINFO]['id'], $gaihaku);
                                $this->gaihaku_mail_to_member($gaihaku);
                                $this->gaihaku_mail_to_teacher($gaihaku);
                                unset($_SESSION['rand']);
                                $this->rand = $_SESSION['rand'] = $this->create_rand_string();

                                /*}else{
                                $this->title = "提出不可画面";
                                $this->message = "外泊期間が重なっている外泊願が既に提出されています．";
                                }*/
                            } else {
                                $this->title = "提出不可画面";
                                $this->message = "未処理の外泊願が残っているため、新たな外泊願を提出できません．";
                            }
                            $this->file = "message.tpl";
                        } else {
                            $this->title = '不正アクセス検知';
                            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                            $this->message = '不正なアクセス（リロードなど）を検知しました．';
                            $this->file = "message.tpl";
                        }
                    }
                }
            }
            $this->form->addElement('submit', 'submit', ['value' => $btn]);
            $this->form->addElement('submit', 'submit2', ['value' => $btn2]);
            $this->form->addElement('reset', 'reset', ['value' => '取り消し']);
        }
        $this->view_display();
    }



    //----------------------------------------------------
    // 欠食届 作成/提出(会員側) type=kessyoku
    //----------------------------------------------------
    public function screen_kessyoku($auth = "")
    {

        $btn = "";
        $btn2 = "";
        $btn3 = "";

        if ($this->action == "create") {
            $this->title = "欠食届作成画面";
            $this->next_type = 'kessyoku';
            $this->next_action = 'form';
            $btn3 = "表作成";
            $this->file = "kessyoku.tpl";
        } else {
            if (isset($_POST['submit3']) && $_POST['submit3'] == "表作成") {
                $this->title = "欠食届作成画面";
                $table = $this->create_kessyoku($_POST["s_day"], $_POST["f_day"]);
                if ($table != "") {
                    $this->view->assign('table', $table);
                }
                $this->s_day = $_POST["s_day"];
                $this->f_day = $_POST["f_day"];
                $this->next_type = 'kessyoku';
                $this->next_action = 'complete';
                $btn = "提出";
                $btn3 = "表作成";
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                $this->file = "kessyoku.tpl";
            } else {
                if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == "提出" && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                    $this->title = "欠食届提出完了画面";
                    $this->file = "message.tpl";
                    if (substr($_SESSION[_MEMBER_AUTHINFO]['class'], 0, 1) == "I") {
                        $grade = substr($_SESSION[_MEMBER_AUTHINFO]['class'], 2, 1);
                    } else {
                        $grade = "1";
                    }
                    if (isset($_POST['auto_delete'])) {
                        $auto_delete = 1;
                    } else {
                        $auto_delete = 0;
                    }
                    $kessyokuModel = new kessyokuModel();
                    $KgroupModel = new KgroupModel();
                    $group_id = $KgroupModel->registGroup($_SESSION[_MEMBER_AUTHINFO]['id'], $grade, $_POST['k_reason'], $auto_delete);
                    $group_id = $group_id['group_id'];
                    $days = $this->meanwhile($_POST['hidden_s_day'], $_POST['hidden_f_day']);
                    $sub_days = [];
                    foreach ($days as $day) {
                        $checked = $this->check_kessyoku($day);
                        if (is_array($checked)) {
                            if ($kessyokuModel->regist_kessyoku($_SESSION[_MEMBER_AUTHINFO]['id'], $group_id, $day, $checked)) {
                                unset($_SESSION['rand']);
                                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                                $this->message .= "<br>{$day}の欠食の申請に成功しました．";
                                array_push($sub_days, $day);
                            } else {
                                $this->message .= "<br>{$day}の欠食は既に申請されています．";
                            }
                        } else {
                            if ($checked == 'time_out') {
                                $this->message .= "<br>{$day}の欠食は3日後以内であるため申請できません．";
                            } else if ($checked == 'delete') {
                                $this->message .= "<br>{$day}の欠食申請は無効な申請となりました．";
                            }
                        }
                    }
                    if (!empty($sub_days)) {
                        $this->kessyoku_mail_to_member($sub_days);
                    }
                } else {
                    $this->title = '不正アクセス検知';
                    $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                    $this->message = '不正なアクセス（リロードなど）を検知しました．';
                    $this->file = "message.tpl";
                }
            }

        }

        $this->form->addElement('submit', 'submit', ['value' => $btn, 'onClick' => 'return check2();']);
        $this->form->addElement('submit', 'submit2', ['value' => $btn2]);
        $this->form->addElement('submit', 'submit3', ['value' => $btn3, 'onClick' => 'return check();']);
        $this->form->addElement('reset', 'reset', ['value' => '取り消し']);
        $this->view_display();
        $this->form->addRecursiveFilter('trim');
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
    // 提出した外泊願の履歴表示
    //----------------------------------------------------
    private function screen_gaihaku_log()
    {
        $gaihakuModel = new gaihakuModel();
        $gaihakuModel->delete_old();

        $KgroupModel = new KgroupModel();
        $kessyokuModel = new kessyokuModel();
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

        if ($this->action == "list") {

            $sql_sub_day = $this->rec_post('sub_day');
            $sql_day = $this->rec_post('day');
            $sql_sort_key = $this->rec_post('sort');
            $sql_app = $this->rec_post('app');
            $sql_comment = $this->rec_post('comment');
            $sql_attend = $this->rec_post('attend');

            $gaihakuModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

            list($data, $count) = $gaihakuModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $sql_day, $sql_sort_key, $sql_app, $sql_comment, $sql_attend);
            list($data, $links) = $this->make_page_link_10($data);
            $this->view->assign('count', $count);
            $this->view->assign('data', $data);
            $this->view->assign('links', $links['all']);
            $this->title = '履歴表示【外泊願】';
            $this->file = 'gaihaku_log.tpl';
            $this->next_type = 'log';
            $this->next_action = 'form';
            $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
        } else {
            if (isset($_POST['submit']) && $_POST['submit'] == "実行") {
                $sql_sub_day = $this->rec_post('sub_day');
                $sql_day = $this->rec_post('day');
                $sql_sort_key = $this->rec_post('sort');
                $sql_app = $this->rec_post('app');
                $sql_comment = $this->rec_post('comment');
                $sql_attend = $this->rec_post('attend');

                $gaihakuModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

                list($data, $count) = $gaihakuModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $sql_day, $sql_sort_key, $sql_app, $sql_comment, $sql_attend);
                list($data, $links) = $this->make_page_link_10($data);
                $this->view->assign('count', $count);
                $this->view->assign('data', $data);
                $this->view->assign('links', $links['all']);
                $this->title = '履歴表示【外泊願】';
                $this->file = 'gaihaku_log.tpl';
                $this->next_type = 'log';
                $this->next_action = 'form';
                $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
            } else {
                if ($this->action == "form") {
                    $_SESSION[_GAIHAKU_AUTHINFO] = $gaihakuModel->get_data_gid($_POST['edit']);
                    $gaihakuModel->close($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id']);
                }
                if ($gaihakuModel->check_gid($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id'])) { //外泊願が存在するかどうかを確認する
                    if (time() <= strtotime($gaihakuModel->getStateBygid($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id']))) { //stateが現在時刻の未来か？
                        $KgroupModel = new KgroupModel();
                        $kessyokuModel = new kessyokuModel();
                        $btn = "";
                        $btn2 = "";
                        //一番最初の初期値設定
                        if ($this->action == 'form') {
                            //$_SESSION[_GAIHAKU_AUTHINFO] = $gaihakuModel->get_data_gid($_POST['edit']);
                            $this->form->addDataSource(
                                new HTML_QuickForm2_DataSource_Array(
                                    [
                                        'psCode1' => $_SESSION[_GAIHAKU_AUTHINFO]['psCode1'],
                                        'psCode2' => $_SESSION[_GAIHAKU_AUTHINFO]['psCode2'],
                                        'address' => $_SESSION[_GAIHAKU_AUTHINFO]['address'],
                                        'last_name2' => $_SESSION[_GAIHAKU_AUTHINFO]['last_name2'],
                                        'first_name2' => $_SESSION[_GAIHAKU_AUTHINFO]['first_name2'],
                                        'tel' => $_SESSION[_GAIHAKU_AUTHINFO]['tel'],
                                        's_time' => $_SESSION[_GAIHAKU_AUTHINFO]['s_time'],
                                        'f_time' => $_SESSION[_GAIHAKU_AUTHINFO]['f_time'],
                                        'dest' => $_SESSION[_GAIHAKU_AUTHINFO]['reason'],
                                        'riyuu' => $_SESSION[_GAIHAKU_AUTHINFO]['riyuu'],
                                    ]
                                )
                            );
                            $this->s_day = $_SESSION[_GAIHAKU_AUTHINFO]['s_day'];
                            $this->f_day = $_SESSION[_GAIHAKU_AUTHINFO]['f_day'];
                            $this->reason = $_SESSION[_GAIHAKU_AUTHINFO]['reason'];
                            $this->gaihaku_id = $_POST['edit'];
                        }

                        // フォームの妥当性検証
                        if (!$this->form->validate()) {

                            if ($this->action == 'confirm') {
                                $this->s_day = $_POST['s_day'];
                                $this->f_day = $_POST['f_day'];
                            }
                            $this->action = "form";
                        }

                        $this->make_gaihaku_controle(); //外泊願のフォーム作成

                        if ($this->action == "form") {
                            $this->title = '外泊願-再編集画面';
                            $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                            $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                            $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                            switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                                case "E":
                                    $this->view->assign('tou', '東寮');
                                    break;
                                case "N":
                                    $this->view->assign('tou', '北寮');
                                    break;
                                case "S":
                                    $this->view->assign('tou', '南寮');
                                    break;
                                default:
                            }
                            $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                            $this->file = 'gaihaku.tpl';
                            $this->next_type = 'log';
                            $this->next_action = 'confirm';
                            $btn = '確認画面へ';
                        } else {

                            if ($this->action == "confirm" && isset($_POST['submit']) && $_POST['submit'] == '確認画面へ') {
                                //再編集画面から確認画面を押されたとき
                                $gaihaku = $this->form->getValue();

                                if (empty($_POST['s_day']) || empty($_POST['f_day'])) {
                                    $this->message .= "日程が入力されていません<br>";
                                } else {
                                    if (strtotime($_POST['s_day']) >= strtotime($_POST['f_day'])) {
                                        $this->message .= "日程の順序が正しくありません．<br>";
                                    }
                                    $today = date('Y-m-d');
                                    if (strtotime($today) > strtotime($_POST['s_day']) || strtotime($today) > strtotime($_POST['f_day'])) {
                                        $this->message .= "日程に過去の日付が入力されています．<br>";
                                    }
                                    $longVacationModel = new longVacationModel;
                                    if ($longVacationModel->check_during_term($_POST['s_day']) || $longVacationModel->check_during_term($_POST['f_day'])) {
                                        $this->message .= "外泊開始日または、終了日が長期休暇期間中です．<br>";
                                    }
                                }
                                $gaihaku = $this->form->getValue();
                                if ($gaihaku['dest']['reason'] == 'その他' && empty($gaihaku['riyuu'])) {
                                    $this->message .= "外泊理由が『その他』の場合は理由を具体的に入力してください．<br>";
                                }

                                if (empty($this->message)) {
                                    //入力間違えナシ
                                    $this->title = '外泊願-再編集確認画面';
                                    $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                                    $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                                    $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                                    $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                                    switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                                        case "E":
                                            $this->view->assign('tou', '東寮');
                                            break;

                                        case "N":
                                            $this->view->assign('tou', '北寮');
                                            break;

                                        case "S":
                                            $this->view->assign('tou', '南寮');
                                            break;

                                        default:
                                    }
                                    $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                                    $this->file = 'gaihaku.tpl';
                                    $this->s_day = $_POST['s_day'];
                                    $this->f_day = $_POST['f_day'];
                                    $this->next_type = 'log';
                                    $this->next_action = 'complete';
                                    $this->form->toggleFrozen(true);
                                    $btn = '更新する';
                                    $btn2 = '戻る';

                                    if (isset($_POST['kessyoku'])) {
                                        if ($_SESSION[_GAIHAKU_AUTHINFO]['group_id'] != 0) {
                                            if ($KgroupModel->checkAppByGroup($_SESSION[_GAIHAKU_AUTHINFO]['group_id'])) {
                                                $_SESSION[_KESSYOKU_AUTHINFO] = $KgroupModel->get_data_group_id($_SESSION[_GAIHAKU_AUTHINFO]['group_id']);
                                                $KgroupModel->close($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                                                $this->value = $_SESSION[_KESSYOKU_AUTHINFO]['reason'];
                                                $data = $kessyokuModel->getKessyokuByGroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                                                $table = $this->create_modify_kessyoku($data);
                                                $this->view->assign('table', $table);
                                                if ($_SESSION[_KESSYOKU_AUTHINFO]['auto_delete'] == 1) {
                                                    $this->view->assign('checked', 'checked');
                                                } else {
                                                    $this->view->assign('checked', '');
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    //入力間違えアリ
                                    $this->title = '外泊願-再編集確認画面';
                                    $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                                    $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                                    $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                                    switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                                        case "E":
                                            $this->view->assign('tou', '東寮');
                                            break;
                                        case "N":
                                            $this->view->assign('tou', '北寮');
                                            break;
                                        case "S":
                                            $this->view->assign('tou', '南寮');
                                            break;
                                        default:
                                    }
                                    $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                                    $this->file = 'gaihaku.tpl';
                                    $this->s_day = $_POST['s_day'];
                                    $this->f_day = $_POST['f_day'];
                                    $this->next_type = 'log';
                                    $this->next_action = 'confirm';
                                    $btn = '確認画面へ';
                                    $btn2 = '戻る';
                                }
                                $gaihakuModel->close($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id']);
                            } else {
                                if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                                    $this->title = '外泊願-再編集画面';
                                    $this->view->assign('last_name', $_SESSION[_MEMBER_AUTHINFO]['last_name']);
                                    $this->view->assign('first_name', $_SESSION[_MEMBER_AUTHINFO]['first_name']);
                                    $this->view->assign('class', $_SESSION[_MEMBER_AUTHINFO]['class']);
                                    switch (substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 0, 1)) {
                                        case "E":
                                            $this->view->assign('tou', '東寮');
                                            break;

                                        case "N":
                                            $this->view->assign('tou', '北寮');
                                            break;

                                        case "S":
                                            $this->view->assign('tou', '南寮');
                                            break;

                                        default:
                                    }
                                    $this->view->assign('roomnum', substr($_SESSION[_MEMBER_AUTHINFO]['roomnum'], 1, 4));
                                    $this->file = 'gaihaku.tpl';
                                    $this->s_day = $_POST['s_day'];
                                    $this->f_day = $_POST['f_day'];
                                    $this->next_type = 'log';
                                    $this->next_action = 'confirm';
                                    $btn = '確認画面へ';
                                    $gaihakuModel->close($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id']);
                                } else {
                                    if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '更新する' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                                        $gaihaku = $this->form->getValue();
                                        if (!$gaihakuModel->check_other_term($_SESSION[_MEMBER_AUTHINFO]['id'], $_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id'], $_POST['s_day'], $_POST['f_day'])) {
                                            $this->title = '更新完了画面';
                                            $gaihaku['class'] = $_SESSION[_MEMBER_AUTHINFO]['class'];
                                            $gaihaku['roomnum'] = $_SESSION[_MEMBER_AUTHINFO]['roomnum'];
                                            $gaihaku['s_day'] = $_POST['s_day'];
                                            $gaihaku['f_day'] = $_POST['f_day'] . " 23:59:59";
                                            $gaihaku['ryoukan'] = NULL;
                                            $gaihaku['teacher'] = NULL;
                                            $gaihaku['app_date'] = NULL;
                                            $gaihaku['app'] = "未閲覧";
                                            if (!isset($gaihaku['riyuu'])) {
                                                $gaihaku['riyuu'] = NULL;
                                            }
                                            $gaihaku['reason'] = $gaihaku['dest']['reason'];
                                            $gaihaku['comment'] = NULL;
                                            $gaihakuModel->modifyBygaihaku_id($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id'], $gaihaku);
                                            $this->change_gaihaku_mail_to_member($gaihaku);
                                            unset($_SESSION['rand']);
                                            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                                            $this->message = "外泊願は更新されました";

                                            if (isset($_POST['kessyoku'])) {
                                                if ($KgroupModel->check($_SESSION[_KESSYOKU_AUTHINFO]['group_id'])) { //欠食グループが存在するかを確かめる
                                                    if (time() <= strtotime($KgroupModel->getStateByGroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id']))) { //stateが現在時刻の未来か？
                                                        if (empty($_POST['all_delete'])) {
                                                            if (isset($_POST['auto_delete'])) {
                                                                $auto_delete = 1;
                                                            } else {
                                                                $auto_delete = 0;
                                                            }
                                                            $KgroupModel->modify_Kgroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id'], $_POST['k_reason'], $auto_delete);
                                                            $sub_days = [];
                                                            foreach ($_POST['id'] as $kessyoku_id) {
                                                                $day = substr($kessyokuModel->getDateBykessyoku_id($kessyoku_id), 0, 10);
                                                                $checked = $this->check_kessyoku($day);
                                                                if (is_array($checked)) {
                                                                    if ($kessyokuModel->check_kid($kessyoku_id)) {
                                                                        $kessyokuModel->modify_kessyoku($kessyoku_id, $checked);
                                                                        $this->message .= "<br>{$day}の欠食申請は更新されました．";
                                                                        array_push($sub_days, $day);
                                                                    } else {
                                                                        $this->message .= "<br>{$day}の欠食申請は削除されました．";
                                                                    }
                                                                } else {
                                                                    if ($checked == 'time_out') {
                                                                        $this->message .= "<br>{$day}の欠食申請の更新は期限切れです．";
                                                                    } else if ($checked == 'delete') {
                                                                        $kessyokuModel->deleteKessyokuByKessyoku_id($kessyoku_id);
                                                                        $this->message .= "<br>{$day}の欠食申請は削除されました．";
                                                                    }
                                                                }
                                                            }
                                                            if (!empty($sub_days)) {
                                                                $this->change_kessyoku_mail_to_member($sub_days);
                                                            }
                                                        } else {
                                                            $kessyokuModel->deleteKessyokuByGroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id'], $three_days_ago);
                                                            if (!$kessyokuModel->checkGroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id'])) {
                                                                $KgroupModel->delete_group($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                                                                $this->message .= "<br>欠食届全体を削除しました．";
                                                            } else {
                                                                $this->message .= "<br>欠食届の一部の欠食申請を削除しました．";
                                                            }
                                                        }
                                                    } else {
                                                        $this->message .= "<br>欠食届の編集は期限切れです．";
                                                    }
                                                } else {
                                                    $this->message .= "<br>欠食届は削除されました．";
                                                }

                                            }
                                            $gaihakuModel->open($_SESSION[_GAIHAKU_AUTHINFO]['gaihaku_id']);
                                            unset($_SESSION[_GAIHAKU_AUTHINFO]);
                                            $KgroupModel->open($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                                            unset($_SESSION[_KESSYOKU_AUTHINFO]);
                                        } else {
                                            $this->title = "提出不可画面";
                                            $this->message = "外泊期間が重なっている外泊願が既に提出されています．";
                                        }
                                        $this->file = "message.tpl";
                                    } else {
                                        $this->title = '不正アクセス検知';
                                        $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                                        $this->message = '不正なアクセス（リロードなど）を検知しました．';
                                        $this->file = "message.tpl";
                                    }
                                }
                            }
                        }

                        $this->form->addElement('submit', 'submit', ['value' => $btn]);
                        $this->form->addElement('submit', 'submit2', ['value' => $btn2]);
                        $this->form->addElement('reset', 'reset', ['value' => '取り消し']);
                    } else {
                        $gaihakuModel->all_open($_SESSION[_MEMBER_AUget_logTHINFO]['id']);

                        $sql_sub_day = $this->rec_post('sub_day');
                        $sql_day = $this->rec_post('day');
                        $sql_sort_key = $this->rec_post('sort');
                        $sql_app = $this->rec_post('app');
                        $sql_comment = $this->rec_post('comment');
                        $sql_attend = $this->rec_post('attend');

                        $gaihakuModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

                        list($data, $count) = $gaihakuModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $sql_day, $sql_sort_key, $sql_app, $sql_comment, $sql_attend);
                        list($data, $links) = $this->make_page_link_10($data);
                        $this->view->assign('count', $count);
                        $this->view->assign('data', $data);
                        $this->view->assign('links', $links['all']);
                        $this->title = '履歴表示【外泊願】';
                        $this->caution1 = 'タイムアウトです。';
                        $this->file = 'gaihaku_log.tpl';
                        $this->next_type = 'log';
                        $this->next_action = 'form';
                        $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
                    }
                } else {
                    $sql_sub_day = $this->rec_post('sub_day');
                    $sql_day = $this->rec_post('day');
                    $sql_sort_key = $this->rec_post('sort');
                    $sql_app = $this->rec_post('app');
                    $sql_comment = $this->rec_post('comment');
                    $sql_attend = $this->rec_post('attend');

                    $gaihakuModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

                    list($data, $count) = $gaihakuModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $sql_day, $sql_sort_key, $sql_app, $sql_comment, $sql_attend);
                    list($data, $links) = $this->make_page_link_10($data);
                    $this->view->assign('count', $count);
                    $this->view->assign('data', $data);
                    $this->view->assign('links', $links['all']);
                    $this->title = '履歴表示【外泊願】';
                    $this->caution1 = '外泊願は削除されました。';
                    $this->file = 'gaihaku_log.tpl';
                    $this->next_type = 'log';
                    $this->next_action = 'form';
                    $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
                }
            }
        }
        $this->view_display();
    }


    //----------------------------------------------------
    // 提出した欠食届の履歴表示 type=kessyoku_log
    //----------------------------------------------------
    private function screen_kessyoku_log()
    {
        $KgroupModel = new KgroupModel();
        $kessyokuModel = new kessyokuModel();
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
        if ($this->action == "list") {
            $sql_sub_day = $this->rec_post('sub_day');
            $sql_day = $this->rec_post('day');
            $sql_sort_key = $this->rec_post('sort');
            $sql_grade = $this->rec_post('grade');
            $sql_app = $this->rec_post('app');
            $sql_reason = $this->rec_post('reason');
            $sql_comment = $this->rec_post('comment');

            $KgroupModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

            if ($sql_day != "") {
                $group_id = $kessyokuModel->same_date($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_day);
            } else {
                $group_id = "";
            }

            list($groups, $count) = $KgroupModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $group_id, $sql_sort_key, $sql_grade, $sql_app, $sql_reason, $sql_comment);
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
            $this->title = '履歴表示【欠食届】';
            $this->file = 'kessyoku_log.tpl';
            $this->next_type = 'kessyoku_log';
            $this->next_action = 'form';
            $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
        } else {
            if (isset($_POST['submit']) && $_POST['submit'] == "実行") {
                $sql_sub_day = $this->rec_post('sub_day');
                $sql_day = $this->rec_post('day');
                $sql_sort_key = $this->rec_post('sort');
                $sql_grade = $this->rec_post('grade');
                $sql_app = $this->rec_post('app');
                $sql_reason = $this->rec_post('reason');
                $sql_comment = $this->rec_post('comment');

                $KgroupModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

                if ($sql_day != "") {
                    $group_id = $kessyokuModel->same_date($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_day);
                } else {
                    $group_id = "";
                }

                list($groups, $count) = $KgroupModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $group_id, $sql_sort_key, $sql_grade, $sql_app, $sql_reason, $sql_comment);
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
                $this->title = '履歴表示【欠食届】';
                $this->file = 'kessyoku_log.tpl';
                $this->next_type = 'kessyoku_log';
                $this->next_action = 'form';
                $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
            } else {
                if ($this->action == "form") {
                    $_SESSION[_KESSYOKU_AUTHINFO] = $KgroupModel->get_data_group_id($_POST['edit']);
                    $KgroupModel->close($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                }
                if ($KgroupModel->check($_SESSION[_KESSYOKU_AUTHINFO]['group_id'])) { //欠食グループが存在するかを確かめる
                    if (time() <= strtotime($KgroupModel->getStateByGroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id']))) { //stateが現在時刻の未来か？
                        $btn = "";
                        $btn2 = "";
                        $btn3 = "";
                        //一番最初の初期値設定
                        if ($this->action == 'form') {
                            $data = $kessyokuModel->getKessyokuByGroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                            $table = $this->create_modify_kessyoku($data);
                            $KgroupModel->close($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                            $this->title = "欠食届編集画面";
                            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                            $this->view->assign('reason', $_SESSION[_KESSYOKU_AUTHINFO]['reason']);
                            $this->view->assign('table', $table);
                            if ($_SESSION[_KESSYOKU_AUTHINFO]['auto_delete'] == 1) {
                                $this->view->assign('checked', 'checked');
                            } else {
                                $this->view->assign('checked', '');
                            }
                            $this->next_type = 'kessyoku_log';
                            $this->next_action = 'complete';
                            $btn = "更新する";
                            $this->file = "kessyoku.tpl";
                        } else {
                            if ($this->action == 'complete' && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                                $this->title = '更新完了画面';
                                $this->message = "";
                                if (isset($_POST['auto_delete'])) {
                                    $auto_delete = 1;
                                } else {
                                    $auto_delete = 0;
                                }
                                $KgroupModel->modify_Kgroup($_SESSION[_KESSYOKU_AUTHINFO]['group_id'], $_POST['k_reason'], $auto_delete);
                                unset($_SESSION['rand']);
                                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                                $sub_days = [];
                                foreach ($_POST['id'] as $kessyoku_id) {
                                    $day = substr($kessyokuModel->getDateBykessyoku_id($kessyoku_id), 0, 10);
                                    $checked = $this->check_kessyoku($day);
                                    if (is_array($checked)) {
                                        if ($kessyokuModel->check_kid($kessyoku_id)) {
                                            $kessyokuModel->modify_kessyoku($kessyoku_id, $checked);
                                            $this->message .= "<br>{$day}の欠食申請は更新されました．";
                                            array_push($sub_days, $day);
                                        } else {
                                            $this->message .= "<br>{$day}の欠食申請は削除されました．";
                                        }
                                    } else {
                                        if ($checked == 'time_out') {
                                            $this->message .= "<br>{$day}の欠食申請の更新は期限切れです．";
                                        } else if ($checked == 'delete') {
                                            $kessyokuModel->deleteKessyokuByKessyoku_id($kessyoku_id);
                                            $this->message .= "<br>{$day}の欠食申請は削除されました．";
                                        }
                                    }
                                }
                                if (!empty($sub_days)) {
                                    $this->change_kessyoku_mail_to_member($sub_days);
                                }
                                $KgroupModel->open($_SESSION[_KESSYOKU_AUTHINFO]['group_id']);
                                unset($_SESSION[_KESSYOKU_AUTHINFO]);
                                $this->file = 'message.tpl';
                            } else {
                                $this->title = '不正アクセス検知';
                                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                                $this->message = '不正なアクセス（リロードなど）を検知しました．';
                                $this->file = "message.tpl";
                            }
                        }
                    } else {
                        $sql_sub_day = $this->rec_post('sub_day');
                        $sql_day = $this->rec_post('day');
                        $sql_sort_key = $this->rec_post('sort');
                        $sql_grade = $this->rec_post('grade');
                        $sql_app = $this->rec_post('app');
                        $sql_reason = $this->rec_post('reason');
                        $sql_comment = $this->rec_post('comment');

                        $KgroupModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

                        if ($sql_day != "") {
                            $group_id = $kessyokuModel->same_date($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_day);
                        } else {
                            $group_id = "";
                        }

                        list($groups, $count) = $KgroupModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $group_id, $sql_sort_key, $sql_grade, $sql_app, $sql_reason, $sql_comment);
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
                        $this->title = '履歴表示【欠食届】';
                        $this->caution1 = 'タイムアウトです。';
                        $this->file = 'kessyoku_log.tpl';
                        $this->next_type = 'kessyoku_log';
                        $this->next_action = 'form';
                        $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
                    }
                } else {
                    $sql_sub_day = $this->rec_post('sub_day');
                    $sql_day = $this->rec_post('day');
                    $sql_sort_key = $this->rec_post('sort');
                    $sql_grade = $this->rec_post('grade');
                    $sql_app = $this->rec_post('app');
                    $sql_reason = $this->rec_post('reason');
                    $sql_comment = $this->rec_post('comment');

                    $KgroupModel->all_open($_SESSION[_MEMBER_AUTHINFO]['id']);

                    if ($sql_day != "") {
                        $group_id = $kessyokuModel->same_date($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_day);
                    } else {
                        $group_id = "";
                    }

                    list($groups, $count) = $KgroupModel->get_log($_SESSION[_MEMBER_AUTHINFO]['id'], $sql_sub_day, $group_id, $sql_sort_key, $sql_grade, $sql_app, $sql_reason, $sql_comment);
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
                    $this->title = '履歴表示【欠食届】';
                    $this->caution1 = '欠食届は削除されました。';
                    $this->file = 'kessyoku_log.tpl';
                    $this->next_type = 'kessyoku_log';
                    $this->next_action = 'form';
                    $this->form->addElement('submit', 'submit', ['value' => "実行", 'id' => 'exe']);
                }
                $this->form->addElement('submit', 'submit', ['value' => $btn, 'onClick' => 'return check2();']);
                $this->form->addElement('submit', 'submit2', ['value' => $btn2]);
                $this->form->addElement('submit', 'submit3', ['value' => $btn3, 'onClick' => 'return check();']);
                $this->form->addElement('reset', 'reset', ['value' => '取り消し']);
            }
        }
        $this->view_display();
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
                    $MemberModel = new MemberModel();
                    $userdata = $MemberModel->get_member_data_id($_SESSION[_MEMBER_AUTHINFO]['id']); //前のユーザのデータ
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
                        $MemberModel->modify_member($userdata);
                        $this->screen_top();
                    }
                }
            }
        }
    }

    //----------------------------------------------------
    // 削除画面
    //----------------------------------------------------
    public function screen_delete()
    {
        $MemberModel = new MemberModel();
        if ($this->action == "confirm") {
            if ($this->is_system) {
                $_SESSION[_MEMBER_AUTHINFO] = $MemberModel->get_member_data_id($_GET['id']);
                $this->message = "[削除する]をクリックすると　";
                $this->message .= htmlspecialchars($_SESSION[_MEMBER_AUTHINFO]['last_name'], ENT_QUOTES);
                $this->message .= htmlspecialchars($_SESSION[_MEMBER_AUTHINFO]['first_name'], ENT_QUOTES);
                $this->message .= "さん　の寮生アカウントを削除します。";
            } else {
                $this->message = "[削除する]をクリックするとあなたの寮生アカウントを削除して退会します。";
            }
            $this->form->addElement('submit', 'submit', ['value' => '削除する']);
            $this->title = '寮生アカウント削除確認画面';
            $this->rand = $_SESSION['rand'] = $this->create_rand_string();
            $this->next_type = 'delete';
            $this->next_action = 'complete';
            $this->file = 'delete_form.tpl';
        } else {
            if ($this->action == "complete" && isset($_POST['rand']) && $_SESSION['rand'] == $_POST['rand']) {
                // データベースを操作します。
                $gaihakuModel = new gaihakuModel();
                $tplModel = new tplModel();
                $KgroupModel = new KgroupModel();
                $TenkoModel = new TenkoModel;
                $AbsenteeModel = new AbsenteeModel;

                $gaihakuModel->all_delete_member_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                $tplModel->all_delete_member_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                $KgroupModel->all_delete_member_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                $TenkoModel->all_delete_member_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                $AbsenteeModel->all_delete_member_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                $MemberModel->delete_member($_SESSION[_MEMBER_AUTHINFO]['id']);

                unset($_SESSION['rand']);
                $this->rand = $_SESSION['rand'] = $this->create_rand_string();
                if ($this->is_system) {
                    unset($_SESSION[_MEMBER_AUTHINFO]);
                } else {
                    $this->auth->logout();
                }
                $this->message = "寮生アカウントを削除しました。";
                $this->title = '寮生アカウント削除完了画面';
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
    //----------------------------------------------------
    // 仮登録者へメール送信
    //----------------------------------------------------
    private function mail_to_premember($userdata)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $userdata['username'] . '@sendai-nct.jp';
        $subject = "【松韻寮】会員登録の確認";
        $reg_date = date('Y-m-d H:i:s');
        $message = <<<EOM
        {$userdata['last_name']} {$userdata['first_name']}　様

        寮生アカウントの仮登録ありがとうございます。
        下のリンクにアクセスして本登録を完了してください。(24時間以内に本登録を完了されないと仮登録は無効化されます)
        なお、このリンクは矢島研究室のLAN内でないと、有効ではありません。

        http://{$_SERVER['SERVER_NAME']}{$path}/premember.php?username={$userdata['username']}&link_pass={$userdata['link_pass']}


        このメールに覚えがない場合はメールを削除してください。

        -----------------------------------------------------------------------------------------------
        登録日時：{$reg_date}
        メールアドレス：{$userdata['username']}@sendai-nct.jp
        氏：{$userdata['last_name']}
        名：{$userdata['first_name']}
        氏(ふりがな)：{$userdata['h_last_name']}
        名(ふりがな)：{$userdata['h_first_name']}
        学年／クラス：{$userdata['class']}
        誕生日：{$userdata['birthday']}

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
    // 外泊願提出時、寮生へのメール
    //------------------------------------------------
    private function gaihaku_mail_to_member($gaihaku)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $_SESSION[_MEMBER_AUTHINFO]['username'] . '@sendai-nct.jp';
        $subject = "【松韻寮】外泊願提出の確認";
        $reg_date = date('Y-m-d H:i:s');
        $s_day = substr($gaihaku['s_day'], 0, 10);
        $f_day = substr($gaihaku['f_day'], 0, 10);
        $message = <<<EOM
        {$_SESSION[_MEMBER_AUTHINFO]['last_name']} {$_SESSION[_MEMBER_AUTHINFO]['first_name']}　様

        外泊願が提出されました。
        教員アカウントに処理されるまで、少々お待ちください。
        詳細は下のURLにアクセスし、確認してください。

        http://{$_SERVER['SERVER_NAME']}{$path}/index.php?type=log&action=list


        このメールに覚えがない場合はメールを削除してください。

        -----------------------------------------------------------------------------------------------
        提出日時：{$reg_date}
        日程：{$s_day} {$gaihaku['s_time']}時　～　{$f_day} {$gaihaku['f_time']}時

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
    // 外泊願編集時、寮生へのメール
    //------------------------------------------------
    private function change_gaihaku_mail_to_member($gaihaku)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $_SESSION[_MEMBER_AUTHINFO]['username'] . '@sendai-nct.jp';
        $subject = "【松韻寮】外泊願更新の確認";
        $reg_date = date('Y-m-d H:i:s');
        $s_day = substr($gaihaku['s_day'], 0, 10);
        $f_day = substr($gaihaku['f_day'], 0, 10);
        $message = <<<EOM
        {$_SESSION[_MEMBER_AUTHINFO]['last_name']} {$_SESSION[_MEMBER_AUTHINFO]['first_name']}　様

        外泊願が更新されました。
        教員アカウントに処理されるまで、少々お待ちください。
        詳細は下のURLにアクセスし、確認してください。

        http://{$_SERVER['SERVER_NAME']}{$path}/index.php?type=log&action=list


        このメールに覚えがない場合はメールを削除してください。

        -----------------------------------------------------------------------------------------------
        編集日時：{$reg_date}
        日程：{$s_day} {$gaihaku['s_time']}時　～　{$f_day} {$gaihaku['f_time']}時

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
    // 外泊願提出時、クラス担任へのメール
    //------------------------------------------------
    private function gaihaku_mail_to_teacher($gaihaku)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $TeacherModel = new TeacherModel;
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

    //-------------------------------------------------
    // 欠食届提出時、寮生へのメール
    //------------------------------------------------
    private function kessyoku_mail_to_member($sub_days)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $_SESSION[_MEMBER_AUTHINFO]['username'] . '@sendai-nct.jp';
        $subject = "【松韻寮】欠食届提出の確認";
        $reg_date = date('Y-m-d H:i:s');
        $message = <<<EOM
        {$_SESSION[_MEMBER_AUTHINFO]['last_name']} {$_SESSION[_MEMBER_AUTHINFO]['first_name']}　様

        欠食届が提出されました。
        事務室アカウントに処理されるまで、少々お待ちください。
        詳細は下のURLにアクセスし、確認してください。

        http://{$_SERVER['SERVER_NAME']}{$path}/index.php?type=kessyoku_log&action=list


        このメールに覚えがない場合はメールを削除してください。

        ----------------------------------------------------------------------------------------------------------
        提出日時：{$reg_date}
        欠食日-------------------------------------------------------------------------

        EOM;

        foreach ($sub_days as $day) {
            $message .= <<<EOM
            {$day}, 
            EOM;
        }

        $message .= <<<EOM
        --------------------------------------------------------------------------------

        -----------------------------------------------------------------------------------------------------------

        ---------------------------------------
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
    // 欠食届編集時、寮生へのメール
    //------------------------------------------------
    private function change_kessyoku_mail_to_member($sub_days)
    {

        $path = pathinfo(_SCRIPT_NAME)['dirname'];

        $to = $_SESSION[_MEMBER_AUTHINFO]['username'] . '@sendai-nct.jp';
        $subject = "【松韻寮】欠食届編集の確認";
        $reg_date = date('Y-m-d H:i:s');
        $message = <<<EOM
        {$_SESSION[_MEMBER_AUTHINFO]['last_name']} {$_SESSION[_MEMBER_AUTHINFO]['first_name']}　様

        欠食届が編集されました。
        事務室アカウントに処理されるまで、少々お待ちください。
        詳細は下のURLにアクセスし、確認してください。

        http://{$_SERVER['SERVER_NAME']}{$path}/index.php?type=kessyoku_log&action=list


        このメールに覚えがない場合はメールを削除してください。

        -------------------------------------------------------------------------------------------------------------------------
        編集日時：{$reg_date}
        欠食日----------------------------------------------------------------------------------------------------------

        EOM;

        foreach ($sub_days as $day) {
            $message .= <<<EOM
            {$day}, 
            EOM;
        }

        $message .= <<<EOM

        --------------------------------------------------------------------------------

        -----------------------------------------------------------------------------------------------------------

        ---------------------------------------
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

}