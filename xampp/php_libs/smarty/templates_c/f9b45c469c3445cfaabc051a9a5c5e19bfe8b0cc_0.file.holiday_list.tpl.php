<?php
/* Smarty version 3.1.30, created on 2023-02-13 15:42:31
  from "C:\xampp\php_libs\smarty\templates\holiday_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63e9dbd721db04_03465617',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9b45c469c3445cfaabc051a9a5c5e19bfe8b0cc' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\holiday_list.tpl',
      1 => 1676270546,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63e9dbd721db04_03465617 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/holiday_list.css">
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
  </tr>
</table>

 <div align="center"> 
  <br>
  <br>
  日付：<input type='date' name='holiday[date]' id='date' min="<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
"> 祝日名：<input type='text' name='holiday[name]' id='name'> 
  <input type='submit' name='submit' value='追加' onClick='return check();'>
  <div id="error" style="color:red; font-size: smaller;" align="center"></div>
  <br>
  <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件の祝日が登録されています<br>
  <font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font>
  </div>

<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>

<table border="1" align="center">
<tr><th>年</th><th>月</th><th>日</th><th>祝日名</th><th></th></tr>

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
<tr bgcolor='#fff' id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
">
<?php } else { ?>
<tr bgcolor='#eee' id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
">
<?php }?>

<td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['date'], ENT_QUOTES, 'UTF-8', true),0,4);?>
</td>
<td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['date'], ENT_QUOTES, 'UTF-8', true),5,2);?>
</td>
<td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['date'], ENT_QUOTES, 'UTF-8', true),8,2);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td>
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('delete');?>
'; dispOverlay(val); } )();">削除</button></div>
<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('delete');?>
 class="back-overlay-off" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('delete');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<div align="center">
<font size="6">
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

</font>
<font size="5">
(<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['date'], ENT_QUOTES, 'UTF-8', true),0,4);?>
年<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['date'], ENT_QUOTES, 'UTF-8', true),5,2);?>
月<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['date'], ENT_QUOTES, 'UTF-8', true),8,2);?>
日)<br>
を削除しますか？
</font>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['id']).('delete');?>
'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
; clickYesBtn(val); } )();'>はい</button></td>
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


<?php }?>
</table>
          <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
          <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
</form>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }
echo '<script'; ?>
 type="text/javascript" src="../js/holiday_list.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
