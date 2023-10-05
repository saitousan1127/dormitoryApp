<?php
/* Smarty version 3.1.30, created on 2021-12-31 19:17:21
  from "C:\xampp\php_libs\smarty\templates\app_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61ced8b1b259a8_74006123',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '970812084e33355014763ee050cfa001bbd2d3ac' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\app_form.tpl',
      1 => 1640945835,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61ced8b1b259a8_74006123 (Smarty_Internal_Template $_smarty_tpl) {
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
<div align="left">[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">外泊願一覧</a> ]</div>
    <table>
      <tr>
      
      <td>
    <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

	<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

	<br>
	<br>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['comment']['html'];?>

    <?php if (isset($_smarty_tpl->tpl_vars['form']->value['comment']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="left"><?php echo $_smarty_tpl->tpl_vars['form']->value['comment']['error'];?>
</div>
    <?php }?>
    <br>
    <br>
		<?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['submit2']['html'];?>

            <?php } else { ?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>

            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>


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
