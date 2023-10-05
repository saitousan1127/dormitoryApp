<?php
/* Smarty version 3.1.30, created on 2023-01-25 15:20:01
  from "C:\xampp\php_libs\smarty\templates\gaihaku.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d0ca11155e85_66889875',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a33d2284e891fdef0d90fbf650264523a88780f' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\gaihaku.tpl',
      1 => 1674627596,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d0ca11155e85_66889875 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<?php echo '<script'; ?>
 type="text/javascript" src="../js/quickform.js" async><?php echo '</script'; ?>
>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
<div align="left">[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]</div>
<?php if ($_smarty_tpl->tpl_vars['type']->value == 'log') {?>
<div align="left">[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=log&action=list">履歴表示【外泊願】</a> ]</div>
<?php }?>
 <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
 <?php if ($_smarty_tpl->tpl_vars['type']->value == "gaihaku") {?>
 <?php if (isset($_smarty_tpl->tpl_vars['caution1']->value)) {?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=gaihaku&action=form2"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</a>
 <?php }?>
 <?php } else { ?>
 <?php if ($_smarty_tpl->tpl_vars['type']->value == "log") {?>
 <div align="left">提出された外泊願を再編集します</div>
 <?php } else { ?>
 <div align="left">外泊願のテンプレートを作成します</div>
 <?php }?>
 <?php }?>
 <div align="center"><font size="6">外泊願</font></div>
 <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>


           <table border="2" style="border-collapse: collapse" width="85%" align="center">

            <tr>
              <td rowspan="2" bgcolor="#00f000" width="5%">氏名</td>
              <td align="left" rowspan="2" width="35%">
               氏：<?php echo $_smarty_tpl->tpl_vars['last_name']->value;?>
　名：<?php echo $_smarty_tpl->tpl_vars['first_name']->value;?>

              </td>
              <td bgcolor="#00f000" width="15%">クラス</td>
              <td bgcolor="#00f000" width="30%">棟</td>
              <td bgcolor="#00f000" width="15%">部屋番号</td>
              </tr>
              <tr>
              <td><?php echo $_smarty_tpl->tpl_vars['class']->value;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['tou']->value;?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['roomnum']->value;?>
号室</td>
              </tr>
            </table>
            <!--<?php if (isset($_smarty_tpl->tpl_vars['form']->value['last_name']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['last_name']['error'];?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['first_name']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['first_name']['error'];?>
</div>
            <?php }?>-->
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['class']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['class']['error'];?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['tou']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['tou']['error'];?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['roomnum']['error'])) {?>
              <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['roomnum']['error'];?>
</div>
            <?php }?>

            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td rowspan="3" bgcolor="#00f000" width="5%">宿泊先<br>及び<br>連絡先</td>
            <td rowspan="2" bgcolor="#00f000" width="5%">宿泊先<br>住所</td>
            <td align="left" width="70%">〒<?php echo $_smarty_tpl->tpl_vars['form']->value['psCode1']['html'];?>
-<?php echo $_smarty_tpl->tpl_vars['form']->value['psCode2']['html'];?>
</td>
            <td rowspan="2" bgcolor="#00f000"><?php echo $_smarty_tpl->tpl_vars['form']->value['tel']['label'];?>
</td>
            </tr>
            <tr>
            <td align="left" width="70%"><?php echo $_smarty_tpl->tpl_vars['form']->value['address']['label'];?>
：<?php echo $_smarty_tpl->tpl_vars['form']->value['address']['html'];?>
</td>
            </tr>
            <tr>
            <td bgcolor="#00f000"  width="5%">相手<br>氏名等</td>
            <td align="left" width="70%">
              <?php echo $_smarty_tpl->tpl_vars['form']->value['last_name2']['label'];?>
：<?php echo $_smarty_tpl->tpl_vars['form']->value['last_name2']['html'];?>
　<?php echo $_smarty_tpl->tpl_vars['form']->value['first_name2']['label'];?>
：<?php echo $_smarty_tpl->tpl_vars['form']->value['first_name2']['html'];?>

            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['form']->value['tel']['html'];?>
</td>
            </tr>
            </table>

          <?php if (isset($_smarty_tpl->tpl_vars['form']->value['psCode1']['error']) && isset($_smarty_tpl->tpl_vars['form']->value['psCode2']['error'])) {?>
           <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['psCode1']['error'];?>
</div>
          <?php } else { ?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['psCode1']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['psCode1']['error'];?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['psCode2']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['psCode2']['error'];?>
</div>
            <?php }?>
          <?php }?>
          <?php if (isset($_smarty_tpl->tpl_vars['form']->value['address']['error'])) {?>
           <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['address']['error'];?>
</div>
          <?php }?>
          <?php if (isset($_smarty_tpl->tpl_vars['form']->value['last_name2']['error'])) {?>
           <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['last_name2']['error'];?>
</div>
          <?php }?>
          <?php if (isset($_smarty_tpl->tpl_vars['form']->value['first_name2']['center'])) {?>
           <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['first_name2']['error'];?>
</div>
          <?php }?>
          <?php if (isset($_smarty_tpl->tpl_vars['form']->value['tel']['error'])) {?>
            <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['tel']['error'];?>
</div>
          <?php }?>

           <?php if ($_smarty_tpl->tpl_vars['type']->value == 'gaihaku' || $_smarty_tpl->tpl_vars['type']->value == 'log') {?>
            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td bgcolor="#00f000" width="5%">日程</td>
            <td align='center'>


            <?php if ($_smarty_tpl->tpl_vars['action']->value === 'complete') {?>
            <?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['s_day']->value),"%Y&#24180;%m&#26376;%d&#26085;");?>

            <input type="hidden" name="s_day" value="<?php echo substr($_smarty_tpl->tpl_vars['s_day']->value,0,10);?>
">
            <?php } else { ?>
            <input type="date" name="s_day" value="<?php echo substr($_smarty_tpl->tpl_vars['s_day']->value,0,10);?>
">
            <?php }?>
            　<?php echo $_smarty_tpl->tpl_vars['form']->value['s_time']['html'];
echo $_smarty_tpl->tpl_vars['form']->value['s_time']['label'];?>
　～
            　
            <?php if ($_smarty_tpl->tpl_vars['action']->value === 'complete') {?>
            <?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['f_day']->value),"%Y&#24180;%m&#26376;%d&#26085;");?>

            <input type="hidden" name="f_day" value="<?php echo substr($_smarty_tpl->tpl_vars['f_day']->value,0,10);?>
">
            <?php } else { ?>
            <input type="date" name="f_day" value="<?php echo substr($_smarty_tpl->tpl_vars['f_day']->value,0,10);?>
">
            <?php }?>
            　<?php echo $_smarty_tpl->tpl_vars['form']->value['f_time']['html'];
echo $_smarty_tpl->tpl_vars['form']->value['f_time']['label'];?>

            </td>
            </tr>
            </table>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['s_day']['error'])) {?>
              <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['s_day']['error'];?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['s_time']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['s_time']['error'];?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['f_day']['error'])) {?>
              <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['f_day']['error'];?>
</div>
            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['f_time']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['f_time']['error'];?>
</div>
            <?php }?>
          <?php }?>

            <table border="2" style="border-collapse: collapse" width="85%" height="20%" align="center">
            <tr>
            <td rowspan="2" bgcolor="#00f000" width="5%">理由</td>
            <td align="left" height="20%">外泊理由：
              <?php echo $_smarty_tpl->tpl_vars['form']->value['dest']['reason']['elements']['帰省']['html'];?>
<label for="kisei">帰省</label>/
              <?php echo $_smarty_tpl->tpl_vars['form']->value['dest']['reason']['elements']['その他']['html'];?>
<label for="sonota">その他</label>　　<font color=red size="2">※その他は帰省先が保護者以外の場合に選択してください．</font>
            </td>
            <td rowspan="2" width="10%">寮監印</td><td rowspan="2" width="10%"></td>
            <td rowspan="2" width="10%">寮務主事印<br>担当主事補印<br>又は担任印</td><td rowspan="2" width="10%"></td>
            </tr>
            <tr>
            <td align="left" height="80%"><?php echo $_smarty_tpl->tpl_vars['form']->value['riyuu']['html'];?>
</td>
            </tr>
            </table>
            <!--$form.reason_gp_dest.error)-->
            <?php if (isset($_smarty_tpl->tpl_vars['form']->value['dest']['error'])) {?>
             <div style="color:red; font-size: smaller;" align="center"><?php echo $_smarty_tpl->tpl_vars['form']->value['dest']['error'];?>
</div>
            <?php }?>

           <?php if ($_smarty_tpl->tpl_vars['action']->value != "confirm") {?>
           <?php if (isset($_smarty_tpl->tpl_vars['table']->value)) {?>
           <div align="center"><font size="6">欠食届</font></div>
           欠食理由 (<input type="text" name="k_reason" size="50" value= "<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
">)
           <?php if ($_smarty_tpl->tpl_vars['type']->value == 'log') {?>
           <div style="color:red; font-size: smaller;">※3日後よりも前の日付の欠食申請に関しては修正・削除ができません．</div>
           <?php }?>
           <table align="center">
           <tr>
           <?php echo $_smarty_tpl->tpl_vars['table']->value;?>

           </tr>
           </table>
           <?php if ($_smarty_tpl->tpl_vars['type']->value == 'gaihaku') {?>
           <input type="checkbox" name="kessyoku" value="TRUE" id="kessyoku" checked><label for="kessyoku">この欠食届を提出する</label>
           <br><input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete"><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
           <?php } else { ?>
           <input type="checkbox" name="kessyoku" value="TRUE" id="kessyoku" checked><label for="kessyoku">この欠食届を編集する</label><br>
           <input type="checkbox" name="all_delete" value="TRUE" id="all_delete"><label for="all_delete">この欠食届を削除する(3日後よりも前の申請は削除不可)</label>
           <br><input type="checkbox" name="auto_delete" value="TRUE" id="auto_delete" <?php echo $_smarty_tpl->tpl_vars['checked']->value;?>
><label for="auto_delete">一日でも申請期限が過ぎた場合に自動削除する</label>
           <?php }?>
           <?php if ($_smarty_tpl->tpl_vars['type']->value == 'gaihaku') {?>
           <div style="color:red;" align="center">※チェックがない欠食届は提出されません。<br>※提出が13時を過ぎた場合、3日後の届は無視されます。</div>
           <?php }?>
           <?php } else { ?>
           <?php if ($_smarty_tpl->tpl_vars['type']->value == 'gaihaku') {?>
           欠食届は提出できません．
           <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'log') {?>
           編集可能な欠食届がありませんでした. 
           <?php }?>
           <?php }?>
           <?php }?>

           <?php if ($_smarty_tpl->tpl_vars['action']->value == "confirm" && $_smarty_tpl->tpl_vars['type']->value == 'log') {?>
           <input type="checkbox" name="kessyoku" value="TRUE" id="kessyoku" checked><label for="kessyoku">いっしょに提出された欠食届編集する</label>
           <?php }?>
           <br>
          <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
          <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
          <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
          <?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
            <div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div><br>
          <?php }?>
          <?php if (($_smarty_tpl->tpl_vars['form']->value['submit2']['attribs']['value'] != '')) {?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['submit2']['html'];?>

            <?php } else { ?>
              <?php echo $_smarty_tpl->tpl_vars['form']->value['reset']['html'];?>

            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>


        </form>

</div>
<?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }
echo '<script'; ?>
 type="text/javascript" src="../js/gaihaku.js" async><?php echo '</script'; ?>
>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
