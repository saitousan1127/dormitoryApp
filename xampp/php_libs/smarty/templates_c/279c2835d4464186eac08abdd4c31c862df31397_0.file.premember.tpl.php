<?php
/* Smarty version 3.1.30, created on 2021-12-22 11:30:11
  from "C:\xampp\php_libs\smarty\templates\premember.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61c28db33dff91_72607123',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '279c2835d4464186eac08abdd4c31c862df31397' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\premember.tpl',
      1 => 1639719424,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61c28db33dff91_72607123 (Smarty_Internal_Template $_smarty_tpl) {
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
        
      <td> <a href="index.php">トップページへ</a>
      </td>
        
      <td>
  		<?php echo $_smarty_tpl->tpl_vars['message']->value;?>


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
