<?php
/* Smarty version 3.1.39, created on 2021-08-13 20:56:55
  from 'D:\xampp8\htdocs\ts5pro\app\Views\smarty\synadmin\alert_error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_611722e76e36b2_76027375',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7df31a8d94c28b74a310d4b0ff82fca5995b866' => 
    array (
      0 => 'D:\\xampp8\\htdocs\\ts5pro\\app\\Views\\smarty\\synadmin\\alert_error.tpl',
      1 => 1628892383,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_611722e76e36b2_76027375 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-danger"><i class="bx bxs-message-square-x"></i>
        </div>
        <div class="ms-3">
            <h6 class="mb-0 text-danger"><?php echo $_smarty_tpl->tpl_vars['error_title']->value;?>
</h6>
            <div><?php echo $_smarty_tpl->tpl_vars['msg_error']->value;?>
</div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><?php }
}
