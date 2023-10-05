<?php
/* Smarty version 3.1.30, created on 2023-02-06 13:50:34
  from "C:\xampp\php_libs\smarty\templates\delete_old.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63e0871a994845_65848247',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e5597a56f588106771942977a87d0b604b82cce' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\delete_old.tpl',
      1 => 1675658608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63e0871a994845_65848247 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/delete_old.css">
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
    <table>
      <tr>
        
      <td style="vertical-align: top;" align="left">
      [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]
	</td>
  <td>
  <td align="left">
      <br>

      </td>
      </tr>
      <tr><td align="left">　<font size=5>削除と凍結について</font></td></tr>
      <tr><td align="left">　<font size=2>凍結されたアカウントは、ログインができなくなります.</font></td></tr>
      <tr><td align="left">　<font size=2>寮生アカウントが凍結された場合、さらにその寮生の提出物が非表示となります.</font></td></tr>
      <tr><td align="left">　<font size=2>寮生アカウントが削除された場合、その寮生が提出した外泊願、欠食届、外泊願テンプレート、点呼ログのすべての情報が完全に削除されます.</font></td></tr>
      <tr><td align="left">　<font size=2>教員アカウントが削除された場合、その教員が処理した外泊願は削除されません.</font></td></tr>
      <tr><td align="left">　<font size=2>削除されたデータは、復元することができません.</font></td></tr>
<tr>
<td>
<tr><td align="left">
<br>
　<input type='date' id='delete_old_gaihaku_date' max=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>より過去に提出された外泊願をすべて<font color="red">削除</font>する------>
<button type="button" onclick="dispOverlay('delete_old_gaihaku');">実行</button><br>
<div id='delete_old_gaihaku_error' style="color:red; font-size: smaller;"></div>

<div id='delete_old_gaihaku' class="back-overlay-off" onclick="closeOverlay('delete_old_gaihaku');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="5">
<div id='delete_old_gaihaku_text'></div>より前に提出された外泊願を<font color="red">削除</font>しますか？
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('delete_old_gaihaku');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='delete_old_gaihaku();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td></tr>

<tr><td align="left">
<br>
　<input type='date' id='delete_old_kessyoku_date' max=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>より過去に提出された欠食届をすべて<font color="red">削除</font>する------>
<button type="button" onclick="dispOverlay('delete_old_kessyoku');">実行</button><br>
<div id='delete_old_kessyoku_error' style="color:red; font-size: smaller;"></div>

<div id='delete_old_kessyoku' class="back-overlay-off" onclick="closeOverlay('delete_old_kessyoku');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<div align="center"><font size="5">
<div id='delete_old_kessyoku_text'></div>より前に提出された欠食届を<font color="red">削除</font>しますか？
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('delete_old_kessyoku');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='delete_old_kessyoku();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td></tr>

<tr><td align="left">
<br>
　<input type='date' id='delete_old_tenko_date' max=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>より過去に登録された点呼履歴を削除する<font color="red">削除</font>する------>
<button type="button" onclick="dispOverlay('delete_old_tenko');">実行</button><br>
<div id='delete_old_tenko_error' style="color:red; font-size: smaller;"></div>

<div id='delete_old_tenko' class="back-overlay-off" onclick="closeOverlay('delete_old_tenko');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<div align="center"><font size="5">
<div id='delete_old_tenko_text'></div>より前に登録された点呼履歴を<font color="red">削除</font>しますか？
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('delete_old_tenko');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='delete_old_kessyoku();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>
</td></tr>

<tr><td align="left">
<br>
　<input type='date' id='ban_old_member_date' max=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>より過去に登録された寮生アカウントをすべて<font color="blue">凍結</font>する------>
<button type="button" onclick="dispOverlay('ban_old_member');">実行</button><br>
<div id='ban_old_member_error' style="color:red; font-size: smaller;"></div>

<div id='ban_old_member' class="back-overlay-off" onclick="closeOverlay('ban_old_member');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="5">
<div id='ban_old_member_text'></div>より前に登録された寮生アカウントをすべて<font color="blue">凍結</font>しますか？
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('ban_old_member');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='ban_old_member();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>

</td></tr>
<tr><td align="left">
<br>
　<input type='date' id='delete_old_member_date' max=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>より前に登録された寮生アカウントをすべて<font color="red">削除</font>する------>
<button type="button" onclick="dispOverlay('delete_old_member');">実行</button><br>
<div id='delete_old_member_error' style="color:red; font-size: smaller;"></div>

<div id='delete_old_member' class="back-overlay-off" onclick="closeOverlay('delete_old_member');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="5">
<div id='delete_old_member_text'></div>より前に登録された寮生アカウントをすべて<font color="red">削除</font>しますか？
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('delete_old_member');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='delete_old_member();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>

</td></tr>
<tr><td align="left">
<br>
　<font color="blue">凍結</font>された寮生アカウントをすべて<font color="red">削除</font>する------>
<button type="button" onclick="dispOverlay2('delete_ban_member');">実行</button><br>
<div id='delete_ban_member_error' style="color:red; font-size: smaller;"></div>

<div id='delete_ban_member' class="back-overlay-off" onclick="closeOverlay('delete_ban_member');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center">
<font size="5">
<font color="blue">凍結</font>された寮生アカウントをすべて<font color="red">削除</font>しますか？
</font>
<div style="color:red; font-size: smaller;">※削除された寮生データとそれに関連するデータは二度と復元できません</div>
</div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('delete_ban_member');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='delete_ban_member();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>

</td></tr>
<tr><td align="left">
<br>
　<input type='date' id='ban_old_teacher_date' max=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>より過去に登録された教員アカウントをすべて<font color="blue">凍結</font>する------>
<button type="button" onclick="dispOverlay('ban_old_teacher');">実行</button><br>
<div id='ban_old_teacher_error' style="color:red; font-size: smaller;"></div>

<div id='ban_old_teacher' class="back-overlay-off" onclick="closeOverlay('ban_old_teacher');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="5">
<div id='ban_old_teacher_text'></div>より前に登録された教員アカウントをすべて<font color="blue">凍結</font>しますか？
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('ban_old_teacher');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='ban_old_teacher();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>

</td></tr>
<tr><td align="left">
<br>
　<input type='date' id='delete_old_teacher_date' max=<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
>より前に登録された教員アカウントをすべて<font color="red">削除</font>する------>
<button type="button" onclick="dispOverlay('delete_old_teacher');">実行</button><br>
<div id='delete_old_teacher_error' style="color:red; font-size: smaller;"></div>

<div id='delete_old_teacher' class="back-overlay-off" onclick="closeOverlay('delete_old_teacher');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center"><font size="5">
<div id='delete_old_teacher_text'></div>より前に登録された教員アカウントをすべて<font color="red">削除</font>しますか？
</font></div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('delete_old_teacher');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='delete_old_teacher();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>

</td></tr>
<tr><td align="left">
<br>
　<font color="blue">凍結</font>された教員アカウントをすべて<font color="red">削除</font>する------>
<button type="button" onclick="dispOverlay2('delete_ban_teacher');">実行</button><br>
<div id='delete_ban_teacher_error' style="color:red; font-size: smaller;"></div>

<div id='delete_ban_teacher' class="back-overlay-off" onclick="closeOverlay('delete_ban_teacher');">
<div class="flex">
<div class="yn-overlay-inner" onclick="clickChild();">
<br>
<br>
<div align="center">
<font size="5">
<font color="blue">凍結</font>された教員アカウントをすべて<font color="red">削除</font>しますか？
</font>
<div style="color:red; font-size: smaller;">※削除された教員データは二度と復元できません</div>
</div>
<br>
<br>
<table align="center">
<tr>
<td><button type="button" class="no_btn" onclick="closeOverlay('delete_ban_teacher');">いいえ</button></td>
<td>　　　</td>
<td><button type="button" class="yes_btn" onclick='delete_ban_teacher();'>はい</button></td>
</tr>
</table>
</div>
</div>
</div>

</td></tr>
</td>
</tr>
</table>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="../js/delete_old.js" async><?php echo '</script'; ?>
>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
