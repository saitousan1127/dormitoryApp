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
<div align="left">[ <a href="{$SCRIPT_NAME}?type=list&action=form{$add_pageID}">外泊願一覧</a> ]</div>
    <table>
      <tr>
      
      <td>
    <form {$form.attributes}>
    {$form.hidden}
	{$message}
	<br>
	<br>
    {$form.comment.html}
    {if isset($form.comment.error)}
             <div style="color:red; font-size: smaller;" align="left">{$form.comment.error}</div>
    {/if}
    <br>
    <br>
		{if ( $form.submit2.attribs.value != "" ) }
              {$form.submit2.html}
            {else}
              {$form.reset.html}
            {/if}
            {$form.submit.html}

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
