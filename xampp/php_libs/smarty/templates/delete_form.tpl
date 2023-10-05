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
<table>
<tr>
        
<td style="vertical-align: top;">
[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]<br>

{if ($is_system) }
{if $type==tdelete}
      	[ <a href="{$SCRIPT_NAME}?type=tlist&action=form{$add_pageID}">教員一覧</a> ]<br>
{else}
		[ <a href="{$SCRIPT_NAME}?type=mlist&action=form{$add_pageID}">会員一覧</a> ]<br>
{/if}
{/if}
<br>
<br>
{$disp_login_state}
</td>
        
<td>　　　</td>

<td>
<form {$form.attributes}>
	{$message}
	<br>
    {if $type==tdelete}
		<div style="color:red; font-size: smaller;" align="center">教員が処理した外泊願は削除されません。</div>
		
    {else}
		<div style="color:red; font-size: smaller;" align="center">この寮生の提出物もすべて削除されます。</div>
	{/if}	
	<br>
		{$form.submit.html}

        <input type="hidden" name="rand" value="{$rand}">
		<input type="hidden" name="type"   value="{$type}">
		<input type="hidden" name="action" value="{$action}">

        </form>
        </td>
      </tr>
    </table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
