<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 15:28:52
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/ficheImage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152391888254202414b5e048-22256105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '657b132f19c50c586e209bbf32c89030e5630e12' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/ficheImage.tpl',
      1 => 1411392531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152391888254202414b5e048-22256105',
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

    <div class="well">
	<ul>
	<li>Pour changer la position d'une photo, modifier le numéro présent sous celle-ci.</li>
	<li>Pour ne pas imprimer une photo, supprimez le numéro présent sous celle-ci</li>
	</ul>
    </div>

    <div class="col-sm-offset-2 col-sm-8">

        <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listPictures')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['i']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['iteration']=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
 $_smarty_tpl->tpl_vars['i']->index++;
 $_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['first'] = $_smarty_tpl->tpl_vars['i']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['boucle']['index']++;
?>


        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']%3==0){?>
        <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['first']){?></div><?php }?>
    <div class="row">
        <?php }?>

        <div class="col-md-4 text-center">
            <img src="<?php echo $_smarty_tpl->getVariable('chemImage')->value;?>
thumb/<?php echo $_smarty_tpl->tpl_vars['i']->value['name'];?>
" alt="" class="img-thumbnail" />
            <input  class="form-control" type="text" name="position_<?php echo $_smarty_tpl->tpl_vars['i']->value['idPhoto'];?>
" value="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
" placeholder="position de la photo (ex : <?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['iteration'];?>
 )"/>
            <p></p>
        </div>

        <?php }} ?>
    </div>







    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
			<button type="submit" name="send" value="Generer" class="btn btn-default">
                <i class="fa fa-print"></i> Générer
			</button>
		</div>
        </div>
	</form>
	</div>

