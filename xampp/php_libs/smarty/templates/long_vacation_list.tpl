<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/holiday_list.css">
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
  </tr>
</table>

  <div align="center">
  <br>
  <br> 
  開始日：<input type='date' name='vacation[first_date]' min="{$today}" id='fd'>～終了日：<input type='date' name='vacation[last_date]' min="{$today}" id='fd'>
   長期休暇名：<input type='text' name='vacation[name]' id='name'> <input type='submit' name='submit' value='追加'  onClick='return check();'>
  <div id="error" style="color:red; font-size: smaller;" align="center"></div>
  <br>
  {$count}件の長期休暇が登録されています<br>
  <font color="red">{$caution1}</font>
</div>

{if ($data) }

<table border="1" align="center">
<tr><th>開始日～終了日</th><th>名称</th><th></th></tr>

<?php
{$i=1};
?>
{foreach item=item from=$data}

{if $i%2==0 }
<tr bgcolor='#fff' id="{$item.id|escape:"html"}">
{else}
<tr bgcolor='#eee' id="{$item.id|escape:"html"}">
{/if}

<td>{$item.first_date|escape:"html"|substr:0:4}年{$item.first_date|escape:"html"|substr:5:2}月{$item.first_date|escape:"html"|substr:8:2}日
～{$item.last_date|escape:"html"|substr:0:4}年{$item.last_date|escape:"html"|substr:5:2}月{$item.last_date|escape:"html"|substr:8:2}日</td>
<td>{$item.name|escape:"html"}</td>
<td>
<div id="delete_btn"><button type="button" class="delete_btn" onclick="(function() { let val = '{$item.id|cat:delete}'; dispOverlay(val); } )();">削除</button></div>
<div id={$item.id|cat:'delete'} class="back-overlay-off" onclick="(function() { let val = '{$item.id|cat:delete}'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<div align="center">
<font size="6">
{$item.name|escape:"html"}
</font>
<font size="4.8">
({$item.first_date|escape:"html"|substr:0:4}年{$item.first_date|escape:"html"|substr:5:2}月{$item.first_date|escape:"html"|substr:8:2}日
～{$item.last_date|escape:"html"|substr:0:4}年{$item.last_date|escape:"html"|substr:5:2}月{$item.last_date|escape:"html"|substr:8:2}日)<br>
を削除しますか？
</font>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '{$item.id|cat:delete}'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = {$item.id}; clickYesBtn(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td>

</tr>
<?php
{$i++};
?>
{/foreach}

{/if}
</table>
          <input type="hidden" name="type" value="{$type}">
          <input type="hidden" name="rand" value="{$rand}">
</form>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
<script type="text/javascript" src="../js/long_vacation_list.js" async></script>
</body>
</html>