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
          <table>
            <tr>
              <th align="left">寮生ページ:</th>
            </tr>
            <tr>
            <td height="50">寮生用アカウントでログインしてください．</td>
            </tr>
            {if $message}
            <tr>
            <td align="right"><font color="red">{$message}</font></td>
            </tr
            {/if}
            <tr>
              <td><div style="text-align: right">{$form.username.label}:</div></td>
              <td align="left"> {$form.username.html}@sendai-nct.jp</td>
            </tr>

	    <tr>
              <td height="70"><div style="text-align: right">{$form.password.label}:</div></td>
              <td align="left"> {$form.password.html}</td>
            </tr>
            <tr>
              <td colspan="2" height="100" >
                 <div style="color:red; font-size: smaller;"> {$auth_error_mess} </div>
                 <br>
                <input type="hidden" name="type" value="{$type}">
                <div style="text-align:center;">{$form.submit.html}</div>
              </td>
            </tr>
          </table>
	  </form>
    <br>
          <br>
          <div align="center"><a href="{$SCRIPT_NAME}?type=regist&action=form"><<新規登録>></a></div>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
<!--<a href="{$SCRIPT_NAME}?type=regist&action=form">新規登録</a>-->
</body>
</html>