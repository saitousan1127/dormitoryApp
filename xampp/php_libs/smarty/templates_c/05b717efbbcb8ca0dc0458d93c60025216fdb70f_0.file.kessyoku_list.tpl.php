<?php
/* Smarty version 3.1.30, created on 2023-02-23 07:42:20
  from "C:\xampp\php_libs\smarty\templates\kessyoku_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63f69a4cc93d06_61473936',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05b717efbbcb8ca0dc0458d93c60025216fdb70f' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\kessyoku_list.tpl',
      1 => 1677105734,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f69a4cc93d06_61473936 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/kessyoku_list.css">
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

<!--検索＆ソート＆フィルタ-->
<div id="sf" class="back-overlay-off" onclick="clickSFClose();">
<div class="flex">
<div class="sf-overlay-inner" onclick="clickChild();">
<div align="left"><button id= "button" type=button onclick="clickSFClose();">Close</button></div>
<br>
<table  frame="box"rules="none" border="2" align="center">
<tr>
<td><b>検索</b></td>
</tr>
<tr>
<td><label for="name_search_key">名前</label></td><td>：</td>
<td><input type="text" name="name_search_key" id="name_search_key" size="15" value=<?php echo $_smarty_tpl->tpl_vars['name_search_key']->value;?>
></td>
</tr>
<tr><td colspan="3"><font size='0.7'>漢字・ひらがな・カタカナで部分一致検索ができます.</font></td></tr>
<tr>
<td><label for="sub_day">提出日</label></td><td>：</td>
<td><input type="date" name="sub_day" id="sub_day" value=<?php echo $_smarty_tpl->tpl_vars['sub_day']->value;?>
></td>
</tr>
</table>

<br>
<table frame="box"rules="none" border="2" align="center">
<tr>
<td><b>ソート</b></td>
</tr>
<tr>
<td>名前</td><td>：</td>
<td><input type="radio" name="sort" value="nameA" id="nameA"><label for="nameA">AtoZ</label></td>
<td><input type="radio" name="sort" value="nameD" id="nameD"><label for="nameD">ZtoA</label></td>
</tr>
<tr>
<td>学年</td><td>：</td>
<td><input type="radio" name="sort" value="gradeA" id="gradeA"><label for="gradeA">低い順</label></td>
<td><input type="radio" name="sort" value="gradeD" id="gradeD"><label for="gradeB">高い順</label></td>
</td>
</tr>
<tr>
<td>提出日</td><td>：</td>
<td><input type="radio" name="sort" value="subA" id="subA" checked><label for="subA">早い順</label></td>
<td><input type="radio" name="sort" value="subD" id="subD"><label for="subD">遅い順</label></td>
</tr>
</table>

<br>
<table frame="box"rules="none" border="2" align="center">
<tr>
<td><b>フィルタ</b></td>
</tr>

<tr>
<td><label for="grade">学年</label></td><td>：</td>
<td>
<select name="grade" id="grade">
<option  value="" id="all_grade">すべて</option><option value="grade_1" id="grade_1">1</option><option value="grade_2" id="grade_2">2</option>
<option value="grade_3" id="grade_3">3</option><option value="grade_4" id="grade_4">4</option><option value="grade_5" id="grade_5">5</option>
</select>
</td>
</tr>

<tr>
<td><label for="reason">欠食理由</label></td><td>：</td>
<td>
<select name="reason" id="reason">
<option  value="" id="all_reason">すべて</option><option value="kisei" id="kisei">帰省</option><option value="not_kisei" id="not_kisei">帰省以外</option>
</select>
</td>
</tr>

</table>
<br>
<div align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</div>
</div>
</div>
</div>
<div align="right"><button type="button" id="sf-button" onclick='(function() { let val1 = "<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
"; let val2 = "<?php echo $_smarty_tpl->tpl_vars['grade']->value;?>
"; let val3 = "<?php echo $_smarty_tpl->tpl_vars['reason']->value;?>
"; clickSFBtn(val1,val2,val3); } )();'>検索＆ソート＆フィルタ</button></div>

未処理の欠食届が<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件蓄積されています．<br>
<?php if (($_smarty_tpl->tpl_vars['groups']->value)) {?>
<font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font>
<br>
<?php echo $_smarty_tpl->tpl_vars['links']->value;?>

<div align="center" id="error" style="color:red; font-size: smaller;"></div>

<table border="1" align="center">
<tr><th>提出日時</th><th>学年</th><th>氏名</th><th width="200">欠食理由</th><th>開始日～終了日</th><th>自動削除モード</th><th></th></tr>

<?php echo '<?php
';
$_smarty_tpl->_assignInScope('i', 1);
?>;
<?php echo '?>';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>


<?php if ($_smarty_tpl->tpl_vars['i']->value%2 == 0) {?>
<tr bgcolor='#fff' id="<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
">
<?php } else { ?>
<tr bgcolor='#eee'  id="<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
">
<?php }?>

<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['grade'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['reason'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars[''.(('first_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value, ENT_QUOTES, 'UTF-8', true),0,10);?>
 ～ <?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars[''.(('last_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value, ENT_QUOTES, 'UTF-8', true),0,10);?>
</td>
<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['auto_delete'] == 1) {?>
<div style="color:red">ON</div>
<?php } else { ?>
OFF
<?php }?>
</td>
<td>
<button type="button" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('overlay');?>
'; dispOverlay(val); } )();">全体表示</button>
<!--オーバーレイ全体表示-->
<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('overlay');?>
 class="back-overlay-off" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('overlay');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="normal-inner <?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
"  onclick="clickChild();">
<div align="center"><font size="6">欠食届の全体表示</font></div>
  <table align="center">
  <tr><td>提出日：</td><td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true);?>
</td></tr>
  <tr><td>学年：<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['grade'], ENT_QUOTES, 'UTF-8', true);?>
</td><td>氏名：<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td></tr>
   <tr><td>欠食理由：</td><td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['reason'], ENT_QUOTES, 'UTF-8', true);?>
</td></tr>
  </table>
  <table align="center">
  <tr>
    <td>
    <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
      <tr><td>　　</td><tr>
      <tr><td>朝食</td></tr>
      <tr><td>昼食</td></tr>
      <tr><td>夕食</td></tr>
    </table>
    </td>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars[''.(("table").($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value, 'record');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['record']->value) {
?>
    <td>
    <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
      <tr><td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['record']->value['date'], ENT_QUOTES, 'UTF-8', true),0,10);?>
</td><tr>
      <tr><td>
      <?php if ($_smarty_tpl->tpl_vars['record']->value['bre']) {?>
      〇
      <?php } else { ?>
      　
      <?php }?>
      </td></tr>
      <tr><td>
      <?php if ($_smarty_tpl->tpl_vars['record']->value['lun']) {?>
      〇
      <?php } else { ?>
      　
      <?php }?>
      </td></tr>
      <tr><td>
      <?php if ($_smarty_tpl->tpl_vars['record']->value['din']) {?>
      〇
      <?php } else { ?>
      　
      <?php }?>
      </td></tr>
    </table>
    </td>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

  </tr>
  </table>
  自動削除モード：
  <?php if ($_smarty_tpl->tpl_vars['item']->value['auto_delete'] == 1) {?>
    <div style="color:red">ON</div>
  <?php } else { ?>
    OFF
  <?php }?>
  <div align="center" id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('error');?>
 style="color:red; font-size: smaller;"><br></div>
  <input type="button" value="受理or却下" id="app_btn" class=<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
 onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
; clickAppBtn(val); } )();">
  <input type="text" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('text');?>
" size=40 placeholder="受理の場合は任意です">
  <button type="button" bgcolor="" onclick='(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
; clickSendBtn(val); } )();'>送信</button>
  <br><div align="center" style="color:red; font-size: smaller;">自動削除モードが設定されている欠食届は先に削除されている可能性があります．</div>
  <br>
<div align="center"><button id= "button" type=button onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('overlay');?>
'; closeOverlay(val); } )();">Close</button></div>
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
          <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
</form>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }
echo '<script'; ?>
 type="text/javascript" src="../js/kessyoku_list.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
