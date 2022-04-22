<?php /* Smarty version Smarty-3.0.6, created on 2012-09-06 10:17:18
         compiled from "/var/www/aptana/extra-immo/modules/documents/views/fiche_acq.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153322579350485c0e608568-41943110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2119e1475a52ef45db06c1c3911cdcaf0f12bc68' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/documents/views/fiche_acq.tpl',
      1 => 1322124725,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153322579350485c0e608568-41943110',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="bulle">
<div id="choosePicturegenerateAfficheMandate">
			<p>Choix de 3 vignettes :</p>
<form action="" method="post">
			<?php  $_smarty_tpl->tpl_vars['pict'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listOfPicture')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pict']->key => $_smarty_tpl->tpl_vars['pict']->value){
?> 
			<div class="vingtPourCent bulle">
				<label>
					<p>
						<img
							src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
<?php echo $_smarty_tpl->getVariable('module')->value;?>
/thumb/<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
"
							alt="" height="180" />
					</p>
					<p>
						Sélectionner <input type="checkbox" class="arrayPicture"
							name="arrayPicture[]" value="<?php echo $_smarty_tpl->getVariable('pict')->value->getName();?>
" />
					</p> </label>
			</div>
			<?php }} ?>
			<hr class="clear invi" />
		</div>
		<p>
		<input type="submit" name="send" value="Generer" />
	</p>
	</form>
</div>

</div>
