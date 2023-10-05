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
        <td>
	  <form {$form.attributes}>
          <table>
            <tr align="left">
            <th>{$state}ページ:</th>
            <br>
            </tr>
            {if $message}
            <tr>
            <td align="right"><font color="red">{$message}</font></td>
            </tr>
            {/if}
            <tr>
            <td>{$caution1}</td>
            </tr>

            <tr>
              <td  height="70"><div style="text-align: right">{$form.username.label}:</div></td>
              <td align="left">{$form.username.html}@sendai-nct.ac.jp</td>
            </tr>

	    <tr>
          <td><div style="text-align: right">{$form.password.label}:</div></td>
              <td align="left">{$form.password.html}</td>
            </tr>
            <tr>
              <td colspan="2" height="100" >
              <br>
                <div style="color:red;font-size: smaller;"> {$auth_error_mess}</div>
                <input type="hidden" name="type" value="{$type}">
                <div style="text-align:center;">{$form.submit.html}</div>
              </td>
            </tr>
          </table>
	  </form>
	  
        </td>
        <td>
            <br>
            <br>
        </td>
      </tr>
    </table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>