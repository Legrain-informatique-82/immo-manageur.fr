<?php /* Smarty version Smarty-3.0.6, created on 2014-05-20 08:47:53
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/acquereur/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4374217537afa99b2dd12-73107649%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75297ece9bc5694c88a5430587092dbbb3eadbdc' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/acquereur/views/see.tpl',
      1 => 1369380352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4374217537afa99b2dd12-73107649',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="acquereurs">
	<div class="accordionStandard" rel="2">
		<h2>
			<a href="#">Acquereurs potentiels</a>
		</h2>
		<div>

			<table class="standard">
				<thead>
					<tr>
						<th>Nom &amp; prénom</th>
						<th>Adresse</th>
						<th>Coordonnées</th>
						<th>Voir fiche</th>
						<th>Rapprocher</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAcqPotentiels')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?> <?php if (BddRapprochement::relMandateAcquereurExist($_smarty_tpl->getVariable('pdo')->value,$_smarty_tpl->getVariable('mandate')->value,$_smarty_tpl->tpl_vars['item']->value)){?>
					<?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(1, null, null);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(0, null, null);?> <?php }?> <?php if (!$_smarty_tpl->getVariable('rapproche')->value){?>
					<tr>
						<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
						<td>
							<p>
								<?php echo $_smarty_tpl->getVariable('item')->value->getAddress();?>
<?php if ($_smarty_tpl->getVariable('item')->value->getVilleAcquereur()){?><br /><?php echo $_smarty_tpl->getVariable('item')->value->getVilleAcquereur()->getZipCode();?>

								<?php echo $_smarty_tpl->getVariable('item')->value->getVilleAcquereur()->getName();?>
<?php }?>
							</p>
						</td>
						<td>
							<p>
								<?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?> Tél : <?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
<br /> <?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?> Portable : <?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
<br />
								<?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?> Travail :
								<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
<br /> <?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getFax()){?> Fax :
								<?php echo $_smarty_tpl->getVariable('item')->value->getFax();?>
<br /> <?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getEmail()){?>
								<?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
 <?php }?>
							</p></td>
						<td><a
							href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','see',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
						</td>
						<td><a
							href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','add_rapprochement_man',$_smarty_tpl->getVariable('item')->value->getIdAcquereur(),array($_smarty_tpl->getVariable('mandate')->value->getIdMandate()));?>
" title="Rapprocher"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
rapprocher.png" alt="Rapprocher" /></a>

						</td>
					</tr>
					<?php }?> <?php }} ?>
				</tbody>
			</table>

		</div>
		<h2>
			<a href="#">Acquereurs rapprochés</a>
		</h2>
		<div>
			<table class="standard">
				<thead>
					<tr>
						<th>Nom &amp; prénom</th>
						<th>Adresse</th>
						<th>Coordonnées</th>
						<th>Voir fiche</th>
						<th>Voir le rapprochement</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAcqPotentiels')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?> <?php if (BddRapprochement::relMandateAcquereurExist($_smarty_tpl->getVariable('pdo')->value,$_smarty_tpl->getVariable('mandate')->value,$_smarty_tpl->tpl_vars['item']->value)){?>
					<?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(1, null, null);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(0, null, null);?> <?php }?> <?php if ($_smarty_tpl->getVariable('rapproche')->value){?>
					<tr>
						<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
						<td>
							<p>
								<?php echo $_smarty_tpl->getVariable('item')->value->getAddress();?>
<?php if ($_smarty_tpl->getVariable('item')->value->getVilleAcquereur()){?><br /><?php echo $_smarty_tpl->getVariable('item')->value->getVilleAcquereur()->getZipCode();?>

								<?php echo $_smarty_tpl->getVariable('item')->value->getVilleAcquereur()->getName();?>
<?php }?>
							</p>
						</td>
						<td>
							<p>
								<?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?> Tél : <?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
<br /> <?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?> Portable : <?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
<br />
								<?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?> Travail :
								<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
<br /> <?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getFax()){?> Fax :
								<?php echo $_smarty_tpl->getVariable('item')->value->getFax();?>
<br /> <?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getEmail()){?>
								<?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
 <?php }?>
							</p></td>
						<td><a
							href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','see',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
						</td>
						<td> <a
							href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','seeByMan',BddRapprochement::loadByMandateAndAcquereur($_smarty_tpl->getVariable('pdo')->value,$_smarty_tpl->getVariable('mandate')->value,$_smarty_tpl->tpl_vars['item']->value)->getIdRapprochement(),array($_smarty_tpl->getVariable('mandate')->value->getIdMandate()));?>
" title="<?php echo Lang::LABEL_SEE;?>
 le rapprochement"<?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
 le rapprochement" /></a></td>
					</tr>
					<?php }?> <?php }} ?>
				</tbody>
			</table>
		</div>
		<h2>
			<a href="#">Infos visites</a>
		</h2>
		<div>
			<p>Visité : <?php echo $_smarty_tpl->getVariable('numberVisite')->value;?>
 fois</p>
			<p>Reste à visiter : <?php echo $_smarty_tpl->getVariable('resteAVisite')->value;?>
 fois</p>

			<table class="triActionsBis">
				<thead>
					<tr>
						<th>Date visite</th>
						<th>Nom &amp; prénom</th>
						<th>Visité</th>
						<th>Résultat de la visite</th>
						<th>Bon visite</th>
						<th>Voir fiche</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listRapprochement')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<tr>
						<td><?php if ($_smarty_tpl->getVariable('item')->value->getDateVisite()){?><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('item')->value->getDateVisite());?>
<?php }?></td>
						<td><?php echo $_smarty_tpl->getVariable('item')->value->getAcquereur()->getName();?>

							<?php echo $_smarty_tpl->getVariable('item')->value->getAcquereur()->getFirstname();?>
</td>
						<td><?php if ($_smarty_tpl->getVariable('item')->value->getResultatVisite()!=0){?>Oui<?php }else{ ?>Non<?php }?></td>
						<td><?php if ($_smarty_tpl->getVariable('item')->value->getResultatVisite()!=0){?>
							<p><?php if ($_smarty_tpl->getVariable('item')->value->getResultatVisite()==1){?>Ne correspond
								pas<?php }else{ ?>OK<?php }?>
									<br />
								<a target="_blank"
									href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','resVisite',$_smarty_tpl->getVariable('item')->value->getAcquereur()->getIdAcquereur(),array($_smarty_tpl->getVariable('mandate')->value->getIdMandate()));?>
">Courrier résultat
									de la visite</a>
								</p> <?php }else{ ?>
							<p>Non visité</p> <?php }?></td>
						<td><?php if ($_smarty_tpl->getVariable('item')->value->getResultatVisite()==0){?>
							<p>
								<a target="_blank"
									href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','bonVisite',$_smarty_tpl->getVariable('item')->value->getAcquereur()->getIdAcquereur(),array($_smarty_tpl->getVariable('mandate')->value->getIdMandate()));?>
">Bon
									de visite</a>	
							</p> <?php }else{ ?>
							<p>-</p> <?php }?></td>
						<td><a
							href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','seeByMan',$_smarty_tpl->getVariable('item')->value->getIdRapprochement(),array($_smarty_tpl->getVariable('mandate')->value->getIdMandate()));?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
						</td>
					</tr>
					<?php }} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
