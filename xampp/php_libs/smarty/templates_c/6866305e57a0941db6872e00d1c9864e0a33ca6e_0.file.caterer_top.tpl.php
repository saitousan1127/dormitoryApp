<?php
/* Smarty version 3.1.30, created on 2023-01-24 13:09:59
  from "C:\xampp\php_libs\smarty\templates\caterer_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63cf5a17598778_29977088',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6866305e57a0941db6872e00d1c9864e0a33ca6e' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\caterer_top.tpl',
      1 => 1674533392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63cf5a17598778_29977088 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/system_top.css">
</head>
<body>
<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

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
  <td >
  <td align="left">
	<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>

      </td>
      </tr>

<tr>
<td>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=pass_modify&action=form">パスワード変更</a> ]---給食業者アカウントのパスワードを変更します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list">欠食者一覧</a> ]---欠食者の一覧表を表示します
<br>
</td></tr>
</td>
</tr>
</table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
