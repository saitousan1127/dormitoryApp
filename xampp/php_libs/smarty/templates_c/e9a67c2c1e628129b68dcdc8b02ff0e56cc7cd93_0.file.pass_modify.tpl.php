<?php
/* Smarty version 3.1.30, created on 2023-02-23 00:34:20
  from "C:\xampp\php_libs\smarty\templates\pass_modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63f635fc11ac18_49265959',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9a67c2c1e628129b68dcdc8b02ff0e56cc7cd93' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\pass_modify.tpl',
      1 => 1677080048,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f635fc11ac18_49265959 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<?php echo '<script'; ?>
 type="text/javascript" src="../js/quickform.js" async><?php echo '</script'; ?>
>
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
          <td align="left">[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]</td>
          </tr>
          <tr>
            <td align="right"><font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font></td>
            </tr>

            <tr>
              <td height="30"><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['oldPass']['label'];?>
:</div></td>
              <td> <?php echo $_smarty_tpl->tpl_vars['form']->value['oldPass']['html'];?>
</td>
            </tr>

            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['oldPass']['error'])) {?>
                 <tr><td></td><td aling="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['oldPass']['error'];?>
</div></td></tr>
                <?php }?>

	        <tr>
              <td height="30"><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['newPass']['label'];?>
:</div></td>
              <td> <?php echo $_smarty_tpl->tpl_vars['form']->value['newPass']['html'];?>
</td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['newPass']['error'])) {?>
                 <tr><td></td><td aling="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['newPass']['error'];?>
</div></td></tr>
                <?php }?>

            <tr>
              <td height="30"><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['newPass2']['label'];?>
:</div></td>
              <td> <?php echo $_smarty_tpl->tpl_vars['form']->value['newPass2']['html'];?>
</td>
            </tr>

            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['newPass2']['error'])) {?>
                 <tr><td></td><td aling="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['newPass2']['error'];?>
</div></td></tr>
                <?php }?>

            <tr>
              <td colspan="2" height="100" >
                <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
                <div style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</div>
		<br>
                <div style="color:red; font-size: smaller;"> <?php echo $_smarty_tpl->tpl_vars['auth_error_mess']->value;?>
 </div></td>
            </tr>
          </table>
          <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
	  </form>
    <?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
      <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

    <?php }?>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
