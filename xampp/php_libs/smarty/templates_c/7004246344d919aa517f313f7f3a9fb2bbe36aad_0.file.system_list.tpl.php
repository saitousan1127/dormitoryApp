<?php
/* Smarty version 3.1.30, created on 2023-01-26 16:52:55
  from "C:\xampp\php_libs\smarty\templates\system_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d231575f09b3_72457033',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7004246344d919aa517f313f7f3a9fb2bbe36aad' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\system_list.tpl',
      1 => 1674719572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d231575f09b3_72457033 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/system_list.css">
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
      	<td style="vertical-align: top;">
	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]
	<br>
	<br>
	<?php echo $_smarty_tpl->tpl_vars['disp_login_state']->value;?>

      	</td>
        <td>
        
<br>

<form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
名前：<input type="text" name="search_key" value="<?php echo $_smarty_tpl->tpl_vars['search_key']->value;?>
">
<input type="submit" name="submit" value="検索する">
<input type="hidden" name="type" value="mlist">
</form>



検索結果は<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件です。<br>
<br>
<?php echo $_smarty_tpl->tpl_vars['links']->value;?>

<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>
<table border="1">
<tbody>
<tr><th>ID</th><th>氏</th><th>名</th><th>氏(フリガナ)</th><th>名(フリガナ)</th><th>誕生日</th><th>登録日</th><th>　</th><?php if ($_smarty_tpl->tpl_vars['maint']->value) {?><th>　</th><?php }?></tr>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['k_last_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['k_first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['birthday'] == '未登録') {?>
未登録
<?php } else {
echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['birthday']),"%Y&#24180;%m&#26376;%d&#26085;");?>

<?php }?>
</td>
<td><?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['reg_date']),"%Y&#24180;%m&#26376;%d&#26085;");?>
</td>

<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['ban'] == 0) {?>
<button type="button" id='<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('ban_btn');?>
' onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('ban');?>
'; dispOverlay(val); } )();">凍結</button>
<?php } else { ?>
<button type="button" id='<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('ban_btn');?>
' onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('ban');?>
'; dispOverlay(val); } )();">凍結解除</button>
<?php }?>
<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('ban');?>
 class="back-overlay-off" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('ban');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="overlay-inner"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
さん<br>
</font>
<div align="center"><font size="5">
<?php if ($_smarty_tpl->tpl_vars['item']->value['ban'] == 0) {?>
のアカウントを凍結しますか？
<?php } else { ?>
のアカウントを凍結解除しますか？
<?php }?>
</font>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('ban');?>
'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
; ban_member(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td>

<?php if ($_smarty_tpl->tpl_vars['maint']->value) {?>
<td>[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=delete&action=confirm&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">削除</a>]</td>
<?php }?>
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


</tbody></table>
<?php }?>

          </td>
      </tr>
    </table>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="../js/system_list.js" async><?php echo '</script'; ?>
>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
