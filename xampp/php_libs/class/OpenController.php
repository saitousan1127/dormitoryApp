<?php
/**
 * Description of PrememberController
 *
 * @author nagatayorinobu
 */
class OpenController extends BaseController
{
    public function run()
    {
        $this->auth = new Auth();
        $this->auth->set_authname(_TEACHER_AUTHINFO);
        $this->auth->set_sessname(_TEACHER_SESSNAME);
        $this->auth->start();

        $gaihakuModel = new gaihakuModel();
        $gaihaku_id = $_POST['gaihaku_id'];
        $gaihakuModel->open($gaihaku_id);
    }
}