<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/system_list.css">
<script type="text/javascript" src="../js/quickform.js" async></script>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<hr>

    <table>
      <tr>
      	<td style="vertical-align: top;">
	[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]
	<br>
	<br>
	{$disp_login_state}
      	</td>
        <td>
        
<br>

<form {$form.attributes}>
名前：<input type="text" name="search_key" value="{$search_key}">
<input type="submit" name="submit" value="検索する">
<input type="hidden" name="type" value="mlist">
</form>



検索結果は{$count}件です。<br>
<br>
{$links}
{if ($data) }
<table border="1">
<tbody>
<tr><th>ID</th><th>氏</th><th>名</th><th>氏(フリガナ)</th><th>名(フリガナ)</th><th>誕生日</th><th>登録日</th><th>　</th>{if $maint}<th>　</th>{/if}</tr>

{foreach item=item from=$data}
<tr>
<td>{$item.id}</td>
<td>{$item.last_name|escape:"html"}</td>
<td>{$item.first_name|escape:"html"}</td>
<td>{$item.k_last_name|escape:"html"}</td>
<td>{$item.k_first_name|escape:"html"}</td>
<td>
{if $item.birthday == '未登録'}
未登録
{else}
{$item.birthday|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}
{/if}
</td>
<td>{$item.reg_date|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}</td>

<td>
{if $item.ban == 0}
<button type="button" id='{$item.id|cat:ban_btn}' onclick="(function() { let val = '{$item.id|cat:ban}'; dispOverlay(val); } )();">凍結</button>
{else}
<button type="button" id='{$item.id|cat:ban_btn}' onclick="(function() { let val = '{$item.id|cat:ban}'; dispOverlay(val); } )();">凍結解除</button>
{/if}
<div id={$item.id|cat:'ban'} class="back-overlay-off" onclick="(function() { let val = '{$item.id|cat:ban}'; closeOverlay(val); } )();">
<div class="flex">
<div class="overlay-inner"  onclick="clickChild();">
<br>
<div align="center"><font size="6">
{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}さん<br>
</font>
<div align="center"><font size="5">
{if $item.ban == 0}
のアカウントを凍結しますか？
{else}
のアカウントを凍結解除しますか？
{/if}
</font>
</div>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="(function() { let val = '{$item.id|cat:ban}'; closeOverlay(val); } )();">いいえ</button></td>
<td>　</td>
<td><button type="button" class="yes_btn" onclick='(function() { let val = {$item.id}; ban_member(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td>

{if $maint}
<td>[<a href="{$SCRIPT_NAME}?type=delete&action=confirm&id={$item.id}{$add_pageID}">削除</a>]</td>
{/if}
</tr>
{/foreach}

</tbody></table>
{/if}

          </td>
      </tr>
    </table>
</div>
<script type="text/javascript" src="../js/system_list.js" async></script>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
