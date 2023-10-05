<?php
/* Smarty version 3.1.30, created on 2023-02-23 19:08:11
  from "C:\xampp\php_libs\smarty\templates\tenko_result.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63f73b0bafd628_64156694',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d4452f999fda4a7e9bfcb956af2d2f1b196359b' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\tenko_result.tpl',
      1 => 1677146888,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f73b0bafd628_64156694 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/tenko_result.css">
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
  <td style="vertical-align: top;">
	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]
  </td>

  <td align="center"> 
  <br>
  <br>
  点呼に応じていない寮生が<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
人います<br>
  <font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font>
  </td>
  </tr>
</table>

<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>

<table border="1" align="center">
<tr><th>学年/クラス</th><th>氏名</th><th>フリガナ</th><th>部屋番号</th><th></th></tr>

<?php echo '<?php
';
$_smarty_tpl->_assignInScope('i', 1);
?>;
<?php echo '?>';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>

<?php if ($_smarty_tpl->tpl_vars['i']->value%2 == 0) {?>
<tr bgcolor='#fff'  id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
<?php } else { ?>
<tr bgcolor='#eee'  id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
<?php }?>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['class'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['k_last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['k_first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td>
<?php if (substr($_smarty_tpl->tpl_vars['item']->value['roomnum'],0,1) == 'N') {
echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true),0,5);?>
号室
<?php } else {
echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true),0,4);?>
号室
<?php }?>
</td>
<td>
<button type="button" class="attend_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('attend');?>
'; dispOverlay(val); } )();">出席</button>
<div id='<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('attend');?>
' class="back-overlay-off" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('attend');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
<br>
</font>
<div align="center"><font size="5">
さんが寮にいることが確認できましたか？
</font>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('attend');?>
'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
; clickAttendBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td>

</tr>
<?php echo '<?php
';
echo $_smarty_tpl->tpl_vars['i']->value++;?>
;
<?php echo '?>';
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>
<br><br>
<button type="button" onclick="send_mail();">点呼欠席者にメールを送る</button>
<div style="color:red;" id='sent'><br></div>
<br>
<button type="button" class="attend_btn" onclick="dispOverlay('determine');">点呼欠席者を確定する</button>
<div id='determine' class="back-overlay-off" onclick="closeOverlay('determine');">
<div class="flex">
<div class="yn-overlay-inner"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
リストに表示されている寮生を点呼欠席者として登録しますか？<br>
</font>
<div style="color:red; font-size: smaller;">※後から変更することができません</div><br>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('determine');">いいえ</button></td>
<td>　</td>
<td><input type='submit' name='submit' value='登録する' class='yes_btn'></td>
</tr>
</table>
</div>
</div>
</div>
<br>
(その日のうちに確定してください．)
<?php }?>
          <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
          <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
          <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
</form>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }
echo '<script'; ?>
 type="text/javascript" src="../js/tenko_result.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
