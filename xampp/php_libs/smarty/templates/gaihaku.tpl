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
{if $type=='log'}
<div align="left">[ <a href="{$SCRIPT_NAME}?type=log&action=list">履歴表示【外泊願】</a> ]</div>
{/if}
 <form {$form.attributes}>
 {if $type=="gaihaku"}
 {if isset($caution1)}
 <a href="{$SCRIPT_NAME}?type=gaihaku&action=form2">{$caution1}</a>
 {/if}
 {else}
 {if $type=="log"}
 <div align="left">提出された外泊願を再編集します</div>
 {else}
 <div align="left">外泊願のテンプレートを作成します</div>
 {/if}
 {/if}
 <div align="center"><font size="6">外泊願</font></div>
 {$form.hidden}

           <table border="2" style="border-collapse: collapse" width="85%" align="center">

            <tr>
              <td rowspan="2" bgcolor="#00f000" width="5%">氏名</td>
              <td align="left" rowspan="2" width="35%">
               氏：{$last_name}　名：{$first_name}
              </td>
              <td bgcolor="#00f000" width="15%">クラス</td>
              <td bgcolor="#00f000" width="30%">棟</td>
              <td bgcolor="#00f000" width="15%">部屋番号</td>
              </tr>
              <tr>
              <td>{$class}</td>
              <td>{$tou}</td>
              <td>{$roomnum}号室</td>
              </tr>
            </table>
            <!--{if isset($form.last_name.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.last_name.error}</div>
            {/if}
            {if isset($form.first_name.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.first_name.error}</div>
            {/if}-->
            {if isset($form.class.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.class.error}</div>
            {/if}
            {if isset($form.tou.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.tou.error}</div>
            {/if}
            {if isset($form.roomnum.error)}
              <div style="color:red; font-size: smaller;" align="center">{$form.roomnum.error}</div>
            {/if}

            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td rowspan="3" bgcolor="#00f000" width="5%">宿泊先<br>及び<br>連絡先</td>
            <td rowspan="2" bgcolor="#00f000" width="5%">宿泊先<br>住所</td>
            <td align="left" width="70%">〒{$form.psCode1.html}-{$form.psCode2.html}</td>
            <td rowspan="2" bgcolor="#00f000">{$form.tel.label}</td>
            </tr>
            <tr>
            <td align="left" width="70%">{$form.address.label}：{$form.address.html}</td>
            </tr>
            <tr>
            <td bgcolor="#00f000"  width="5%">相手<br>氏名等</td>
            <td align="left" width="70%">
              {$form.last_name2.label}：{$form.last_name2.html}　{$form.first_name2.label}：{$form.first_name2.html}
            </td>
            <td>{$form.tel.html}</td>
            </tr>
            </table>

          {if isset($form.psCode1.error)&&isset($form.psCode2.error)}
           <div style="color:red; font-size: smaller;" align="center">{$form.psCode1.error}</div>
          {else}
            {if isset($form.psCode1.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.psCode1.error}</div>
            {/if}
            {if isset($form.psCode2.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.psCode2.error}</div>
            {/if}
          {/if}
          {if isset($form.address.error)}
           <div style="color:red; font-size: smaller;" align="center">{$form.address.error}</div>
          {/if}
          {if isset($form.last_name2.error)}
           <div style="color:red; font-size: smaller;" align="center">{$form.last_name2.error}</div>
          {/if}
          {if isset($form.first_name2.center)}
           <div style="color:red; font-size: smaller;" align="center">{$form.first_name2.error}</div>
          {/if}
          {if isset($form.tel.error)}
            <div style="color:red; font-size: smaller;" align="center">{$form.tel.error}</div>
          {/if}

           {if $type=='gaihaku'||$type=='log'}
            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td bgcolor="#00f000" width="5%">日程</td>
            <td align='center'>


            {if $action==='complete'}
            {$s_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}
            <input type="hidden" name="s_day" value="{$s_day|substr:0:10}">
            {else}
            <input type="date" name="s_day" value="{$s_day|substr:0:10}">
            {/if}
            　{$form.s_time.html}{$form.s_time.label}　～
            　
            {if $action==='complete'}
            {$f_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}
            <input type="hidden" name="f_day" value="{$f_day|substr:0:10}">
            {else}
            <input type="date" name="f_day" value="{$f_day|substr:0:10}">
            {/if}
            　{$form.f_time.html}{$form.f_time.label}
            </td>
            </tr>
            </table>
            {if isset($form.s_day.error)}
              <div style="color:red; font-size: smaller;" align="center">{$form.s_day.error}</div>
            {/if}
            {if isset($form.s_time.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.s_time.error}</div>
            {/if}
            {if isset($form.f_day.error)}
              <div style="color:red; font-size: smaller;" align="center">{$form.f_day.error}</div>
            {/if}
            {if isset($form.f_time.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.f_time.error}</div>
            {/if}
          {/if}

            <table border="2" style="border-collapse: collapse" width="85%" height="20%" align="center">
            <tr>
            <td rowspan="2" bgcolor="#00f000" width="5%">理由</td>
            <td align="left" height="20%">外泊理由：
              {$form.dest.reason.elements['帰省'].html}<label for="kisei">帰省</label>/
              {$form.dest.reason.elements['その他'].html}<label for="sonota">その他</label>　　<font color=red size="2">※その他は帰省先が保護者以外の場合に選択してください．</font>
            </td>
            <td rowspan="2" width="10%">寮監印</td><td rowspan="2" width="10%"></td>
            <td rowspan="2" width="10%">寮務主事印<br>担当主事補印<br>又は担任印</td><td rowspan="2" width="10%"></td>
            </tr>
            <tr>
            <td align="left" height="80%">{$form.riyuu.html}</td>
            </tr>
            </table>
            <!--$form.reason_gp_dest.error)-->
            {if isset($form.dest.error)}
             <div style="color:red; font-size: smaller;" align="center">{$form.dest.error}</div>
            {/if}

           {if $action!="confirm"}
           {if isset($table)}
           <div align="center"><font size="6">欠食届</font></div>
           欠食理由 (<input type="text" name="k_reason" size="50" value= "{$value}">)
           {if $type=='log'}
           <div style="color:red; font-size: smaller;">※3日後よりも前の日付の欠食申請に関しては修正・削除ができません．</div>
           {/if}
           <table align="center">
           <tr>
           {$table}
           </tr>
           </table>
           {if $type=='gaihaku'}
           <input type="checkbox" name="kessyoku" value="TRUE" id="kessyoku" checked><label for="kessyoku">この欠食届を提出する</label>
           <br><input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete"><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
           <div style="color:red;" align="center">※チェックがない欠食届は提出されません。<br>※提出が13時を過ぎた場合、3日後の届は無視されます。</div>
           {else}
           <input type="checkbox" name="kessyoku" value="TRUE" id="kessyoku" checked><label for="kessyoku">この欠食届を編集する</label><br>
           <input type="checkbox" name="all_delete" value="TRUE" id="all_delete"><label for="all_delete">この欠食届を削除する(3日後よりも前の申請は削除不可)</label>
           <br><input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete" {$checked}><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
           {/if}
           {else}
           {if $type=='gaihaku'}
           欠食届は提出できません．
           {else if $type=='log'}
           編集可能な欠食届がありませんでした. 
           {/if}
           {/if}
           {/if}

           {if $action=="confirm" && $type=='log'}
           <input type="checkbox" name="kessyoku" value="TRUE" id="kessyoku" checked><label for="kessyoku">いっしょに提出された欠食届編集する</label>
           {/if}
           <br>
          <input type="hidden" name="rand" value="{$rand}">
          <input type="hidden" name="type"   value="{$type}">
          <input type="hidden" name="action" value="{$action}">
          {if isset($message)}
            <div style="color:red; font-size: smaller;">{$message}</div><br>
          {/if}
          {if ( $form.submit2.attribs.value != "" ) }
              {$form.submit2.html}
            {else}
              {$form.reset.html}
            {/if}
            {$form.submit.html}

        </form>

</div>
{if $form.javascript}
    {$form.javascript}
{/if}
<script type="text/javascript" src="../js/gaihaku.js" async></script>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>