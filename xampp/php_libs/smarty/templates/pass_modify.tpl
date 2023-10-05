<!DOCTYPE html>
<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<script type="text/javascript" src="../js/quickform.js" async></script>
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
          <td align="left">[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]</td>
          </tr>
          <tr>
            <td align="right"><font color="red">{$caution1}</font></td>
            </tr>

            <tr>
              <td height="30"><div style="text-align: right">{$form.oldPass.label}:</div></td>
              <td> {$form.oldPass.html}</td>
            </tr>

            {if isset($form.oldPass.error)}
                 <tr><td></td><td aling="left"><div style="color:red; font-size: smaller;">{$form.oldPass.error}</div></td></tr>
                {/if}

	        <tr>
              <td height="30"><div style="text-align: right">{$form.newPass.label}:</div></td>
              <td> {$form.newPass.html}</td>
            </tr>
            {if isset($form.newPass.error)}
                 <tr><td></td><td aling="left"><div style="color:red; font-size: smaller;">{$form.newPass.error}</div></td></tr>
                {/if}

            <tr>
              <td height="30"><div style="text-align: right">{$form.newPass2.label}:</div></td>
              <td> {$form.newPass2.html}</td>
            </tr>

            {if isset($form.newPass2.error)}
                 <tr><td></td><td aling="left"><div style="color:red; font-size: smaller;">{$form.newPass2.error}</div></td></tr>
                {/if}

            <tr>
              <td colspan="2" height="100" >
                <input type="hidden" name="type"   value="{$type}">
                <input type="hidden" name="action" value="{$action}">
                <div style="text-align:right;">{$form.submit.html}</div>
		<br>
                <div style="color:red; font-size: smaller;"> {$auth_error_mess} </div></td>
            </tr>
          </table>
          <input type="hidden" name="rand" value="{$rand}">
	  </form>
    {if $form.javascript}
      {$form.javascript}
    {/if}
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>