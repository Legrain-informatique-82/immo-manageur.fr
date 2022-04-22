<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:46
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/mandateCom/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1066979796519f1c4edd12e4-48653419%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd10943a96bc1f56e7856941871417cb2976794c0' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/mandateCom/views/see.tpl',
      1 => 1369380348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1066979796519f1c4edd12e4-48653419',
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
