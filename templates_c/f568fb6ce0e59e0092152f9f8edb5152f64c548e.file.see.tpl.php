<?php /* Smarty version Smarty-3.0.6, created on 2014-05-19 16:25:52
         compiled from "/var/www/aptana/immo-manageur.fr/modules/user/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:955942728537a1470b51699-00957443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f568fb6ce0e59e0092152f9f8edb5152f64c548e' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/user/views/see.tpl',
      1 => 1400509547,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '955942728537a1470b51699-00957443',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>  <?php if ($_smarty_tpl->getVariable('hook_header')->value){?> <?php  $_smarty_tpl->tpl_vars['hook'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('hook_header')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['hook']->key => $_smarty_tpl->tpl_vars['hook']->value){
?> <?php $_template = new Smarty_Internal_Template($_smarty_tpl->tpl_vars['hook']->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?> <?php }} ?> <?php }?>
<h1>Infos :</h1>
<div>
	<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('userToSee')->value->getIdUser()){?><a
		href="<?php echo Constant::DEFAULT_URL;?>
/mod-user/update/<?php echo $_GET['action'];?>
">Modifier
		la fiche</a><?php }?> <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1&&$_smarty_tpl->getVariable('user')->value->getIdUser()!=$_smarty_tpl->getVariable('userToSee')->value->getIdUser()){?><a
		href="<?php echo Constant::DEFAULT_URL;?>
/mod-user/delete/<?php echo $_GET['action'];?>
">Supprimer
		le membre</a><?php }?>
</div>
<div class="bulle">
	<p>Identifiant : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getIdentifiant();?>
</p>
	<p>Nom : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getName();?>
</p>
	<p>Prénom : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getFirstname();?>
</p>
	<p>Email : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getEmail();?>
</p>
    <p>Téléphone portable : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getCellPhone();?>
</p>
	<p>Agence : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getAgency()->getName();?>
</p>
	<p>Niveau : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getLevelMember()->getName();?>
</p>
	<p>Thème : <?php echo $_smarty_tpl->getVariable('userToSee')->value->getTheme();?>
</p>
	<p>Ouverture des pages dans de nouveaux onglets : <?php if ($_smarty_tpl->getVariable('userToSee')->value->getOpenInNewTab()==0){?>Non<?php }else{ ?>Oui<?php }?></p>
</div>
<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('userToSee')->value->getIdUser()){?>
<h1>Historique des connexions :</h1>

<div class="containtTbl">
	<?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('historicConnexion')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['line']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['line']->iteration=0;
 $_smarty_tpl->tpl_vars['line']->index=-1;
if ($_smarty_tpl->tpl_vars['line']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value){
 $_smarty_tpl->tpl_vars['line']->iteration++;
 $_smarty_tpl->tpl_vars['line']->index++;
 $_smarty_tpl->tpl_vars['line']->first = $_smarty_tpl->tpl_vars['line']->index === 0;
 $_smarty_tpl->tpl_vars['line']->last = $_smarty_tpl->tpl_vars['line']->iteration === $_smarty_tpl->tpl_vars['line']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["tblhist"]['first'] = $_smarty_tpl->tpl_vars['line']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["tblhist"]['last'] = $_smarty_tpl->tpl_vars['line']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tblhist']['first']){?>
	<table class="twoColumnWithFirstDate">
		<thead>
			<tr>
				<th>Date de connexion</th>
				<th>Ip</th>
			</tr>
		</thead>
		<tbody>
			<?php }?>
			<tr>
				<td><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('line')->value->getDateConnection());?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('line')->value->getIp();?>
</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tblhist']['last']){?>
		</tbody>
	</table>
	<?php }?> <?php }} ?>
</div>
<?php }?> <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1){?>
<div>
	<h1>Log</h1>
	<div class="containtTbl">
		<?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('arrayLog')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['line']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['line']->iteration=0;
 $_smarty_tpl->tpl_vars['line']->index=-1;
if ($_smarty_tpl->tpl_vars['line']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value){
 $_smarty_tpl->tpl_vars['line']->iteration++;
 $_smarty_tpl->tpl_vars['line']->index++;
 $_smarty_tpl->tpl_vars['line']->first = $_smarty_tpl->tpl_vars['line']->index === 0;
 $_smarty_tpl->tpl_vars['line']->last = $_smarty_tpl->tpl_vars['line']->iteration === $_smarty_tpl->tpl_vars['line']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["tblLog"]['first'] = $_smarty_tpl->tpl_vars['line']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["tblLog"]['last'] = $_smarty_tpl->tpl_vars['line']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tblLog']['first']){?>
		<table class="threeColumnWithFirstDate">
			<thead>
				<tr>
					<th>Date</th>
					<th>Module</th>
					<th>Log</th>
				</tr>
			</thead>
			<tbody>
				<?php }?>
				<tr>
					<td><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('line')->value->getDateLog());?>
</td>
					<td><?php echo $_smarty_tpl->getVariable('line')->value->getPluginName();?>
</td>
					<td><?php echo $_smarty_tpl->getVariable('line')->value->getLog();?>
</td>
				</tr>
				<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['tblLog']['last']){?>
			</tbody>
		</table>
		<?php }?> <?php }} ?>
	</div>
</div>
<?php }?>
</div>
