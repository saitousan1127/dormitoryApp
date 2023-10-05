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
      <td style="vertical-align:top;">
            [ <a href="{$SCRIPT_NAME}?type=logout">ログアウト</a> ]
      </td>
        <td style="vertical-align:top;">
        <div style="text-align: left; margin-left:15px;">
          {$last_name|escape:"html"} {$first_name|escape:"html"} さん、{$greeting}（{$disp_login_state}）
          <br>
          <br>
          <a href="{$SCRIPT_NAME}?type=modify&action=form">プロフィール編集</a>
          <br>
          <br>
	        <a href="{$SCRIPT_NAME}?type=pass_modify&action=form">パスワードの変更</a>
          <br>
          <br>
          <a href="{$SCRIPT_NAME}?type=tpl&action=form">外泊願テンプレート作成</a>
          <br>
          <br>
	        <a href="{$SCRIPT_NAME}?type=gaihaku&action=form">外泊願　作成/提出</a>
          <br>
          <br>
          <a href="{$SCRIPT_NAME}?type=kessyoku&action=create">欠食届　作成/提出</a>
          <br>
          <br>
	        <a href="{$SCRIPT_NAME}?type=log&action=list">履歴表示【外泊願】</a>
          <br>
          <br>
          <a href="{$SCRIPT_NAME}?type=kessyoku_log&action=list">履歴表示【欠食届】</a>
          <br>
        </div>
        </td>
      </tr>
    </table>
    <div align='center'>今日が誕生日の人({$today|escape:"html"})</div>
    <table align='center'>
    {foreach item=item from=$data}
    <tr>
    <td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}さん</td>
    <td>　{$item.birthday|escape:"html"}才</td>
    </tr>
    {/foreach}

    </table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
