<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 11:56:58
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/delDocument.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1151415098541bfdea0be295-75124456%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '513f03b586ed9cc00b693c6297076bd4197ad0dc' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/delDocument.tpl',
      1 => 1411120617,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1151415098541bfdea0be295-75124456',
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
                <button type="submit" name="delete" value="Oui" class="btn btn-danger" title="<?php echo Lang::LABEL_DELETE;?>
">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="cancel" value="Non" class="btn btn-default" title="<?php echo Lang::LABEL_CANCEL;?>
">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    <?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Êtes-vous certain de vouloir supprimer ce document ? </p>


            <p>

                <button type="submit" name="delete" value="Oui" class="btn btn-danger">
                    <i class="fa fa-trash"></i> <?php echo Lang::LABEL_DELETE;?>

                </button>
                <button type="submit" name="cancel" value="Non" class="btn btn-default">
                    <i class="fa fa-close"></i> <?php echo Lang::LABEL_CANCEL;?>

                </button>
            </p>
        </div>
    </div>
</form>
</div>
