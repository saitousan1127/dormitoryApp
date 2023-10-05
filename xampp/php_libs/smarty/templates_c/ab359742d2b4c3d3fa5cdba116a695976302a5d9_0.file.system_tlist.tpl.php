<?php
/* Smarty version 3.1.30, created on 2023-01-26 17:21:13
  from "C:\xampp\php_libs\smarty\templates\system_tlist.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d237f91d4bc3_26604972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ab359742d2b4c3d3fa5cdba116a695976302a5d9' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\system_tlist.tpl',
      1 => 1674719565,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d237f91d4bc3_26604972 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
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
<link rel="stylesheet" href="../css/system_tlist.css">
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
        <p>[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tregist&action=form<?php echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">新規登録</a> ]
<br>

<form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
名前：<input type="text" name="search_key" value="<?php echo $_smarty_tpl->tpl_vars['search_key']->value;?>
">
<input type="submit" name="submit" value="検索する">
<input type="hidden" name="type" value="tlist">
</form>



検索結果は<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件です。<br>
<br>
<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>

<?php if ($_smarty_tpl->tpl_vars['maint']->value) {?>
<button type="button" onclick="dispOverlay('call_off_ryoukan');">寮監取り消し</button>
<div id='call_off_ryoukan' class="back-overlay-off" onclick="closeOverlay('call_off_ryoukan');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="6">
現在の寮監設定を取り消しますか？<br>
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('call_off_ryoukan');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='call_off_ryoukan();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
　　　
<button type="button" onclick="dispOverlay2('call_off_class');">教員とクラスの紐づけを解除</button>
<div id='call_off_class' class="back-overlay-off" onclick="closeOverlay('call_off_class');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="5">
教員に設定されているクラス情報を<br>すべて削除しますか？<br>
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('call_off_class');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='call_off_class();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
<?php }?>

<br><br>

<table border="1">
<tbody>
<tr><th>ID</th><th>氏</th><th>名</th><th>氏(フリガナ)</th><th>名(フリガナ)</th><th>担任の学年/クラス</th><th>登録日</th><th>　</th><?php if ($_smarty_tpl->tpl_vars['maint']->value) {?><th>　</th><th>　</th><?php }?><th>寮監</tr>

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
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['class'], ENT_QUOTES, 'UTF-8', true);?>
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
<div class="yn-overlay-inner"  onclick="clickChild();">
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
; ban_teacher(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td>

<?php if ($_smarty_tpl->tpl_vars['maint']->value) {?>
<td>[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tmodify&action=form&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">更新</a>]</td>
<td>[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=tdelete&action=confirm&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">削除</a>]</td>
<?php }?>
<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['id'] == $_smarty_tpl->tpl_vars['ryoukan_id']->value) {?>
<font color="red">寮監</font>
<?php } else { ?>
　
<?php }?>
</td>
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
<?php echo '<script'; ?>
 type="text/javascript" src="../js/system_tlist.js" async><?php echo '</script'; ?>
>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
