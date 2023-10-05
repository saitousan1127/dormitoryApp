<?php
/* Smarty version 3.1.30, created on 2023-01-26 15:53:13
  from "C:\xampp\php_libs\smarty\templates\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d22359003325_05831175',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3571e1ebad3e4be698c841e1a7e3fb731c43eab2' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\login.tpl',
      1 => 1674715961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d22359003325_05831175 (Smarty_Internal_Template $_smarty_tpl) {
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
          <table>
            <tr>
              <th align="left">寮生ページ:</th>
            </tr>
            <tr>
            <td height="50">寮生用アカウントでログインしてください．</td>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['message']->value) {?>
            <tr>
            <td align="right"><font color="red"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</font></td>
            </tr
            <?php }?>
            <tr>
              <td><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['label'];?>
:</div></td>
              <td align="left"> <?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>
@sendai-nct.jp</td>
            </tr>

	    <tr>
              <td height="70"><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
:</div></td>
              <td align="left"> <?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>
</td>
            </tr>
            <tr>
              <td colspan="2" height="100" >
                 <div style="color:red; font-size: smaller;"> <?php echo $_smarty_tpl->tpl_vars['auth_error_mess']->value;?>
 </div>
                 <br>
                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <div style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</div>
              </td>
            </tr>
          </table>
	  </form>
    <br>
          <br>
          <div align="center"><a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=regist&action=form"><<新規登録>></a></div>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
<!--<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=regist&action=form">新規登録</a>-->
</body>
</html><?php }
}
