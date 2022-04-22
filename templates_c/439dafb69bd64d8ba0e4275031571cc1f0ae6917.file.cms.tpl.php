<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 14:53:29
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export_site/views/cms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132829693854216d49dad2c2-75822156%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '439dafb69bd64d8ba0e4275031571cc1f0ae6917' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export_site/views/cms.tpl',
      1 => 1411476803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132829693854216d49dad2c2-75822156',
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
            <h1 class="h2"><?php echo $_smarty_tpl->getVariable('cms')->value->getPrivateName();?>
</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Sauvegarder">
                    <i class="fa-save fa fa-2x"></i>
                </button>


            </p>
        </div>
    </div>





        <?php $_template = new Smarty_Internal_Template("tpl_default/error.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>




        <div class="form-group">
            <label class="col-sm-2 control-label" for="publicName">Titre du menu  :</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="publicName" id="publicName" value="<?php echo $_smarty_tpl->getVariable('cms')->value->getPublicName();?>
" />
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label" for="title">Titre de la page  :</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $_smarty_tpl->getVariable('cms')->value->getTitle();?>
" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="url">Url de la page  :</label>
            <div class="col-sm-8">
                <input class="form-control" type="text" name="url" id="url" value="<?php echo $_smarty_tpl->getVariable('cms')->value->getUrl();?>
" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="description">Description : </label>
            <div class="col-sm-8">
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('cms')->value->getDescription();?>
</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="content">Texte :</label>
            <div class="col-sm-8">
                <textarea class="form-control editor"  name="content" id="content" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('cms')->value->getContent();?>
</textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="send" value="Valider" class="btn btn-success">
                    <i class="fa fa-save"></i> sauvegarder
                </button>
            </div>
        </div>
</form>
</div>
