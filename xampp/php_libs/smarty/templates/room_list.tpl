<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="../css/room_list.css">
<script type="text/javascript" src="../js/quickform.js" async></script>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<hr>
<div align="left">[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]</div>
 <!--<div align="center"><font size="6">{$state}</font></div>-->
 <form {$form.attributes}>
 {$form.hidden}

    <table align="center" frame="box">
    <tr>
    <td><label for="tou">棟</label></td><td>：</td>
    <td>
    <select name="tou" id="tou">
    <option value="" id="select_tou">選択してください</option><option value="N" id="north">北寮</option><option value="E" id="east">女子寮</option><option value="S" id="south">南寮</option>
    </select>
    </td><td>　</td>
    <td><label for="floor">階</label></td><td>：</td>
    <td>
    <select name="floor" id="floor">
    <option value="" id="select_floor">選択してください</option><option value="2" id="floor2">2</option><option value="3" id="floor3">3</option><option value="4" id="floor4">4</option><option value="5" id="floor5">5</option>
    </select>
    </td>
    </tr>
    <tr>
    <td colspan="7" align="left">新しい部屋を追加：<input type="text" name="new_room"></td>
    </tr>
    <tr>
    <td colspan="7" align="left"><input type="checkbox" name="drive_out" value="drive_out" id="drive_out"><label for="oidasi">全員部屋から追い出す</label></td>
    </tr>
    <tr>
    <td colspan="7" align="right">{$form.submit.html}</td>
    </tr>
    </table>

    <table align="center">
    <tr><td colspan=3>{$message}</td></tr>
    <tr>
{if ($Ndata)}
    <td valign="top">
    北寮：<br>
    <table border="1" align="center">
    <tr><th>部屋番号</td><th></th><th>現居住者</th><th></th></tr>

   {foreach item=item from=$Ndata}

    <tr id="{$item.roomnum}" class="default_row">
    <td>{$item.roomnum|escape:"html"}</td>
    <td>
    <input type="radio" name="{$item.roomnum}" value="TRUE" id="{$item.roomnum|cat:'T'}" {$item.checkT}><label for="{$item.roomnum|cat:'T'}">居住可</label>／
    <input type="radio" name="{$item.roomnum}" value="FALSE" id="{$item.roomnum|cat:'F'}" {$item.checkF}><label for="{$item.roomnum|cat:'F'}">居住不可</label>
    </td>
    <td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
    <td><button type="button" bgcolor="" onclick='(function() { let val = "{$item.roomnum}"; clickDeleteBtn(val); } )();'>削除</button></td>
    </tr>
    {/foreach}
    </table>
    </td>
    {/if}
    
    {if ($Edata)}
    <td>　</td>
    <td valign="top">
    東寮：<br>
    <table  border="1" align="center">
    <tr><th>部屋番号</td><th></th><th>現居住者</th><th></th></tr>

   {foreach item=item from=$Edata}
    <tr id="{$item.roomnum}"  class="default_row">
    <td>{$item.roomnum|escape:"html"}</td>
    <td>
    <input type="radio" name="{$item.roomnum}" value="TRUE" id="{$item.roomnum|cat:'T'}" {$item.checkT}><label for="{$item.roomnum|cat:'T'}">居住可</label>／
    <input type="radio" name="{$item.roomnum}" value="FALSE" id="{$item.roomnum|cat:'F'}" {$item.checkF}><label for="{$item.roomnum|cat:'F'}">居住不可</label>
    </td>
    <td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
    <td><button type="button" bgcolor="" onclick="(function() { let val = {$item.roomnum}; clickDeleteBtn(val); } )();">削除</button></td>
    </tr>
    {/foreach}
    </table>
    </td>
    {else}
    <td>a</td>
    {/if}

    {if ($Sdata)}
    <td>　</td>
    <td valign="top">
    南寮：<br>
    <table  border="1" align="center">
    <tr><th>部屋番号</td><th></th><th>現居住者</th><th></th></tr>

   {foreach item=item from=$Sdata}

    <tr id="{$item.roomnum}" class="default_row">
    <td>{$item.roomnum|escape:"html"}</td>
    <td>
    <input type="radio" name="{$item.roomnum}" value="TRUE" id="{$item.roomnum|cat:'T'}" {$item.checkT}><label for="{$item.roomnum|cat:'T'}">居住可</label>／
    <input type="radio" name="{$item.roomnum}" value="FALSE" id="{$item.roomnum|cat:'F'}" {$item.checkF}><label for="{$item.roomnum|cat:'F'}">居住不可</label>
    </td>
    <td>{$item.last_name|escape:"html"} {$item.first_name|escape:"html"}</td>
    <td><button type="button" bgcolor="" onclick="(function() { let val = {$item.roomnum}; clickDeleteBtn(val); } )();">削除</button></td>
    </tr>
    {/foreach}
    </table>
    </td>
    {/if}

    </tr>
    </table>
          <input type="hidden" name="rand" value="{$rand}">
          <input type="hidden" name="type"  value="{$type}">
        </form>

</div>
{if $form.javascript}
    {$form.javascript}
{/if}
<script type="text/javascript" src="../js/room_list.js" async></script>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>