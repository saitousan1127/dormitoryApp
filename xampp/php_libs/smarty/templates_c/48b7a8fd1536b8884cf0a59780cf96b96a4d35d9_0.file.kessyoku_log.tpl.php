<?php
/* Smarty version 3.1.30, created on 2023-02-22 17:17:22
  from "C:\xampp\php_libs\smarty\templates\kessyoku_log.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63f5cf92bbdd40_08317859',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '48b7a8fd1536b8884cf0a59780cf96b96a4d35d9' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\kessyoku_log.tpl',
      1 => 1677053839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63f5cf92bbdd40_08317859 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/kessyoku_log.css">
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
  <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件の欠食届が蓄積されてます<br>
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
<td><label for="sub_day">提出日</label></td><td>：</td>
<td><input type="date" name="sub_day" id="sub_day" value=<?php echo $_smarty_tpl->tpl_vars['sub_day']->value;?>
></td>
</tr>
<tr>
<td><label for="day">欠食日</label></td><td>：</td>
<td><input type="date" name="day" id="day" value=<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
></td>
</tr>
</table>

<br>
<table frame="box"rules="none" border="2" align="center">
<tr>
<td><b>ソート</b></td>
</tr>
<tr>
<td>提出日</td><td>：</td>
<td><input type="radio" name="sort" value="subA" id="subA"><label for="subA">早い順</label></td>
<td><input type="radio" name="sort" value="subD" id="subD" checked><label for="subD">遅い順</label></td>
</tr>
<!--
<tr>
<td>欠食日</td><td>：</td>
<td><input type="radio" name="sort" value="dateA" id="dateA"><label for="dateA">早い順</label></td>
<td><input type="radio" name="sort" value="dateD" id="dateD" checked><label for="dateD">遅い順</label></td>
</tr>
-->
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
<option  value="" id="all_grade">すべて</option><option value="1" id="grade_1">1</option><option value="2" id="grade_2">2</option>
<option value="3" id="grade_3">3</option><option value="4" id="grade_4">4</option><option value="5" id="grade_5">5</option>
</select>
</td>
</tr>

<tr>
<td><label for="app">状態</label></td><td>：</td>
<td>
<select name="app" id="app">
<option  value="" id="all_app">すべて</option><option value="未閲覧" id="unobserved">未閲覧</option><option value="閲覧" id="observed">閲覧</option>
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
<tr><th width="80">状態</th><th>提出日時</th><th width="200">欠食理由</th><th>開始日～終了日</th><th>自動削除モード</th><th></th><th>編集</th><th width="200">コメント</th><th></th></tr>

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
<tr bgcolor='#fff' id="<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
">
<?php } else { ?>
<tr bgcolor='#eee'  id="<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
">
<?php }?>

<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['app'] == '受理') {?>
<div style="color:red">受理</div>
<?php } elseif ($_smarty_tpl->tpl_vars['item']->value['app'] == '却下') {?>
<div style="color:blue">却下</div>
<?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>

<?php }?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true);?>
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
<td><button type="button" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('overlay');?>
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
  <tr><td>学年：</td><td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['grade'], ENT_QUOTES, 'UTF-8', true);?>
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
  <nobr>
  自動削除モード： 
  <?php if ($_smarty_tpl->tpl_vars['item']->value['auto_delete'] == 1) {?>
    <div style="color:red">ON</div>
  <?php } else { ?>
    OFF
 <?php }?>
  </nobr>     
<div align="center"><button id= "button" type=button onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('overlay');?>
'; closeOverlay(val); } )();">Close</button></div>
</div>
</div>
</div>

</td>
<td>
<?php if (smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S') < ((smarty_modifier_date_format(time(),'%Y-%m-%d')).(' ')).('13:00:00')) {
if (((smarty_modifier_date_format((time()+24*60*60*2),'%Y-%m-%d')).(' ')).('00:00:00') < $_smarty_tpl->tpl_vars[''.(('last_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value) {
if ($_smarty_tpl->tpl_vars['item']->value['app'] === '未閲覧') {?>
<button type='submit' name='edit' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
'>編集可能</button>
<?php } else {
if ($_smarty_tpl->tpl_vars['item']->value['app'] === '閲覧') {?>
編集不可(閲覧中)
<?php } else { ?>
編集不可
<?php }
}
} else { ?>
編集不可
<?php }
} else {
if (((smarty_modifier_date_format((time()+24*60*60*3),'%Y-%m-%d')).(' ')).('00:00:00') < $_smarty_tpl->tpl_vars[''.(('last_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value) {
if ($_smarty_tpl->tpl_vars['item']->value['app'] === '未閲覧') {?>
<button type='submit' name='edit' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
'>編集可能</button>
<?php } else {
if ($_smarty_tpl->tpl_vars['item']->value['app'] === '閲覧') {?>
編集不可(閲覧中)
<?php } else { ?>
編集不可
<?php }
}
} else { ?>
編集不可
<?php }
}?>

</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['comment'], ENT_QUOTES, 'UTF-8', true);?>
</td>

<td>
<?php if (smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S') < ((smarty_modifier_date_format(time(),'%Y-%m-%d')).(' ')).('13:00:00')) {
if (((smarty_modifier_date_format((time()+24*60*60*2),'%Y-%m-%d')).(' ')).('00:00:00') < $_smarty_tpl->tpl_vars[''.(('last_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value) {?>
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
'; dispOverlay(val); } )();">削除</button></div>
<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
 class="back-overlay-off" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner <?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars[''.(('first_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value, ENT_QUOTES, 'UTF-8', true),0,10);?>
 ～ <?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars[''.(('last_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value, ENT_QUOTES, 'UTF-8', true),0,10);?>
<br>
</font>
<div align="center"><font size="5">
の欠食申請を取り消しますか？
</font>
<br>
<font size="2" color="red">※1 削除された申請はなかったものとして扱われます．</font>
<br>
<font size="2" color="red">※2 今日から3日後以内の申請は削除されません．</font>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
; clickYesBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
<?php } else { ?>
削除不可
<?php }
} else {
if (((smarty_modifier_date_format((time()+24*60*60*3),'%Y-%m-%d')).(' ')).('00:00:00') < $_smarty_tpl->tpl_vars[''.(('last_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value) {?>
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
'; dispOverlay(val); } )();">削除</button></div>
<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
 class="back-overlay-off" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner <?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars[''.(('first_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value, ENT_QUOTES, 'UTF-8', true),0,10);?>
 ～ <?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars[''.(('last_day').($_smarty_tpl->tpl_vars['item']->value['group_id']))]->value, ENT_QUOTES, 'UTF-8', true),0,10);?>
<br>
</font>
<div align="center"><font size="5">
の欠食申請を取り消しますか？
</font>
<br>
<font size="2" color="red">※1 削除された申請はなかったものとして扱われます．</font>
<br>
<font size="2" color="red">※2 今日から3日後以内の申請は削除されません．</font>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['group_id']).('delete');?>
'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
; clickYesBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
<?php } else { ?>
削除不可
<?php }
}?>


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
          <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
</form>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }
echo '<script'; ?>
 type="text/javascript" src="../js/kessyoku_log.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
