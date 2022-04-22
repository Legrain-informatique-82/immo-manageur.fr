<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 10:50:48
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/modules/upload/views/upload.tpl" */ ?>
<?php /*%%SmartyHeaderCode:498806109541fe2e884f9f2-23740609%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '744a340e3c3c22bf3bc19d498533415fdddb5453' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/modules/upload/views/upload.tpl',
      1 => 1411375844,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '498806109541fe2e884f9f2-23740609',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php if ($_smarty_tpl->getVariable('errorUpload')->value){?> <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errorUpload')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['item']->index=-1;
if ($_smarty_tpl->tpl_vars['item']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['e']['first'] = $_smarty_tpl->tpl_vars['item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['e']['last'] = $_smarty_tpl->tpl_vars['item']->last;
?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['first']){?>
    <div class="alert alert-danger" role="alert">
    <ul>
<?php }?>
    <li class="error"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</li> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['e']['last']){?>
        </ul>
    <?php }?> <?php }} ?>
    </div>
<?php }?>

<form action="" method="post" enctype="multipart/form-data" class="form-inline" role="form">
    <div class="form-group">
        <label for="newDoc">Ajouter un fichier :</label>
        <input type="file" name="newDoc" id="newDoc" />
    </div>
    <div class="form-group">
        <input type="submit" value="Envoyer" id="sendDocForMandate" name="sendDocForMandate" class="btn btn-default" />
    </div>
</form>
<p></p>
<p></p>
<table class="dataTableDefault3 table table-striped table-bordered">
    <thead>
    <tr>
        <th>Fichier</th>
        <th>Supprimer</th>
    </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['upl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUpload')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['upl']->key => $_smarty_tpl->tpl_vars['upl']->value){
?>
        <tr>
            <td><a
                        href="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
upload/<?php echo $_smarty_tpl->getVariable('upl')->value->getMandate()->getIdMandate();?>
/<?php echo $_smarty_tpl->getVariable('upl')->value->getName();?>
"
                        target="_blank" class="btn btn-default"><i class="fa fa-download"></i> <?php echo $_smarty_tpl->getVariable('upl')->value->getName();?>
 (<?php echo $_smarty_tpl->getVariable('upl')->value->getSize();?>
)</a></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="idDoc" value="<?php echo $_smarty_tpl->getVariable('upl')->value->getIdUpload();?>
" />


                    <button type="submit" class="btn btn-danger" name="delDocument">
                        <i class="fa fa-trash"></i> Supprimer le document
                    </button>
                </form>
            </td>

        </tr>
    <?php }} ?>
    </tbody>
</table>




