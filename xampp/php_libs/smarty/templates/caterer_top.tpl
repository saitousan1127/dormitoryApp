<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/system_top.css">
</head>
<body>
{$message}
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<hr>
    <table>
      <tr>
        
      <td style="vertical-align: top;" align="left">
      	[ <a href="{$SCRIPT_NAME}?type=logout">ログアウト</a> ]
	</td>
  <td >
  <td align="left">
	{$disp_login_state}
      </td>
      </tr>

<tr>
<td>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=pass_modify&action=form">パスワード変更</a> ]---給食業者アカウントのパスワードを変更します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=list">欠食者一覧</a> ]---欠食者の一覧表を表示します
<br>
</td></tr>
</td>
</tr>
</table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
