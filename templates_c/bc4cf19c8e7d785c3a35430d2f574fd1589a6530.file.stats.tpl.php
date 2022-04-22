<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:35
         compiled from "/var/www/aptana/extra-immo/modules/accueil/modules/02statistiques/views/stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:841975468519f1c43988d34-98337715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc4cf19c8e7d785c3a35430d2f574fd1589a6530' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/accueil/modules/02statistiques/views/stats.tpl',
      1 => 1369380393,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '841975468519f1c43988d34-98337715',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="blocStats">
<div id="contBlocStats">
	<p class="bgyellow" ><span>Mandats :</span> <?php echo $_smarty_tpl->getVariable('nbMandats')->value;?>
</p>
	<p class="bggreen"><span>Terrains :</span> <?php echo $_smarty_tpl->getVariable('nbTerrains')->value;?>
</p>
	<p class="bgblue"><span>Acquéreurs :</span> <?php echo $_smarty_tpl->getVariable('nbAcq')->value;?>
 </p>
	<p class="bgpurple"><span>Rapprochements :</span> <?php echo $_smarty_tpl->getVariable('nbRapprochement')->value;?>
 </p>
	<p class="bgred"><span>Compromis :</span> <?php echo $_smarty_tpl->getVariable('nbCompromis')->value;?>
 </p>
	</div>
</div>
