<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:46
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/mandateDescription/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:895295121519f1c4eeacf96-90420348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd13a62128b58ee56b967af260589a6dd7f91da1a' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/mandateDescription/views/see.tpl',
      1 => 1369380338,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '895295121519f1c4eeacf96-90420348',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h3>
	<a href="#">Description</a>
</h3>
<div>
	 <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>
	<p>
		<a
			href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateDescription',$_GET['action']);?>
">Modifier
			les descriptions</a>
	</p>
	<?php }?> 
	<table id="tableSeeMandateDescription">
		<thead>
			<tr>
				<th>Niveau</th>
				<th>Pièce</th>
				<th>Surface</th>
				<th>Sol/Mur/équipement</th>
			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfDescription')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
			<tr>
				<td><?php echo $_smarty_tpl->getVariable('i')->value->getNiveau();?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('i')->value->getPiece();?>
</td>
				<td><?php if (preg_match('/.00/i',$_smarty_tpl->getVariable('i')->value->getSurface())){?>
					<?php echo round($_smarty_tpl->getVariable('i')->value->getSurface(),0);?>
 <?php }else{ ?> <?php echo $_smarty_tpl->getVariable('i')->value->getSurface();?>
 <?php }?> m²</td>
				<td><?php echo $_smarty_tpl->getVariable('i')->value->getCarac();?>
</td>
			</tr>
			<?php }} else { ?>
			<tr>
				<td colspan=4>Aucune description pour ce mandat</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
