<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 09:57:11
         compiled from "/var/www/aptana/extra-immo/modules/export_site/views/generalite.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73822036351666cd72e76e4-41958040%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac26af658945910250e2a18ada04ca05759ba745' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export_site/views/generalite.tpl',
      1 => 1365667001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73822036351666cd72e76e4-41958040',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div id="blocMandate" class="bulle">
	<h1>Généralités</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label for="nomSite">Nom du site : </label> <input type="text"
				name="nomSite" id="nomSite" value="<?php echo $_smarty_tpl->getVariable('se')->value->getNomSite();?>
" />
		</p>
		
	
		<p><label for="emailContact">Email de contact :</label> <input type="text"
			name="emailContact" id="emailContact" value="<?php echo $_smarty_tpl->getVariable('se')->value->getEmailContact();?>
" />
		</p>
<p><label for="nameAgency">Nom de l'agence :</label> <input type="text"
			name="nameAgency" id="nameAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getNameAgency();?>
" />
		</p>
		<p><label for="addressAgency">Adresse de l'agence :</label> <input type="text"
			name="addressAgency" id="addressAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getAddressAgency();?>
" />
		</p>
		<p><label for="zipCodeAgency">Code postal de l'agence :</label> <input type="text"
			name="zipCodeAgency" id="zipCodeAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getZipCodeAgency();?>
" />
		</p>
		<p><label for="cityAgency">Ville de l'agence :</label> <input type="text"
			name="cityAgency" id="cityAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getCityAgency();?>
" />
		</p>
		<p><label for="phoneAgency">téléphone de l'agence :</label> <input type="text"
			name="phoneAgency" id="phoneAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getPhoneAgency();?>
" />
		</p>
		<p><label for="faxAgency">Fax de l'agence :</label> <input type="text"
			name="faxAgency" id="faxAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getFaxAgency();?>
" />
		</p>


		<p><label for="robots">Référençable : </label><select name="robots" id="robots">
				<option <?php if ($_smarty_tpl->getVariable('se')->value->getRobots()==0){?> selected="selected"<?php }?> value="0">Non</option>
				<option <?php if ($_smarty_tpl->getVariable('se')->value->getRobots()==1){?> selected="selected"<?php }?> value="1">Oui</option>
			</select></p>
			
			<p><label for="theme">Thème : </label><select name="theme" id="theme">
			<?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('themes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
?>
				<option <?php if ($_smarty_tpl->getVariable('it')->value->getId()==$_smarty_tpl->getVariable('se')->value->getTheme()->getId()){?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->getVariable('it')->value->getId();?>
"><?php echo $_smarty_tpl->getVariable('it')->value->getName();?>
</option>
			<?php }} ?>
			</select></p>
			
			<p><label for="nbNouveauteParAgence">Nouveautés par agence :</label><select name="nbNouveauteParAgence" id="nbNouveauteParAgence">
					<option <?php if ($_smarty_tpl->getVariable('se')->value->getNbNouveauteParAgence()==2){?> selected="selected" <?php }?> value="2">2</option>
					<option <?php if ($_smarty_tpl->getVariable('se')->value->getNbNouveauteParAgence()==4){?> selected="selected" <?php }?> value="4">4</option>
					<option <?php if ($_smarty_tpl->getVariable('se')->value->getNbNouveauteParAgence()==6){?> selected="selected" <?php }?> value="6">6</option>
				</select></p>
				
			<p><label for="nbAnnonceParPage">Annonces par page : </label><select name="nbAnnonceParPage" id="nbAnnonceParPage">
				
					<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['name'] = 'foo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] = is_array($_loop=101) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] = 1;
            $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'];
            $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total']);
?>
    					<option <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['foo']['index']==$_smarty_tpl->getVariable('se')->value->getNbAnnoncesParPage()){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['foo']['index'];?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['foo']['index'];?>
</option>
					<?php endfor; endif; ?>
				</select></p>
				<div class="bulle clear">
			<?php if ($_smarty_tpl->getVariable('se')->value->getHeader()){?>
			<p><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/<?php echo $_GET['module'];?>
/images/<?php echo $_smarty_tpl->getVariable('se')->value->getHeader();?>
" alt="" /></p>
			<?php }?>
			<p><label for="header">Entête (jpg) :</label><input type="file" name="header" id="header" /></p>
			</div>
			<div class="bulle clear">
			<?php if ($_smarty_tpl->getVariable('se')->value->getLogo()){?>
			<p class="clear"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/<?php echo $_GET['module'];?>
/images/<?php echo $_smarty_tpl->getVariable('se')->value->getLogo();?>
" alt="" /></p>
			<?php }?>
			<p><label for="logo">Logo (png) :</label><input type="file" name="logo" id="logo" /></p>
			</div>
			
			
		<p><input type="submit" name="send" value="Valider" /></p>
	</form>
</div>
</div>
