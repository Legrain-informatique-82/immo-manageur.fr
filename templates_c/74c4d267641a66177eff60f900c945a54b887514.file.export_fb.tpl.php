<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 11:47:04
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export/views/export_fb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1280900929541aaa18c97d57-66144197%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74c4d267641a66177eff60f900c945a54b887514' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export/views/export_fb.tpl',
      1 => 1411033623,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1280900929541aaa18c97d57-66144197',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">Gestion des exports facebook</h1>
    </div>


</div>



<p class="text-center">
    Cliquez sur le bouton ci-dessous pour publier les biens sélectionnés pour toutes les passerelles facebook sur votre/vos page(s) Facebook.
    <br/>En cas de soucis d'exports, il se peut que le jeton de connexion est expiré. <a target="_blank" href="<?php echo Constant::DEFAULT_URL;?>
/scripts/get_token_facebook.php">Cliquez-ici pour en régénérer un nouveau</a>.
</p>
<p class="text-center">
    <a class="btn btn-lg btn-info" href="<?php echo Constant::DEFAULT_URL;?>
/scripts/passerelle_facebook.php" target="_blank">Publier sur facebook</a>
</p>







</div>

