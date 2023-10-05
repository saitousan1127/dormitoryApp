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
<div align="left"> [ <a href="{$SCRIPT_NAME}?type={$type}">戻る</a> ]</div>
{if isset($message)}
  <br><div style="color:red; font-size: smaller;">{$message}</div>
{/if}

 <div align="center"><font size="6">外泊願</font></div>
 <form {$form.attributes}>
 {$form.hidden}

           <table border="2" style="border-collapse: collapse" width="85%" align="center">

            <tr>
              <td rowspan="2" bgcolor="#00f000" width="5%">氏名</td>
              <td align="left" rowspan="2" width="35%">
               氏：{$gaihaku.last_name}　名：{$gaihaku.first_name}
              </td>
              <td bgcolor="#00f000" width="15%">学年/クラス</td>
              <td bgcolor="#00f000" width="30%">棟</td>
              <td bgcolor="#00f000" width="15%">部屋番号</td>
              </tr>
              <tr>
              <td>{$gaihaku.class}</td>
              <td>{$gaihaku.tou}</td>
              <td>{$gaihaku.roomnum}号室</td>
              </tr>
            </table>
            
            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td rowspan="3" bgcolor="#00f000" width="5%">宿泊先<br>及び<br>連絡先</td>
            <td rowspan="2" bgcolor="#00f000" width="5%">宿泊先<br>住所</td>
            <td align="left" width="70%">〒{$gaihaku.psCode1}-{$gaihaku.psCode2}</td>
            <td rowspan="2" bgcolor="#00f000">外泊先の電話番号<br>※ハイフン(-)も含める</td>
            </tr>
            <tr>
            <td align="left" width="70%">住所：{$gaihaku.address}</td>
            </tr>
            <tr>
            <td bgcolor="#00f000"  width="5%">相手<br>氏名等</td>
            <td align="left" width="70%">
              氏：{$gaihaku.last_name2}　名：{$gaihaku.first_name2}
            </td>
            <td>{$gaihaku.tel}</td>
            </tr>
            </table>

         
            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td bgcolor="#00f000" width="5%">日程</td>
            <td>
             {$gaihaku.s_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}　{$gaihaku.s_time}時　～　
             {$gaihaku.f_day|strtotime|date_format:"%Y&#24180;%m&#26376;%d&#26085;"}　{$gaihaku.f_time}時
            </td>
            </tr>
            </table>
      
            <table border="2" style="border-collapse: collapse" width="85%" height="20%" align="center">
            <tr>
            <td rowspan="2" bgcolor="#00f000" width="5%">理由</td>
            <td align="left" height="20%">外泊理由：
              {$gaihaku.reason}
            </td>
            <td rowspan="2" width="10%">寮監印</td><td rowspan="2" width="10%"></td>
            <td rowspan="2" width="10%">寮務主事印<br>担当主事補印<br>又は担任印</td><td rowspan="2" width="10%"></td>
            </tr>
            <tr>
            <td align="left" height="80%">{$gaihaku.riyuu}</td>
            </tr>
            </table>

          <input type="hidden" name="type"   value="{$type}">
          <input type="hidden" name="action" value="{$action}">
          <br>
          {if ($i)}
          <font size="5">[<a href="{$SCRIPT_NAME}?type=delete&action=complete&id={$gaihaku.id}{$add_pageID}">確認済み</a>] </font>
          {/if}
          </form>
</div>
{if $form.javascript}
    {$form.javascript}
{/if}
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>