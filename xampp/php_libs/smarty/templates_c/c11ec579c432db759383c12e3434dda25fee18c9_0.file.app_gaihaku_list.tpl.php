<?php
/* Smarty version 3.1.30, created on 2022-08-09 23:09:59
  from "C:\xampp\php_libs\smarty\templates\app_gaihaku_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f26ab796a5a2_67540394',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c11ec579c432db759383c12e3434dda25fee18c9' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\app_gaihaku_list.tpl',
      1 => 1660054191,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f26ab796a5a2_67540394 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\php_libs\\smarty\\libs\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
<hr>

    <table>
      <tr>
      	<td style="vertical-align: top;">
	[ <a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
">トップページへ</a> ]
	<br>
	<br>
      	</td>
        <td>
      
<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
件の外泊願があります。<br>
<br>
<font color="red"><?php echo $_smarty_tpl->tpl_vars['caution1']->value;?>
</font>
<br>
<?php echo $_smarty_tpl->tpl_vars['links']->value;?>

<?php if (($_smarty_tpl->tpl_vars['data']->value)) {?>
<table border="1">
<tr><th>氏</th><th>名</th><th>学年/クラス</th><th>棟</th><th>部屋番号</th><th>日程</th><th>提出日時</th><th>　</th></tr>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
<tr>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['last_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['first_name'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['class'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['tou'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['roomnum'], ENT_QUOTES, 'UTF-8', true);?>
時</td>
<td><?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['s_day']),"%Y&#24180;%m&#26376;%d&#26085;");
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['s_time'], ENT_QUOTES, 'UTF-8', true);?>
時
～<?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['item']->value['f_day']),"%Y&#24180;%m&#26376;%d&#26085;");
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['f_time'], ENT_QUOTES, 'UTF-8', true);?>
時</td>
<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['sub_date'], ENT_QUOTES, 'UTF-8', true);?>
</td>
<td>
<?php if (($_smarty_tpl->tpl_vars['i']->value)) {?>
[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=detail&action=ryoukan&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">全体表示</a>]
<?php } else { ?>
[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=detail&action=kyoka&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">全体表示</a>]
<?php }?>
</td>
<!--
<td>
<?php if (($_smarty_tpl->tpl_vars['i']->value)) {?>
[<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?type=app2&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];
echo $_smarty_tpl->tpl_vars['add_pageID']->value;?>
">確認済み</a>]
<?php }?>
</td>
-->
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


</table>
<?php }?>

          </td>
      </tr>
    </table>
</div>
<?php if (($_smarty_tpl->tpl_vars['debug_str']->value)) {?><pre><?php echo $_smarty_tpl->tpl_vars['debug_str']->value;?>
</pre><?php }?>
</body>
</html>
<?php }
}
