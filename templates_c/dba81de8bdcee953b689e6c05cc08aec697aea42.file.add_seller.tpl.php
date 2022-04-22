<?php /* Smarty version Smarty-3.0.6, created on 2014-05-16 14:47:26
         compiled from "/var/www/aptana/extra-immo/modules/seller/views/add_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1552111325537608de51c952-42643551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dba81de8bdcee953b689e6c05cc08aec697aea42' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/seller/views/add_seller.tpl',
      1 => 1369380722,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1552111325537608de51c952-42643551',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Ajouter un vendeur</h1>
	<?php if ($_smarty_tpl->getVariable('error')->value){?>
	<ul class="contError">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li> <?php }} ?>
	</ul>
	<?php }?> 
	<div id="blocSeller" class="bulle">
<form action="" method="post">


	<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
	<p>
		<label for="seller_add_user">Utilisateur : </label> <select name="seller_add_user"
			id="seller_add_user"> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUser')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
				<option <?php if (($_smarty_tpl->getVariable('item')->value->getIdUser()==$_POST['seller_add_user']&&!empty($_POST['seller_add_user']))||($_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('item')->value->getIdUser()&&empty($_POST['seller_add_user']))){?>
					selected="selected"
					<?php }?>value="<?php echo $_smarty_tpl->getVariable('item')->value->getIdUser();?>
"><?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>

					<?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</option> <?php }} ?>

		</select> 
	</p>
	<?php }?> <?php $_template = new Smarty_Internal_Template('seller/views/frm_add_seller.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<p>
		<label for="seller_add_comment"><?php echo Lang::LABEL_SELLER_ADD_COMMENT;?>
</label><textarea
				name="seller_add_comment" id="seller_add_comment" cols="30"
				rows="10"><?php echo $_POST['seller_add_comment'];?>
</textarea> 
	</p>
	
	<p>
		<input type="submit" value="<?php echo Lang::LABEL_SAVE;?>
"
			id="seller_add_submit_send" name="seller_add_submit_send" />
	</p>
</form>
</div>
</div>
