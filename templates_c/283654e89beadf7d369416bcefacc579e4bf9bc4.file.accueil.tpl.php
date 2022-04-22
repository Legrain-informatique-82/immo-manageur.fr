<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 14:56:49
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export_site/views/accueil.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118574087054216e11e8fa50-77301406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '283654e89beadf7d369416bcefacc579e4bf9bc4' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export_site/views/accueil.tpl',
      1 => 1411477008,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118574087054216e11e8fa50-77301406',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Page d'accueil</h1>
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
        <label class="col-sm-2 control-label" for="titreAccueil">Titre  :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control"  name="titreAccueil" id="titreAccueil" value="<?php echo $_smarty_tpl->getVariable('se')->value->getTitreAccueil();?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="metaDescriptionAccueil">Description : </label>
        <div class="col-sm-8">
            <textarea class="form-control" name="metaDescriptionAccueil" id="metaDescriptionAccueil" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('se')->value->getMetaDescriptionAccueil();?>
</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="txtAccueil" class="col-sm-2 control-label">Texte :</label>
        <div class="col-sm-8">
            <textarea class="form-control editor" name="txtAccueil" id="txtAccueil" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('se')->value->getTxtIndex();?>
</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Valider" class="btn btn-success">
                <i class="fa fa-save"></i> Sauvegarder
            </button>
        </div>
    </div>
</form>
</div>

