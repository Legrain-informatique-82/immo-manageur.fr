<?php /* Smarty version Smarty-3.0.6, created on 2012-10-17 11:26:59
         compiled from "/var/www/aptana/extra-immo/modules/notary/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:983269082507e79e3c3dae9-88618878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aff8a561c69569cc766c4ecb94a22204e30cb6b5' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/notary/views/see.tpl',
      1 => 1350466018,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '983269082507e79e3c3dae9-88618878',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<h1><?php echo Lang::LABEL_NOTARY_SEE_H1;?>
</h1>
<p> <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'notary','list');?>
">Fermer la fiche</a>
<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<=2){?>
	- <a href="<?php echo $_smarty_tpl->getVariable('urlUpdate')->value;?>
">Modifier</a> - <a href="<?php echo $_smarty_tpl->getVariable('urlDelete')->value;?>
">Supprimer</a>
<?php }?>
</p>
<div class="bulle">
<p>Nom : <?php echo $_smarty_tpl->getVariable('notary')->value->getName();?>
</p>
<p>Prénom : <?php echo $_smarty_tpl->getVariable('notary')->value->getFirstname();?>
</p>
<p>Adresse : <?php echo $_smarty_tpl->getVariable('notary')->value->getAddress();?>
</p>
<p>Code Postal : <?php echo $_smarty_tpl->getVariable('notary')->value->getZipCode();?>
</p>
<p>Ville : <?php echo $_smarty_tpl->getVariable('notary')->value->getCity();?>
</p>
<p>Code Postal : <?php echo $_smarty_tpl->getVariable('notary')->value->getZipCode();?>
</p>
<p>Téléphone : <?php echo $_smarty_tpl->getVariable('notary')->value->getPhone();?>
</p>
<p>Téléphone portable : <?php echo $_smarty_tpl->getVariable('notary')->value->getMobilPhone();?>
</p>
<p>Téléphone travail : <?php echo $_smarty_tpl->getVariable('notary')->value->getJobPhone();?>
</p>
<p>Fax : <?php echo $_smarty_tpl->getVariable('notary')->value->getFax();?>
</p>
<p>Email : <?php echo $_smarty_tpl->getVariable('notary')->value->getEmail();?>
</p>
<p>Commentaire : <?php echo $_smarty_tpl->getVariable('notary')->value->getComments();?>
</p>
</div>

<h1>Clerc de notaire</h1>
<div class="bulle">
<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<=2){?>
<p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'notary','addClerk',$_smarty_tpl->getVariable('notary')->value->getIdNotary());?>
">Ajouter un clerc de notaire</a></p>
<?php }?>
<table class="standard">
	<thead>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Téléphones</th>
			<th>Email</th>
			<th>Modifier</th>
			<th>Supprimer</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>

		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('list')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>

		<tr>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
				<p><?php echo Lang::LABEL_NOTARY_ADD_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?>
				<p><?php echo Lang::LABEL_NOTARY_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('item')->value->getJobPhone()){?>
				<p><?php echo Lang::LABEL_NOTARY_ADD_JOB_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getJobPhone();?>
</p><?php }?></td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<=2){?><a href="#" title="<?php echo Lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo Lang::LABEL_UPDATE;?>
" /></a><?php }else{ ?>-<?php }?></td>
			<td><?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<=2){?><a class="#" rel="<?php echo $_smarty_tpl->getVariable('item')->value->getIdNotaryClerk();?>
" href="#" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /><?php }else{ ?>-<?php }?></a>
			</td>
			<td><a href="<?php ob_start();?><?php echo $_smarty_tpl->getVariable('item')->value->getIdNotaryClerk();?>
<?php $_tmp1=ob_get_clean();?><?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'notary','seeClerk',$_tmp1);?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a></td>
		</tr>
		<?php }} ?>
	</tbody>

</table>
</div>

</div>