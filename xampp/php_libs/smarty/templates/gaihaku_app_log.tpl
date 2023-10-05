<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/gaihaku_app_log.css">
</head>
<body>
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<hr>
<form {$form.attributes}>
{$form.hidden}
<table>
  <tr>
  <td style="vertical-align: top;">
	[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]
  </td>

  <td align="center"> 
  <br>
  <br>
  {$count}件の{$teacher}さんが処理した外泊願が蓄積されてます<br>
  <font color="red">{$caution1}</font>
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
<td><input type="text" name="name_search_key" id="name_search_key" size="10" value={$name_search_key}></td>
</tr>
<tr><td colspan="3"><font size='0.7'>漢字・ひらがな・カタカナで部分一致検索ができます.</font></td></tr>
<tr>
<td><label for="room_search_key">部屋番号</label></td><td>：</td></label>
<td><input type="text" name="room_search_key" id="room_search_key" size="10" value="{$room_search_key}" oninput="formCheck();"></td>
</tr>
<tr><td colspan="3"><div id="error"></div></td></tr>
</table>
</td>

<td>
<table>
<tr>
<td><label for="sub_day">提出日</label></td><td>：</td>
<td><input type="date" name="sub_day" id="sub_day" value={$sub_day}></td>
</tr>
<tr>
<td><label for="day">外泊日</label></td><td>：</td>
<td><input type="date" name="day" id="day" value={$day}></td>
</tr>
<tr>
<td><label for="app_day">処理した日</label></td><td>：</td>
<td><input type="date" name="app_day" id="app_day" value={$app_day}></td>
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
{if $class==='寮務主事'||$class==='担当主事補'||$class==='寮監'}
<tr>
<td>学年</td><td>：</td>
<td><input type="radio" name="sort" value="gradeA" id="gradeA"><label for="gradeA">低い順</td>
<td><input type="radio" name="sort" value="gradeD" id="gradeD"><label for="gradeB">高い順</td><td>　</td>
</tr>
{/if}
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
<div align="center">{$form.submit2.html}</div>
</div>
</div>
</div>
<div align="right"><button type="button" id="sf-button" onclick='(function() { let val1 = "{$sort}"; let val2 ="{$spe_class}"; let val3="{$tou}"; let val4="{$floor}"; let val5="{$app}"; let val6="{$comment}"; let val7="{$attend}"; clickSFBtn(val1,val2,val3,val4,val5,val6,val7); } )();'>検索＆ソート＆フィルタ</button></div>


{if ($data) }
{$links}

<table border="1" align="center">
<tr><th>承認/非承認</th><th>クラス</th><th>寮生氏名</th><th>棟</th><th>部屋番号</th><th>相手氏名</th><th>宿泊先住所</th><th>電話番号</th><th>外泊期間</th><th>提出日時</th><th></th><th width="200">コメント</th></tr>

<?php
{$i=1};
?>
{foreach item=item from=$data}
<!--{if $i == 11}
{break}
{/if}-->

{if $i%2==0 }
<tr bgcolor='#fff'>
{else}
<tr bgcolor='#eee'>
{/if}

<td>
    {if $item.app === '承認'}
        <div style="color:red">{$item.app|escape:"html"}</div>
      {elseif $item.app === '非承認'}
        <div style="color:blue">{$item.app|escape:"html"}</div>
      {else}
      {$item.app|escape:"html"}
    {/if}
    </td>
<td>{$item.class|escape:"html"}</td>
<td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
<td>{$item.tou|escape:"html"}</td>
<td>{$item.roomnum|escape:"html"|substr:1:4}</td>
<td>{$item.last_name2|escape:"html"} {$item.first_name2|escape:"html"}</td>
<td><div align="left">{$item.psCode1|escape:"html"}-{$item.psCode1|escape:"html"}</div><div align="left">{$item.address|escape:"html"}</div></td>
<td>{$item.tel|escape:"html"}</td>
<td>{$item.s_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}{$item.s_time|escape:"html"}時
～{$item.f_day|strtotime|date_format:"%m&#26376;%d&#26085;"}{$item.f_time|escape:"html"}時</td>
<td>{$item.sub_date|escape:"html"}</td>
<td><button type="button" onclick="(function() { let val = {$item.gaihaku_id}; dispEntire(val); } )();">全体表示</button>

<!--オーバーレイ全体表示-->

<div id={$item.gaihaku_id|cat:'overlay'} class="back-overlay-off" onclick="(function() { let val = {$item.gaihaku_id}; clickClose(val); } )();">
<div class="flex">
<div class="normal-inner {$item.gaihaku_id}">
<div align="center"><font size="6">外泊願の全体表示</font></div>
<br>
          <table border="2" style="border-collapse: collapse" hight="1%" width="23.88%" bgcolor='#FFFFFF' id="sub" >
          <tr>
          <td bgcolor="#00f000" width="6%">提出日</td>
          <td width="15%"><div align="left">{$item.sub_date|escape:"html"|substr:0:4}年{$item.sub_date|escape:"html"|substr:5:2}月{$item.sub_date|escape:"html"|substr:8:2}日</div></td>
          </tr>
          </table>

          <table border="2" style="border-collapse: collapse" width="85%" align="center" bgcolor='#FFFFFF'>
            <tr>
              <td rowspan="2" bgcolor="#00f000" width="5%">氏名</td>
              <td align="left" rowspan="2" width="35%">
               氏：{$item.last_name|escape:"html"}　名：{$item.first_name|escape:"html"}
              </td>
              <td bgcolor="#00f000" width="15%">学年/クラス</td>
              <td bgcolor="#00f000" width="30%">棟</td>
              <td bgcolor="#00f000" width="15%">部屋番号</td>
              </tr>
              <tr>
              <td>{$item.class|escape:"html"}</td>
              <td>{$item.tou|escape:"html"}</td>
              <td>{$item.roomnum|escape:"html"|substr:1:4}号室</td>
              </tr>
            </table>

           <table border="2" style="border-collapse: collapse" width="85%" align="center" bgcolor='#FFFFFF'>
            <tr>
            <td rowspan="3" bgcolor="#00f000" width="5%">宿泊先<br>及び<br>連絡先</td>
            <td rowspan="2" bgcolor="#00f000" width="5%">宿泊先<br>住所</td>
            <td align="left" width="70%">〒{$item.psCode1|escape:"html"}-{$item.psCode2|escape:"html"}</td>
            <td rowspan="2" bgcolor="#00f000">外泊先の電話番号</td>
            </tr>
            <tr>
            <td align="left" width="70%">住所：{$item.address|escape:"html"}</td>
            </tr>
            <tr>
            <td bgcolor="#00f000"  width="5%">相手<br>氏名等</td>
            <td align="left" width="70%">
              氏：{$item.last_name2|escape:"html"}　名：{$item.first_name2|escape:"html"}
            </td>
            <td>{$item.tel|escape:"html"}</td>
            </tr>
           </table>

           <table border="2" style="border-collapse: collapse" width="85%" align="center" bgcolor='#FFFFFF'>
            <tr>
            <td bgcolor="#00f000" width="5%">日程</td>
            <td>
             {$item.s_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}　{$item.s_time|escape:"html"}時　～　
             {$item.f_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}　{$item.f_time|escape:"html"}時
            </td>
            </tr>
            </table>

            <table border="2" style="border-collapse: collapse" width="85%" height="20%" align="center" bgcolor='#FFFFFF'>
            <tr>
            <td rowspan="2" bgcolor="#00f000" width="5%">理由</td>
            <td align="left" height="20%">外泊理由：
              {$item.reason|escape:"html"}
            </td>
            <td rowspan="2" width="10%">寮監印</td>
            <td rowspan="2" width="10%">
            {if ($item.ryoukan)}
              {$item.ryoukan|escape:"html"}
             <br>
             {if ($item.app)}
             {if $item.app === '承認'}
              <div style="color:red">{$item.app|escape:"html"}</div>
            {else}
              <div style="color:blue">{$item.app|escape:"html"}</div>
              {/if}
             {/if}
             {/if}
            </td>

            <td rowspan="2" width="10%">寮務主事印<br>担当主事補印<br>又は担任印</td>
            <td rowspan="2" width="10%">
            {if ($item.teacher)}
              {$item.teacher|escape:"html"}
             <br>
             {if ($item.app)}
             {if $item.app === '承認'}
              <div style="color:red">{$item.app|escape:"html"}</div>
            {else}
              <div style="color:blue">{$item.app|escape:"html"}</div>
              {/if}
             {/if}
             {/if}

            </td>
            </tr>
            <tr>
            <td align="left" height="80%">{$item.riyuu|escape:"html"}</td>
            </tr>
            </table>
            <br>

      <button id= "button" type=button  onclick="(function() { let val = {$item.gaihaku_id}; clickClose(val); } )();">Close</button>
    </div>
  </div>
</div>

</td>

<td>{$item.comment|escape:"html"}</td>
</tr>
<?php
{$i++};
?>
{/foreach}

{/if}
</table>
          <input type="hidden" name="type"   value="{$type}">
          <input type="hidden" name="action" value="{$action}">
</form>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
<script type="text/javascript" src="../js/gaihaku_app_log.js" async></script>
</body>
</html>