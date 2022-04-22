<?php /* Smarty version Smarty-3.0.6, created on 2014-09-02 09:25:30
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/documents/views/linkFicheVierge.tpl" */ ?>
<?php /*%%SmartyHeaderCode:455466119540570ea6482c7-94629962%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '071e0b6c2e5c2e934383ba25ccf0b76c97c89b0c' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/documents/views/linkFicheVierge.tpl',
      1 => 1409642729,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '455466119540570ea6482c7-94629962',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'mandat','imprFicheVierge');?>
" target="_blank"><i class="fa fa-print"></i> Imprimer une fiche vierge</a>