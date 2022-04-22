<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:46
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/mandateCom/views/seeCom.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1636995699519f1c4ece1d25-72928779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1849c6963587a80b69f8f8f7a57374c96b78116' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/mandateCom/views/seeCom.tpl',
      1 => 1369380349,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1636995699519f1c4ece1d25-72928779',
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
