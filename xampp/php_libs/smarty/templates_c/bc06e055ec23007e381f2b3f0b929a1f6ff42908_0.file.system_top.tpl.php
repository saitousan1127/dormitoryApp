<?php
/* Smarty version 3.1.30, created on 2023-02-06 13:13:07
  from "C:\xampp\php_libs\smarty\templates\system_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63e07e53821ad5_66368521',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bc06e055ec23007e381f2b3f0b929a1f6ff42908' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\system_top.tpl',
      1 => 1675656736,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63e07e53821ad5_66368521 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
<?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

<hr>
    <table>
      <tr>
        
      <td style="vertical-align: top;" align="left">
      	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=logout">ログアウト</a> ]
	</td>
  <td >
  <td align="left">
	<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>

      </td>
      </tr>
      <tr><td>メンテナンスモード：<?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</td></tr>
      <?php if (isset($_smarty_tpl->tpl_vars['maint_time']->value)) {?>
        <tr><td><div style="color:red; font-size: smaller;">メンテナンスモードを解除できるのは<?php echo $_smarty_tpl->tpl_vars['maint_time']->value;?>
からです．</div></td></tr>
      <?php }?>
      <tr>
      <td>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=pass_modify&action=form">パスワード変更</a> ]---Systemアカウントのパスワードを変更します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=delete_old">古いデータの削除</a> ]---ずっと前に登録された寮生や外泊願、欠食届などのデータを削除します。
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=mlist&action=form">寮生一覧</a> ]---寮生の検索・更新・削除を行います
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tlist&action=form">教員一覧</a> ]---教員の検索・更新・削除を行います
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=room">居住可能部屋設定</a> ]---寮生が居住可能な部屋を設定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=holiday">祝日設定</a> ]---祝日を設定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=long_vacation">長期休暇期間設定</a> ]---夏休みや冬休みなどの長期休暇期間を設定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=kessyoku_list&action=list">提出された欠食届の処理</a> ]---寮生から提出された欠食届を受理するか受理しないか決定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=kessyoku_log&action=list">処理した欠食届一覧</a> ]---処理した欠食届の履歴が見れます
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=absentee_list" style="text-align: left">点呼欠席者一覧</a> ]
<br>
</td></tr>
         </td>
      </tr>
    </table>
</div>
<input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
</form>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
