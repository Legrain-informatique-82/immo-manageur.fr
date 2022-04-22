<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 09:36:42
         compiled from "/var/www/aptana/immo-manageur.fr/modules/acquereur/views/addUpdSit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:718696769541a8b8aa74d69-82597168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d3bf82808a3bdf9e60c1d6fb2c9b34a13e3754f' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/acquereur/views/addUpdSit.tpl',
      1 => 1411025799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '718696769541a8b8aa74d69-82597168',
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
            <h1 class="h2"><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" class="btn <?php if ($_smarty_tpl->getVariable('add')->value){?>btn-success<?php }else{ ?>btn-warning<?php }?>" name="go" title="Enregistrer">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" class="btn btn-default" name="cancel" title="Annuler et fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
        </div>
    </div>
    <?php $_template = new Smarty_Internal_Template("tpl_default/error.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Situation : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('obj')->value['name'];?>
" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Nécessite une date :</p>

            <label for="eventDateTrue"  class="radio-inline">
                <input type="radio" name="eventDate" id="eventDateTrue" value="1"  <?php if ($_smarty_tpl->getVariable('obj')->value['eventDate']==1){?> checked="checked"<?php }?> />
                Oui
            </label>
            <label for="eventDateFalse"  class="radio-inline">
                <input type="radio" name="eventDate" id="eventDateFalse" value="0"  <?php if ($_smarty_tpl->getVariable('obj')->value['eventDate']==0){?> checked="checked"<?php }?> />
                Non
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Nécessite un lieu :</p>
            <label for="eventLocationTrue"  class="radio-inline">
                <input type="radio" name="eventLocation" id="eventLocationTrue" value="1"  <?php if ($_smarty_tpl->getVariable('obj')->value['eventLocation']==1){?> checked="checked"<?php }?> />
                Oui
            </label>

            <label for="eventLocationFalse" class="radio-inline" >
                <input type="radio" name="eventLocation" id="eventLocationFalse" value="0" <?php if ($_smarty_tpl->getVariable('obj')->value['eventLocation']==0){?> checked="checked"<?php }?> />
                Non
            </label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" name="go" value="Envoyer" class="btn <?php if ($_smarty_tpl->getVariable('add')->value){?>btn-success<?php }else{ ?>btn-warning<?php }?>" >
                <i class="fa fa-save"></i> Enregistrer
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler
            </button>
        </div>
    </div>
</form>

</div>
