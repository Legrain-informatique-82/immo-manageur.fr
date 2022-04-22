<?php /* Smarty version Smarty-3.0.6, created on 2012-09-06 09:26:22
         compiled from "/var/www/aptana/extra-immo/modules/documents/views/afficheMandat.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20054538505048501e5ce255-57590032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c760fb1af735633fc92b3ebf0b83845257f7b5a' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/documents/views/afficheMandat.tpl',
      1 => 1322124466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20054538505048501e5ce255-57590032',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="blocDoc" class="bulle">
<h1><?php echo $_smarty_tpl->getVariable('title')->value;?>
</h1>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<ul class="contError">
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
<form action="" method="post">

	<fieldset>
		<legend> Localisation : </legend>
		<p>
			<label for="ville"> Ville : <?php echo $_smarty_tpl->getVariable('ville')->value;?>
</label><input type="radio" <?php if (empty($_POST['villeSecteur'])||$_POST['villeSecteur']=='ville'){?> checked="checked" <?php }?> name="villeSecteur" id="ville"
				value="ville" /> 
		</p>
		<p>
			<label for="secteur"> Secteur :</label> <?php echo $_smarty_tpl->getVariable('secteur')->value;?>
<input type="radio"
				<?php if ($_POST['villeSecteur']=='secteur'){?> checked="checked"
				<?php }?>  name="villeSecteur" id="secteur" value="secteur" /> 
		</p>
	</fieldset>
	<fieldset>
		<legend> spécificité : </legend>
		<p>
			<label for="default"> Classique </label><input type="radio" name="type"
				id="default" <?php if (empty($_POST['type'])||$_POST['type']=='default'){?> checked="checked" <?php }?>  value="default" /> 
		</p>
		<p>
			<label for="exclu"> Exlusivité</label> <input type="radio" name="type"
				id="exclu" <?php if ($_POST['type']=='exclu'){?> checked="checked"
				<?php }?>  value="exclu" /> 
		</p>
		<p>
			<label for="dejaV"> Déja vendu</label> <input type="radio" name="type"
				id="dejaV" <?php if ($_POST['type']=='dejaV'){?> checked="checked"
				<?php }?>  value="dejaV" /> 
		</p>
		<p>
			<label for="nouveaute"> Nouveaute  </label><input type="radio" name="type"
				id="nouveaute" <?php if ($_POST['type']=='nouveaute'){?> checked="checked" <?php }?>  value="nouveaute" />
		</p>
	</fieldset>
	<fieldset>
		<legend> Vignettes : </legend>
		<p>
			<label for="une"> Non </label><input type="radio" name="photos" id="une" <?php if (empty($_POST['photos'])||$_POST['photos']=='une'){?> checked="checked" <?php }?> value="une" /> 
		</p>
		<p>
			<label for="quatre"> Oui </label> <input type="radio" name="photos"
				<?php if ($_POST['photos']=='quatre'){?> checked="checked"
				<?php }?>   id="quatre" value="quatre" />
		</p>
		<div id="choosePicturegenerateAfficheMandate">
			<p>Choix de 3 vignettes :</p>

			<?php  $_smarty_tpl->tpl_vars['pict'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfPicture')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pict']->key => $_smarty_tpl->tpl_vars['pict']->value){
?> <?php if (!$_smarty_tpl->getVariable('pict')->value->getIsDefault()){?>
			<div class="vingtPourCent bulle">
				<label>
					<p>
						<img
							src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
mandat/thumb/<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
"
							alt="" />
					</p>
					<p>
						Sélectionner <input type="checkbox" class="arrayPicture"
							name="arrayPicture[]" value="<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
" />
					</p> </label>
			</div>
			<?php }?> <?php }} ?>
			<hr class="clear invi" />
		</div>
	</fieldset>
	<p>
		<label for="corps"> Corps : </label> <textarea name="corps" id="corps"
				cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('corps')->value;?>
</textarea>
	</p>
	<p>
		<input type="submit" name="send" value="Generer" />
	</p>
</form>
</div>
</div>
