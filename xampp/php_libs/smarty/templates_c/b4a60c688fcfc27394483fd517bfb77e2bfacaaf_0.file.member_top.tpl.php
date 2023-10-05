<?php
/* Smarty version 3.1.30, created on 2023-01-18 14:00:42
  from "C:\xampp\php_libs\smarty\templates\member_top.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63c77cfa987417_61699343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4a60c688fcfc27394483fd517bfb77e2bfacaaf' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\member_top.tpl',
      1 => 1674017784,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63c77cfa987417_61699343 (Smarty_Internal_Template $_smarty_tpl) {
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
      <td style="vertical-align:top;">
            [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=logout">ログアウト</a> ]
      </td>
        <td style="vertical-align:top;">
        <div style="text-align: left; margin-left:15px;">
          <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['last_name']->value, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_name']->value, ENT_QUOTES, 'UTF-8', true);?>
 さん、<?php echo $_smarty_tpl->tpl_vars['greeting']->value;?>
（<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>
）
          <br>
          <br>
          <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=modify&action=form">プロフィール編集</a>
          <br>
          <br>
	        <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=pass_modify&action=form">パスワードの変更</a>
          <br>
          <br>
          <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tpl&action=form">外泊願テンプレート作成</a>
          <br>
          <br>
	        <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=gaihaku&action=form">外泊願　作成/提出</a>
          <br>
          <br>
          <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=kessyoku&action=create">欠食届　作成/提出</a>
          <br>
          <br>
	        <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=log&action=list">履歴表示【外泊願】</a>
          <br>
          <br>
          <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=kessyoku_log&action=list">履歴表示【欠食届】</a>
          <br>
        </div>
        </td>
      </tr>
    </table>
    <div align='center'>今日が誕生日の人(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['today']->value, ENT_QUOTES, 'UTF-8', true);?>
)</div>
    <table align='center'>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
    <tr>
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
さん</td>
    <td>　<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['birthday'], ENT_QUOTES, 'UTF-8', true);?>
才</td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
