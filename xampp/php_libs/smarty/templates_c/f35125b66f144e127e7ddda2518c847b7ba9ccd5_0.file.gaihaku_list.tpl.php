<?php
/* Smarty version 3.1.30, created on 2023-03-08 01:01:04
  from "C:\xampp\php_libs\smarty\templates\gaihaku_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_64075fc0166995_31046516',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f35125b66f144e127e7ddda2518c847b7ba9ccd5' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\gaihaku_list.tpl',
      1 => 1678204849,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64075fc0166995_31046516 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/gaihaku_list.css">
</head>
<body>

<div class="test">
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
  <td style="vertical-align: top;" align="left">
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
<td>
<table>
<tr>
<td><label for="name_search_key">名前</label></td><td>：</td>
<td><input type="text" name="name_search_key" id="name_search_key"  value=<?php echo $_smarty_tpl->tpl_vars['name_search_key']->value;?>
></td>
</tr>
<tr><td colspan="3"><font size='0.7'>漢字・ひらがな・カタカナで部分一致検索ができます.</font></td></tr>
<tr>
<td><label for="room_search_key">部屋番号</label></td><td>：</td>
<td><input type="text" name="room_search_key" id="room_search_key" value="<?php echo $_smarty_tpl->tpl_vars['room_search_key']->value;?>
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
<tr><td colspan="3"><font size='0.7'>　</font></td></tr>
<tr>
<td><label for="day">外泊日</label></td><td>：</td>
<td><input type="date" name="day" id="day" value=<?php echo $_smarty_tpl->tpl_vars['day']->value;?>
></td>
</tr>
</table>
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
<td>提出日</td><td>：</td>
<td><input type="radio" name="sort" value="subA" id="subA" checked><label for="subA">早い順</label></td>
<td><input type="radio" name="sort" value="subD" id="subD"><label for="subD">遅い順</label></td>
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
<?php if ($_smarty_tpl->tpl_vars['class']->value === '寮務主事' || $_smarty_tpl->tpl_vars['class']->value === '担当主事補' || $_smarty_tpl->tpl_vars['class']->value === '寮監') {?>
<tr>
<td>学年</td><td>：</td>
<td><input type="radio" name="sort" value="gradeA" id="gradeA"><label for="gradeA">低い順</label></td>
<td><input type="radio" name="sort" value="gradeD" id="gradeD"><label for="gradeB">高い順</label></td>
</td>
</tr>
<?php }?>
</table>
<br>
<table frame="box"rules="none" border="2" align="center">
<tr>
<td><b>フィルタ</b></td>
</tr>
<tr>
<?php if ($_smarty_tpl->tpl_vars['class']->value === '寮務主事' || $_smarty_tpl->tpl_vars['class']->value === '担当主事補' || $_smarty_tpl->tpl_vars['class2']->value === '寮監') {?>
<td><label for="class">クラス</label></td><td>：</td>
<td>
<select name="spe_class" id="class">
<option value="" id="all_class" selected>すべて</option><option value="1-1" id="1-1">1-1</option><option value="1-2" id="1-2">1-2</option><option value="1-3" id="1-3">1-3</option>
<option value="IS2" id="IS2">IS2</option><option value="IT2" id="IT2">IT2</option><option value="IE2" id="IE2">IE2</option>
<option value="IS3" id="IS3">IS3</option><option value="IT3" id="IT3">IT3</option><option value="IE3" id="IE3">IE3</option>
<option value="IS4" id="IS4">IS4</option><option value="IT4" id="IT4">IT4</option><option value="IE4" id="IE4">IE4</option>
<option value="IS5" id="IS5">IS5</option><option value="IT5" id="IT5">IT5</option><option value="IE5" id="IE5">IE5</option>
</select>
</td>

<?php } elseif ($_smarty_tpl->tpl_vars['class']->value === '1年主任') {?>
<td><label for="class">クラス</label></td><td>：</td>
<td>
<select name="spe_class" id="class">
<option id="all_class" value="" selected>１学年すべて</option><option value="1-1" id="1-1">1-1</option><option value="1-2" id="1-2">1-2</option><option value="1-3" id="1-3">1-3</option>
</select>
</td>

<?php } elseif ($_smarty_tpl->tpl_vars['class']->value === '2年主任') {?>
<td><label for="class">クラス</label></td><td>：</td>
<td>
<select name="spe_class" id="class">
<option id="all_class" value="" selected>２学年すべて</option><option value="IS2" id="IS2">IS2</option><option value="IT2" id="IT2">IT2</option><option value="IE2" id="IE2">IE2</option>
</select>
</td>

<?php } elseif ($_smarty_tpl->tpl_vars['class']->value === '3年主任') {?>
<td><label for="class">クラス</label></td><td>：</td>
<td>
<select name="spe_class" id="class">
<option id="all_class" value="" selected>３学年すべて</option><option value="IS3" id="IS3">IS3</option><option value="IT3" id="IT3">IT3</option><option value="IE3" id="IE3">IE3</option>
</select>
</td>

<?php } elseif ($_smarty_tpl->tpl_vars['class']->value === '4年主任') {?>
<td><label for="class">クラス</label></td><td>：</td>
<td>
<select name="spe_class" id="class">
<option id="all_class" value="" selected>４学年すべて</option><option value="IS4" id="IS4">IS4</option><option value="IT4" id="IT4">IT4</option><option value="IE4" id="IE4">IE4</option>
</select>
</td>

<?php } elseif ($_smarty_tpl->tpl_vars['class']->value === '5年主任') {?>
<td><label for="class">クラス</label></td><td>：</td>
<td>
<select name="spe_class" id="class">
<option id="all_class" value="" selected>５学年すべて</option><option value="IS5" id="IS5">IS5</option><option value="IT5" id="IT5">IT5</option><option value="IE5" id="IE5">IE5</option>
</select>
</td>

<?php } else { ?>
<td>クラス</td><td>：</td>
<td>
<?php if ($_smarty_tpl->tpl_vars['class']->value != "その他") {
echo $_smarty_tpl->tpl_vars['class']->value;?>

<?php } else { ?>
　
<?php }?>
</td>
<?php }?>
</tr>
<tr>
<td><label for="tou">棟</label></td><td>：</td>
<td>
<select name="tou" id="tou">
<option value="" id="all_tou" selected>すべて</option><option value="N" id="north">北寮</option><option value="E" id="east">女子寮</option><option value="S" id="south">南寮</option>
</select>
</td>
</tr>
<tr>
<td><label for="floor">階</label></td><td>：</td>
<td>
<select name="floor" id="floor">
<option  value="" id="all_floor" selected>すべて</option><option value="2" id="floor2">2</option><option value="3" id="floor3">3</option><option value="4" id="floor4">4</option><option value="5" id="floor5">5</option>
</select>
</td>
</tr>
</table>
<br>
<div align="center"><input type='submit' name='submit2' id='exe' value="実行"></div>
</div>
</div>
</div>
<div align="right"><button type="button" id="sf-button" onclick='(function() { let val1 = "<?php echo $_smarty_tpl->tpl_vars['sort']->value;?>
"; let val2 = "<?php echo $_smarty_tpl->tpl_vars['spe_class']->value;?>
"; let val3 = "<?php echo $_smarty_tpl->tpl_vars['tou']->value;?>
"; let val4 = "<?php echo $_smarty_tpl->tpl_vars['floor']->value;?>
"; clickSFBtn(val1,val2,val3,val4); } )();'>検索＆ソート＆フィルタ</button></div>
<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件の外泊願が提出されています。<br>
<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>

<table align="center" width="90%">
<tr>
<td>
<div></div>
<br>
<br>
<?php echo $_smarty_tpl->tpl_vars['links']->value;?>
<br>
<div align="sent" id="error2" style="color:red;"></div>
</td>
</tr>
<tr>
<td width="50%">
<div align="left"><input type='submit' name='submit' value="まとめて送信" onClick='return check();'></div>
</td>
</tr>
</table>
<!--リスト-->
<div align="center" id="error2" style="color:red; font-size: smaller;"></div>
<table border="1" align="center">
<tr><th>外泊願ID</th><th>承認/非承認</th><th>氏名</th><th>学年/クラス</th><th>棟</th><th>部屋番号</th><th>外泊期間</th><th>提出日時</th><th></th><th>コメント</th><th></th></tr>
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
<tr bgcolor='#fff' id="<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
">
<?php } else { ?>
<tr bgcolor='#eee'  id="<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
">
<?php }?>
<td><?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
</td>
<td><input type="button" value="承認or非承認" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
" onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
; clickAppBtn(val); } )();">
    <input type="hidden" value=<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
 name = "gaihaku_id[]">
    <input type="hidden" value="承認or非承認" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
 Apps" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('app');?>
" name = "<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('app');?>
">
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['class'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['tou'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo substr(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true),1,4);?>
</td>
<td><?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['s_day']),"%Y&#24180;%m&#26376;%d&#26085;");
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['s_time'], ENT_QUOTES, 'UTF-8', true);?>
時
～<?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['f_day']),"%Y&#24180;%m&#26376;%d&#26085;");
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['f_time'], ENT_QUOTES, 'UTF-8', true);?>
時</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><button type="button" onclick="(function() { let val = '<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('overlay');?>
'; dispOverlay(val); } )();">全体表示</button></td>
<td><input type="text" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('text1');?>
" class='Comments' name="<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('text');?>
" size=40 placeholder="承認の場合は任意です"></td>
<td><button type="button" bgcolor="" onclick='(function() { let val1 = "<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
"; val2 = "<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
"; clickSendBtn(val1,val2); } )();'>一件だけ送信</button>

<!--全体表示-->
<div id=<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('overlay');?>
 class="back-overlay-off" onclick="(function() { let val = '<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
'; clickClose(val); } )();">
<div class="flex">
<div class="overlay-inner <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
" onclick="clickChild();">
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
            <td rowspan="2" width="10%">寮監印</td><td rowspan="2" width="10%"></td>
            <td rowspan="2" width="10%">寮務主事印<br>担当主事補印<br>又は担任印</td><td rowspan="2" width="10%"></td>
            </tr>
            <tr>
            <td align="left" height="80%"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['riyuu'], ENT_QUOTES, 'UTF-8', true);?>
</td>
            </tr>
            </table>
            <div align="center" id='<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('error');?>
' style="color:red; font-size: smaller;"><br></div>
            <input type="button" value="承認or非承認" class="<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
" onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
; clickAppBtn(val); } )();">
            <input type="text" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('text2');?>
" name="<?php echo ($_smarty_tpl->tpl_vars['item']->value['gaihaku_id']).('text2');?>
" size=40 placeholder="承認の場合は任意です">
            <button type="button" bgcolor="" onclick='(function() { let val1 = <?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
; val2 = "<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
"; clickSendBtnInOverlay(val1,val2); } )();'>一件だけ送信</button>
            <br>
            <br>
      <button id= "button" type=button onclick="(function() { let val = '<?php echo $_smarty_tpl->tpl_vars['item']->value['gaihaku_id'];?>
'; clickClose(val); } )();">Close</button>
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
<input type="hidden" name="i" value=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
>
<?php }?>
          <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
          <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
</form>
</div>


<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }
echo '<script'; ?>
 type="text/javascript" src="../js/gaihaku_list.js" async><?php echo '</script'; ?>
>
</div>
</body>
</html><?php }
}
