<?php
/* Smarty version 3.1.30, created on 2023-01-24 16:43:39
  from "C:\xampp\php_libs\smarty\templates\kessyoku_app_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63cf8c2b4341c6_79448697',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6273d0b3b0b5c93baeebd9ccd7f1aac43c818784' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\kessyoku_app_list.tpl',
      1 => 1674546161,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63cf8c2b4341c6_79448697 (Smarty_Internal_Template $_smarty_tpl) {
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
<form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
<?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

<table>
  <tr>
  <td style="vertical-align: top;">
	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]
  </td>
  </tr>
</table>

 <div align="center"> 
  <br>
  <br>
  日付：<input type='date' name='date' min="<?php echo $_smarty_tpl->tpl_vars['three_days_ago']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['date']->value;?>
">　　<?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

  <br>
  <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件の欠食申請があります<br>
  <font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font>
  </div>

<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>

<table border="1" align="center">
<tr><th>学年</th><th>氏名</th><th>朝食</th><th>昼食</th><th>夕食</th></tr>

<?php echo '<?php
';
$_smarty_tpl->_assignInScope('i', 1);
?>;
<?php echo '?>';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
<!--<?php if ($_smarty_tpl->tpl_vars['i']->value == 11) {
break 1;
}?>-->

<?php if ($_smarty_tpl->tpl_vars['i']->value%2 == 0) {?>
<tr bgcolor='#fff'>
<?php } else { ?>
<tr bgcolor='#eee'>
<?php }?>

<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['grade'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['bre'] == 1) {?>
  〇
<?php }?>
</td>
<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['lun'] == 1) {?>
  〇
<?php }?>
</td>
<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['din'] == 1) {?>
  〇
<?php }?>
</td>
</tr>
<?php echo '<?php
';
echo $_smarty_tpl->tpl_vars['i']->value++;?>
;
<?php echo '?>';
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


<?php }?>
</table>
          <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
</form>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
