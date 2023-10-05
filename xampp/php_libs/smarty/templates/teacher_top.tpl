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
<td style="vertical-align: top;" align="left">
[ <a href="{$SCRIPT_NAME}?type=logout">ログアウト</a> ]
</td>
</tr>
<tr>
<td></td>
<td>
{$last_name|escape:"html"} {$first_name|escape:"html"} さんのアカウントでログイン中（{$caution1}）
</td>
</td></tr>

<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=modify&action=form" style="text-align: left">パスワード変更</a> ]---パスワードの変更ができます
<br>
</td></tr>

{if $class !== '外注'}
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=list" style="text-align: left">提出された外泊願の処理</a> ]---寮務主事、寮務主事補、担任の承認が必要な外泊願
<br>
</td></tr>

{if $ryoukan}
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=app_log" style="text-align: left">提出された外泊願一覧</a> ]---処理した外泊願の履歴が見れます
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=tenko&action=list" style="text-align: left">まだ点呼を完了していない寮生一覧</a> ]
<br>
</td></tr>
{else}
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=app_log" style="text-align: left">処理した外泊願一覧</a> ]---処理した外泊願の履歴が見れます
<br>
</td></tr>
{/if}

{else}
    
{if $ryoukan}
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=app_log" style="text-align: left">提出された外泊願一覧</a> ]---提出された外泊願の履歴が見れます
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=tenko&action=list" style="text-align: left">まだ点呼を完了していない寮生一覧</a> ]
<br>
</td></tr>
{/if}

{/if}

<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=absentee_list" style="text-align: left">点呼欠席者一覧</a> ]
<br>
</td></tr>

</table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
