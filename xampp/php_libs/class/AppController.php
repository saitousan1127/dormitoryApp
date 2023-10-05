<?php
/**
 * Description of PrememberController
 *
 * @author nagatayorinobu
 */
class AppController extends BaseController
{
    public function run()
    {

        //var_dump($_POST['type']);
        switch ($_POST['type']) {
            case 'kessyoku':
                //$this->auth = new Auth();
                //$this->auth->set_authname(_SYSTEM_AUTHINFO);
                //$this->auth->set_sessname(_SYSTEM_SESSNAME);
                //$this->auth->start();
                $this->app_kessyoku($_POST['group_id'], $_POST['app'], $_POST['comment']);
                break;
            case 'gaihaku':
                $this->auth = new Auth();
                $this->auth->set_authname(_TEACHER_AUTHINFO);
                $this->auth->set_sessname(_TEACHER_SESSNAME);
                $this->auth->start();
                $this->app_gaihaku($_POST['gaihaku_id'], $_POST['app'], $_POST['comment'], $_POST['state']);
                break;
            case 'tenko':
                $this->attend_tenko($_POST['id']);
                break;
            case 'send_tenko_mail':
                $this->send_tenko_mail();
                break;
            default:
        }
    }


    private function app_gaihaku($gaihaku_id, $app, $comment, $state)
    {
        $gaihakuModel = new gaihakuModel();
        $gaihaku = $gaihakuModel->get_data_gid($gaihaku_id);

        if ($state === '寮監') {
            $gaihaku['ryoukan'] = $_SESSION[_TEACHER_AUTHINFO]['last_name'] . ' ' . $_SESSION[_TEACHER_AUTHINFO]['first_name'];
        } else {
            $gaihaku['teacher'] = $_SESSION[_TEACHER_AUTHINFO]['last_name'] . ' ' . $_SESSION[_TEACHER_AUTHINFO]['first_name'];
        }
        $gaihaku['app'] = $app;
        $gaihaku['comment'] = $comment;
        $gaihaku['app_date'] = date("Y/m/d H:i:s");
        $gaihakuModel->modifyBygaihaku_id($gaihaku_id, $gaihaku);
        $this->app_gaihaku_mail_to_member($gaihaku);
    }

    private function app_kessyoku($group_id, $app, $comment)
    {
        $KgroupModel = new KgroupModel();
        $kessyoku = $KgroupModel->get_data_group_id($group_id);
        $kessyoku['app'] = $app;
        $kessyoku['comment'] = $comment;
        $kessyoku['app_date'] = date("Y/m/d H:i:s");

        $KgroupModel->modifyByGroup_id($group_id, $kessyoku);
        $this->app_kessyoku_mail_to_member($kessyoku);
    }

    private function attend_tenko($id)
    {
        $TenkoModel = new TenkoModel();
        $TenkoModel->regist_tenko($id);
    }

    private function send_tenko_mail()
    {
        $MemberModel = new MemberModel();
        $gaihakuModel = new gaihakuModel();
        $TenkoModel = new TenkoModel();
        $ids = $MemberModel->get_all_id();
        foreach ($ids as $key => $value) {
            if (!$TenkoModel->check_todays($value['id'])) { //今日の点呼に出席していなかったらTRUE
                if (!$gaihakuModel->check_todays($value['id'])) { //今日の外泊願が提出されていなかったらTRUE
                    $userdata = $MemberModel->get_member_data_id($value['id']);
                    $this->tenko_mail_to_member($userdata);
                }
            }
            $i++;
        }

    }

    //-------------------------------------------------
    // 外泊願処理時に寮生にメールを送る
    //------------------------------------------------
    private function app_gaihaku_mail_to_member($gaihaku)
    {
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
        ”{$gaihaku['app']}”となりました。
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

    //-------------------------------------------------
    // 欠食届処理時に寮生にメールを送る
    //------------------------------------------------
    private function app_kessyoku_mail_to_member($kessyoku)
    {
        $to = $kessyoku['username'] . '@sendai-nct.jp';
        $subject = "【松韻寮】提出した欠食届が" . $kessyoku['app'] . "されました";
        $app_date = date('Y-m-d H:i:s');
        $message = <<<EOM
        {$kessyoku['last_name']} {$kessyoku['first_name']}　様

        提出した欠食届が事務室アカウントによって
        ”{$kessyoku['app']}”されました。
        詳細は下のURLにアクセスし、確認してください。

        http://{$_SERVER['SERVER_NAME']}/member/index.php?type=log&action=list


        このメールに覚えがない場合はメールを削除してください。

        -----------------------------------------------------------------------------------------------
        処理日時：{$app_date}
        コメント：{$kessyoku['comment']}

        ----------------------------------
        松韻寮 外泊願・欠食届処理システム
        EOM;
        $add_header = "";

        //$add_header .= "From: s1801063@sendai-nct.jp\n";

        //mb_send_mail($to, $subject, $message, $add_header);
        mail($to, $subject, $message);

    }

    //-------------------------------------------------
    // 点呼欠席者にメールを送る
    //------------------------------------------------
    private function tenko_mail_to_member($userdata)
    {
        $to = $userdata['username'] . '@sendai-nct.jp';
        $subject = "【松韻寮】あなたの点呼が情報が送られてきていません";
        $app_date = date('Y-m-d H:i:s');
        $message = <<<EOM
        {$userdata['last_name']} {$userdata['first_name']}　様

        本日({date('Y-m-d')})の点呼が完了しておりません。
        至急、寮監室まで来てください。

        このメールに覚えがない場合はメールを削除してください。

        ----------------------------------
        松韻寮 外泊願・欠食届処理システム
        EOM;
        $add_header = "";

        mail($to, $subject, $message);

    }

}