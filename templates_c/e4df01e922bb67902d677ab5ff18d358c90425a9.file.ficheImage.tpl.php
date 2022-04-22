<?php /* Smarty version Smarty-3.0.6, created on 2012-09-06 10:12:14
         compiled from "/var/www/aptana/extra-immo/modules/documents/views/ficheImage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65105733550485adef18010-89626972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4df01e922bb67902d677ab5ff18d358c90425a9' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/documents/views/ficheImage.tpl',
      1 => 1322123427,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65105733550485adef18010-89626972',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="ficheImage" class="bulle">
	<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
	<ul>
	<li>Pour changer la position d'une photo, modifier le numéro présent sous celle-ci.</li>
	<li>Pour ne pas imprimer une photo, supprimez le numéro présent sous celle-ci</li>
	</ul>
	<form action="" method="post">
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPictures')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['iteration']=0;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['iteration']++;
?>
		<div class="vingtPourCent bulle">
		<p>
		<img src="<?php echo $_smarty_tpl->getVariable('chemImage')->value;?>
thumb/<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
" alt=""  height="161" />
		</p><p>
		<input type="text" name="position_<?php echo $_smarty_tpl->tpl_vars['i']->value['idPhoto'];?>
" value="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" />
		</p>
		</div>
		<?php }} ?>
		<p class="clear">
			<input type="submit" name="send" value="Generer" />
		</p>
	</form>
	</div>
</div>
