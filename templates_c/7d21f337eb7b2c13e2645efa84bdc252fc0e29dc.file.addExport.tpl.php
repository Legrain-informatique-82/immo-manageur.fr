<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 10:25:52
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/modules/export/views/addExport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175738049541fdd10245525-88858904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d21f337eb7b2c13e2645efa84bdc252fc0e29dc' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/modules/export/views/addExport.tpl',
      1 => 1411374350,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175738049541fdd10245525-88858904',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<form action="" method="post" class="form-inline" role="form">
    <div class="row">
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPasserelle')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
?>

            <div class="checkbox col-xs-2">
                <label>
                    <input type="checkbox"
                            <?php if ($_smarty_tpl->getVariable('p')->value->isLinked($_smarty_tpl->getVariable('mandate')->value)){?> checked="checked" <?php }?>
                           name="nomPasserelle[]" value="<?php echo $_smarty_tpl->getVariable('p')->value->getIdPasserelle();?>
"
                           id="<?php echo $_smarty_tpl->getVariable('p')->value->getName();?>
" /> <?php echo $_smarty_tpl->getVariable('p')->value->getName();?>

                </label>
            </div>


        <?php }} ?>
    </div>
    <div class="row">
        <div class="form-group col-md-12">

            <button type="submit" name="goListExport" value="Mettre à jour les passerelles" class="btn btn-warning">
                <i class="fa fa-save"></i> Mettre à jour les passerelles
            </button>
        </div>
    </div>
</form>

