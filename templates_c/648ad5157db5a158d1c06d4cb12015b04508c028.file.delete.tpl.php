<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 12:33:09
         compiled from "/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41299443554214c65f257f6-49214487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '648ad5157db5a158d1c06d4cb12015b04508c028' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/delete.tpl',
      1 => 1411468388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41299443554214c65f257f6-49214487',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-8">
            <h1 class="h2">Suppression du rapprochement</h1>
        </div>
        <div class="col-md-4">
            <p class="h4 text-right ">
                <button type="submit" value="Supprimer" name="send" id="send" class="btn btn-danger" title="Supprimer">
                    <i class="fa fa-trash fa-2x"></i>
                </button>

                <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default" title="Annuler &amp; fermer">
                    <i class="fa fa-close fa-2x"></i>
                </button>
            </p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            <p class="help-block">Êtes-vous sûr de vouloir supprimer le rapprochement entre
                <?php echo $_smarty_tpl->getVariable('rapprochement')->value->getAcquereur()->getFirstname();?>

                <?php echo $_smarty_tpl->getVariable('rapprochement')->value->getAcquereur()->getName();?>
 et le mandat
                <?php echo $_smarty_tpl->getVariable('rapprochement')->value->getMandate()->getNumberMandate();?>
 ?</p>

            <p>
                <button type="submit" value="Supprimer" name="send" id="send" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Supprimer
                </button>

                <button type="submit" value="Annuler" name="cancel" id="cancel" class="btn btn-default">
                    <i class="fa fa-close"></i> Annuler &amp; fermer
                </button>
            </p>
        </div>
</form>
</div>
</div>