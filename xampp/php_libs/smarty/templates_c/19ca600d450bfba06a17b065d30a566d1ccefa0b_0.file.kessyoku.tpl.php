<?php
/* Smarty version 3.1.30, created on 2023-01-23 19:26:04
  from "C:\xampp\php_libs\smarty\templates\kessyoku.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63ce60bc570032_85002345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19ca600d450bfba06a17b065d30a566d1ccefa0b' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\kessyoku.tpl',
      1 => 1674206464,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ce60bc570032_85002345 (Smarty_Internal_Template $_smarty_tpl) {
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
<div align="left">[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]</div>
<?php if ($_smarty_tpl->tpl_vars['type']->value == 'kessyoku_log') {?>
<div align="left">[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=kessyoku_log&action=list">履歴表示【欠食届】</a> ]</div>
<?php }
if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
  <br><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
<?php }?>
 <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
 <!--<form method="post" id="Form" action="/index.php">-->
 
 <div align="center"><font size="6">欠食届</font></div>
 <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>

<table style="border-collapse: collapse" align="center">
<tr>
<td><div id="error" style="color:red; font-size: smaller;" align="center"></div></td>
</tr>
<?php if ($_smarty_tpl->tpl_vars['type']->value == "kessyoku") {?>
<tr>
<td>
<?php if (isset($_smarty_tpl->tpl_vars['s_day']->value) && isset($_smarty_tpl->tpl_vars['f_day']->value)) {?>
開始日：<input type="date" name="s_day" id="s_day" value="<?php echo $_smarty_tpl->tpl_vars['s_day']->value;?>
">～終了日：<input type="date" name="f_day" id="f_day" value="<?php echo $_smarty_tpl->tpl_vars['f_day']->value;?>
">  
<input type="hidden" name="hidden_s_day" value="<?php echo $_smarty_tpl->tpl_vars['s_day']->value;?>
"><input type="hidden" name="hidden_f_day" value="<?php echo $_smarty_tpl->tpl_vars['f_day']->value;?>
">
<?php } else { ?>
開始日：<input type="date" name="s_day" id="s_day" value="">～終了日：<input type="date" name="f_day" id="f_day" value="">
<?php }
echo $_smarty_tpl->tpl_vars['form']->value['submit3']['html'];?>

</td>
</tr>
<?php }?>
<tr><td>　</td></tr>
<tr>
<td>
<?php if (isset($_smarty_tpl->tpl_vars['table']->value)) {?>
<table>
<tr id="table">
<?php if (isset($_smarty_tpl->tpl_vars['reason']->value)) {?>
欠食理由 (<input type="text" size="30" name="k_reason" id="k_reason" value="<?php echo $_smarty_tpl->tpl_vars['reason']->value;?>
">)
<?php } else { ?>
欠食理由 (<input type="text" size="30" name="k_reason" id="k_reason">)
<?php }
echo $_smarty_tpl->tpl_vars['table']->value;?>

</tr>
</table>
<?php if ($_smarty_tpl->tpl_vars['type']->value == 'kessyoku') {?>
<input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete"><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
<?php } else { ?>
<input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete" <?php echo $_smarty_tpl->tpl_vars['checked']->value;?>
><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
<?php }
}?>
</td>
</tr>

</table>
        <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
        <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
        <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">

        <?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['submit2']['html'];?>

        <?php } else { ?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>

        <?php }?>
        <?php if (($_smarty_tpl->tpl_vars['form']->value['submit']['attribs']['value'] != '')) {?>
             <?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>

        <?php }?>
</form>
</div>
<?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }
echo '<script'; ?>
 type="text/javascript" src="../js/kessyoku.js" async><?php echo '</script'; ?>
>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
