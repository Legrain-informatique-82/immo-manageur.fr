<?php /* Smarty version Smarty-3.0.6, created on 2014-07-16 16:25:12
         compiled from "/var/www/aptana/immo-manageur.fr/modules/acquereur/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40219442853c68b487ae517-69301381%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec7d517dd39fd577d52befe485030aa14bdd80c9' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/acquereur/views/see.tpl',
      1 => 1369380425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40219442853c68b487ae517-69301381',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Fiche de l'acquereur</h1>
<p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'list');?>
">Retour à
	la liste</a></p>
	<?php if (Tools::moduleIsLoad('documents')){?>
	<p>
		<a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','ficheCriteresAcquereur',$_smarty_tpl->getVariable('acq')->value->getIdAcquereur());?>
" target="_blank">Imprimer la fiche acquereur</a>
	</p>
	<?php }?>
<div class="bulle">

<h2>Infos utilisateur</h2>
<p>Utilisateur :<?php echo $_smarty_tpl->getVariable('acq')->value->getUser()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getUser()->getName();?>
</p>
<p>Date d'ajout de l'acquereur : <?php if ($_smarty_tpl->getVariable('acq')->value->getDateInsert()){?><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('acq')->value->getDateInsert());?>
<?php }else{ ?>NC<?php }?></p>
	<h2>Infos Acquereur</h2>
	<p>Nom : <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
</p>
	<?php if ($_smarty_tpl->getVariable('acq')->value->getMaidenName()){?>
	<p>Nom de jeune fille : <?php echo $_smarty_tpl->getVariable('acq')->value->getMaidenName();?>
</p>
<?php }?>
	<p>Prénom : <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
</p>
	<p>
		Adresse : <?php echo $_smarty_tpl->getVariable('acq')->value->getAddress();?>
 <br />
		<?php echo $_smarty_tpl->getVariable('acq')->value->getVilleAcquereur()->getZipCode();?>

		<?php echo $_smarty_tpl->getVariable('acq')->value->getVilleAcquereur()->getName();?>

	</p>
	<p>Téléphones :</p>
	<ul>
		<li>Principal : <?php echo $_smarty_tpl->getVariable('acq')->value->getPhone();?>
</li>
		<li>Mobile : <?php echo $_smarty_tpl->getVariable('acq')->value->getMobilPhone();?>
</li>
		<li>Du travail : <?php echo $_smarty_tpl->getVariable('acq')->value->getWorkPhone();?>
</li>
		<li>Fax : <?php echo $_smarty_tpl->getVariable('acq')->value->getFax();?>
</li>
	</ul>
	<p>Email : <?php echo $_smarty_tpl->getVariable('acq')->value->getEmail();?>
</p>
	
	<p>Date de naissance : <?php if ($_smarty_tpl->getVariable('acq')->value->getBirthdate()){?><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('acq')->value->getBirthdate());?>
<?php }else{ ?>NC<?php }?></p>
	<p>Lieu de naissance : <?php if ($_smarty_tpl->getVariable('acq')->value->getBirthLocation()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getBirthLocation();?>
<?php }else{ ?>NC<?php }?></p>
	<p>Nationalité : <?php if ($_smarty_tpl->getVariable('acq')->value->getNationality()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getNationality();?>
<?php }else{ ?>NC<?php }?></p>
	<p>Profession : <?php if ($_smarty_tpl->getVariable('acq')->value->getJob()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getJob();?>
<?php }else{ ?>NC<?php }?></p>
	
	<?php if ($_smarty_tpl->getVariable('situationFamille')->value){?>
<h3>Situation de famille</h3>
<div class="bulle">
<p><?php echo $_smarty_tpl->getVariable('situationFamille')->value->getSituationAcquereur()->getName();?>
</p>
 <?php if ($_smarty_tpl->getVariable('situationFamille')->value->getSituationAcquereur()->getIfEventDate()){?><p>Le : <?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('situationFamille')->value->getEventDate());?>
</p><?php }?>
 <?php if ($_smarty_tpl->getVariable('situationFamille')->value->getSituationAcquereur()->getIfEventLocation()){?><p>À : <?php echo $_smarty_tpl->getVariable('situationFamille')->value->getEventLocation();?>
</p><?php }?>
</div>
<?php }?>
</div>
<div class="bulle">
<h2>Acquéreurs associés : </h2>
<?php if ($_smarty_tpl->getVariable('acq')->value->getUser()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
<p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','addAcqAssocie',$_smarty_tpl->getVariable('acq')->value->getIdAcquereur());?>
">Associer un acquereur</a></p>
<?php }?>
<h3>Liste des acquereurs associés</h3>
<table class="standard">
	<thead>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>téléphones</th>
			<th>email</th>
			<th>Modifier</th>
			<th>Supprimer</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAcqAssos')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getTitreAcquereur()->getName();?>
</td>
			</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getCellPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getCellPhone();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?>
			</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getAcquereur()->getUser()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','updateAcqAssos',$_smarty_tpl->getVariable('item')->value->getId());?>
" title="<?php echo lang::LABEL_UPDATE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
update.png" alt="<?php echo lang::LABEL_UPDATE;?>
" /></a>
				<?php }else{ ?> _ <?php }?></td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getAcquereur()->getUser()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <a
				class="" rel="<?php echo $_smarty_tpl->getVariable('item')->value->getId();?>
"
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','deleteAcqAssos',$_smarty_tpl->getVariable('item')->value->getId());?>
"  title="<?php echo lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo lang::LABEL_DELETE;?>
" /></a>
				<?php }else{ ?> _ <?php }?></td>
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','seeAcqAssos',$_smarty_tpl->getVariable('item')->value->getId());?>
"  title="<?php echo lang::LABEL_SEE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo lang::LABEL_SEE;?>
" /></a>

			</td>
		</tr>
		<?php }} ?>
	</tbody>
</table>

</div>
<div class="bulle">
	<h2>Critères</h2>
	<p>Type de transaction : <?php echo str_replace('Vente','Achat',$_smarty_tpl->getVariable('acq')->value->getTransactionType()->getName());?>
</p>
	<p>Type de critère : <?php if ($_smarty_tpl->getVariable('acq')->value->getMandateType()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getMandateType()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
	<p>Style : <?php if ($_smarty_tpl->getVariable('acq')->value->getMandateStyle()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getMandateStyle()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
	<p>Prix compris entre <?php echo $_smarty_tpl->getVariable('acq')->value->getPriceMin();?>
 et <?php echo $_smarty_tpl->getVariable('acq')->value->getPriceMax();?>
 €.</p>
	<p>Surface de terrain entre <?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceTerrainMin();?>
 et
		<?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceTerrainMax();?>
 m²</p>
	<p>Surface habitable entre <?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceHabitableMin();?>
 et
		<?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceHabitableMax();?>
 m²</p>
	<p>Secteur souhaité : <?php if ($_smarty_tpl->getVariable('acq')->value->getRechercheSector()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getRechercheSector()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
	<p>Ville souhaitée : <?php if ($_smarty_tpl->getVariable('acq')->value->getRechercheCity()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getRechercheCity()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
</div>
<?php if ($_smarty_tpl->getVariable('acq')->value->getComment()&&$_smarty_tpl->getVariable('acq')->value->getComment()!=''){?>
<div class="bulle">
	<h2>Commentaire</h2>
	<div><?php echo $_smarty_tpl->getVariable('acq')->value->getComment();?>
</div>
</div>
<?php }?>  <?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_content_bottom"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>
