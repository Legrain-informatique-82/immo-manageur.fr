<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 15:38:08
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/fiche_acq.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2098698547542026405bc3b1-18107422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9055931a1d3ed47bec4017cf766c34441423c9aa' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/fiche_acq.tpl',
      1 => 1411393087,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2098698547542026405bc3b1-18107422',
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
            <h1 class="h2"> <?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="send" value="Generer" class="btn btn-default">
                    <i class="fa fa-print fa-2x"></i>
                </button>


            </p>
        </div>
    </div>



    <div id="choosePicturegenerateAfficheMandate">
        <div class="col-sm-offset-2 col-sm-8">
        <p class="help-block">Choix de 3 vignettes :</p>

        <?php  $_smarty_tpl->tpl_vars['pict'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfPicture')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['pict']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pict']->key => $_smarty_tpl->tpl_vars['pict']->value){
 $_smarty_tpl->tpl_vars['pict']->index++;
 $_smarty_tpl->tpl_vars['pict']->first = $_smarty_tpl->tpl_vars['pict']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['first'] = $_smarty_tpl->tpl_vars['pict']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['index']++;
?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']%3==0){?>
            <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?></div><?php }?>
        <div class="row">
            <?php }?>
            <div class="col-md-4 text-center">
                <label>
                    <p>
                        <img
                                src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php echo $_smarty_tpl->getVariable('module')->value;?>
/thumb/<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
"
                                alt="" class="img-thumbnail"/>
                    </p>
                    <p>
                        Sélectionner <input type="checkbox" class="arrayPicture"
                                            name="arrayPicture[]" value="<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
" />
                    </p> </label>
            </div>
        <?php }} ?>
            </div>
        </div>


   <div class="form-group">
       <div class="col-sm-offset-2 col-sm-8">
           <button type="submit" name="send" value="Generer" class="btn btn-default">
               <i class="fa fa-print"></i> Génerer
           </button>
           </div>
   </div>
        </div>
</div>

</form>
