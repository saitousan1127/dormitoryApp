<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<link rel="stylesheet" href="../css/system_tlist.css">
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
        <p>[ <a href="{$SCRIPT_NAME}?type=tregist&action=form{$add_pageID}">新規登録</a> ]
<br>

<form {$form.attributes}>
名前：<input type="text" name="search_key" value="{$search_key}">
<input type="submit" name="submit" value="検索する">
<input type="hidden" name="type" value="tlist">
</form>



検索結果は{$count}件です。<br>
<br>
{if ($data) }

{if $maint}
<button type="button" onclick="dispOverlay('call_off_ryoukan');">寮監取り消し</button>
<div id='call_off_ryoukan' class="back-overlay-off" onclick="closeOverlay('call_off_ryoukan');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="6">
現在の寮監設定を取り消しますか？<br>
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('call_off_ryoukan');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='call_off_ryoukan();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
　　　
<button type="button" onclick="dispOverlay2('call_off_class');">教員とクラスの紐づけを解除</button>
<div id='call_off_class' class="back-overlay-off" onclick="closeOverlay('call_off_class');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="5">
教員に設定されているクラス情報を<br>すべて削除しますか？<br>
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('call_off_class');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='call_off_class();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
{/if}

<br><br>

<table border="1">
<tbody>
<tr><th>ID</th><th>氏</th><th>名</th><th>氏(フリガナ)</th><th>名(フリガナ)</th><th>担任の学年/クラス</th><th>登録日</th><th>　</th>{if $maint}<th>　</th><th>　</th>{/if}<th>寮監</tr>

{foreach item=item from=$data}
<tr>
<td>{$item.id}</td>
<td>{$item.last_name|escape:"html"}</td>
<td>{$item.first_name|escape:"html"}</td>
<td>{$item.k_last_name|escape:"html"}</td>
<td>{$item.k_first_name|escape:"html"}</td>
<td>{$item.class|escape:"html"}</td>
<td>{$item.reg_date|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}</td>

<td>
{if $item.ban == 0}
<button type="button" id='{$item.id|cat:ban_btn}' onclick="(function() { let val = '{$item.id|cat:ban}'; dispOverlay(val); } )();">凍結</button>
{else}
<button type="button" id='{$item.id|cat:ban_btn}' onclick="(function() { let val = '{$item.id|cat:ban}'; dispOverlay(val); } )();">凍結解除</button>
{/if}
<div id={$item.id|cat:'ban'} class="back-overlay-off" onclick="(function() { let val = '{$item.id|cat:ban}'; closeOverlay(val); } )();">
<div class="flex">
<div class="yn-overlay-inner"  onclick="clickChild();">
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
<td><button type="button" class="yes_btn" onclick='(function() { let val = {$item.id}; ban_teacher(val); } )();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td>

{if $maint}
<td>[<a href="{$SCRIPT_NAME}?type=tmodify&action=form&id={$item.id}{$add_pageID}">更新</a>]</td>
<td>[<a href="{$SCRIPT_NAME}?type=tdelete&action=confirm&id={$item.id}{$add_pageID}">削除</a>]</td>
{/if}
<td>
{if $item.id == $ryoukan_id}
<font color="red">寮監</font>
{else}
　
{/if}
</td>
</tr>
{/foreach}

</tbody></table>
{/if}

          </td>
      </tr>
    </table>
<script type="text/javascript" src="../js/system_tlist.js" async></script>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>