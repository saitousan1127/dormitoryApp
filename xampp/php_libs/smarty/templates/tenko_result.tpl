<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/tenko_result.css">
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
  点呼に応じていない寮生が{$count}人います<br>
  <font color="red">{$caution1}</font>
  </td>
  </tr>
</table>

{if ($data) }

<table border="1" align="center">
<tr><th>学年/クラス</th><th>氏名</th><th>フリガナ</th><th>部屋番号</th><th></th></tr>

<?php
{$i=1};
?>
{foreach item=item from=$data}

{if $i%2==0 }
<tr bgcolor='#fff'  id="{$item.id}">
{else}
<tr bgcolor='#eee'  id="{$item.id}">
{/if}
<td>{$item.class|escape:"html"}</td>
<td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
<td>{$item.k_last_name|escape:"html"} {$item.k_first_name|escape:"html"}</td>
<td>
{if $item.roomnum|substr:0:1 == 'N'}
{$item.roomnum|escape:"html"|substr:0:5}号室
{else}
{$item.roomnum|escape:"html"|substr:0:4}号室
{/if}
</td>
<td>
<button type="button" class="attend_btn" onclick="(function() { let val = '{$item.id|cat:attend}'; dispOverlay(val); } )();">出席</button>
<div id='{$item.id|cat:attend}' class="back-overlay-off" onclick="(function() { let val = '{$item.id|cat:attend}'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}<br>
</font>
<div align="center"><font size="5">
さんが寮にいることが確認できましたか？
</font>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '{$item.id|cat:attend}'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = {$item.id}; clickAttendBtn(val); } )();'>はい</button></td>
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
</table>
<br><br>
<button type="button" onclick="send_mail();">点呼欠席者にメールを送る</button>
<div style="color:red;" id='sent'><br></div>
<br>
<button type="button" class="attend_btn" onclick="dispOverlay('determine');">点呼欠席者を確定する</button>
<div id='determine' class="back-overlay-off" onclick="closeOverlay('determine');">
<div class="flex">
<div class="yn-overlay-inner"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
リストに表示されている寮生を点呼欠席者として登録しますか？<br>
</font>
<div style="color:red; font-size: smaller;">※後から変更することができません</div><br>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('determine');">いいえ</button></td>
<td>　</td>
<td><input type='submit' name='submit' value='登録する' class='yes_btn'></td>
</tr>
</table>
</div>
</div>
</div>
<br>
(その日のうちに確定してください．)
{/if}
          <input type="hidden" name="type"   value="{$type}">
          <input type="hidden" name="action" value="{$action}">
          <input type="hidden" name="rand" value="{$rand}">
</form>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
<script type="text/javascript" src="../js/tenko_result.js" async></script>
</body>
</html>