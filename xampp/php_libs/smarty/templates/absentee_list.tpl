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
  日付：<input type='date' name='date' max="{$today}" value="{$date}">　　{$form.submit.html}
  <br>
  {$count}件の欠食申請があります<br>
  <font color="red">{$caution1}</font>
  </div>

{if ($data) }

<table border="1" align="center">
<tr><th>確定日時</th><th>学年／クラス</th><th>氏名</th><th>氏名(フリガナ)</th></tr>

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

<td>{$item.date|escape:"html"}</td>
<td>{$item.class|escape:"html"}</td>
<td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
<td>{$item.k_last_name|escape:"html"} {$item.k_first_name|escape:"html"}</td>
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