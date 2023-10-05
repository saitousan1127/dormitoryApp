<?php
/* Smarty version 3.1.30, created on 2023-01-25 16:32:21
  from "C:\xampp\php_libs\smarty\templates\kessyoku_app_log.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d0db0574cf39_24250287',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6b2f9d9fc98794cd414925b34bd2439751fe282' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\kessyoku_app_log.tpl',
      1 => 1674631937,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d0db0574cf39_24250287 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/kessyoku_app_log.css">
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
  未処理の欠食届が<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件蓄積されています．<br>
  <font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font>
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

<td>
<table>
<tr>
<td><label for="name_search_key">名前</label></td><td>：</td>
<td><input type="text" name="name_search_key" id="name_search_key" size="15" value=<?php echo $_smarty_tpl->tpl_vars['name_search_key']->value;?>
></td>
</tr>
<tr><td colspan="3"><font size='0.7'>漢字・ひらがな・カタカナで部分一致検索ができます.</font></td></tr>
</table>
</td>

<td>
<table>
<tr>
<td><label for="sub_day">提出日</label></td><td>：</td>
<td><input type="date" name="sub_day" id="sub_day" value=<?php echo $_smarty_tpl->tpl_vars['sub_day']->value;?>
></td>
</tr>
<tr>
<td><label for="app_day">処理した日</label></td><td>：</td>
<td><input type="date" name="app_day" id="app_day" value=<?php echo $_smarty_tpl->tpl_vars['app_day']->value;?>
></td>
</tr>
</table>
</td>
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
<td><input type="radio" name="sort" value="subA" id="subA"><label for="subA">早い順</label></td>
<td><input type="radio" name="sort" value="subD" id="subD"><label for="subD">遅い順</label></td>
</tr>
<tr>
<td>処理した日</td><td>：</td>
<td><input type="radio" name="sort" value="appA" id="appA"><label for="appA">早い順</label></td>
<td><input type="radio" name="sort" value="appD" id="appD" checked><label for="appD">遅い順</label></td>
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
<td><label for="app">受理/却下</label></td><td>：</td>
<td>
<select name="app" id="app">
<option  value="" id="all_app">すべて</option>
<option value="受理" id="accept">受理</option><option value="却下" id="reject">却下</option>
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

<tr>
<td><label for="comment">コメント</label></td><td>：</td>
<td>
<select name="comment" id="comment">
<option  value="" id="all_comment">すべて</option><option value="with_comment" id="with_comment">コメントあり</option><option value="without_comment" id="without_comment">コメントなし</option>
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
"; let val3 = "<?php echo $_smarty_tpl->tpl_vars['app']->value;?>
"; let val4 = "<?php echo $_smarty_tpl->tpl_vars['reason']->value;?>
"; let val5 = "<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
"; clickSFBtn(val1,val2,val3,val4,val5); } )();'>検索＆ソート＆フィルタ</button></div>


<?php if (($_smarty_tpl->tpl_vars['groups']->value)) {
echo $_smarty_tpl->tpl_vars['links']->value;?>

<table border="1" align="center">
<tr><th width="80">受理/却下</th><th>提出日時</th><th>学年</th><th>氏名</th><th width="200">欠食理由</th><th>開始日～終了日</th><th></th><th>処理日</th><th  width="200">コメント</th></tr>

<?php echo '<?php
';
$_smarty_tpl->_assignInScope('i', 1);
?>;
<?php echo '?>';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
<!--<?php if ($_smarty_tpl->tpl_vars['i']->value == 11) {
break 1;
}?>-->

<?php if ($_smarty_tpl->tpl_vars['i']->value%2 == 0) {?>
<tr bgcolor='#fff'>
<?php } else { ?>
<tr bgcolor='#eee'>
<?php }?>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</td>
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
  <br>
<div align="center"><button id= "button" type=button onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('overlay');?>
'; closeOverlay(val); } )();">Close</button></div>
</div>
</div>
</div>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['comment'], ENT_QUOTES, 'UTF-8', true);?>
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
 type="text/javascript" src="../js/kessyoku_app_log.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
