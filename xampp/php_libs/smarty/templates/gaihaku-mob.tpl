<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<!--<script type="text/javascript" src="js/quickform.js" async></script>-->
</head>
<body>
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<hr>
 <form {$form.attributes}>
 {$form.hidden}
           <table border="1">
             <tr>
             <td align="left">
             [ <a href="{$SCRIPT_NAME}">トップページへ</a> ]
             </td>
             <td>
 	           {$message}
              </td>
            </tr>

            <tr>
            <td align="left">必要情報を入力してください</td>
            </tr>

            <tr>
              <td align="center" colspan="4">{$form.last_name.label}：{$form.last_name.html}{$form.first_name.label}：{$form.first_name.html}</td>
            </tr>
            {if isset($form.last_name.error)}
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;">{$form.last_name.error}</div></td></tr>
            {/if}
            {if isset($form.first_name.error)}
                  <tr><td></td><td align="left"><div style="color:red; font-size: smaller;">{$form.first_name.error}</div></td></tr>
            {/if}

            <tr>
              <td align="right">{$form.class.label}：</td>
              <td style="text-align:left;">
              {$form.class.html}
              </td>
              </tr>
                {if isset($form.class.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.class.error}</div></td></tr>
                {/if}


            <tr>
              <td align="right">{$form.tou.label}：</td>
              <td style="text-align:left;">
              {$form.tou.html}
              </td>
              </tr>
                {if isset($form.tou.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.tou.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.roomnum.label}：</td>
              <td style="text-align:left;">
              {$form.roomnum.html}
              </td>
              </tr>
                {if isset($form.roomnum.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.roomnum.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.aorb.label}：</td>
              <td style="text-align:left;">
              {$form.aorb.html}
              </td>
              </tr>
                {if isset($form.aorb.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.aorb.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.psCode1.label}：</td>
              <td style="text-align:left;">
              {$form.psCode1.html}
              </td>
              </tr>
                {if isset($form.psCode1.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.psCode1.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.psCode2.label}：</td>
              <td style="text-align:left;">
              {$form.psCode2.html}
              </td>
              </tr>
                {if isset($form.psCode2.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.psCode2.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.address.label}：</td>
              <td style="text-align:left;">
              {$form.address.html}
              </td>
              </tr>
                {if isset($form.address.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.address.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.last_name2.label}：</td>
              <td style="text-align:left;">
              {$form.last_name2.html}
              </td>
              </tr>
                {if isset($form.last_name2.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.last_name2.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.first_name2.label}：</td>
              <td style="text-align:left;">
              {$form.first_name2.html}
              </td>
              </tr>
                {if isset($form.first_name2.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.first_name2.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.tel.label}：</td>
              <td style="text-align:left;">
              {$form.tel.html}
              </td>
              </tr>
                {if isset($form.tel.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.tel.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.s_day.label}：</td>
              <td style="text-align:left;">
              {$form.s_day.Y.html}{$form.s_day.m.html}{$form.s_day.d.html}
              </td>
              </tr>
                {if isset($form.s_day.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.s_day.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.s_time.label}：</td>
              <td style="text-align:left;">
              {$form.s_time.html}
              </td>
              </tr>
                {if isset($form.s_time.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.s_time.error}</div></td></tr>
                {/if}

             <tr>
              <td align="right">{$form.f_day.label}：</td>
              <td style="text-align:left;">
              {$form.f_day.Y.html}{$form.f_day.m.html}{$form.f_day.d.html}
              </td>
              </tr>
                {if isset($form.f_day.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.riyuu.error}</div></td></tr>
                {/if}

            <tr>
              <td align="right">{$form.f_time.label}：</td>
              <td style="text-align:left;">
              {$form.f_time.html}
              </td>
              </tr>
                {if isset($form.f_time.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.f_time.error}</div></td></tr>
                {/if}

            <tr>
            <td></td>

              <td style="text-align:left;">
              外泊理由<br>
              {$form.dest.reason.elements['帰省'].html}<label for="kisei">帰省</label>
              <br>
              {$form.dest.reason.elements['その他'].html}<label for="sonota">その他</label>
              </td>
              </tr>
                {if isset($form.reason_gp.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.reason_gp.error}</div></td></tr>
                {/if}

            <tr>
              <td style="text-align:left;">
              {$form.riyuu.html}
              </td>
              </tr>
                {if isset($form.riyuu.error)}
                  <tr><td></td><td><div style="color:red; font-size: smaller;">{$form.riyuu.error}</div></td></tr>
                {/if}

            <tr>
            <td></td>
            <td>
            {if ( $form.submit2.attribs.value != "" ) }
              {$form.submit2.html}
            {else}
              {$form.reset.html}
            {/if}
            {$form.submit.html}
            <input type="hidden" name="type"   value="{$type}">
            <input type="hidden" name="action" value="{$action}">
            <input type="hidden" name="i" value="{$i}">
            </td>
            </tr>
          </table>
        </form>


</div>
{if $form.javascript}
    {$form.javascript}
{/if}
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>