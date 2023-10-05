<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/gaihaku_log.css">
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
  {$count}件の過去に提出した外泊願が蓄積されてます<br>
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
<td><b>検索</b></td>
</tr>
<tr>
<td><label for="sub_day">提出日</label></td><td>：</td>
<td><input type="date" name="sub_day" id="sub_day" value={$sub_day}></td>
</tr>
<tr><td>　</td></tr>
<tr>
<td><label for="day">外泊日</label></td><td>：</td>
<td><input type="date" name="day" id="day" value={$day}></td>
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
<div align="center">{$form.submit.html}</div>
</div>
</div>
</div>
<div align="right"><button type="button" id="sf-button" onclick='(function() { let val1 = "{$sort}"; let val2 = "{$app}"; let val3 = "{$comment}"; let val4 = "{$attend}"; clickSFBtn(val1,val2,val3,val4); } )();'>検索＆ソート＆フィルタ</button></div>

{if ($data) }
{$links}

<table border="1" align="center">
<tr><th>承認/非承認</th><th>相手氏名</th><th>宿泊先住所</th><th>電話番号</th><th>外泊期間</th><th>提出日時</th><th></th><th>編集</th><th>教員</th><th width="200">コメント</th><th></th></tr>

<?php
{$i=1};
?>
{foreach item=item from=$data}
<!--{if $i == 11}
{break}
{/if}-->

{if $i%2==0 }
<tr bgcolor='#fff'  id="{$item.gaihaku_id}">
{else}
<tr bgcolor='#eee'  id="{$item.gaihaku_id}">
{/if}

<td>
    {if $item.app === '承認'}
        <div style="color:red">{$item.app|escape:"html"}</div>
      {elseif $item.app === '非承認'}
        <div style="color:blue">{$item.app|escape:"html"}</div>
    {else if $item.app === '未閲覧'}
      {$item.app|escape:"html"}
    {else}
       閲覧中
    {/if}
</td>
<td>{$item.last_name2|escape:"html"} {$item.first_name2|escape:"html"}</td>
<td><div align="left">{$item.psCode1|escape:"html"}-{$item.psCode1|escape:"html"}</div><div align="left">{$item.address|escape:"html"}</div></td>
<td>{$item.tel|escape:"html"}</td>
<td>{$item.s_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}{$item.s_time|escape:"html"}時
～{$item.f_day|strtotime|date_format:"%m&#26376;%d&#26085;"}{$item.f_time|escape:"html"}時</td>
<td>{$item.sub_date|escape:"html"}</td>
<td><button type="button" onclick="(function() { let val = '{$item.gaihaku_id|cat:overlay}'; dispOverlay(val); } )();">全体表示</button>

<!--オーバーレイ全体表示-->

<div id={$item.gaihaku_id|cat:'overlay'} class="back-overlay-off"  onclick="(function() { let val = '{$item.gaihaku_id|cat:overlay}'; closeOverlay(val); } )();">
<div class="flex">
<div class="normal-inner {$item.gaihaku_id}"  onclick="clickChild();">
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

      <button id= "button" type=button  onclick="(function() { let val = '{$item.gaihaku_id|cat:overlay}'; closeOverlay(val); } )();">Close</button>
    </div>
  </div>
</div>

</td>

<td>
{if $item.app === '未閲覧'}
<button type='submit' name='edit' value='{$item.gaihaku_id}'>編集可能</button>
{else}
{if $item.app === '閲覧'}
編集不可(閲覧中)
{else}
編集不可
{/if}
{/if}
</td>

<td>{if ($item.teacher)}
    {$item.teacher|escape:"html"}
    {else}
    {if ($item.ryoukan)}
    {$item.ryoukan|cat:'(寮監)'|escape:"html"}
    {/if}
    {/if}</td>
<td>{$item.comment|escape:"html"}</td>
<td>
{if $smarty.now|date_format:'%Y-%m-%d %H:%M:%S' < $item.s_day|date_format:'%Y-%m-%d'|cat:' '|cat:$item.s_time|cat:':00:00'}
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '{$item.gaihaku_id|cat:delete}'; dispOverlay(val); } )();">削除</button></div>
<div id={$item.gaihaku_id|cat:'delete'} class="back-overlay-off" onclick="(function() { let val = '{$item.gaihaku_id|cat:delete}'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner {$item.gaihaku_id}"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
{$item.s_day|escape:"html"|substr:0:10} ～ {$item.f_day|escape:"html"|substr:0:10}<br>
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
<td><button type="button" class="no_btn" onclick="(function() { let val = '{$item.gaihaku_id|cat:delete}'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = {$item.gaihaku_id}; clickYesBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
{else}
削除不可
{/if}
</td>

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
<script type="text/javascript" src="../js/gaihaku_log.js" async></script>
</body>
</html>