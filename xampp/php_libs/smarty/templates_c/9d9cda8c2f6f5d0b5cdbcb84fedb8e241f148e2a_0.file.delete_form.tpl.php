<?php
/* Smarty version 3.1.30, created on 2023-01-30 11:21:17
  from "C:\xampp\php_libs\smarty\templates\delete_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d7299d5f3d48_42068260',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d9cda8c2f6f5d0b5cdbcb84fedb8e241f148e2a' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\delete_form.tpl',
      1 => 1675045274,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d7299d5f3d48_42068260 (Smarty_Internal_Template $_smarty_tpl) {
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
        
<td style="vertical-align: top;">
[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]<br>

<?php if (($_smarty_tpl->tpl_vars['is_system']->value)) {
if ($_smarty_tpl->tpl_vars['type']->value == 'tdelete') {?>
      	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tlist&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">教員一覧</a> ]<br>
<?php } else { ?>
		[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=mlist&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">会員一覧</a> ]<br>
<?php }
}?>
<br>
<br>
<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>

</td>
        
<td>　　　</td>

<td>
<form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
	<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

	<br>
    <?php if ($_smarty_tpl->tpl_vars['type']->value == 'tdelete') {?>
		<div style="color:red; font-size: smaller;" align="center">教員が処理した外泊願は削除されません。</div>
		
    <?php } else { ?>
		<div style="color:red; font-size: smaller;" align="center">この寮生の提出物もすべて削除されます。</div>
	<?php }?>	
	<br>
		<?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>


        <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
		<input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
		<input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">

        </form>
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
