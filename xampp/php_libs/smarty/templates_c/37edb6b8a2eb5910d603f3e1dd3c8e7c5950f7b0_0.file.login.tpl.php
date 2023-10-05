<?php
/* Smarty version 3.1.30, created on 2023-01-20 17:52:22
  from "C:\xampp\htdocs\ryousei.jp\..\..\php_libs\smarty\templates\login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63ca56460d97e4_13441020',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '37edb6b8a2eb5910d603f3e1dd3c8e7c5950f7b0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ryousei.jp\\..\\..\\php_libs\\smarty\\templates\\login.tpl',
      1 => 1671513818,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ca56460d97e4_13441020 (Smarty_Internal_Template $_smarty_tpl) {
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
              <th align="left">一般ページ:</th>
            </tr>
            <tr>
            <td height="50">アカウントをお持ちの方はログインしてください</td>
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
              <td> <?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>
</td>
            </tr>

            <tr>
            <td align="right"><font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font></td>
            </tr>

	    <tr>
              <td height="70"><div style="text-align: right"><?php echo $_smarty_tpl->tpl_vars['form']->value['password']['label'];?>
:</div></td>
              <td> <?php echo $_smarty_tpl->tpl_vars['form']->value['password']['html'];?>
</td>
            </tr>
            <tr>
              <td colspan="2" height="100" >
                <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
                <div style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</div>
		<br>
                <div style="color:red; font-size: smaller;"> <?php echo $_smarty_tpl->tpl_vars['auth_error_mess']->value;?>
 </div></td>
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
