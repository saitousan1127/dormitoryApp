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
 <div align="center"><font size="6">{$state}</font></div>
 {$form.hidden}

    <table align="center">
    <tr>
    <td><label for="day">日付</label></td><td>：</td>
    <td><input type="date" name="day" id="tou" value=""></td><td>　</td>
    <td><label for="tou">棟</label></td><td>：</td>
    <td>
    <select name="tou" id="tou">
    <option value="" id="select_tou">選択してください</option><option value="N" id="north">北寮</option><option value="E" id="east">女子寮</option><option value="S" id="south">南寮</option>
    </select>
    </td><td>　</td>
    <td><label for="floor">階</label></td><td>：</td>
    <td>
    <select name="floor" id=""floor>
    <option value="" id="select_floor">選択してください</option><option value="2" id="floor2">2</option><option value="3" id="floor3">3</option><option value="4" id="floor4">4</option><option value="5" id="floor5">5</option>
    </select>
    </td><td>　</td>
    <td>{$form.submit.html}</td>
    </tr>

    <tr><td>
    <table>
    <tr><th>N212B</td><th>N211B</th><th>N210B</th><th>N209B</th><th>N208B</th><th>N207B</th><th>N206B</th></tr>
    <tr>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr><td align="center"></td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="11B" value="出席" id="11B_attend"><label for="11B_attend">いる</label></td>
    <td align="center"><input type="radio" name="11B" value="未出席" id="11B_non_attend"><label for="11B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="10B" value="出席" id="10B_attend"><label for="10B_attend">いる</label></td>
    <td align="center"><input type="radio" name="10B" value="未出席" id="10B_non_attend"><label for="10B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="09B" value="出席" id="09B_attend"><label for="09B_attend">いる</label></td>
    <td align="center"><input type="radio" name="09B" value="未出席" id="09B_non_attend"><label for="09B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="08B" value="出席" id="08B_attend"><label for="08B_attend">いる</label></td>
    <td align="center"><input type="radio" name="08B" value="未出席" id="08B_non_attend"><label for="08B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="07B" value="出席" id="07B_attend"><label for="07B_attend">いる</label></td>
    <td align="center"><input type="radio" name="07B" value="未出席" id="07B_non_attend"><label for="07B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="06B" value="出席" id="06B_attend"><label for="06B_attend">いる</label></td>
    <td align="center"><input type="radio" name="06B" value="未出席" id="06B_non_attend"><label for="06B_non_attend">いない</label></td>
    </tr>
    </table></td>
    </tr>
    <tr>
    <td>N212A</td><td>N211A</td><td>N210A</td><td>N209A</td><td>N208A</td><td>N207A</td><td>N206A</td>
    </tr>
    <tr>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12Aa" value="出席" id="12Aa_attend"><label for="12Aa_attend">いる</label></td>
    <td align="center"><input type="radio" name="12Aa" value="未出席" id="12Aa_non_attend"><label for="12Aa_non_attend">いない</label></td>
    </tr>
    <tr><td>--------------</td></tr>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12Ab" value="出席" id="12Ab_attend"><label for="12Ab_attend">いる</label></td>
    <td align="center"><input type="radio" name="12Ab" value="未出席" id="12Ab_non_attend"><label for="12Ab_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="11Aa" value="出席" id="11Aa_attend"><label for="11Aa_attend">いる</label></td>
    <td align="center"><input type="radio" name="11Aa" value="未出席" id="11Aa_non_attend"><label for="11Aa_non_attend">いない</label></td>
    </tr>
    <tr><td>--------------</td></tr>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="11Ab" value="出席" id="11Ab_attend"><label for="11Ab_attend">いる</label></td>
    <td align="center"><input type="radio" name="11Ab" value="未出席" id="11Ab_non_attend"><label for="11Ab_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    <tr><td>--------------</td></tr>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    <tr><td>--------------</td></tr>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    <tr><td>--------------</td></tr>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    </table></td>
    <td><table>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    <tr><td>--------------</td></tr>
    <tr><td>name</td></tr>
    <tr><td>申請</td><td>：</td><td>外泊</td></tr>
    <tr>
    <td align="center"><input type="radio" name="12B" value="出席" id="12B_attend"><label for="12B_attend">いる</label></td>
    <td align="center"><input type="radio" name="12B" value="未出席" id="12B_non_attend"><label for="12B_non_attend">いない</label></td>
    </tr>
    </table></td>

    </tr>
    </table>
    </td></tr>
    
    </table>

          <input type="hidden" name="type"   value="{$type}">
          <input type="hidden" name="action" value="{$action}">
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