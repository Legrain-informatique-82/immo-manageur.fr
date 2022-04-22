<?php /* Smarty version Smarty-3.0.6, created on 2012-07-19 09:43:52
         compiled from "/var/www/aptana/extra-immo/modules/terrain/modules/mandateCom/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6702391405007bab84d0af5-19358795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dec672a21c115c102f0a3220d08ce3c75b9c1119' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/terrain/modules/mandateCom/views/see.tpl',
      1 => 1320917475,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6702391405007bab84d0af5-19358795',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h3>
	<a href="#">Commentaire / Infos visite</a>
</h3>
<div>
	 <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>

	<p>
		<a
			href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateCom',$_GET['action']);?>
">
			<?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> Modifier le commentaire et/ou l'info visite.
			<?php }else{ ?> Ajouter un commentaire et/ou l'info visite <?php }?> </a>
	</p>

	<?php }?>
	<div class="bulle">
		<h4>Commentaire</h4>
		<?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value->getCom()!=''){?>
		<?php echo $_smarty_tpl->getVariable('elementMandateCom')->value->getCom();?>
 <?php }else{ ?>
		<p>Aucun commentaire actuellement.</p>
		<?php }?> <?php }else{ ?>
		<p>Aucun commentaire actuellement.</p>
		<?php }?>
	</div>
	<div class="bulle">
		<h4>Infos visite</h4>
		<?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value->getInfoVisite()!=''){?>
		<?php echo $_smarty_tpl->getVariable('elementMandateCom')->value->getInfoVisite();?>
 <?php }else{ ?>
		<p>Aucune info visite actuellement.</p>
		<?php }?> <?php }else{ ?>
		<p>Aucune info visite actuellement.</p>
		<?php }?>
	</div>
	<div class="bulle">
		<h4>Observations</h4>
		<?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value->getOtherCom()!=''){?>
		<?php echo $_smarty_tpl->getVariable('elementMandateCom')->value->getOtherCom();?>
 <?php }else{ ?>
		<p>Aucune observation actuellement.</p>
		<?php }?> <?php }else{ ?>
		<p>Aucune observation actuellement.</p>
		<?php }?>
	</div>
</div>
