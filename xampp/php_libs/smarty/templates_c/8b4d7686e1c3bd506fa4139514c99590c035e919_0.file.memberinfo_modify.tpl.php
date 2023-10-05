<?php
/* Smarty version 3.1.30, created on 2022-11-25 17:01:42
  from "C:\xampp\php_libs\smarty\templates\memberinfo_modify.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6380766685e627_90576943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8b4d7686e1c3bd506fa4139514c99590c035e919' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\memberinfo_modify.tpl',
      1 => 1669011158,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6380766685e627_90576943 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<?php echo '<script'; ?>
 type="text/javascript" src="js/quickform.js" async><?php echo '</script'; ?>
>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>

           <table>
             <tr>
             <td align="left">
	            [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]<br>
             <?php if (($_smarty_tpl->tpl_vars['is_system']->value)) {?>
      	      [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=list&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">会員一覧</a> ]<br>
             <?php }?>
	           <br>
	           <?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>

             </td>
             <td>
 	           <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

             <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
             <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

            </tr>

            <tr>
            <td align="left">必要情報を入力してください</td>
            </tr>

            <tr>
              <td style="vertical-align:top; text-align:right;"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['label'];?>
：</td>
              <td style="text-align:left;">
              <?php echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>

              </td>
              </tr>
                <?php if (isset($_smarty_tpl->tpl_vars['form']->value['username']['error'])) {
echo $_smarty_tpl->tpl_vars['form']->value['username']['html'];?>
</td>
                  <tr><td></td><td><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['error'];?>
</div></td></tr>
                <?php }?>
            

            <tr>
            <td align="right"><font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font></td>
            </tr>


            <tr>
              <td style="vertical-align:top; text-align:right;">氏：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['last_name']['html'];?>

                </td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['last_name']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['last_name']['error'];?>
</div></td></tr>
            <?php }?>

            <tr>
              <td style="vertical-align:top; text-align:right;">名：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['first_name']['html'];?>

              </td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['first_name']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['first_name']['error'];?>
</div></td></tr>
            <?php }?>
            
            <tr>
              <td style="vertical-align:top; text-align:right;" >氏(ふりがな)：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['h_last_name']['html'];?>

                </td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['h_last_name']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['h_last_name']['error'];?>
</div></td></tr>
            <?php }?>

            <tr>
              <td style="vertical-align:top; text-align:right;">名(ふりがな)：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['h_first_name']['html'];?>

              </td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['h_first_name']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['h_first_name']['error'];?>
</div></td></tr>
            <?php }?>

            <tr>
              <td style="vertical-align:top; text-align:right;"><?php echo $_smarty_tpl->tpl_vars['form']->value['birthday']['label'];?>
：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['birthday']['Y']['html'];
echo $_smarty_tpl->tpl_vars['form']->value['birthday']['m']['html'];
echo $_smarty_tpl->tpl_vars['form']->value['birthday']['d']['html'];?>
</td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['birthday']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['birthday']['error'];?>
</div></td></tr>
            <?php }?>

            <tr>
            <td></td>
            <td>
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
            <input type="hidden" name="i" value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
            </td>
            </tr>
          </table>
          <br>
        </form>
      
</div>
<?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }
if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
