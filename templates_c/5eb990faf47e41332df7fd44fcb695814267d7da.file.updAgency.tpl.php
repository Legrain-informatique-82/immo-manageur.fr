<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 14:57:33
         compiled from "/var/www/aptana/immo-manageur.fr/modules/user/views/updAgency.tpl" */ ?>
<?php /*%%SmartyHeaderCode:248436041541ad6bd6abd97-36740430%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5eb990faf47e41332df7fd44fcb695814267d7da' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/user/views/updAgency.tpl',
      1 => 1411045051,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '248436041541ad6bd6abd97-36740430',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <button type="submit" name="upd" value="Valider" class="btn btn-warning" title="Valider">
                <i class="fa fa-save fa-2x"></i>
            </button>

            <a title="Annuler et fermer" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"user","listAgencies");?>
">
                <i class="fa fa-close fa-2x"></i>
            </a>

        </p>
    </div>
</div>

<div id="blocAgency">

<fieldset>
    <legend>Général</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="name">Nom ( interne) : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getName();?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="generalName">Nom ( general) : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="generalName" id="generalName" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getGeneralName();?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="url">Site web : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="url" id="url" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getUrl();?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="tel1">Tél 1 : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="tel1" id="tel1" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getTel1();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="tel2">Tél 2 : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="tel2" id="tel2" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getTel2();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="tel3">Tél 3 : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="tel3" id="tel3" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getTel3();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="email">Email : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getEmail();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="address">Adresse : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="address" id="address" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getAddress();?>
"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="city">Ville : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="city" id="city" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getCity();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="zipCode">Code postal : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="zipCode" id="zipCode" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getZipCode();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="contact">Contact : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="contact" id="contact" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getContact();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="siret">Siret : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="siret" id="siret" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getSiret();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="capital">Capital : </label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="capital" id="capital" value="<?php echo $_smarty_tpl->getVariable('agency')->value->getCapital();?>
" />
        </div>
    </div>
</fieldset>
<!-- 3 logos  -->
<fieldset>
    <legend>Logos</legend>



    <!-- Afficher le logo existant -->
    <?php if ($_smarty_tpl->getVariable('errorAfficheMandat')->value){?>
        <p class="error">
            <?php echo $_smarty_tpl->getVariable('errorAfficheMandat')->value;?>

        </p>
    <?php }?>
    <?php if ($_smarty_tpl->getVariable('agency')->value->getLogoAfficheMandat()){?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoAfficheMandat();?>
" alt="logo affiche mandat existant" />
                </p>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logoAfficheMandat">Entête affiche mandat : </label>
        <div class="col-sm-8">
            <input type="file" name="logoAfficheMandat" id="logoAfficheMandat" />
        </div>
    </div>



    <?php if ($_smarty_tpl->getVariable('errorAfficheTerrain')->value){?>
        <p class="error">
            <?php echo $_smarty_tpl->getVariable('errorAfficheTerrain')->value;?>

        </p>
    <?php }?>
    <?php if ($_smarty_tpl->getVariable('agency')->value->getLogoAfficheTerrain()){?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoAfficheTerrain();?>
" alt="logo affiche terrain existant" />
                </p>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logoAfficheTerrain">Entête affiche terrain :</label>
        <div class="col-sm-8">
            <input type="file" name="logoAfficheTerrain" id="logoAfficheTerrain" />
        </div>
    </div>
</fieldset>


<fieldset>
    <legend>Lettres type</legend>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="footerLettre">Pied de page</label>
        <div class="col-sm-8">
            <textarea class="form-control" name="footerLettre" id="footerLettre" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('agency')->value->getFooterLettre();?>
</textarea>
        </div>
    </div>



    <?php if ($_smarty_tpl->getVariable('errorEnteteLettre')->value){?>
        <p class="error">
            <?php echo $_smarty_tpl->getVariable('errorEnteteLettre')->value;?>

        </p>
    <?php }?>
    <!-- Afficher le logo existant -->
    <?php if ($_smarty_tpl->getVariable('agency')->value->getEnteteLettre()){?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getEnteteLettre();?>
" alt="entête de lettre existante" />
                </p>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="enteteLettre">Entête Lettre :</label>
        <div class="col-sm-8">
            <input type="file" name="enteteLettre" id="enteteLettre" />
        </div>
    </div>





    <?php if ($_smarty_tpl->getVariable('errorFooterLettre')->value){?>
        <p class="error">
            <?php echo $_smarty_tpl->getVariable('errorFooterLettre')->value;?>

        </p>
    <?php }?>

    <?php if ($_smarty_tpl->getVariable('agency')->value->getLogoFooterlettre()){?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <p>
                    <img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/user/<?php echo $_smarty_tpl->getVariable('agency')->value->getLogoFooterlettre();?>
" alt="entête de lettre existante" />
                </p>
            </div>
        </div>
    <?php }?>

    <!-- Afficher le logo existant -->

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logoFooterLettre">logo pied de page :</label>
        <div class="col-sm-8">
            <input type="file" name="logoFooterLettre" id="logoFooterLettre" />
        </div>
    </div>


</fieldset>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
       

        <button type="submit" name="upd" value="Valider" class="btn btn-warning" title="Valider">
            <i class="fa fa-save"></i> Mettre à jour
        </button>

        <a title="Annuler et fermer" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"user","listAgencies");?>
">
            <i class="fa fa-close"></i> Annuler et fermer
        </a>

    </div>
</div>
</form>

</div>