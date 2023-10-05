<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/kessyoku_log.css">
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
  {$count}件の欠食届が蓄積されてます<br>
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
<tr>
<td><label for="day">欠食日</label></td><td>：</td>
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
<div align="center">{$form.submit.html}</div>
</div>
</div>
</div>
<div align="right"><button type="button" id="sf-button" onclick='(function() { let val1 = "{$sort}"; let val2 = "{$grade}"; let val3 = "{$app}"; let val4 = "{$reason}"; let val5 = "{$comment}"; clickSFBtn(val1,val2,val3,val4,val5); } )();'>検索＆ソート＆フィルタ</button></div>

{if ($groups) }
{$links}

<table border="1" align="center">
<tr><th width="80">状態</th><th>提出日時</th><th width="200">欠食理由</th><th>開始日～終了日</th><th>自動削除モード</th><th></th><th>編集</th><th width="200">コメント</th><th></th></tr>

<?php
{$i=1};
?>
{foreach item=item from=$groups}
<!--{if $i == 11}
{break}
{/if}-->

{if $i%2==0 }
<tr bgcolor='#fff' id="{$item.group_id}">
{else}
<tr bgcolor='#eee'  id="{$item.group_id}">
{/if}

<td>
{if $item.app == '受理'}
<div style="color:red">受理</div>
{else if  $item.app == '却下'}
<div style="color:blue">却下</div>
{else}
{$item.app|escape:"html"}
{/if}
</td>
<td>{$item.sub_date|escape:"html"}</td>
<td>{$item.reason|escape:"html"}</td>
<td>{${'first_day'|cat:$item.group_id}|escape:"html"|substr:0:10} ～ {${'last_day'|cat:$item.group_id}|escape:"html"|substr:0:10}</td>
<td>
{if $item.auto_delete == 1}
<div style="color:red">ON</div>
{else}
OFF
{/if}
</td>
<td><button type="button" onclick="(function() { let val = '{$item.group_id|cat:overlay}'; dispOverlay(val); } )();">全体表示</button>

<!--オーバーレイ全体表示-->

<div id={$item.group_id|cat:'overlay'} class="back-overlay-off" onclick="(function() { let val = '{$item.group_id|cat:overlay}'; closeOverlay(val); } )();">
<div class="flex">
<div class="normal-inner {$item.group_id}"  onclick="clickChild();">
<div align="center"><font size="6">欠食届の全体表示</font></div>
  <table align="center">
  <tr><td>提出日：</td><td>{$item.sub_date|escape:"html"}</td></tr>
  <tr><td>学年：</td><td>{$item.grade|escape:"html"}</td></tr>
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
  <nobr>
  自動削除モード： 
  {if $item.auto_delete == 1}
    <div style="color:red">ON</div>
  {else}
    OFF
 {/if}
  </nobr>     
<div align="center"><button id= "button" type=button onclick="(function() { let val = '{$item.group_id|cat:overlay}'; closeOverlay(val); } )();">Close</button></div>
</div>
</div>
</div>

</td>
<td>
{if $smarty.now|date_format:'%Y-%m-%d %H:%M:%S'< $smarty.now|date_format:'%Y-%m-%d'|cat:' '|cat:'13:00:00'}
{if ($smarty.now+24*60*60*2)|date_format:'%Y-%m-%d'|cat:' '|cat:'00:00:00' < ${'last_day'|cat:$item.group_id}}
{if $item.app === '未閲覧'}
<button type='submit' name='edit' value='{$item.group_id}'>編集可能</button>
{else}
{if $item.app === '閲覧'}
編集不可(閲覧中)
{else}
編集不可
{/if}
{/if}
{else}
編集不可
{/if}
{else}
{if ($smarty.now+24*60*60*3)|date_format:'%Y-%m-%d'|cat:' '|cat:'00:00:00' < ${'last_day'|cat:$item.group_id}}
{if $item.app === '未閲覧'}
<button type='submit' name='edit' value='{$item.group_id}'>編集可能</button>
{else}
{if $item.app === '閲覧'}
編集不可(閲覧中)
{else}
編集不可
{/if}
{/if}
{else}
編集不可
{/if}
{/if}

</td>
<td>{$item.comment|escape:"html"}</td>

<td>
{if $smarty.now|date_format:'%Y-%m-%d %H:%M:%S'< $smarty.now|date_format:'%Y-%m-%d'|cat:' '|cat:'13:00:00'}
{if ($smarty.now+24*60*60*2)|date_format:'%Y-%m-%d'|cat:' '|cat:'00:00:00' < ${'last_day'|cat:$item.group_id}}
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '{$item.group_id|cat:delete}'; dispOverlay(val); } )();">削除</button></div>
<div id={$item.group_id|cat:'delete'} class="back-overlay-off" onclick="(function() { let val = '{$item.group_id|cat:delete}'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner {$item.group_id}"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
{${'first_day'|cat:$item.group_id}|escape:"html"|substr:0:10} ～ {${'last_day'|cat:$item.group_id}|escape:"html"|substr:0:10}<br>
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
<td><button type="button" class="no_btn" onclick="(function() { let val = '{$item.group_id|cat:delete}'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = {$item.group_id}; clickYesBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
{else}
削除不可
{/if}
{else}
{if ($smarty.now+24*60*60*3)|date_format:'%Y-%m-%d'|cat:' '|cat:'00:00:00' < ${'last_day'|cat:$item.group_id}}
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '{$item.group_id|cat:delete}'; dispOverlay(val); } )();">削除</button></div>
<div id={$item.group_id|cat:'delete'} class="back-overlay-off" onclick="(function() { let val = '{$item.group_id|cat:delete}'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner {$item.group_id}"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
{${'first_day'|cat:$item.group_id}|escape:"html"|substr:0:10} ～ {${'last_day'|cat:$item.group_id}|escape:"html"|substr:0:10}<br>
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
<td><button type="button" class="no_btn" onclick="(function() { let val = '{$item.group_id|cat:delete}'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = {$item.group_id}; clickYesBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
{else}
削除不可
{/if}
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
<script type="text/javascript" src="../js/kessyoku_log.js" async></script>
</body>
</html>