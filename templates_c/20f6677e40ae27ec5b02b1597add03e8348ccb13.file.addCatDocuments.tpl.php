<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 11:44:55
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/addCatDocuments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1741929696541bfb17d2e599-81928170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20f6677e40ae27ec5b02b1597add03e8348ccb13' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/addCatDocuments.tpl',
      1 => 1411119893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1741929696541bfb17d2e599-81928170',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" value="<?php echo $_smarty_tpl->getVariable('label_send')->value;?>
" name="send" class="btn <?php if ($_smarty_tpl->getVariable('add')->value){?>btn-success<?php }else{ ?>btn-warning<?php }?>" title="<?php if ($_smarty_tpl->getVariable('add')->value){?>Enregistrer<?php }else{ ?>Mettre à jour<?php }?>">
                    <i class="fa fa-save fa-2x"></i>
                </button>

                <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','listCatDocuments');?>
" title="Annuler &amp; retourner à la liste">
                    <i class="fa fa-close fa-2x"></i>
                </a>
            </p>
        </div>
    </div>
    <?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Catégorie : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Destinataires :</p>
            <div class="form-inline">
                <label class="checkbox-inline"><input type="radio" name="code" value="seller" <?php if ($_smarty_tpl->getVariable('code')->value=="seller"){?> checked="checked" <?php }?>/> Vendeurs</label>
                <label class="checkbox-inline"><input type="radio" name="code" value="acq" <?php if ($_smarty_tpl->getVariable('code')->value=="acq"){?> checked="checked" <?php }?>/> Acquéreurs</label>
                <label class="checkbox-inline"><input type="radio" name="code" value="none" <?php if ($_smarty_tpl->getVariable('code')->value=="none"){?> checked="checked" <?php }?>/> Indéfini</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" value="<?php echo $_smarty_tpl->getVariable('label_send')->value;?>
" name="send" class="btn <?php if ($_smarty_tpl->getVariable('add')->value){?>btn-success<?php }else{ ?>btn-warning<?php }?>">
                <i class="fa fa-save"></i> <?php if ($_smarty_tpl->getVariable('add')->value){?>Enregistrer<?php }else{ ?>Mettre à jour<?php }?>
            </button>
            <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','listCatDocuments');?>
">
                <i class="fa fa-close"></i> Annuler &amp; retourner à la liste
            </a>
        </div>
    </div>

</form>
</div>
