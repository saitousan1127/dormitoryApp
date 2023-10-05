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
<div align="left">[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]</div>
{if $type=='kessyoku_log'}
<div align="left">[ <a href="{$SCRIPT_NAME}?type=kessyoku_log&action=list">履歴表示【欠食届】</a> ]</div>
{/if}
{if isset($message)}
  <br><div style="color:red; font-size: smaller;">{$message}</div>
{/if}
 <form {$form.attributes}>
 <!--<form method="post" id="Form" action="/index.php">-->
 
 <div align="center"><font size="6">欠食届</font></div>
 {$form.hidden}
<table style="border-collapse: collapse" align="center">
<tr>
<td><div id="error" style="color:red; font-size: smaller;" align="center"></div></td>
</tr>
{if $type=="kessyoku"}
<tr>
<td>
{if isset($s_day)&&isset($f_day)}
開始日：<input type="date" name="s_day" id="s_day" value="{$s_day}">～終了日：<input type="date" name="f_day" id="f_day" value="{$f_day}">  
<input type="hidden" name="hidden_s_day" value="{$s_day}"><input type="hidden" name="hidden_f_day" value="{$f_day}">
{else}
開始日：<input type="date" name="s_day" id="s_day" value="">～終了日：<input type="date" name="f_day" id="f_day" value="">
{/if}
{$form.submit3.html}
</td>
</tr>
{/if}
<tr><td>　</td></tr>
<tr>
<td>
{if isset($table)}
<table>
<tr id="table">
{if isset($reason)}
欠食理由 (<input type="text" size="30" name="k_reason" id="k_reason" value="{$reason}">)
{else}
欠食理由 (<input type="text" size="30" name="k_reason" id="k_reason">)
{/if}
{$table}
</tr>
</table>
{if $type=='kessyoku'}
<input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete"><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
{else}
<input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete" {$checked}><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
{/if}
{/if}
</td>
</tr>

</table>
        <input type="hidden" name="rand" value="{$rand}">
        <input type="hidden" name="type" value="{$type}">
        <input type="hidden" name="action" value="{$action}">

        {if ( $form.submit2.attribs.value != "" ) }
            {$form.submit2.html}
        {else}
            {$form.reset.html}
        {/if}
        {if ( $form.submit.attribs.value != "" ) }
             {$form.submit.html}
        {/if}
</form>
</div>
{if $form.javascript}
    {$form.javascript}
{/if}
<script type="text/javascript" src="../js/kessyoku.js" async></script>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>