<?php
/**
 * Description of PrememberController
 *
 * @author nagatayorinobu
 */
class PrememberController extends BaseController
{
    public function run()
    {
        if (isset($_GET['username']) && isset($_GET['link_pass'])) {
            // 必要なパラメータがある
            // データベースを操作します。
            $PrememberModel = new PrememberModel();
            $roomModel = new roomModel();
            $userdata = $PrememberModel->check_premember($_GET['username'], $_GET['link_pass']);
            if (!empty($userdata) && count($userdata) >= 1) {
                // パラメータが合致する
                // 仮登録テーブルから削除して、memberへデータを挿入する
                $PrememberModel->delete_premember_and_regist_member($userdata);
                $roomModel->regist_username($userdata['username'], $userdata['roomnum']);
                $this->title = '登録完了画面';
                $this->message = '登録を完了しました。トップページよりログインしてください。';
                $this->link = '<a href=index.php>トップページへ</a>';
            } else {
                // パラメータが合致しない
                $this->title = 'エラー画面';
                $this->message = 'このURLは無効です。';
            }
        } else {
            // 必要なパラメータがない
            $this->title = 'エラー画面';
            $this->message = 'このURLは無効です。';
        }
        $this->file = 'pre.tpl';
        $this->view_display();
    }


}