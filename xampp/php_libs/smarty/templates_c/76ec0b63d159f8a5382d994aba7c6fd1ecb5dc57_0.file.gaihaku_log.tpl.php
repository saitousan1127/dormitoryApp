<?php
/* Smarty version 3.1.30, created on 2023-01-25 16:10:11
  from "C:\xampp\php_libs\smarty\templates\gaihaku_log.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d0d5d3a68ca6_01824945',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76ec0b63d159f8a5382d994aba7c6fd1ecb5dc57' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\gaihaku_log.tpl',
      1 => 1674629108,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d0d5d3a68ca6_01824945 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/gaihaku_log.css">
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
件の過去に提出した外泊願が蓄積されてます<br>
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
<tr><td>　</td></tr>
<tr>
<td><label for="day">外泊日</label></td><td>：</td>
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
<tr>
<td>外泊開始日</td><td>：</td>
<td><input type="radio" name="sort" value="startA" id="startA"><label for="startA">早い順</label></td>
<td><input type="radio" name="sort" value="startD" id="startD"><label for="startD">遅い順</label></td>
</tr>
<tr>
<td>外泊期間</td><td>：</td>
<td><input type="radio" name="sort" value="betweenA" id="betweenA"><label for="betweenA">短い順</label></td>
<td><input type="radio" name="sort" value="betweenD" id="betweenD"><label for="betweenD">長い順</label></td>
</tr>
</table>

<br>
<table frame="box"rules="none" border="2" align="center">
<tr>
<td><b>フィルタ</b></td>
</tr>

<tr>
<td><label for="app_form">承認/非承認</label></td><td>：</td>
<td>
<select name="app" id="app_form">
<option value="" id="all_app">すべて</option><option value="承認" id="app">承認</option><option value="非承認" id="non_app">非承認</option>
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

<tr>
<td><label for="attend">点呼</label></td><td>：</td>
<td>
<select name="attend" id="attend">
<option  value="" id="all_attend">すべて</option><option value="まだ" id="yet">まだ</option><option value="出席" id="attended">出席済み</option><option value="未出席" id="non_attended">未出席</option>
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
"; let val2 = "<?php echo $_smarty_tpl->tpl_vars['app']->value;?>
"; let val3 = "<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
"; let val4 = "<?php echo $_smarty_tpl->tpl_vars['attend']->value;?>
"; clickSFBtn(val1,val2,val3,val4); } )();'>検索＆ソート＆フィルタ</button></div>

<?php if (($_smarty_tpl->tpl_vars['data']->value)) {
echo $_smarty_tpl->tpl_vars['links']->value;?>


<table border="1" align="center">
<tr><th>承認/非承認</th><th>相手氏名</th><th>宿泊先住所</th><th>電話番号</th><th>外泊期間</th><th>提出日時</th><th></th><th>編集</th><th>教員</th><th width="200">コメント</th><th></th></tr>

<?php echo '<?php
';
$_smarty_tpl->_assignInScope('i', 1);
?>;
<?php echo '?>';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
<!--<?php if ($_smarty_tpl->tpl_vars['i']->value == 11) {
break 1;
}?>-->

<?php if ($_smarty_tpl->tpl_vars['i']->value%2 == 0) {?>
<tr bgcolor='#fff'  id="<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
">
<?php } else { ?>
<tr bgcolor='#eee'  id="<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
">
<?php }?>

<td>
    <?php if ($_smarty_tpl->tpl_vars['item']->value['app'] === '承認') {?>
        <div style="color:red"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
      <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['app'] === '非承認') {?>
        <div style="color:blue"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['app'] === '未閲覧') {?>
      <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>

    <?php } else { ?>
       閲覧中
    <?php }?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name2'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name2'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><div align="left"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['psCode1'], ENT_QUOTES, 'UTF-8', true);?>
-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['psCode1'], ENT_QUOTES, 'UTF-8', true);?>
</div><div align="left"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['address'], ENT_QUOTES, 'UTF-8', true);?>
</div></td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['tel'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['s_day']),"%Y&#24180;%m&#26376;%d&#26085;");
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['s_time'], ENT_QUOTES, 'UTF-8', true);?>
時
～<?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['f_day']),"%m&#26376;%d&#26085;");
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['f_time'], ENT_QUOTES, 'UTF-8', true);?>
時</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><button type="button" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('overlay');?>
'; dispOverlay(val); } )();">全体表示</button>

<!--オーバーレイ全体表示-->

<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('overlay');?>
 class="back-overlay-off"  onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('overlay');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="normal-inner <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
"  onclick="clickChild();">
<div align="center"><font size="6">外泊願の全体表示</font></div>
<br>
          <table border="2" style="border-collapse: collapse" hight="1%" width="23.88%" bgcolor='#FFFFFF' id="sub" >
          <tr>
          <td bgcolor="#00f000" width="6%">提出日</td>
          <td width="15%"><div align="left"><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true),0,4);?>
年<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true),5,2);?>
月<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true),8,2);?>
日</div></td>
          </tr>
          </table>

          <table border="2" style="border-collapse: collapse" width="85%" align="center" bgcolor='#FFFFFF'>
            <tr>
              <td rowspan="2" bgcolor="#00f000" width="5%">氏名</td>
              <td align="left" rowspan="2" width="35%">
               氏：<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
　名：<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>

              </td>
              <td bgcolor="#00f000" width="15%">学年/クラス</td>
              <td bgcolor="#00f000" width="30%">棟</td>
              <td bgcolor="#00f000" width="15%">部屋番号</td>
              </tr>
              <tr>
              <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['class'], ENT_QUOTES, 'UTF-8', true);?>
</td>
              <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['tou'], ENT_QUOTES, 'UTF-8', true);?>
</td>
              <td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true),1,4);?>
号室</td>
              </tr>
            </table>

           <table border="2" style="border-collapse: collapse" width="85%" align="center" bgcolor='#FFFFFF'>
            <tr>
            <td rowspan="3" bgcolor="#00f000" width="5%">宿泊先<br>及び<br>連絡先</td>
            <td rowspan="2" bgcolor="#00f000" width="5%">宿泊先<br>住所</td>
            <td align="left" width="70%">〒<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['psCode1'], ENT_QUOTES, 'UTF-8', true);?>
-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['psCode2'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            <td rowspan="2" bgcolor="#00f000">外泊先の電話番号</td>
            </tr>
            <tr>
            <td align="left" width="70%">住所：<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['address'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            </tr>
            <tr>
            <td bgcolor="#00f000"  width="5%">相手<br>氏名等</td>
            <td align="left" width="70%">
              氏：<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name2'], ENT_QUOTES, 'UTF-8', true);?>
　名：<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name2'], ENT_QUOTES, 'UTF-8', true);?>

            </td>
            <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['tel'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            </tr>
           </table>

           <table border="2" style="border-collapse: collapse" width="85%" align="center" bgcolor='#FFFFFF'>
            <tr>
            <td bgcolor="#00f000" width="5%">日程</td>
            <td>
             <?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['s_day']),"%Y&#24180;%m&#26376;%d&#26085;");?>
　<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['s_time'], ENT_QUOTES, 'UTF-8', true);?>
時　～　
             <?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['f_day']),"%Y&#24180;%m&#26376;%d&#26085;");?>
　<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['f_time'], ENT_QUOTES, 'UTF-8', true);?>
時
            </td>
            </tr>
            </table>

            <table border="2" style="border-collapse: collapse" width="85%" height="20%" align="center" bgcolor='#FFFFFF'>
            <tr>
            <td rowspan="2" bgcolor="#00f000" width="5%">理由</td>
            <td align="left" height="20%">外泊理由：
              <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['reason'], ENT_QUOTES, 'UTF-8', true);?>

            </td>
            <td rowspan="2" width="10%">寮監印</td>
            <td rowspan="2" width="10%">
            <?php if (($_smarty_tpl->tpl_vars['item']->value['ryoukan'])) {?>
              <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['ryoukan'], ENT_QUOTES, 'UTF-8', true);?>

             <br>
             <?php if (($_smarty_tpl->tpl_vars['item']->value['app'])) {?>
             <?php if ($_smarty_tpl->tpl_vars['item']->value['app'] === '承認') {?>
              <div style="color:red"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
            <?php } else { ?>
              <div style="color:blue"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
              <?php }?>
             <?php }?>
             <?php }?>
            </td>

            <td rowspan="2" width="10%">寮務主事印<br>担当主事補印<br>又は担任印</td>
            <td rowspan="2" width="10%">
            <?php if (($_smarty_tpl->tpl_vars['item']->value['teacher'])) {?>
              <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['teacher'], ENT_QUOTES, 'UTF-8', true);?>

             <br>
             <?php if (($_smarty_tpl->tpl_vars['item']->value['app'])) {?>
             <?php if ($_smarty_tpl->tpl_vars['item']->value['app'] === '承認') {?>
              <div style="color:red"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
            <?php } else { ?>
              <div style="color:blue"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
              <?php }?>
             <?php }?>
             <?php }?>

            </td>
            </tr>
            <tr>
            <td align="left" height="80%"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['riyuu'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            </tr>
            </table>
            <br>

      <button id= "button" type=button  onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('overlay');?>
'; closeOverlay(val); } )();">Close</button>
    </div>
  </div>
</div>

</td>

<td>
<?php if ($_smarty_tpl->tpl_vars['item']->value['app'] === '未閲覧') {?>
<button type='submit' name='edit' value='<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
'>編集可能</button>
<?php } else {
if ($_smarty_tpl->tpl_vars['item']->value['app'] === '閲覧') {?>
編集不可(閲覧中)
<?php } else { ?>
編集不可
<?php }
}?>
</td>

<td><?php if (($_smarty_tpl->tpl_vars['item']->value['teacher'])) {?>
    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['teacher'], ENT_QUOTES, 'UTF-8', true);?>

    <?php } else { ?>
    <?php if (($_smarty_tpl->tpl_vars['item']->value['ryoukan'])) {?>
    <?php echo htmlspecialchars(($_smarty_tpl->tpl_vars['item']->value['ryoukan']).('(寮監)'), ENT_QUOTES, 'UTF-8', true);?>

    <?php }?>
    <?php }?></td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['comment'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td>
<?php if (smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S') < (((smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['s_day'],'%Y-%m-%d')).(' ')).($_smarty_tpl->tpl_vars['item']->value['s_time'])).(':00:00')) {?>
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('delete');?>
'; dispOverlay(val); } )();">削除</button></div>
<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('delete');?>
 class="back-overlay-off" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('delete');?>
'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
<?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['s_day'], ENT_QUOTES, 'UTF-8', true),0,10);?>
 ～ <?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['f_day'], ENT_QUOTES, 'UTF-8', true),0,10);?>
<br>
</font>
<div align="center"><font size="5">
の外泊申請を取り消しますか？
</font>
<br>
<font size="2" color="red">※削除された申請はなかったものとして扱われます．</font>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('delete');?>
'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
; clickYesBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
<?php } else { ?>
削除不可
<?php }?>
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
 type="text/javascript" src="../js/gaihaku_log.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
