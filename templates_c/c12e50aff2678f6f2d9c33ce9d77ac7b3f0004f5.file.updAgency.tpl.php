<?php /* Smarty version Smarty-3.0.6, created on 2013-10-30 11:45:25
         compiled from "/var/www/aptana/extra-immo/modules/user/views/updAgency.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17527088305270e345224920-51943925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c12e50aff2678f6f2d9c33ce9d77ac7b3f0004f5' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/user/views/updAgency.tpl',
      1 => 1369380412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17527088305270e345224920-51943925',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<div id="blocAgency">
<form action="" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Général</legend>
<p><label for="name">Nom ( interne) : </label><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getName();?>
"/></p>
<p><label for="generalName">Nom ( general) : </label><input type="text" name="generalName" id="generalName" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getGeneralName();?>
"/></p>
<p><label for="url">Site web : </label><input type="text" name="url" id="url" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getUrl();?>
"/></p>
<p><label for="tel1">Tél 1 : </label><input type="text" name="tel1" id="tel1" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getTel1();?>
" /></p>
<p><label for="tel2">Tél 2 : </label><input type="text" name="tel2" id="tel2" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getTel2();?>
" /></p>
<p><label for="tel3">Tél 3 : </label><input type="text" name="tel3" id="tel3" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getTel3();?>
" /></p>
<p><label for="email">Email : </label><input type="text" name="email" id="email" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getEmail();?>
" /></p>
<p><label for="address">Adresse : </label><input type="text" name="address" id="address" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getAddress();?>
"/></p>
<p><label for="city">Ville : </label><input type="text" name="city" id="city" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getCity();?>
" /></p>
<p><label for="zipCode">Code postal : </label><input type="text" name="zipCode" id="zipCode" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getZipCode();?>
" /></p>
<p><label for="contact">Contact : </label><input type="text" name="contact" id="contact" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getContact();?>
" /></p>
<p><label for="siret">Siret : </label><input type="text" name="siret" id="siret" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getSiret();?>
" /></p>
<p><label for="capital">Capital : </label><input type="text" name="capital" id="capital" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getCapital();?>
" /></p>
</fieldset>
<!-- 3 logos  -->
<fieldset>
<legend>Logos</legend>

<div class="bulle">
<?php if ($_smarty_tpl->getVariable('errorlogoExtranet')->value){?><p class="error"><?php echo $_smarty_tpl->getVariable('errorlogoExtranet')->value;?>
</p><?php }?>

<?php if ($_smarty_tpl->getVariable('agency')->value->getLogoExtranet()){?>
<p><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoExtranet();?>
" alt="logo extranet existant" /></p>
<?php }?>
<p><label for="logoExtranet">Logo extranet : </label>
<input type="file" name="logoExtranet" id="logoExtranet" /></p>
</div>


<div class="bulle">
<!-- Afficher le logo existant -->
<?php if ($_smarty_tpl->getVariable('errorAfficheMandat')->value){?><p class="error"><?php echo $_smarty_tpl->getVariable('errorAfficheMandat')->value;?>
</p><?php }?>
<?php if ($_smarty_tpl->getVariable('agency')->value->getLogoAfficheMandat()){?>
<p><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoAfficheMandat();?>
" alt="logo affiche mandat existant" /></p>
<?php }?>
<p><label for="logoAfficheMandat">Entête affiche mandat : </label>
<input type="file" name="logoAfficheMandat" id="logoAfficheMandat" /></p>
</div>

<div class="bulle">
<?php if ($_smarty_tpl->getVariable('errorAfficheTerrain')->value){?><p class="error"><?php echo $_smarty_tpl->getVariable('errorAfficheTerrain')->value;?>
</p><?php }?>
<?php if ($_smarty_tpl->getVariable('agency')->value->getLogoAfficheTerrain()){?>
<p><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoAfficheTerrain();?>
" alt="logo affiche terrain existant" /></p>
<?php }?>
<p><label for="logoAfficheTerrain">Entête affiche terrain :</label>
<input type="file" name="logoAfficheTerrain" id="logoAfficheTerrain" /></p>
</div>


<div class="bulle">
<?php if ($_smarty_tpl->getVariable('errorEnteteCourrier')->value){?><p class="error"><?php echo $_smarty_tpl->getVariable('errorEnteteCourrier')->value;?>
</p><?php }?>
<!-- Afficher le logo existant -->
<?php if ($_smarty_tpl->getVariable('agency')->value->getLogoCourrier()){?>
<p><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoCourrier();?>
" alt="entête de courrier existante" /></p>
<?php }?>
<p><label for="logoCourrier">Entête courrier :</label>
<input type="file" name="logoCourrier" id="logoCourrier" /></p>
</div>
</fieldset>

<legend>Lettres type</legend>
<fieldset>
<div class="bulle">
<p><label for="footerLettre">Pied de page</label><textarea name="footerLettre" id="footerLettre" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('agency')->value->getFooterLettre();?>
</textarea></p>
</div>

<div class="bulle">
<?php if ($_smarty_tpl->getVariable('errorEnteteLettre')->value){?><p class="error"><?php echo $_smarty_tpl->getVariable('errorEnteteLettre')->value;?>
</p><?php }?>
<!-- Afficher le logo existant -->
<?php if ($_smarty_tpl->getVariable('agency')->value->getEnteteLettre()){?>
<p><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getEnteteLettre();?>
" alt="entête de lettre existante" /></p>
<?php }?>
<p><label for="enteteLettre">Entête Lettre :</label>
<input type="file" name="enteteLettre" id="enteteLettre" /></p>
</div>


<div class="bulle">
<?php if ($_smarty_tpl->getVariable('errorFooterLettre')->value){?><p class="error"><?php echo $_smarty_tpl->getVariable('errorFooterLettre')->value;?>
</p><?php }?>
<!-- Afficher le logo existant -->
<?php if ($_smarty_tpl->getVariable('agency')->value->getLogoFooterlettre()){?>
<p><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoFooterlettre();?>
" alt="entête de lettre existante" /></p>
<?php }?>
<p><label for="logoFooterLettre">logo pied de page :</label>
<input type="file" name="logoFooterLettre" id="logoFooterLettre" /></p>
</div>

</fieldset>

<p><input type="submit" name="upd" value="Valider" /></p>
</form>
</div>
</div>