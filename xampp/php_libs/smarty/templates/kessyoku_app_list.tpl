<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
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
  日付：<input type='date' name='date' min="{$three_days_ago}" value="{$date}">　　{$form.submit.html}
  <br>
  {$count}件の欠食申請があります<br>
  <font color="red">{$caution1}</font>
  </div>

{if ($data) }

<table border="1" align="center">
<tr><th>学年</th><th>氏名</th><th>朝食</th><th>昼食</th><th>夕食</th></tr>

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

<td>{$item.grade|escape:"html"}</td>
<td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
<td>
{if $item.bre==1}
  〇
{/if}
</td>
<td>
{if $item.lun==1}
  〇
{/if}
</td>
<td>
{if $item.din==1}
  〇
{/if}
</td>
</tr>
<?php
{$i++};
?>
{/foreach}

{/if}
</table>
          <input type="hidden" name="type" value="{$type}">
</form>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>