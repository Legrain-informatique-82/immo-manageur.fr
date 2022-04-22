<?php /* Smarty version Smarty-3.0.6, created on 2014-05-20 08:47:53
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/mandateCom/views/seeCom.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1434120482537afa9963b9a1-09110601%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33d82f1d1fd644ada7a5b5e28c019b493f3fde00' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/mandateCom/views/seeCom.tpl',
      1 => 1369380349,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1434120482537afa9963b9a1-09110601',
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
