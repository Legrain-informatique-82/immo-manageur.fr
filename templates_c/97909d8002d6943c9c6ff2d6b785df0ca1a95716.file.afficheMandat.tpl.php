<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 15:58:16
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/afficheMandat.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141653313254202af8c512c1-19786664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97909d8002d6943c9c6ff2d6b785df0ca1a95716' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/afficheMandat.tpl',
      1 => 1411394294,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141653313254202af8c512c1-19786664',
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
    <?php $_template = new Smarty_Internal_Template('tpl_default/error.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

	<fieldset>
		<legend> Localisation : </legend>
		<div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
			<label for="ville" class="radio-inline">
            <input type="radio" <?php if (empty($_POST['villeSecteur'])||$_POST['villeSecteur']=='ville'){?> checked="checked" <?php }?> name="villeSecteur" id="ville"
				value="ville" />Ville </label>

			<label for="secteur" class="radio-inline">
                <?php echo $_smarty_tpl->getVariable('secteur')->value;?>
<input type="radio"
				<?php if ($_POST['villeSecteur']=='secteur'){?> checked="checked"
				<?php }?>  name="villeSecteur" id="secteur" value="secteur" />
                Secteur </label>
                </div>
		</div>
	</fieldset>
	<fieldset>
		<legend> spécificité : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
			<label for="default" class="radio-inline">
                <input type="radio" name="type"
				id="default" <?php if (empty($_POST['type'])||$_POST['type']=='default'){?> checked="checked" <?php }?>  value="default" />
                Classique </label>
			<label for="exclu" class="radio-inline">
                <input type="radio" name="type"
				id="exclu" <?php if ($_POST['type']=='exclu'){?> checked="checked"
				<?php }?>  value="exclu" />
                Exlusivité</label>
			<label for="dejaV" class="radio-inline">
                <input type="radio" name="type"
				id="dejaV" <?php if ($_POST['type']=='dejaV'){?> checked="checked"
				<?php }?>  value="dejaV" />
                Déja vendu</label>
			<label for="nouveaute" class="radio-inline">
                <input type="radio" name="type"
				id="nouveaute" <?php if ($_POST['type']=='nouveaute'){?> checked="checked" <?php }?>  value="nouveaute" />
                Nouveaute  </label>
		</div>
        </div>
	</fieldset>
	<fieldset>
		<legend> Vignettes : </legend>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
			<label for="une" class="radio-inline">
                <input type="radio" name="photos" id="une" <?php if (empty($_POST['photos'])||$_POST['photos']=='une'){?> checked="checked" <?php }?> value="une" />
                Non </label>
			<label for="quatre" class="radio-inline">
                <input type="radio" name="photos"
				<?php if ($_POST['photos']=='quatre'){?> checked="checked"
				<?php }?>   id="quatre" value="quatre" />
                Oui </label>
		</div>
        </div>
		<div id="choosePicturegenerateAfficheMandate">
            <div class="col-sm-offset-2 col-sm-8">
                <p class="help-block">Choix de 3 vignettes :</p>
           <?php $_smarty_tpl->tpl_vars['count'] = new Smarty_variable(0, null, null);?>
			<?php  $_smarty_tpl->tpl_vars['pict'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfPicture')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pict']->key => $_smarty_tpl->tpl_vars['pict']->value){
?>
                <?php if (!$_smarty_tpl->getVariable('pict')->value->getIsDefault()){?>

                <?php if ($_smarty_tpl->getVariable('count')->value%3==0){?>
                <?php if ($_smarty_tpl->getVariable('count')->value!==0){?></div><?php }?>
            <div class="row">
                <?php }?>
                <div class="col-md-4 text-center">

				<label>
					<p>
						<img
							src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
mandat/thumb/<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
"
							alt="" class="img-thumbnail" />
					</p>
					<p>
						Sélectionner <input type="checkbox" class="arrayPicture"
							name="arrayPicture[]" value="<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
" />
					</p> </label>
			</div>
                <!--<?php echo $_smarty_tpl->getVariable('count')->value++;?>
-->
			<?php }?>
                <?php }} ?>
			</div>
		</div>
	</fieldset>
    <fieldset>
        <legend>Corps</legend>
        <div class="form-group">
		<label for="corps" class="col-sm-2 control-label"> Corps : </label>
            <div class="col-sm-8">
            <textarea name="corps" id="corps" class="form-control"
				cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('corps')->value;?>
</textarea>
                </div>
	</div>
        </fieldset>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
		<button type="submit" name="send" value="Generer" class="btn btn-default">
            <i class="fa fa-print"></i> Générer
		</button>

	</div>

</form>
</div>

