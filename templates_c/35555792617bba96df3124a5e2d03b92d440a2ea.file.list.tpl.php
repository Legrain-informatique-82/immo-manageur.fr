<?php /* Smarty version Smarty-3.0.6, created on 2013-03-29 13:47:44
         compiled from "/var/www/aptana/extra-immo/modules/rapprochement/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104682913051558d70af6318-84536187%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35555792617bba96df3124a5e2d03b92d440a2ea' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/rapprochement/views/list.tpl',
      1 => 1325174263,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104682913051558d70af6318-84536187',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Liste des rapprochements</h1>
<table class="standard">
	<thead>
		<tr>
			<th>Numéro mandat</th>
			<th>Acquereur</th>
			<th>Tel</th>
			<th>Tel travail</th>
			<th>Budget</th>
			<th>Utilisateur lié</th>
			<th>Visitée ?</th>
			<th>Modifier</th>
			<th>supprimer</th>
			<th>Voir la fiche</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listRapp')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
?>
		<tr>
			 <?php $_smarty_tpl->tpl_vars['acq'] = new Smarty_variable($_smarty_tpl->getVariable('r')->value->getAcquereur(), null, null);?>
			<td><?php echo $_smarty_tpl->getVariable('r')->value->getMandate()->getNumberMandate();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
</td>
			<td><p>Fixe : <?php echo $_smarty_tpl->getVariable('acq')->value->getPhone();?>
</p>
				<p>Mobile : <?php echo $_smarty_tpl->getVariable('acq')->value->getMobilPhone();?>
</p></td>
			<td><?php echo $_smarty_tpl->getVariable('acq')->value->getWorkPhone();?>
</td>
			<td>De <?php echo $_smarty_tpl->getVariable('acq')->value->getPriceMin();?>
 à <?php echo $_smarty_tpl->getVariable('acq')->value->getPriceMax();?>
 €</td>
			<td><?php echo $_smarty_tpl->getVariable('acq')->value->getUser()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getUser()->getName();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('r')->value->getResultatVisite()!=0){?>Oui<?php }else{ ?>Non<?php }?></td>
			<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('r')->value->getUser()->getIdUser()){?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','update',$_smarty_tpl->getVariable('r')->value->getIdRapprochement());?>
" title="Modifier"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="Modifier" /></a>
				<?php }else{ ?> - <?php }?></td>
			<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('r')->value->getUser()->getIdUser()){?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','delete',$_smarty_tpl->getVariable('r')->value->getIdRapprochement());?>
" title="Supprimer"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="Supprimer" /></a>
				<?php }else{ ?> - <?php }?></td>

			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','see',$_smarty_tpl->getVariable('r')->value->getIdRapprochement());?>
" title="Voir la fiche" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="Voir la fiche" /></a></td>

		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
