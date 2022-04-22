<?php /* Smarty version Smarty-3.0.6, created on 2014-05-14 09:53:35
         compiled from "/var/www/aptana/extra-immo/modules/export/views/export_fb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1180568396537320ffb98333-13049105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f070675790cb7d47af580a83f549c3d04227353' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export/views/export_fb.tpl',
      1 => 1399991538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1180568396537320ffb98333-13049105',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<h1>Gestion des exports facebook</h1>


<p class="center">
    Cliquez sur le bouton ci-dessous pour publier les biens sélectionnés pour toutes les passerelles facebook sur votre/vos page(s) Facebook.
    <br/>En cas de soucis d'exports, il se peut que le jeton de connexion est expiré. <a target="_blank" href="<?php echo Constant::DEFAULT_URL;?>
/scripts/get_token_facebook.php">Cliquez-ici pour en régénérer un nouveau</a>.
    </p>
<p class="center">
    <a class="btn_fb" href="<?php echo Constant::DEFAULT_URL;?>
/scripts/passerelle_facebook.php" target="_blank">Publier sur facebook</a>
</p>




<p class="center"></p>


</div>

