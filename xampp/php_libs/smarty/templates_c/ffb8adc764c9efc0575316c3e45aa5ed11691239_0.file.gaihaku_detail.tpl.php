<?php
/* Smarty version 3.1.30, created on 2022-08-09 23:15:22
  from "C:\xampp\php_libs\smarty\templates\gaihaku_detail.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f26bfa1e33f2_73764715',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ffb8adc764c9efc0575316c3e45aa5ed11691239' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\gaihaku_detail.tpl',
      1 => 1660054515,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f26bfa1e33f2_73764715 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<?php echo '<script'; ?>
 type="text/javascript" src="js/quickform.js" async><?php echo '</script'; ?>
>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>
<div align="left"> [ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">戻る</a> ]</div>
<?php if (isset($_smarty_tpl->tpl_vars['message']->value)) {?>
  <br><div style="color:red; font-size: smaller;"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
<?php }?>

 <div align="center"><font size="6">外泊願</font></div>
 <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
 <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>


           <table border="2" style="border-collapse: collapse" width="85%" align="center">

            <tr>
              <td rowspan="2" bgcolor="#00f000" width="5%">氏名</td>
              <td align="left" rowspan="2" width="35%">
               氏：<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['last_name'];?>
　名：<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['first_name'];?>

              </td>
              <td bgcolor="#00f000" width="15%">学年/クラス</td>
              <td bgcolor="#00f000" width="30%">棟</td>
              <td bgcolor="#00f000" width="15%">部屋番号</td>
              </tr>
              <tr>
              <td><?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['class'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['tou'];?>
</td>
              <td><?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['roomnum'];?>
号室</td>
              </tr>
            </table>
            
            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td rowspan="3" bgcolor="#00f000" width="5%">宿泊先<br>及び<br>連絡先</td>
            <td rowspan="2" bgcolor="#00f000" width="5%">宿泊先<br>住所</td>
            <td align="left" width="70%">〒<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['psCode1'];?>
-<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['psCode2'];?>
</td>
            <td rowspan="2" bgcolor="#00f000">外泊先の電話番号<br>※ハイフン(-)も含める</td>
            </tr>
            <tr>
            <td align="left" width="70%">住所：<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['address'];?>
</td>
            </tr>
            <tr>
            <td bgcolor="#00f000"  width="5%">相手<br>氏名等</td>
            <td align="left" width="70%">
              氏：<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['last_name2'];?>
　名：<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['first_name2'];?>

            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['tel'];?>
</td>
            </tr>
            </table>

         
            <table border="2" style="border-collapse: collapse" width="85%" align="center">
            <tr>
            <td bgcolor="#00f000" width="5%">日程</td>
            <td>
             <?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['gaihaku']->value['s_day']),"%Y&#24180;%m&#26376;%d&#26085;");?>
　<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['s_time'];?>
時　～　
             <?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['gaihaku']->value['f_day']),"%Y&#24180;%m&#26376;%d&#26085;");?>
　<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['f_time'];?>
時
            </td>
            </tr>
            </table>
      
            <table border="2" style="border-collapse: collapse" width="85%" height="20%" align="center">
            <tr>
            <td rowspan="2" bgcolor="#00f000" width="5%">理由</td>
            <td align="left" height="20%">外泊理由：
              <?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['reason'];?>

            </td>
            <td rowspan="2" width="10%">寮監印</td><td rowspan="2" width="10%"></td>
            <td rowspan="2" width="10%">寮務主事印<br>担当主事補印<br>又は担任印</td><td rowspan="2" width="10%"></td>
            </tr>
            <tr>
            <td align="left" height="80%"><?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['riyuu'];?>
</td>
            </tr>
            </table>

          <input type="hidden" name="type"   value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
          <input type="hidden" name="action" value="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
">
          <br>
          <?php if (($_smarty_tpl->tpl_vars['i']->value)) {?>
          <font size="5">[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=delete&action=complete&id=<?php echo $_smarty_tpl->tpl_vars['gaihaku']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">確認済み</a>] </font>
          <?php }?>
          </form>
</div>
<?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }
if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
