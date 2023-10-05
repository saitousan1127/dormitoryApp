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

           <table>
             <tr>
             <td align="left">
	            [ <a href="{$SCRIPT_NAME}?type=treset&action=top">トップページへ</a> ]<br>
             {if ($is_system) }
      	      [ <a href="{$SCRIPT_NAME}?type=tlist&action=form{$add_pageID}">教員一覧</a> ]<br>
             {/if}
	           <br><br>
	           {$disp_login_state}
             </td>
             <td>
 	           {$message}
             <form {$form.attributes}>
             {$form.hidden}
            </tr>

            <tr>
            <td align="left">必要情報を入力してください</td>
            </tr>

            {if $type != 'tmodify'}
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.username.label}：</td>
              <td style="text-align:left;">
              {$form.username.html}@sendai-nct.ac.jp
              </td>
              </tr>
                {if isset($form.username.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.username.error}</div></td></tr>
                {/if}

              {/if}


            <tr>
              <td style="vertical-align:top; text-align:right;" >氏：</td>
              <td style="text-align:left;">
                {$form.last_name.html}
                </td>
            </tr>
            {if isset($form.last_name.error)}
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;">{$form.last_name.error}</div></td></tr>
            {/if}

            <tr>
              <td style="vertical-align:top; text-align:right;">名：</td>
              <td style="text-align:left;">
                {$form.first_name.html}
              </td>
            </tr>
            {if isset($form.first_name.error)}
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;">{$form.first_name.error}</div></td></tr>
            {/if}

            <tr>
              <td style="vertical-align:top; text-align:right;">氏(ふりがな)：</td>
              <td style="text-align:left;">
                {$form.h_last_name.html}
                </td>
            </tr>
            {if isset($form.h_last_name.error)}
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;">{$form.h_last_name.error}</div></td></tr>
            {/if}

            <tr>
              <td style="vertical-align:top; text-align:right;" >名(ふりがな)：</td>
              <td style="text-align:left;">
                {$form.h_first_name.html}
                </td>
            </tr>
            {if isset($form.h_first_name.error)}
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;">{$form.h_first_name.error}</div></td></tr>
            {/if}
            
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.class.label}：</td>
              <td style="text-align:left;">{$form.class.html}</td>
            </tr>
            {if isset($form.class.error)}
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;">{$form.class.error}</div></td></tr>
            {/if}


            <tr>
            <td colspan=2>
              {if $message}
                <div style="color:red; font-size: smaller;">{$message}</div>
              {/if}
            </td>
            </tr>
            <tr>
            <td colspan=2>
            {if ( $form.submit2.attribs.value != "" ) }
              {$form.submit2.html}
            {else}
              {$form.reset.html}
            {/if}
            {$form.submit.html}
            <input type="hidden" name="rand" value="{$rand}">
            <input type="hidden" name="type"   value="{$type}">
            <input type="hidden" name="action" value="{$action}">
            </td>
            </tr>
          </table>
          <br>
        </form>
      
</div>
{if $form.javascript}
    {$form.javascript}
{/if}
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
<script type="text/javascript" src="../js/KtoH.js" async></script>
</body>
</html>