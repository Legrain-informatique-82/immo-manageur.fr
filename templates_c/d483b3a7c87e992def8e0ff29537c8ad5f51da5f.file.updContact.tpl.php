<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 14:24:03
         compiled from "/var/www/aptana/extra-immo/modules/contacts/views/updContact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:479904080507d51e3e88c79-03905420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd483b3a7c87e992def8e0ff29537c8ad5f51da5f' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/contacts/views/updContact.tpl',
      1 => 1350390241,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '479904080507d51e3e88c79-03905420',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<form action="" method="post">
	<div class="quatreVingt">
		<div class="accordion">

<h2><a href="#">Catégories</a></h2>
<div>

<p>Sélectionner les catégories associées à ce contact</p>
<?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCategories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
?>
	<p class="inlineBlock bulle"><label for="cat_<?php echo $_smarty_tpl->getVariable('cat')->value->getIdCategoryContact();?>
"><?php echo $_smarty_tpl->getVariable('cat')->value->getName();?>
</label><input <?php if (in_array($_smarty_tpl->getVariable('cat')->value->getIdCategoryContact(),$_smarty_tpl->getVariable('categoriesForContact')->value)){?> checked="checked" <?php }?> type="checkbox" name="cat[]" id="cat_<?php echo $_smarty_tpl->getVariable('cat')->value->getIdCategoryContact();?>
" value="<?php echo $_smarty_tpl->getVariable('cat')->value->getIdCategoryContact();?>
"/></p>
<?php }} ?>
						


<!-- <p><a href="">Ajouter une catégorie</a></p> -->
</div>
			<?php  $_smarty_tpl->tpl_vars['tc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listTC')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tc']->key => $_smarty_tpl->tpl_vars['tc']->value){
?>
			<h2>
				<a href="#"><?php echo $_smarty_tpl->getVariable('tc')->value->getLibel();?>
</a>
			</h2>
			<div>

				<?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCC')->value[$_smarty_tpl->getVariable('tc')->value->getIdTypeChampsContact()]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cc']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['cc']->iteration=0;
if ($_smarty_tpl->tpl_vars['cc']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value){
 $_smarty_tpl->tpl_vars['cc']->iteration++;
 $_smarty_tpl->tpl_vars['cc']->last = $_smarty_tpl->tpl_vars['cc']->iteration === $_smarty_tpl->tpl_vars['cc']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['last'] = $_smarty_tpl->tpl_vars['cc']->last;
?>
				<p class="bulle">
					<input type="hidden" name="type[]"
						value="<?php echo $_smarty_tpl->getVariable('tc')->value->getIdTypeChampsContact();?>
" /> <input type="hidden"
						name="id[]" value="<?php echo $_smarty_tpl->getVariable('cc')->value->getIdChampsContact();?>
" /> Position : <input
						type="text" name="pos[]" value="<?php echo $_smarty_tpl->getVariable('cc')->value->getPosition();?>
"
						class="minText" />  Libellé :
					<textarea class="trenteCinq" name="libel[]" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('cc')->value->getLibel();?>
</textarea>
					Valeur :
					<textarea class="trenteCinq" name="val[]" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('cc')->value->getVal();?>
</textarea>
					<?php if ($_smarty_tpl->getVariable('cc')->value->getIndestructible()==0){?>Supprimer ? <input type="checkbox"
						name="del[]" value="<?php echo $_smarty_tpl->getVariable('cc')->value->getIdChampsContact();?>
" /> <?php }else{ ?>
					Supprimer ? <input type="checkbox" name="del[]" disabled="disabled"
						value="" /> <?php }?>
				</p>
				<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['last']){?> 
				<p class="bulle">
					<input type="hidden" name="type[]"
						value="<?php echo $_smarty_tpl->getVariable('tc')->value->getIdTypeChampsContact();?>
" /><input type="hidden"
						name="id[]" value="" />Position : <input type="text" name="pos[]"
						value="" class="minText" /> Libellé :
					<textarea class="trenteCinq" name="libel[]" cols="30" rows="10"></textarea>
					Valeur :
					<textarea class="trenteCinq" name="val[]" cols="30" rows="10"></textarea>
					Supprimer ? <input type="checkbox" name="del[]" disabled="disabled"
						value="" />
				</p>
				<?php }?> <?php }} else { ?> 
				<p class="bulle">
					<input type="hidden" name="type[]"
						value="<?php echo $_smarty_tpl->getVariable('tc')->value->getIdTypeChampsContact();?>
" /><input type="hidden"
						name="id[]" value="" />Position : <input type="text" name="pos[]"
						value="" class="minText" /> Libellé :
					<textarea class="trenteCinq" name="libel[]" cols="30" rows="10"></textarea>
					Valeur :
					<textarea class="trenteCinq" name="val[]" cols="30" rows="10"></textarea>
					Supprimer ? <input type="checkbox" name="del[]" disabled="disabled"
						value="" />
				</p>
				<?php } ?> 
				<div class="jsAddLinkNewLine" rel="<?php echo $_smarty_tpl->getVariable('tc')->value->getIdTypeChampsContact();?>
"></div>

			</div>
			<?php }} ?>

		</div>
	</div>
	<div class="colDte">
		<p>
			<input type="submit" value="Valider" name="valid" />
		</p>
		<p>
			<input type="submit" value="Valider et retourner à la fiche"
				name="validAndQuit" />
		</p>
		<p>
			<input type="submit" value="Annuler" name="cancel" />
		</p>
	</div>
</form>
</div>
