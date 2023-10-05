<?php
/* Smarty version 3.1.30, created on 2023-01-12 16:55:41
  from "C:\xampp\php_libs\smarty\templates\message.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63bfbcfd1a9f95_24528315',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c75633c697c3b48c1c94071012d7cd9515a9d092' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\message.tpl',
      1 => 1673510137,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63bfbcfd1a9f95_24528315 (Smarty_Internal_Template $_smarty_tpl) {
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
">トップページへ</a> ]<br>

<?php if ($_smarty_tpl->tpl_vars['type']->value == 'app') {?>
 [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list&action=form">外泊願一覧</a> ]<br>
<?php }
if ($_smarty_tpl->tpl_vars['type']->value == 'list2') {?>
 [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list2&action=form">外泊願処理画面</a> ]<br>
<?php }?>

<?php if (($_smarty_tpl->tpl_vars['is_system']->value)) {?>

<?php if ($_smarty_tpl->tpl_vars['type']->value == 'tlist') {?>
  [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tlist&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">教員一覧</a> ]<br>
<?php } else { ?>
  [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">会員一覧</a> ]<br>
<?php }
}?>
	<br>
	<br>
	<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>

      </td>
        
      <td>
  		<?php echo $_smarty_tpl->tpl_vars['message']->value;?>



        </td>
      </tr>
      <tr>
      <?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>

      </tr>
    </table>
    <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
    </form>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
