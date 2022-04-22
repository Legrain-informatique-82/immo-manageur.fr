<?php /* Smarty version Smarty-3.0.6, created on 2014-07-17 16:00:37
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/modules/mandateCom/views/seeCom.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113817282253c7d70563f6f7-98649448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9d3430da5e3a4e959b74a18fda01151ea1a78ee' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/modules/mandateCom/views/seeCom.tpl',
      1 => 1369380452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113817282253c7d70563f6f7-98649448',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value->getOtherCom()!=''){?>
<div class="blocEnteteMandat">
	<h1>Observations :</h1>
	<p><?php echo Tools::substr($_smarty_tpl->getVariable('elementMandateCom')->value->getOtherCom(),0,250);?>
 <?php if (Tools::strlen($_smarty_tpl->getVariable('elementMandateCom')->value->getOtherCom())>250){?> [...] <?php }?>
	</p>
</div>
<?php }?> <?php }?>
