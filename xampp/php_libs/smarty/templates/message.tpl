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
	[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]<br>

{if $type=='app'}
 [ <a href="{$SCRIPT_NAME}?type=list&action=form">外泊願一覧</a> ]<br>
{/if}
{if $type=='list2'}
 [ <a href="{$SCRIPT_NAME}?type=list2&action=form">外泊願処理画面</a> ]<br>
{/if}

{if ($is_system) }

{if $type=='tlist'}
  [ <a href="{$SCRIPT_NAME}?type=tlist&action=form{$add_pageID}">教員一覧</a> ]<br>
{else}
  [ <a href="{$SCRIPT_NAME}?type=list&action=form{$add_pageID}">会員一覧</a> ]<br>
{/if}
{/if}
	<br>
	<br>
	{$disp_login_state}
      </td>
        
      <td>
  		{$message}


        </td>
      </tr>
      <tr>
      {$caution1}
      </tr>
    </table>
    <input type="hidden" name="rand" value="{$rand}">
    </form>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
