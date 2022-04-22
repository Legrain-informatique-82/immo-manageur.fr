<?php /* Smarty version Smarty-3.0.6, created on 2012-07-19 09:43:52
         compiled from "/var/www/aptana/extra-immo/modules/terrain/modules/mandateCom/views/seeCom.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1373693275007bab8425178-83363038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82d1b055eaf481146da60a06935ca77f8b3c2cf8' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/terrain/modules/mandateCom/views/seeCom.tpl',
      1 => 1312885718,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1373693275007bab8425178-83363038',
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
