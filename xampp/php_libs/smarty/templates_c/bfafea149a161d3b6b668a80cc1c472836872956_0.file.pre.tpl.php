<?php
/* Smarty version 3.1.30, created on 2022-01-20 11:02:09
  from "C:\xampp\php_libs\smarty\templates\pre.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61e8c2a1b1a7c9_01877688',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfafea149a161d3b6b668a80cc1c472836872956' => 
    array (
      0 => 'C:\\xampp\\php_libs\\smarty\\templates\\pre.tpl',
      1 => 1642644124,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e8c2a1b1a7c9_01877688 (Smarty_Internal_Template $_smarty_tpl) {
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
        
      <td> <?php echo $_smarty_tpl->tpl_vars['link']->value;?>

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
