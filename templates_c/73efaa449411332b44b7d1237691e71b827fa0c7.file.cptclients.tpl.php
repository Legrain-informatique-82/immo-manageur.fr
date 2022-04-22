<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 15:09:13
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export_site/views/cptclients.tpl" */ ?>
<?php /*%%SmartyHeaderCode:485903020542170f9be6708-66428882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73efaa449411332b44b7d1237691e71b827fa0c7' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export_site/views/cptclients.tpl',
      1 => 1411477752,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '485903020542170f9be6708-66428882',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Gestion des comptes clients</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Sauvegarder">
                    <i class="fa-save fa fa-2x"></i>
                </button>


            </p>
        </div>
    </div>





    <div class="form-group">
        <label class="col-sm-2 control-label" for="urlwebsite">Url du site vitrine : </label>
        <div class="col-sm-8">
        <input type="text" name="urlwebsite" id="urlwebsite" value="<?php echo $_smarty_tpl->getVariable('urlwebsite')->value;?>
" class="form-control"/>
    </div>
    </div>

    <fieldset>
        <legend>E-mail inscription :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subjectemailwelcome">Sujet de l'e-mail : </label>
            <div class="col-sm-8">
            <input type="text" name="subjectemailwelcome" id="subjectemailwelcome" value="<?php echo $_smarty_tpl->getVariable('subjectemailwelcome')->value;?>
" class="form-control"/>
        </div>
        </div>
        <div class="form-group">
            <p class="help-block col-sm-offset-2 col-sm-10">Mots clefs : {prenom}, {nom},{url},{identifiant},{motDePasse} ( respectez la casse)</p>
            <label class="col-sm-2 control-label" for="emailwelcome">Contenu :</label>

            <div class="col-sm-8">
            <textarea name="emailwelcome" id="emailwelcome" cols="30" rows="10" class="editor form-control"><?php echo $_smarty_tpl->getVariable('emailwelcome')->value;?>
</textarea>
        </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>E-mail régénérer le mot de passe :</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subjectemailresetpassword">Sujet de l'e-mail : </label>
            <div class="col-sm-8">
            <input type="text" name="subjectemailresetpassword" id="subjectemailresetpassword" value="<?php echo $_smarty_tpl->getVariable('subjectemailresetpassword')->value;?>
" class="form-control"/>
        </div>
        </div>
        <div class="form-group">
            <p class="help-block col-sm-offset-2 col-sm-10"> Mots clefs : {prenom}, {nom},{url},{identifiant},{motDePasse} ( respectez la casse)</p>
            <label class="col-sm-2 control-label" for="emailresetpassword">Contenu : </label>
            <div class="col-sm-8">

            <textarea name="emailresetpassword" id="emailresetpassword" cols="30" rows="10" class="editor form-control"><?php echo $_smarty_tpl->getVariable('emailresetpassword')->value;?>
</textarea>
        </div>
        </div>
    </fieldset>
    <fieldset>
        <legend>Email de contact commercial</legend>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subjectemailcontactcommercial">Sujet de l'email :</label>
            <div class="col-sm-8">
            <input type="text" name="subjectemailcontactcommercial" id="subjectemailcontactcommercial" value="<?php echo $_smarty_tpl->getVariable('subjectemailcontactcommercial')->value;?>
" class="form-control"/>
        </div>
        </div>
    </fieldset>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="send" value="Valider" class="btn-success btn">
            <i class="fa fa-save"></i> Sauvegarder
        </button>
    </div>
    </div>
</form>
</div>

