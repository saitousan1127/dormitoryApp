<?php
/* Smarty version 3.1.30, created on 2023-01-20 18:31:45
  from "C:\xampp\htdocs\ryousei.jp\..\..\php_libs\smarty\templates\memberinfo_form.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63ca5f819af6c7_37502505',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a72abaa6b19b6cb09cedb26e721dae8955b32070' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ryousei.jp\\..\\..\\php_libs\\smarty\\templates\\memberinfo_form.tpl',
      1 => 1674206702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ca5f819af6c7_37502505 (Smarty_Internal_Template $_smarty_tpl) {
?>
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

           <table>
             <tr>
             <td align="left">
	            [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]<br>
             <?php if (($_smarty_tpl->tpl_vars['is_system']->value)) {?>
      	      [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=mlistt&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
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
                <?php if (isset($_smarty_tpl->tpl_vars['form']->value['username']['error'])) {?>
                  <tr><td></td><td><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['username']['error'];?>
</div></td></tr>
                <?php }?>

            <tr>
            <td align="right"><font color="red" size="2"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
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
              <td style="vertical-align:top; text-align:right;">氏(ふりがな)：</td>
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
              <td style="vertical-align:top; text-align:right;">学年/クラス：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['class']['html'];?>

              </td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['class']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['class']['error'];?>
</div></td></tr>
            <?php }?>


            <tr>
              <td style="vertical-align:top; text-align:right;">部屋番号：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['roomnum']['html'];?>

              </td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['roomnum']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['roomnum']['error'];?>
</div></td></tr>
            <?php }?>

            <tr>
            <td align="right"><font color="red" size="2">記入例：N207A(N:北寮，E:東寮，S:南寮)</font></td>
            </tr>
            
            <tr>
              <td style="vertical-align:top; text-align:right;"><?php echo $_smarty_tpl->tpl_vars['form']->value['birthday']['label'];?>
(任意)：</td>
              <td style="text-align:left;">
                <?php echo $_smarty_tpl->tpl_vars['form']->value['birthday']['Y']['html'];
echo $_smarty_tpl->tpl_vars['form']->value['birthday']['m']['html'];
echo $_smarty_tpl->tpl_vars['form']->value['birthday']['d']['html'];?>

                <?php echo $_smarty_tpl->tpl_vars['form']->value['dest']['regist']['elements']['non_regist']['html'];?>
<label for="non_regist">非登録</label>/
              <?php echo $_smarty_tpl->tpl_vars['form']->value['dest']['regist']['elements']['regist']['html'];?>
<label for="regist">登録</label>
              </td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['birthday']['error'])) {?>
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['form']->value['birthday']['error'];?>
</div></td></tr>
            <?php }?>

<tr></tr>
            <tr>
            <td></td>
            <td>
            <?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['submit2']['html'];?>

            <?php } else { ?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>

            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

            <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
            <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
            <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
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
</pre><?php }
echo '<script'; ?>
 type="text/javascript" src="../js/KtoH.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
