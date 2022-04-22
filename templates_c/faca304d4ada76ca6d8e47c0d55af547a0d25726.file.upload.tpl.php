<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:47
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/upload/views/upload.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1887287057519f1c4f0a9944-14680890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'faca304d4ada76ca6d8e47c0d55af547a0d25726' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/upload/views/upload.tpl',
      1 => 1369380355,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1887287057519f1c4f0a9944-14680890',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('errorUpload')->value){?>
<ul>
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errorUpload')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
<form action="" method="post" enctype="multipart/form-data">
	<p>
		<label for="newDoc">Ajouter un fichier : <input type="file"
			name="newDoc" id="newDoc" /> </label> <input type="submit"
			value="Envoyer" id="sendDocForMandate" name="sendDocForMandate" />
	</p>
</form>
<table class="standard">
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
				target="_blank"><?php echo $_smarty_tpl->getVariable('upl')->value->getName();?>
 (<?php echo $_smarty_tpl->getVariable('upl')->value->getSize();?>
)</a></td>
			<td>
				<form action="" method="post">
					<input type="hidden" name="idDoc" value="<?php echo $_smarty_tpl->getVariable('upl')->value->getIdUpload();?>
" /><input
						type="submit" name="delDocument" value="Supprimer" />
				</form>
			</td>

		</tr>
		<?php }} ?>
	</tbody>
</table>




