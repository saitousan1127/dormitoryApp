<?php
/* Smarty version 3.1.30, created on 2023-01-25 15:22:39
  from "C:\xampp\php_libs\smarty\templates\room_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63d0caaf31eec9_02171055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3dae3a39855cf48d453922e832e9038675143593' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\room_list.tpl',
      1 => 1674206972,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63d0caaf31eec9_02171055 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link rel="stylesheet" href="../css/room_list.css">
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
 <!--<div align="center"><font size="6"><?php echo $_smarty_tpl->tpl_vars['state']->value;?>
</font></div>-->
 <form <?php echo $_smarty_tpl->tpl_vars['form']->value['attributes'];?>
>
 <?php echo $_smarty_tpl->tpl_vars['form']->value['hidden'];?>


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
    <td colspan="7" align="right"><?php echo $_smarty_tpl->tpl_vars['form']->value['submit']['html'];?>
</td>
    </tr>
    </table>

    <table align="center">
    <tr><td colspan=3><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</td></tr>
    <tr>
<?php if (($_smarty_tpl->tpl_vars['Ndata']->value)) {?>
    <td valign="top">
    北寮：<br>
    <table border="1" align="center">
    <tr><th>部屋番号</td><th></th><th>現居住者</th><th></th></tr>

   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['Ndata']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>

    <tr id="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" class="default_row">
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td>
    <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" value="TRUE" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('T');?>
" <?php echo $_smarty_tpl->tpl_vars['item']->value['checkT'];?>
><label for="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('T');?>
">居住可</label>／
    <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" value="FALSE" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('F');?>
" <?php echo $_smarty_tpl->tpl_vars['item']->value['checkF'];?>
><label for="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('F');?>
">居住不可</label>
    </td>
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td><button type="button" bgcolor="" onclick='(function() { let val = "<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
"; clickDeleteBtn(val); } )();'>削除</button></td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </table>
    </td>
    <?php }?>
    
    <?php if (($_smarty_tpl->tpl_vars['Edata']->value)) {?>
    <td>　</td>
    <td valign="top">
    東寮：<br>
    <table  border="1" align="center">
    <tr><th>部屋番号</td><th></th><th>現居住者</th><th></th></tr>

   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['Edata']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
    <tr id="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
"  class="default_row">
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td>
    <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" value="TRUE" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('T');?>
" <?php echo $_smarty_tpl->tpl_vars['item']->value['checkT'];?>
><label for="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('T');?>
">居住可</label>／
    <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" value="FALSE" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('F');?>
" <?php echo $_smarty_tpl->tpl_vars['item']->value['checkF'];?>
><label for="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('F');?>
">居住不可</label>
    </td>
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td><button type="button" bgcolor="" onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
; clickDeleteBtn(val); } )();">削除</button></td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </table>
    </td>
    <?php } else { ?>
    <td>a</td>
    <?php }?>

    <?php if (($_smarty_tpl->tpl_vars['Sdata']->value)) {?>
    <td>　</td>
    <td valign="top">
    南寮：<br>
    <table  border="1" align="center">
    <tr><th>部屋番号</td><th></th><th>現居住者</th><th></th></tr>

   <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['Sdata']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>

    <tr id="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" class="default_row">
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td>
    <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" value="TRUE" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('T');?>
" <?php echo $_smarty_tpl->tpl_vars['item']->value['checkT'];?>
><label for="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('T');?>
">居住可</label>／
    <input type="radio" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
" value="FALSE" id="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('F');?>
" <?php echo $_smarty_tpl->tpl_vars['item']->value['checkF'];?>
><label for="<?php echo ($_smarty_tpl->tpl_vars['item']->value['roomnum']).('F');?>
">居住不可</label>
    </td>
    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
    <td><button type="button" bgcolor="" onclick="(function() { let val = <?php echo $_smarty_tpl->tpl_vars['item']->value['roomnum'];?>
; clickDeleteBtn(val); } )();">削除</button></td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </table>
    </td>
    <?php }?>

    </tr>
    </table>
          <input type="hidden" name="rand" value="<?php echo $_smarty_tpl->tpl_vars['rand']->value;?>
">
          <input type="hidden" name="type"  value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
        </form>

</div>
<?php if ($_smarty_tpl->tpl_vars['form']->value['javascript']) {?>
    <?php echo $_smarty_tpl->tpl_vars['form']->value['javascript'];?>

<?php }
echo '<script'; ?>
 type="text/javascript" src="../js/room_list.js" async><?php echo '</script'; ?>
>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html><?php }
}
