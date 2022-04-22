<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 16:41:50
         compiled from "/var/www/aptana/immo-manageur.fr/modules/accueil/modules/02statistiques/views/stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2517567895420352ee61996-49702723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03c68b78e7350c320063dc05d8eaebfc5f2c2503' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/accueil/modules/02statistiques/views/stats.tpl',
      1 => 1411396909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2517567895420352ee61996-49702723',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Mes statistiques</h3>
    </div>
    <div class="panel-body">

        <p class="bgyellow" ><span>Nombre de biens non terrains :</span> <?php echo $_smarty_tpl->getVariable('nbMandats')->value;?>
</p>
        <p class="bggreen"><span>Nombre de terrains :</span> <?php echo $_smarty_tpl->getVariable('nbTerrains')->value;?>
</p>
        <p class="bgblue"><span>Mes Acquéreurs :</span> <?php echo $_smarty_tpl->getVariable('nbAcq')->value;?>
 </p>
        <p class="bgpurple"><span>Mes rapprochements :</span> <?php echo $_smarty_tpl->getVariable('nbRapprochement')->value;?>
 </p>
        <p class="bgred"><span>Mes mandats en compromis :</span> <?php echo $_smarty_tpl->getVariable('nbCompromis')->value;?>
 </p>
    </div>
</div>

