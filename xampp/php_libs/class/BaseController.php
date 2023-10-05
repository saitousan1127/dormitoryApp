<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author nagatayorinobu
 */
class BaseController
{
    protected $type;
    protected $action;
    protected $next_type;
    protected $next_action;
    protected $i;
    protected $s_day;
    protected $f_day;
    protected $file;
    protected $form;
    protected $renderer;
    protected $auth;
    protected $is_system = false;
    protected $is_ryoukan = false;
    protected $view;
    protected $title;
    protected $caution1;
    protected $message;
    protected $message2;
    protected $link;
    protected $link2;
    protected $auth_error_mess;
    protected $login_state;
    protected $gaihaku;
    protected $reason;
    protected $s_time;
    protected $f_time;
    protected $value;
    protected $state;
    protected $rand;
    protected $class;
    protected $gaihaku_id;
    private $debug_str;

    public function __construct($flag = false)
    {
        $this->set_system($flag);
        $this->set_ryoukan($flag);
        // VIEWの準備
        $this->view_initialize();
    }


    public function set_system($flag)
    {
        $this->is_system = $flag;
    }

    public function set_ryoukan($flag)
    {
        $this->is_ryoukan = $flag;
    }

    private function view_initialize()
    {
        // 画面表示クラス
        $this->view = new Smarty();
        // Smarty関連ディレクトリの設定
        $this->view->template_dir = _SMARTY_TEMPLATES_DIR;
        $this->view->compile_dir = _SMARTY_TEMPLATES_C_DIR;
        $this->view->config_dir = _SMARTY_CONFIG_DIR;
        $this->view->cache_dir = _SMARTY_CACHE_DIR;

        // 入力チェック用クラス
        $this->form = new HTML_QuickForm2('Form');
        HTML_QuickForm2_Renderer::register('smarty', 'HTML_QuickForm2_Renderer_Smarty');
        $this->renderer = HTML_QuickForm2_Renderer::factory('smarty');
        $this->renderer->setOption('old_compat', true);
        $this->renderer->setOption('group_errors', false);

        // リクエスト変数 typeとactionで動作を決めます。
        if (isset($_REQUEST['type'])) {
            $this->type = $_REQUEST['type'];
        }
        if (isset($_REQUEST['action'])) {
            $this->action = $_REQUEST['action'];
        }
        if (isset($_REQUEST['i'])) {
            $this->i = $_REQUEST['i'];
        }
        if (isset($_REQUEST['s_time'])) {
            $this->s_time = $_REQUEST['s_time'];
        }
        if (isset($_REQUEST['f_time'])) {
            $this->f_time = $_REQUEST['f_time'];
        }
        // 共通の変数
        $this->view->assign('is_system', $this->is_system);
        $this->view->assign('SCRIPT_NAME', _SCRIPT_NAME);
        $this->view->assign('add_pageID', $this->add_pageID());
    }

    //----------------------------------------------------
    // フォームと変数を読み込んでテンプレートに組み込んで表示します。
    //----------------------------------------------------
    protected function view_display()
    {
        // セッション変数などの内容の表示
        $this->debug_display();

        // ログイン状況の表示
        $this->disp_login_state();

        $this->view->assign('title', $this->title);
        $this->view->assign('caution1', $this->caution1);
        $this->view->assign('i', $this->i);
        $this->view->assign('auth_error_mess', $this->auth_error_mess);
        $this->view->assign('message', $this->message);
        $this->view->assign('message2', $this->message2);
        $this->view->assign('disp_login_state', $this->login_state);
        $this->view->assign('type', $this->next_type);
        $this->view->assign('action', $this->next_action);
        $this->view->assign('s_day', $this->s_day);
        $this->view->assign('f_day', $this->f_day);
        $this->view->assign('link', $this->link);
        $this->view->assign('link2', $this->link2);
        $this->view->assign('value', $this->value);
        $this->view->assign('rand', $this->rand);
        $this->view->assign('state', $this->state);
        $this->view->assign('gaihaku_id', $this->gaihaku_id);
        $this->view->assign('debug_str', $this->debug_str);

        $this->view->assign('gaihaku', $this->gaihaku);
        $this->view->assign('form', $this->form->render($this->renderer)->toArray());
        $this->view->display($this->file);

        // デバッグ用
        //echo "<b>toArray()</b><pre>";var_dump($this->renderer->toArray());echo "</pre>";
        //print "<hr>";
        //echo "<b>form</b><pre>";var_dump($this->form);echo "</pre>";
    }

    //----------------------------------------------------
    // ログイン中の表示
    //----------------------------------------------------
    private function disp_login_state()
    {
        if (is_object($this->auth) && $this->auth->check()) {
            $this->login_state = "ログイン中";
        }
    }


    //----------------------------------------------------
    // ランダムな文字列を生成
    //----------------------------------------------------
    public function create_rand_string()
    {
        $str = chr(mt_rand(97, 122));
        for ($i = 0; $i < 10; $i++) {
            $str .= chr(mt_rand(97, 122));
        }
        return $str;
    }


    //----------------------------------------------------
    // 会員情報入力項目と入力ルールの設定
    //----------------------------------------------------
    public function make_form_controle($regist = "")
    {
        $options = [
            'format' => 'Ymd',
            'minYear' => 1950,
            'maxYear' => date("Y"),
        ];
        if ($this->type === "regist") {
            $classValue = ['' => '選択してください', '1-1' => '1-1', '1-2' => '1-2', '1-3' => '1-3', 'IS2' => 'IS2', 'IT2' => 'IT2', 'IE2' => 'IE2', 'IS3' => 'IS3', 'IT3' => 'IT3', 'IE3' => 'IE3', 'IS4' => 'IS4', 'IT4' => 'IT4', 'IE4' => 'IE4', 'IS5' => 'IS5', 'IT5' => 'IT5', 'IE5' => 'IE5'];
        } else {
            $classValue = ['1-1' => '1-1', '1-2' => '1-2', '1-3' => '1-3', 'IS2' => 'IS2', 'IT2' => 'IT2', 'IE2' => 'IE2', 'IS3' => 'IS3', 'IT3' => 'IT3', 'IE3' => 'IE3', 'IS4' => 'IS4', 'IT4' => 'IT4', 'IE4' => 'IE4', 'IS5' => 'IS5', 'IT5' => 'IT5', 'IE5' => 'IE5'];
        }
        if ($this->type != "modify") {
            $username = $this->form->addElement('text', 'username', ['size' => 20], ['label' => '学内メールアドレス']);
            $password = $this->form->addElement('password', 'password', ['size' => 20, 'maxlength' => 50], ['label' => 'パスワード']);
        }
        $last_name = $this->form->addElement('text', 'last_name', ['id' => 'last_name', 'size' => 30, 'onkeyup' => '(function() { let val="last_name";keyup(val); } )();']);
        $first_name = $this->form->addElement('text', 'first_name', ['id' => 'first_name', 'size' => 30, 'onkeyup' => '(function() { let val="first_name";keyup(val); } )();']);
        $h_last_name = $this->form->addElement('text', 'h_last_name', ['id' => 'h_last_name', 'size' => 30]);
        $h_first_name = $this->form->addElement('text', 'h_first_name', ['id' => 'h_first_name', 'size' => 30]);
        $class = $this->form->addElement('select', 'class', null, ['label' => '学年/クラス', 'options' => $classValue]);
        $roomnum = $this->form->addElement('text', 'roomnum', ['size' => 5], ['label' => '部屋番号']);
        $birthday = $this->form->addElement('date', 'birthday', null, ['label' => '誕生日'] + $options);
        if ($regist === '未登録' || $regist == '') {
            $reason_gp_dest = $this->form->addGroup('dest'); //誕生日登録・非登録ラジオボタン
            $reason_gp_dest->addElement('radio', 'regist', ['value' => 'non_regist', 'id' => 'non_regist', 'checked' => 'checked']);
            $reason_gp_dest->addElement('radio', 'regist', ['value' => 'regist', 'id' => 'regist']);
        } else {
            $reason_gp_dest = $this->form->addGroup('dest'); //誕生日登録・非登録ラジオボタン
            $reason_gp_dest->addElement('radio', 'regist', ['value' => 'non_regist', 'id' => 'non_regist']);
            $reason_gp_dest->addElement('radio', 'regist', ['value' => 'regist', 'id' => 'regist', 'checked' => 'checked']);
        }

        //ルール設定
        if ($this->type != "modify") {
            $username->addRule('required', '学内メールアドレスを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
            $password->addRule('required', 'パスワードを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
            $password->addRule('length', 'パスワードは8文字から16文字の範囲で入力してください。', [8, 16], HTML_QuickForm2_Rule::SERVER);
            $password->addRule('regex', 'パスワードは半角の英数字、記号（ _ - ! ? # $ % & @ ）を使ってください。', '/^[a-zA-z0-9_\-!?#$%&@]*$/', HTML_QuickForm2_Rule::SERVER);
        }
        $class->addRule('required', '学年/クラスを選択してください。', null, HTML_QuickForm2_Rule::SERVER);
        $roomnum->addRule('required', '部屋番号を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $last_name->addRule('required', '氏を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $first_name->addRule('required', '名を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_last_name->addRule('required', '氏(ふりがな)を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_first_name->addRule('required', '名(ふりがな)を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $h_last_name->addRule('regex', 'ひらがなを入力してください。', '/^[ぁ-ゞ]+$/u', HTML_QuickForm2_Rule::SERVER);
        $h_first_name->addRule('regex', 'ひらがなを入力してください。', '/^[ぁ-ゞ]+$/u', HTML_QuickForm2_Rule::SERVER);
        $this->form->addRecursiveFilter('trim');

    }


    //----------------------------------------------------
    // リストの役職専用のフォーム作成
    //----------------------------------------------------
    public function make_option_controle()
    {
        $classValue = ['' => 'すべて', '1-1' => '1-1', '1-2' => '1-2', '1-3' => '1-3', 'IS2' => 'IS2', 'IT2' => 'IT2', 'IE2' => 'IE2', 'IS3' => 'IS3', 'IT3' => 'IT3', 'IE3' => 'IE3', 'IS4' => 'IS4', 'IT4' => 'IT4', 'IE4' => 'IE4', 'IS5' => 'IS5', 'IT5' => 'IT5', 'IE5' => 'IE5'];
        $class = $this->form->addElement('select', 'spe-class', null, ['id' => 'class', 'options' => $classValue]);
        $class->addRule('required', '学年/クラスを入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $this->form->addRecursiveFilter('trim');
    }


    //----------------------------------------------------
    // 外泊願の入力項目と入力ルールの設定
    //----------------------------------------------------
    public function make_gaihaku_controle()
    {
        $options = [
            'format' => 'Ymd',
            'minYear' => date("Y"),
            'maxYear' => 2030,
        ];

        $classValue = ['1-1' => '1-1', '1-2' => '1-2', '1-3' => '1-3', 'IS2' => 'IS2', 'IT2' => 'IT2', 'IE2' => 'IE2', 'IS3' => 'IS3', 'IT3' => 'IT3', 'IE3' => 'IE3', 'IS4' => 'IS4', 'IT4' => 'IT4', 'IE4' => 'IE4', 'IS5' => 'IS5', 'IT5' => 'IT5', 'IE5' => 'IE5'];
        $timeValue = ['7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20'];
        $psCode1 = $this->form->addElement('text', 'psCode1', ['size' => 5], ['label' => '郵便番号1']); //郵便番号先頭3桁
        $psCode2 = $this->form->addElement('text', 'psCode2', ['size' => 10], ['label' => '郵便番号2']); //郵便番号後尾4桁
        $address = $this->form->addElement('text', 'address', ['size' => 37], ['label' => '住所']);
        $last_name2 = $this->form->addElement('text', 'last_name2', ['size' => 10], ['label' => '氏']); //宿泊先の相手氏名
        $first_name2 = $this->form->addElement('text', 'first_name2', ['size' => 10], ['label' => '名']);
        $tel = $this->form->addElement('text', 'tel', ['size' => 25], ['label' => '外泊先の電話番号<br>※ハイフン(-)も含める']);
        if ($this->type == 'gaihaku' || $this->type == 'log') {
            $s_time = $this->form->addElement('select', 's_time', null, ['label' => '時', 'options' => $timeValue]); //外泊開始時間
            $f_time = $this->form->addElement('select', 'f_time', null, ['label' => '時', 'options' => $timeValue]); //外泊終了時間
        }

        if ($this->reason == '帰省') {
            $reason_gp_dest = $this->form->addGroup('dest'); //帰省理由ラジオボタン
            $reason_gp_dest->addElement('radio', 'reason', ['value' => '帰省', 'id' => 'kisei', 'checked' => 'checked']); //帰省
            $reason_gp_dest->addElement('radio', 'reason', ['value' => 'その他', 'id' => 'sonota']); //その他
        } else if ($this->reason == 'その他') {
            $reason_gp_dest = $this->form->addGroup('dest'); //帰省理由ラジオボタン
            $reason_gp_dest->addElement('radio', 'reason', ['value' => '帰省', 'id' => 'kisei']); //帰省
            $reason_gp_dest->addElement('radio', 'reason', ['value' => 'その他', 'id' => 'sonota', 'checked' => 'checked']); //その他
        } else {
            $reason_gp_dest = $this->form->addGroup('dest'); //帰省理由ラジオボタン
            $reason_gp_dest->addElement('radio', 'reason', ['value' => '帰省', 'id' => 'kisei', 'checked' => 'checked']); //帰省
            $reason_gp_dest->addElement('radio', 'reason', ['value' => 'その他', 'id' => 'sonota']); //その他
        }

        $riyuu = $this->form->addElement('textarea', 'riyuu', ['cols' => 95, 'rows' => 7, 'placeholder' => "その他の場合は理由を具体的に記入してください"]);

        $psCode1->addRule('required', '郵便番号を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $psCode1->addRule('regex', '適切な郵便番号番号を入力してください。', '/^[0-9]{3}$/', HTML_QuickForm2_Rule::SERVER); //郵便番号先頭3桁の正規表現
        $psCode2->addRule('required', '郵便番号を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $psCode2->addRule('regex', '適切な郵便番号を入力してください。', '/^[0-9]{4}$/', HTML_QuickForm2_Rule::SERVER); //郵便番号後尾3桁の正規表現
        $address->addRule('required', '宿泊先住所を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $last_name2->addRule('required', '氏を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $first_name2->addRule('required', '名を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $tel->addRule('required', '電話番号を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        $tel->addRule(
            'regex',
            '適切な電話番号を入力してください。'
            ,
            '/^0([0-9]-[0-9]{4}|[0-9]{2}-[0-9]{3}|[0-9]{3}-[0-9]{2}|[0-9]{4}-[0-9])-[0-9]{4}$|^0[789]0-[0-9]{4}-[0-9]{4}$/', HTML_QuickForm2_Rule::SERVER
        ); //固定電話番号の正規表現|携帯電話番号の正規表現
        if ($this->type == 'gaihaku' || $this->type == 'log') {
            $s_time->addRule('required', '外泊開始時間を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
            $f_time->addRule('required', '外泊終了時間を入力してください。', null, HTML_QuickForm2_Rule::SERVER);
        }
        $reason_gp_dest->addRule('required', '外泊理由を選んでください。', null, HTML_QuickForm2_Rule::SERVER);

        $this->form->addRecursiveFilter('trim');

    }



    //----------------------------------------------------
    // 検索処理関係
    //----------------------------------------------------
    //
    // pageIDをURLに追加。
    //
    public function add_pageID()
    {
        if (!($this->is_system && $this->type == 'list')) {
            return;
        }

        $add_pageID = "";
        if (isset($_GET['pageID']) && $_GET['pageID'] != "") {
            $add_pageID = '&pageID=' . $_GET['pageID'];
            $_SESSION['pageID'] = $_GET['pageID'];
        } else if (isset($_SESSION['pageID']) && $_SESSION['pageID'] != "") {
            $add_pageID = '&pageID=' . $_SESSION['pageID'];
        }
        return $add_pageID;
    }



    //----------------------------------------------------
    // ページ分割処理(寮生一覧)
    //----------------------------------------------------
    public function make_page_link($data)
    {
        // Slindingを使用する場合
        //require_once('Pager/Sliding.php');

        // Jumpingを使用する場合
        require_once('Pager/Jumping.php');

        $params = [
            'mode' => 'Jumping',
            'perPage' => 10,
            'delta' => 10,
            'itemData' => $data
        ];

        // Slindingを使用する場合
        //$pager = new Pager_Sliding($params);

        // Jumpingを使用する場合
        $pager = new Pager_Jumping($params);

        $data = $pager->getPageData();
        $links = $pager->getLinks();
        return [$data, $links];
    }



    //----------------------------------------------------
    // ページ分割処理(提出済み外泊願一覧)
    //----------------------------------------------------
    public function make_page_link_1($data)
    {
        // Slindingを使用する場合
        //require_once('Pager/Sliding.php');

        // Jumpingを使用する場合
        require_once('Pager/Jumping.php');

        $params = [
            'mode' => 'Jumping',
            'perPage' => 1,
            'delta' => 10,
            'itemData' => $data
        ];

        // Slindingを使用する場合
        //$pager = new Pager_Sliding($params);

        // Jumpingを使用する場合
        $pager = new Pager_Jumping($params);

        $data = $pager->getPageData();
        $links = $pager->getLinks();
        return [$data, $links];
    }


    //----------------------------------------------------
    // ページ分割処理(認証済み外泊願一覧)
    //----------------------------------------------------
    public function make_page_link_10($data)
    {
        // Slindingを使用する場合
        //require_once('Pager/Sliding.php');

        // Jumpingを使用する場合
        require_once('Pager/Jumping.php');

        $params = [
            'mode' => 'Jumping',
            'perPage' => 10,
            'delta' => 10,
            'itemData' => $data
        ];

        // Slindingを使用する場合
        //$pager = new Pager_Sliding($params);

        // Jumpingを使用する場合
        $pager = new Pager_Jumping($params);

        $data = $pager->getPageData();
        $links = $pager->getLinks();
        return [$data, $links];
    }

    //----------------------------------------------------
    // デバッグ用表示処理
    //----------------------------------------------------
    public function debug_display()
    {
        if (_DEBUG_MODE) {
            $this->debug_str = "";
            if (isset($_SESSION)) {
                $this->debug_str .= '<br><br>$_SESSION<br>';
                $this->debug_str .= var_export($_SESSION, TRUE);
            }
            if (isset($_POST)) {
                $this->debug_str .= '<br><br>$_POST<br>';
                $this->debug_str .= var_export($_POST, TRUE);
            }
            if (isset($_GET)) {
                $this->debug_str .= '<br><br>$_GET<br>';
                $this->debug_str .= var_export($_GET, TRUE);
            }
            // smartyのデバッグモード設定 ポップアップウィンドウにテンプレート内の変数を
            // 表示します。
            $this->view->debugging = _DEBUG_MODE;
        }
    }
}