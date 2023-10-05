<?php
/* Smarty version 3.1.30, created on 2023-02-06 13:14:46
  from "C:\xampp\php_libs\smarty\templates\teacher_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63e07eb64bcde0_50221467',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97f6efdb2ef952a923df4568cc7c7bbc766e8d2e' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\teacher_top.tpl',
      1 => 1675656750,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63e07eb64bcde0_50221467 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
<table>

<tr>
<td style="vertical-align: top;" align="left">
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=logout">ログアウト</a> ]
</td>
</tr>
<tr>
<td></td>
<td>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['last_name']->value, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_name']->value, ENT_QUOTES, 'UTF-8', true);?>
 さんのアカウントでログイン中（<?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
）
</td>
</td></tr>

<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=modify&action=form" style="text-align: left">パスワード変更</a> ]---パスワードの変更ができます
<br>
</td></tr>

<?php if ($_smarty_tpl->tpl_vars['class']->value !== '外注') {?>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list" style="text-align: left">提出された外泊願の処理</a> ]---寮務主事、寮務主事補、担任の承認が必要な外泊願
<br>
</td></tr>

<?php if ($_smarty_tpl->tpl_vars['ryoukan']->value) {?>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=app_log" style="text-align: left">提出された外泊願一覧</a> ]---処理した外泊願の履歴が見れます
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tenko&action=list" style="text-align: left">まだ点呼を完了していない寮生一覧</a> ]
<br>
</td></tr>
<?php } else { ?>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=app_log" style="text-align: left">処理した外泊願一覧</a> ]---処理した外泊願の履歴が見れます
<br>
</td></tr>
<?php }?>

<?php } else { ?>
    
<?php if ($_smarty_tpl->tpl_vars['ryoukan']->value) {?>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=app_log" style="text-align: left">提出された外泊願一覧</a> ]---提出された外泊願の履歴が見れます
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tenko&action=list" style="text-align: left">まだ点呼を完了していない寮生一覧</a> ]
<br>
</td></tr>
<?php }?>

<?php }?>

<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=absentee_list" style="text-align: left">点呼欠席者一覧</a> ]
<br>
</td></tr>

</table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
