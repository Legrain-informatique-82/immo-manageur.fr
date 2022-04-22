<?php /* Smarty version Smarty-3.0.6, created on 2014-09-18 10:49:09
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export/views/updatePasserelle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:263109385541a9c852caa93-15290631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f1ab5beb27d25777a492a7186db2e05d7e7bff0' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export/views/updatePasserelle.tpl',
      1 => 1411030148,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '263109385541a9c852caa93-15290631',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" role="form" class="form-horizontal">

    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Modifier la passerelle</h1>
        </div>

        <div class="col-md-6">
            <p class="h4 text-right ">
                <button type="submit" name="send" value="Modifier" title="Modifier" class="btn btn-warning">
                    <i class="fa fa-save fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Annuler" title="Annuler" class="btn btn-default">
                    <i class="fa fa-close fa-2x"></i>
                </button>

            </p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Nom :</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" value="<?php echo $_smarty_tpl->getVariable('name')->value;?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"l for="type">Type d'export : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="type" id="type" value="<?php echo $_smarty_tpl->getVariable('type')->value;?>
" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="param">Paramètres : </label>
        <div class="col-sm-8">
            <textarea name="param" class="form-control" id="param" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('param')->value;?>
</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label for="asset">
                    <input type="checkbox" <?php if ($_smarty_tpl->getVariable('asset')->value==1){?> checked="checked" <?php }?> name="asset" id="asset" value="1" />
                    Active
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Modifier" class="btn btn-warning">
                <i class="fa fa-save"></i> Modifier
            </button>
            <button type="submit" name="cancel" value="Annuler" class="btn btn-default">
                <i class="fa fa-close"></i> Annuler
            </button>
        </div>
    </div>
</form>
</div>
