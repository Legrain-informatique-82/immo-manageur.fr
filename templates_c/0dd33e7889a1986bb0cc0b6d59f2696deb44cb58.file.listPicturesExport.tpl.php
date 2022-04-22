<?php /* Smarty version Smarty-3.0.6, created on 2014-09-02 12:13:43
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/export/views/listPicturesExport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2129719041540598578c3027-44971898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dd33e7889a1986bb0cc0b6d59f2696deb44cb58' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/export/views/listPicturesExport.tpl',
      1 => 1409652820,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2129719041540598578c3027-44971898',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

	<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('photosExportees')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['i']->iteration=0;
 $_smarty_tpl->tpl_vars['i']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["exportPictures"]['index']=-1;
if ($_smarty_tpl->tpl_vars['i']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['i']->iteration++;
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["exportPictures"]['first'] = $_smarty_tpl->tpl_vars['i']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["exportPictures"]['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["exportPictures"]['last'] = $_smarty_tpl->tpl_vars['i']->last;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['exportPictures']['first']||$_smarty_tpl->getVariable('smarty')->value['foreach']['exportPictures']['index']%4==0){?>
        <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['exportPictures']['first']){?></div><?php }?>

    <div class="row">
        <?php }?>
	<div class="col-xs-3">
        <span class="badge"><?php echo $_smarty_tpl->getVariable('i')->value->getPosition();?>
</span> <img src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php echo $_GET['module'];?>
/thumb/<?php echo $_smarty_tpl->getVariable('i')->value->getName();?>
" alt="" class="img-thumbnail"/>
    </div>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['exportPictures']['last']){?>
            </div>

       <?php }?>
	<?php }} else { ?>
	<p>Aucune photo exportée.</p>
	<?php } ?>


