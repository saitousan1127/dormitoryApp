<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/kessyoku_app_log.css">
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
  未処理の欠食届が{$count}件蓄積されています．<br>
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

<td>
<table>
<tr>
<td><label for="name_search_key">名前</label></td><td>：</td>
<td><input type="text" name="name_search_key" id="name_search_key" size="15" value={$name_search_key}></td>
</tr>
<tr><td colspan="3"><font size='0.7'>漢字・ひらがな・カタカナで部分一致検索ができます.</font></td></tr>
</table>
</td>

<td>
<table>
<tr>
<td><label for="sub_day">提出日</label></td><td>：</td>
<td><input type="date" name="sub_day" id="sub_day" value={$sub_day}></td>
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
<div align="center">{$form.submit.html}</div>
</div>
</div>
</div>
<div align="right"><button type="button" id="sf-button" onclick='(function() { let val1 = "{$sort}"; let val2 = "{$grade}"; let val3 = "{$app}"; let val4 = "{$reason}"; let val5 = "{$comment}"; clickSFBtn(val1,val2,val3,val4,val5); } )();'>検索＆ソート＆フィルタ</button></div>


{if ($groups) }
{$links}
<table border="1" align="center">
<tr><th width="80">受理/却下</th><th>提出日時</th><th>学年</th><th>氏名</th><th width="200">欠食理由</th><th>開始日～終了日</th><th></th><th>処理日</th><th  width="200">コメント</th></tr>

<?php
{$i=1};
?>
{foreach item=item from=$groups}
<!--{if $i == 11}
{break}
{/if}-->

{if $i%2==0 }
<tr bgcolor='#fff'>
{else}
<tr bgcolor='#eee'>
{/if}
<td>{$item.app|escape:"html"}</td>
<td>{$item.sub_date|escape:"html"}</td>
<td>{$item.grade|escape:"html"}</td>
<td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
<td>{$item.reason|escape:"html"}</td>
<td>{${'first_day'|cat:$item.group_id}|escape:"html"|substr:0:10} ～ {${'last_day'|cat:$item.group_id}|escape:"html"|substr:0:10}</td>
<td>
<button type="button" onclick="(function() { let val = '{$item.group_id|cat:overlay}'; dispOverlay(val); } )();">全体表示</button>
<!--オーバーレイ全体表示-->
<div id={$item.group_id|cat:'overlay'} class="back-overlay-off" onclick="(function() { let val = '{$item.group_id|cat:overlay}'; closeOverlay(val); } )();">
<div class="flex">
<div class="normal-inner {$item.group_id}"  onclick="clickChild();">
<div align="center"><font size="6">欠食届の全体表示</font></div>
  <table align="center">
  <tr><td>提出日：</td><td>{$item.sub_date|escape:"html"}</td></tr>
  <tr><td>学年：{$item.grade|escape:"html"}</td><td>氏名：{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td></tr>
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
    {foreach item=record from=${"table"|cat:$item.group_id}}
    <td>
    <table border="2" style="border-collapse: collapse" width="126" height="22" align="left">
      <tr><td>{$record.date|escape:"html"|substr:0:10}</td><tr>
      <tr><td>
      {if $record.bre}
      〇
      {else}
      　
      {/if}
      </td></tr>
      <tr><td>
      {if $record.lun}
      〇
      {else}
      　
      {/if}
      </td></tr>
      <tr><td>
      {if $record.din}
      〇
      {else}
      　
      {/if}
      </td></tr>
    </table>
    </td>
    {/foreach}
  </tr>
  </table>
  <br>
<div align="center"><button id= "button" type=button onclick="(function() { let val = '{$item.group_id|cat:overlay}'; closeOverlay(val); } )();">Close</button></div>
</div>
</div>
</div>
</td>
<td>{$item.app_date|escape:"html"}</td>
<td>{$item.comment|escape:"html"}</td>

</tr>
<?php
{$i++};
?>
{/foreach}

{/if}
</table>
          <input type="hidden" name="type"   value="{$type}">
</form>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
<script type="text/javascript" src="../js/kessyoku_app_log.js" async></script>
</body>
</html>