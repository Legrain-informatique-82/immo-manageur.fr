<?php /* Smarty version Smarty-3.0.6, created on 2012-10-16 12:54:41
         compiled from "/var/www/aptana/extra-immo/modules/mandat/views/updatePub.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1639697378507d3cf1775589-96719946%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a65c828d179bcb0f52720522c3522347d46aff20' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/views/updatePub.tpl',
      1 => 1320846231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1639697378507d3cf1775589-96719946',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Pubs</h1>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<ul class="contError">
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
<div id="blocMandate">
<form action="" method="post">
<div class="mSep">
<h2>Coup de coeur</h2>
	<p >
		<label for="coupCoeur">Coup de coeur : </label><input <?php if ($_smarty_tpl->getVariable('coupCoeur')->value=="on"){?>checked="checked" <?php }?> type="checkbox" name="coupCoeur"
			value="on" id="coupCoeur" />
	</p>
	</div>
	<div class="mSep">
	
	<h2>Affiché en vitrine</h2>
	<p >
		<label for="afficheEnVitrine">Texte utilisé dans la vitrine : </label><input
			<?php if ($_smarty_tpl->getVariable('afficheEnVitrine')->value=="on"){?>checked="checked" <?php }?> type="checkbox"
			name="afficheEnVitrine" value="on" id="afficheEnVitrine" />
	</p>
	</div>
	
	<hr class="clear invi" />
	<div class="bulle">
	<h2>Texte utilisé dans les affiches :</h2>
	<p >
		<label for="vitrine">Texte vitrine : </label>
		<textarea name="vitrine" id="vitrine" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('vitrine')->value;?>
</textarea>
	</p>
	</div>
	<div class="bulle">
	<h2>Texte utilisé avec les passerelles :</h2>
	<p >
		<label for="pub">Publicité Internet : </label>
		<textarea name="pub" id="pub" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('pub')->value;?>
</textarea>
	</p>
	</div>
	<?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_updatePhotosExport"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<p>
		<input type="submit" name="valid" value="Valider" /><input
			type="submit" name="cancel" value="Annuler" />
	</p>
</form>
</div>
</div>