<?php
/* Smarty version 3.1.30, created on 2023-03-08 00:38:13
  from "C:\xampp\php_libs\smarty\templates\gaihaku_app_log.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_64075a6533d722_67219758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c53b83aa7ba01d5a1fd4c047c80dcfbfe4e8c10' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\gaihaku_app_log.tpl',
      1 => 1678203302,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64075a6533d722_67219758 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/gaihaku_app_log.css">
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
件の<?php echo $_smarty_tpl->tpl_vars['teacher']->value;?>
さんが処理した外泊願が蓄積されてます<br>
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
<td><b><div align="left">検索</div></b></td>
</tr>
<tr>

<td>
<table>
<tr>
<td><label for="name_search_key">名前</label></td><td>：</td>
<td><input type="text" name="name_search_key" id="name_search_key" size="10" value=<?php echo $_smarty_tpl->tpl_vars['name_search_key']->value;?>
></td>
</tr>
<tr><td colspan="3"><font size='0.7'>漢字・ひらがな・カタカナで部分一致検索ができます.</font></td></tr>
<tr>
<td><label for="room_search_key">部屋番号</label></td><td>：</td></label>
<td><input type="text" name="room_search_key" id="room_search_key" size="10" value="<?php echo $_smarty_tpl->tpl_vars['room_search_key']->value;?>
" oninput="formCheck();"></td>
</tr>
<tr><td colspan="3"><div id="error"></div></td></tr>
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
<td><label for="day">外泊日</label></td><td>：</td>
<td><input type="date" name="day" id="day" value=<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
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
<td><b><div align="left">ソート</div></b></td>
</tr>
<tr>

<td>
<table>
<tr>
<td>名前</td><td>：</td>
<td><input type="radio" name="sort" value="nameA" id="nameA"><label for="nameA">AtoZ</td>
<td><input type="radio" name="sort" value="nameD" id="nameD"><label for="nameD">ZtoA</td><td>　</td>
</tr>
<tr>
<td>外泊開始日</td><td>：</td>
<td><input type="radio" name="sort" value="startA" id="startA"><label for="startA">早い順</td>
<td><input type="radio" name="sort" value="startD" id="startD"><label for="startD">遅い順</td><td>　</td>
</tr>
<tr>
<td>提出日</td><td>：</td>
<td><input type="radio" name="sort" value="subA" id="subA" checked><label for="subA">早い順</td>
<td><input type="radio" name="sort" value="subD" id="subD"><label for="subD">遅い順</td><td>　</td>
</tr>
</table>
</td>

<td>
<table>
<?php if ($_smarty_tpl->tpl_vars['class']->value === '寮務主事' || $_smarty_tpl->tpl_vars['class']->value === '担当主事補' || $_smarty_tpl->tpl_vars['class']->value === '寮監') {?>
<tr>
<td>学年</td><td>：</td>
<td><input type="radio" name="sort" value="gradeA" id="gradeA"><label for="gradeA">低い順</td>
<td><input type="radio" name="sort" value="gradeD" id="gradeD"><label for="gradeB">高い順</td><td>　</td>
</tr>
<?php }?>
<tr>
<td>外泊期間</td><td>：</td>
<td><input type="radio" name="sort" value="betweenA" id="betweenA"><label for="betweenA">短い順</td>
<td><input type="radio" name="sort" value="betweenD" id="betweenD"><label for="betweenD">長い順</td><td>　</td>
</tr>
<tr>
<td>処理した日</td><td>：</td>
<td><input type="radio" name="sort" value="processA" id="processA"><label for="processA">早い順</td>
<td><input type="radio" name="sort" value="processD" id="processD"><label for="processD">遅い順</td><td>　</td>
</tr>
</table>
</td>
</tr>
</table>

<br>
<table frame="box"rules="none" border="2" align="center">
<tr>
<td><b><div align="left">フィルタ</div></b></td>
</tr>

<tr>
<td>

<table>
<tr>
<td><label for="class">学年/クラス</label></td><td>：</td>
<td>
<select name="spe_class" id="class">
<option value="" id="all_class" value="" selected>すべて</option>
<option value="1-1" id="1-1">1-1</option><option value="1-2" id="1-2">1-2</option><option value="1-3" id="1-3">1-3</option>
<option value="IS2" id="IS2">IS2</option><option value="IT2" id="IT2">IT2</option><option value="IE2" id="IE2">IE2</option>
<option value="IS3" id="IS3">IS3</option><option value="IT3" id="IT3">IT3</option><option value="IE3" id="IE3">IE3</option>
<option value="IS4" id="IS4">IS4</option><option value="IT4" id="IT4">IT4</option><option value="IE4" id="IE4">IE4</option>
<option value="IS5" id="IS5">IS5</option><option value="IT5" id="IT5">IT5</option><option value="IE5" id="IE5">IE5</option>
</select>
</td>
</tr>
<tr>
<td><label for="tou">棟</label></td><td>：</td>
<td>
<select name="tou" id="tou">
<option value="" id="all_tou" selected>すべて</option><option value="N" id="north">北寮</option><option value="女子寮" id="E">女子寮</option><option value="南寮" id="S">南寮</option>
</select>
</td>
</tr>
<tr>
<td><label for="floor">階</label></td><td>：</td>
<td>
<select name="floor" id="floor">
<option  value="" id="all_floor" selected>すべて</option><option value="2" id="floor2">2</option><option value="3" id="floor3">3</option><option value="4" id="floor4">4</option><option value="5"  id="floor5">5</option>
</select>
</td>
</tr>
</table>
</td>
<td>
<table>
<tr>
<td><label for="app_form">承認/非承認</label></td><td>：</td>
<td>
<select name="app" id="app_form">
<option value="" id="all_app" selected>すべて</option><option value="承認" id="app">承認</option><option value="非承認" id="non_app">非承認</option>
</select>
</td>
</tr>
<tr>
<td><label for="comment">コメント</label></td><td>：</td>
<td>
<select name="comment" id="comment">
<option  value="" id="all_comment" selected>すべて</option><option value="with_comment" id="with_comment">コメントあり</option><option value="without_comment" id="without_comment">コメントなし</option>
</select>
</td>
</tr>
<tr>
<td><label for="attend">点呼</label></td><td>：</td>
<td>
<select name="attend" id="attend">
<option  value="" id="all_attend" selected>すべて</option><option value="まだ" id="yet">まだ</option><option value="出席" id="attended">出席済み</option><option value="未出席" id="non_attended">未出席</option>
</select>
</td>
</tr>
</table>

</td>
</tr>
</table>

<br>
<div align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit2']['html'];?>
</div>
</div>
</div>
</div>
<div align="right"><button type="button" id="sf-button" onclick='(function() { let val1 = "<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
"; let val2 ="<?php echo $_smarty_tpl->tpl_vars['spe_class']->value;?>
"; let val3="<?php echo $_smarty_tpl->tpl_vars['tou']->value;?>
"; let val4="<?php echo $_smarty_tpl->tpl_vars['floor']->value;?>
"; let val5="<?php echo $_smarty_tpl->tpl_vars['app']->value;?>
"; let val6="<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
"; let val7="<?php echo $_smarty_tpl->tpl_vars['attend']->value;?>
"; clickSFBtn(val1,val2,val3,val4,val5,val6,val7); } )();'>検索＆ソート＆フィルタ</button></div>


<?php if (($_smarty_tpl->tpl_vars['data']->value)) {
echo $_smarty_tpl->tpl_vars['links']->value;?>


<table border="1" align="center">
<tr><th>承認/非承認</th><th>クラス</th><th>寮生氏名</th><th>棟</th><th>部屋番号</th><th>相手氏名</th><th>宿泊先住所</th><th>電話番号</th><th>外泊期間</th><th>提出日時</th><th></th><th width="200">コメント</th></tr>

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
<tr bgcolor='#fff'>
<?php } else { ?>
<tr bgcolor='#eee'>
<?php }?>

<td>
    <?php if ($_smarty_tpl->tpl_vars['item']->value['app'] === '承認') {?>
        <div style="color:red"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
      <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['app'] === '非承認') {?>
        <div style="color:blue"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>
</div>
      <?php } else { ?>
      <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['app'], ENT_QUOTES, 'UTF-8', true);?>

    <?php }?>
    </td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['class'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['tou'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true),1,4);?>
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
<td><button type="button" onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
; dispEntire(val); } )();">全体表示</button>

<!--オーバーレイ全体表示-->

<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('overlay');?>
 class="back-overlay-off" onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
; clickClose(val); } )();">
<div class="flex">
<div class="normal-inner <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
">
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

      <button id= "button" type=button  onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
; clickClose(val); } )();">Close</button>
    </div>
  </div>
</div>

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
          <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
</form>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }
echo '<script'; ?>
 type="text/javascript" src="../js/gaihaku_app_log.js" async><?php echo '</script'; ?>
>
</body>
</html><?php }
}
