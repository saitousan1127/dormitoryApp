<?php
/* Smarty version 3.1.30, created on 2023-01-30 13:49:33
  from "C:\xampp\php_libs\smarty\templates\teacher_login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d74c5dd30f99_70068736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a530779e580851313b868133e307f0cf2a97e21b' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\teacher_login.tpl',
      1 => 1675054170,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d74c5dd30f99_70068736 (Smarty_Internal_Template $_smarty_tpl) {
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
        <td>
	  <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
          <table>
            <tr align="left">
            <th><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
ページ:</th>
            <br>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
            <tr>
            <td align="right"><font color="red"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</font></td>
            </tr>
            <?php }?>
            <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</td>
            </tr>

            <tr>
              <td  height="70"><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['label'];?>
:</div></td>
              <td align="left"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>
@sendai-nct.ac.jp</td>
            </tr>

	    <tr>
          <td><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
:</div></td>
              <td align="left"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>
</td>
            </tr>
            <tr>
              <td colspan="2" height="100" >
              <br>
                <div style="color:red;font-size: smaller;"> <?php echo $_smarty_tpl->tpl_vars['auth_error_mess']->value;?>
</div>
                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <div style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</div>
              </td>
            </tr>
          </table>
	  </form>
	  
        </td>
        <td>
            <br>
            <br>
        </td>
      </tr>
    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
