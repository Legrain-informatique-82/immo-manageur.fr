<?php /* Smarty version Smarty-3.0.6, created on 2014-05-19 09:20:37
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8513390325379b0c54ed218-45555856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99244ac6012a2865d1e17124519ab143d0d49e5b' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/views/list.tpl',
      1 => 1400484035,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8513390325379b0c54ed218-45555856',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listElem')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->tpl_vars['item']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["listMenuTrois"]['first'] = $_smarty_tpl->tpl_vars['item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["listMenuTrois"]['last'] = $_smarty_tpl->tpl_vars['item']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['listMenuTrois']['first']){?>
<ul class="menuHorizontal">
	<?php }?>
	<li><a <?php if ($_smarty_tpl->tpl_vars['item']->value['name']==$_smarty_tpl->getVariable('nameOfEtap')->value){?>class="actif"
		<?php }?> href="<?php echo $_smarty_tpl->tpl_vars['item']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['listMenuTrois']['last']){?><hr class="clear invi" /><?php }?></li> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['listMenuTrois']['last']){?>
</ul>
<?php }?> <?php }} ?>

<hr class="clear invi" />
<form action="" method="post">
	<p class="mSep">
		<label for="confidentialMode"> Mode confidentiel<input type="checkbox"
			<?php if ($_POST['confidentialMode']=='ok'||empty($_POST)){?> checked="checked" <?php }?> value="ok"
			name="confidentialMode" id="confidentialMode" /> </label> <input
			type="submit" name="toogleConfidentialMode" value="Ok" />
	</p>
	<p class="mSep alignR">
		<label for="agency">Voir les mandats de : <select name="agency"
			id="agency">
				<option value="ALL" <?php if ($_smarty_tpl->getVariable('agency')->value=='ALL'){?> selected="selected"<?php }?>>Toute
					les agences</option> <?php  $_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAgency')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['a']->key => $_smarty_tpl->tpl_vars['a']->value){
?>
				<option value="<?php echo $_smarty_tpl->getVariable('a')->value->getIdAgency();?>
" <?php if ($_smarty_tpl->getVariable('agency')->value==$_smarty_tpl->getVariable('a')->value->getIdAgency()){?>
					selected="selected" <?php }?>>l'agence de <?php echo $_smarty_tpl->getVariable('a')->value->getName();?>
</option>
				<?php }} ?>
		</select> </label> <input type="submit" name="toogleConfidentialMode"
			value="Ok" />

	</p>

	<hr class="invi clear" />
	<h1>Liste des terrains : <?php echo $_smarty_tpl->getVariable('nameOfEtap')->value;?>
</h1>
</form>

<p>
    <span class="violet">En violet, les mandats dont la date de création est comprise entre <?php echo Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_1;?>
 et <?php echo Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_2;?>
 jours.</span>
    <br/>
    <span class="red">En rouge, les mandats arrivant à échéance dans <?php echo Constant::N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1;?>
 jours ou moins.</span>
</p>

<table class="KeyTable listMandat" id="tableMandat">
	<thead>
		<tr>
			<th>Prix (FAI en euros)</th>
			<th>Photo</th>
			<th>Ref mandat</th>
			<th>Surface terrain</th>
			<th>Adresse du mandat</th> <?php if ($_POST['confidentialMode']!='ok'&&!empty($_POST)){?>
			<th>Nature</th>
			<th>Nom &amp; prénom du vendeur</th>
			<th>Coordonnées vendeur par defaut</th> <?php }?>
			<th>Voir</th>
			<th>Dupliquer</th>
			
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandat')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
            <tr rel="<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getIdMandate();?>
"  <?php if (date('Ymd',strtotime((((date('Y-m-d',$_smarty_tpl->getVariable('item')->value['obj']->getDeadDate())).(" - ")).(Constant::N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1)).("days")))<=date('Ymd')){?>
                class="red"
            <?php }?>
                    <?php if ((date('Ymd',strtotime((((date('Y-m-d',$_smarty_tpl->getVariable('item')->value['obj']->getInitDate())).(" + ")).(Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_1)).("days")))<=date('Ymd'))&&(date('Ymd')<=date('Ymd',strtotime((((date('Y-m-d',$_smarty_tpl->getVariable('item')->value['obj']->getInitDate())).(" + ")).(Constant::N_DAYS_AFTER_WARRANT_CREATION_ALERT_2)).("days"))))){?>
                class="violet"
                    <?php }?>>
			
			<!-- <td class="gras"><?php echo round($_smarty_tpl->getVariable('item')->value['obj']->getPriceFai(),2);?>
</td> -->
			<td class="gras"><span title="<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getPriceFai();?>
"><?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('item')->value['obj']->getPriceFai(),0));?>
 &euro;</span></td>
			 <td>
		   	<?php if ($_smarty_tpl->getVariable('item')->value['obj']->getPictureByDefault()){?>
				<img src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getPictureByDefault()->getName();?>
" width="100" alt=""/>
			<?php }else{ ?>
				NC
			<?php }?>
		   </td>

			<td class="gras"><?php echo $_smarty_tpl->getVariable('item')->value['obj']->getNumberMandate();?>
</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value['obj']->getSuperficieTotale()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value['obj']->getSuperficieTotale();?>
<?php }?></td>
			<td><?php if ($_POST['confidentialMode']!='ok'&&!empty($_POST)){?> <?php echo $_smarty_tpl->getVariable('item')->value['obj']->getAddress();?>
 <?php }?>
				<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getCity()->getZipCode();?>

				<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getCity()->getName();?>
</td> <?php if ($_POST['confidentialMode']!='ok'&&!empty($_POST)){?>
			<td><?php if ($_smarty_tpl->getVariable('item')->value['obj']->getNature()==null){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value['obj']->getNature()->getName();?>
<?php }?></td>

			<td><?php if ($_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()){?>
			<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getFirstname();?>

				<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getName();?>
<?php }?></td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()){?> <?php if ($_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getPhone()){?>
				<p>Téléphone : <?php echo $_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getPhone();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getMobilPhone()){?>
				<p>Téléphone portable:
					<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getMobilPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getWorkPhone()){?>
				<p>Téléphone travail:
					<?php echo $_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getWorkPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getFax()){?>
				<p>Fax : <?php echo $_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getFax();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getEmail()){?>
				<p>Email : <?php echo $_smarty_tpl->getVariable('item')->value['obj']->getDefaultSeller()->getEmail();?>
</p><?php }?>
				<?php }else{ ?> NC <?php }?></td> <?php }?>
<td><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urls']['see'];?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a></td>
<td><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['urls']['duplicate'];?>
" title="Dupliquer" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
duplicate.png" alt="Dupliquer" /></a></td>
			
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
