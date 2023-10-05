<?php
/**
 * Description of PrememberController
 *
 * @author nagatayorinobu
 */
class DeleteController extends BaseController
{
  public function run()
  {
    $this->auth = new Auth();
    $this->auth->set_authname(_MEMBER_AUTHINFO);
    $this->auth->set_sessname(_MEMBER_SESSNAME);
    $this->auth->start();

    switch ($_POST['type']) {
      case "kessyoku":
        $this->delete_kessyoku($_POST['group_id']);
        break;

      case "gaihaku":
        $this->delete_gaihaku($_POST['gaihaku_id']);
        break;

      case "delete_old_gaihaku":
        $this->delete_old_gaihaku($_POST['date']);
        break;

      case "delete_old_kessyoku":
        $this->delete_old_kessyoku($_POST['date']);
        break;

      case "delete_old_tenko":
        $this->delete_old_tenko($_POST['date']);
        break;

      case "ban_old_member":
        $this->ban_old_member($_POST['date']);
        break;

      case "delete_old_member":
        $this->delete_old_member($_POST['date']);
        break;

      case "delete_ban_member":
        $this->delete_ban_member();
        break;

      case "ban_old_teacher":
        $this->ban_old_teacher($_POST['date']);
        break;

      case "delete_old_teacher":
        $this->delete_old_teacher($_POST['date']);
        break;

      case "delete_ban_teacher":
        $this->delete_ban_teacher();
        break;

      case "swich_ban_member":
        $this->swich_ban_member($_POST['id']);
        break;

      case "swich_ban_teacher":
        $this->swich_ban_teacher($_POST['id']);
        break;

      case "holiday":
        $this->delete_holiday($_POST['id']);
        break;

      case "ryoukanlog":
        $this->delete_ryoukanlog();
        break;

      case "class":
        $this->call_off_class(); //教員とクラスの紐づけを全解除する
        break;

      case "vacation":
        $this->delete_vacation($_POST['id']);
        break;

      default:
    }
  }

  private function delete_kessyoku($group_id)
  {
    $KgroupModel = new KgroupModel;
    $kessyokuModel = new kessyokuModel;

    $now = time();
    $thirteen = mktime(13, 0, 0, date("m"), date("d"), date("Y")); //本日の13時
    if ($now < $thirteen) {
      $three_days_ago = date("Y-m-d", strtotime("+3 day"));
    } else {
      $three_days_ago = date("Y-m-d", strtotime("+4 day"));
    }

    $kessyokuModel->deleteKessyokuByGroup($group_id, $three_days_ago);
    if (!$kessyokuModel->checkGroup($group_id)) {
      $KgroupModel->delete_group($group_id);
    }
  }

  private function delete_gaihaku($gaihaku_id)
  {
    $gaihakuModel = new gaihakuModel;
    $gaihakuModel->deleteGaihakuByGid($gaihaku_id);
  }

  private function delete_old_gaihaku($date)
  {
    $gaihakuModel = new gaihakuModel;
    $gaihakuModel->delete_old_gaihaku($date);
  }

  private function delete_old_kessyoku($date)
  {
    $KgroupModel = new KgroupModel;
    $KgroupModel->delete_old_kessyoku($date);
  }

  private function delete_old_tenko($date)
  {
    $TenkoModel = new TenkoModel;
    $AbsenteeModel = new AbsenteeModel;

    $TenkoModel->delete_old_tenko($date);
    $AbsenteeModel->delete_old_absentee($date);
  }

  private function ban_old_member($date)
  {
    $MemberModel = new MemberModel;
    $MemberModel->ban_old_member($date);
  }

  private function delete_old_member($date)
  {
    $gaihakuModel = new gaihakuModel;
    $KgroupModel = new KgroupModel;
    $tplModel = new tplModel;
    $TenkoModel = new TenkoModel;
    $AbsenteeModel = new AbsenteeModel;
    $MemberModel = new MemberModel;

    $gaihakuModel->delete_old_member_gaihaku($date);
    $KgroupModel->delete_old_member_kessyoku($date);
    $tplModel->delete_old_member_tpl($date);
    $TenkoModel->delete_old_member_tenko($date);
    $AbsenteeModel->delete_old_member_absentee($date);
    $MemberModel->delete_old_member($date);
  }

  private function delete_ban_member()
  {
    $gaihakuModel = new gaihakuModel;
    $KgroupModel = new KgroupModel;
    $tplModel = new tplModel;
    $TenkoModel = new TenkoModel;
    $AbsenteeModel = new AbsenteeModel;
    $MemberModel = new MemberModel;

    $gaihakuModel->delete_ban_member_gaihaku();
    $KgroupModel->delete_ban_member_kessyoku();
    $tplModel->delete_ban_member_tpl();
    $TenkoModel->delete_ban_member_tenko();
    $AbsenteeModel->delete_ban_member_absentee();
    $MemberModel->delete_ban_member();
  }

  private function ban_old_teacher($date)
  {
    $TeacherModel = new TeacherModel;
    $TeacherModel->ban_old_teacher($date);
  }

  private function delete_old_teacher($date)
  {
    $TeacherModel = new TeacherModel;
    $TeacherModel->delete_old_teacher($date);
  }

  private function delete_ban_teacher()
  {
    $TeacherModel = new TeacherModel;
    $TeacherModel->delete_ban_teacher();
  }

  private function swich_ban_member($id)
  {
    $MemberModel = new MemberModel;
    $MemberModel->swich_ban($id);
  }

  private function swich_ban_teacher($id)
  {
    $TeacherModel = new TeacherModel;
    $TeacherModel->swich_ban($id);
  }

  private function delete_holiday($id)
  {
    $holidayModel = new holidayModel;
    $holidayModel->delete_holiday($id);
  }

  private function delete_ryoukanlog()
  {
    $RyoukanlogModel = new RyoukanlogModel;
    $RyoukanlogModel->disable_log();
  }

  private function call_off_class()
  {
    $TeacherModel = new TeacherModel;
    $TeacherModel->call_off_class();
  }

  private function delete_vacation($id)
  {
    $longVacationModel = new longVacationModel;
    $longVacationModel->delete_vacation($id);
  }

}