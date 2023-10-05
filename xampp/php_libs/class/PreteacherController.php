<?php
/**
 * Description of PreteacherController
 *
 * @author nagatayorinobu
 */
class PreteacherController extends BaseController {
    public function run(){
        if (isset($_GET['username']) && isset($_GET['link_pass'])){
        // 必要なパラメータがある
            // データベースを操作します。
            $PreteacherModel = new PreteacherModel();
            $userdata = $PreteacherModel->check_preteacher($_GET['username'], $_GET['link_pass']);
            if(!empty($userdata) && count($userdata) >= 1){
            // パラメータが合致する
            // 仮登録テーブルから削除して、memberへデータを挿入する
                $PreteacherModel->delete_preteacher_and_regist_teacher($userdata);
                $this->title = '登録完了画面';
                $this->message = '登録を完了しました。トップページよりログインしてください。';
                $this->link = '<a href=teacher.php>トップページへ</a>';
            }else{
            // パラメータが合致しない
                $this->title = 'エラー画面';
                $this->message = 'このURLは無効です。';
            }
        }else{
        // 必要なパラメータがない
            $this->title = 'エラー画面';
            $this->message = 'このURLは無効です。';
        }
        $this->file = 'pre.tpl'; 
        $this->view_display();
    }    
    

}