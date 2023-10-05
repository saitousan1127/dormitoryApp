<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
</head>
<body>
{$message}
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<form {$form.attributes}>
{$form.hidden}
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
      <tr><td>メンテナンスモード：{$form.submit.html}</td></tr>
      {if isset($maint_time)}
        <tr><td><div style="color:red; font-size: smaller;">メンテナンスモードを解除できるのは{$maint_time}からです．</div></td></tr>
      {/if}
      <tr>
      <td>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=pass_modify&action=form">パスワード変更</a> ]---Systemアカウントのパスワードを変更します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=delete_old">古いデータの削除</a> ]---ずっと前に登録された寮生や外泊願、欠食届などのデータを削除します。
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=mlist&action=form">寮生一覧</a> ]---寮生の検索・更新・削除を行います
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=tlist&action=form">教員一覧</a> ]---教員の検索・更新・削除を行います
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=room">居住可能部屋設定</a> ]---寮生が居住可能な部屋を設定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=holiday">祝日設定</a> ]---祝日を設定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=long_vacation">長期休暇期間設定</a> ]---夏休みや冬休みなどの長期休暇期間を設定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=kessyoku_list&action=list">提出された欠食届の処理</a> ]---寮生から提出された欠食届を受理するか受理しないか決定します
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=kessyoku_log&action=list">処理した欠食届一覧</a> ]---処理した欠食届の履歴が見れます
<br>
</td></tr>
<tr><td align="left">
<br>
[ <a href="{$SCRIPT_NAME}?type=absentee_list" style="text-align: left">点呼欠席者一覧</a> ]
<br>
</td></tr>
         </td>
      </tr>
    </table>
</div>
<input type="hidden" name="rand" value="{$rand}">
</form>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
