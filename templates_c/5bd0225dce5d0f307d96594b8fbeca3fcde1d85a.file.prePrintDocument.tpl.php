<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 13:32:52
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/prePrintDocument.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1738242520541c14643b39d3-95534467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bd0225dce5d0f307d96594b8fbeca3fcde1d85a' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/prePrintDocument.tpl',
      1 => 1411126371,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1738242520541c14643b39d3-95534467',
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
            </p>
        </div>
    </div>
    <?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


    <?php if ($_smarty_tpl->getVariable('destinataires')->value){?>
        <fieldset>
            <legend>Destinataires : </legend>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <p class="help-block">
                        Sélectionner les destinataires pour lesquels vous souhaitez imprimer le document.
                    </p>
                    <?php  $_smarty_tpl->tpl_vars['dest'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('destinataires')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['dest']->key => $_smarty_tpl->tpl_vars['dest']->value){
?>

                        <label class="checkbox-inline">
                            <input type="checkbox" name="destinataires[]" value="<?php echo $_smarty_tpl->tpl_vars['dest']->value['id'];?>
" checked="checked"/>
                            <?php echo $_smarty_tpl->tpl_vars['dest']->value['prenom'];?>
 <?php echo $_smarty_tpl->tpl_vars['dest']->value['nom'];?>
<br/>
                            <?php echo $_smarty_tpl->tpl_vars['dest']->value['adresse'];?>
<br/>
                            <?php echo $_smarty_tpl->tpl_vars['dest']->value['code_postal'];?>
 <?php echo $_smarty_tpl->tpl_vars['dest']->value['ville'];?>

                        </label>

                    <?php }} ?>
                </div>
            </div>
        </fieldset>
    <?php }?>
    <fieldset>
        <legend>Contenu :</legend>
        <?php $_template = new Smarty_Internal_Template("documents/views/editor.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
    </fieldset>

   <div class="form-group">
       <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" value="Générer" name="send" class="btn btn-default">
            <i class="fa fa-print"></i> Imprimer
        </button>
           </div>
       </div>


</form>
</div>
