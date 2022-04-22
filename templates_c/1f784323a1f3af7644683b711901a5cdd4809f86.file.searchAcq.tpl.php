<?php /* Smarty version Smarty-3.0.6, created on 2014-05-19 09:31:36
         compiled from "/var/www/aptana/immo-manageur.fr/modules/rechercheMulti/views/searchAcq.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7786625015379b358d8baa7-76726356%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f784323a1f3af7644683b711901a5cdd4809f86' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/rechercheMulti/views/searchAcq.tpl',
      1 => 1369380629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7786625015379b358d8baa7-76726356',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Recherche d'acquereurs</h1>


<form action="" method="post">




<?php if ($_POST){?>

<?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable;
 $_from = $_POST['critere']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['index']++;
?>
<?php if ($_smarty_tpl->tpl_vars['it']->value!=''){?>
	<p class="lineCritere bulle">
		<select name="critere[]" class="chooseCritereMandate">
			<option value="" class="empty">_____</option>
			 <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCritere')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
				<option value="<?php echo $_smarty_tpl->getVariable('i')->value->getChampsCorrespondant();?>
" <?php if ($_smarty_tpl->getVariable('i')->value->getChampsCorrespondant()==$_smarty_tpl->tpl_vars['it']->value){?>selected="selected"<?php }?> class="<?php if ($_smarty_tpl->getVariable('i')->value->getType()!='list'){?><?php echo $_smarty_tpl->getVariable('i')->value->getType();?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('i')->value->getNameTable();?>
<?php }?>"><?php echo $_smarty_tpl->getVariable('i')->value->getNom();?>
 </option>

			<?php }} ?>
		</select>
	
		<span class="complementWithJs">
		 <?php if ($_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='simple'){?>
			<span class="complementWithJs"><input type="text"  name="val1[]" value="<?php echo $_POST['val1'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/> <input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="<?php echo $_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/><input type="hidden" name="table[]" value=""/></span>
		<?php }elseif($_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='double'){?>
			<span class="complementWithJs"><input type="text"  name="val1[]" value="<?php echo $_POST['val1'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/> et <input type="text" name="val2[]" value="<?php echo $_POST['val2'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/><input type="hidden" name="type[]" value="<?php echo $_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/><input type="hidden" name="table[]" value=""/></span>
		<?php }elseif($_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='list'){?>
		<select name="val1[]" >
			<?php ob_start();?><?php echo $_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
<?php $_tmp1=ob_get_clean();?><?php  $_smarty_tpl->tpl_vars['elemList'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listElement')->value[$_tmp1]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['elemList']->key => $_smarty_tpl->tpl_vars['elemList']->value){
?>
			
			<option  <?php if ($_smarty_tpl->getVariable('elemList')->value->getId()==$_POST['val1'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]){?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('elemList')->value->getId();?>
">
			 <?php if ($_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='User'){?> <?php echo $_smarty_tpl->getVariable('elemList')->value->getFirstname();?>
<?php }?>
			 <?php if ($_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='City'){?> <?php echo $_smarty_tpl->getVariable('elemList')->value->getZipCode();?>
<?php }?>
			  <?php echo $_smarty_tpl->getVariable('elemList')->value->getName();?>
</option>
			<?php }} ?>
			</select>
<input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="list"/><input type="hidden" name="table[]" value="<?php echo $_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/>
		<?php }?>
		</span>
		<a href="#" class="delLineRecherche">Supprimer</a>
	</p>
	
	<?php }?>
<?php }} ?>


<?php }?>
<hr class="invi lineCritere"/>
	<p class="lineCritere bulle">
		<select name="critere[]" class="chooseCritereMandate">
			<option value="" class="empty">_____</option>
			 <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCritere')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>


				<option value="<?php echo $_smarty_tpl->getVariable('i')->value->getChampsCorrespondant();?>
" class="<?php if ($_smarty_tpl->getVariable('i')->value->getType()!='list'){?><?php echo $_smarty_tpl->getVariable('i')->value->getType();?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('i')->value->getNameTable();?>
<?php }?>"><?php echo $_smarty_tpl->getVariable('i')->value->getNom();?>
</option>


			<?php }} ?>
		</select>
		<span class="complementWithJs"></span>
		<a href="#" class="delLineRecherche">Supprimer</a>
	</p>


	<p><a href="#" id="addNewRecherchLine" class="Critere_acquereur">Ajouter une nouvelle ligne</a></p>
	<p><input type="submit" value="Rechercher" name="rechercher" /></p>
</form>
<?php if ($_POST){?>
<table class="standard">
		<thead>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>téléphones</th>
			<th>email</th>
			<th>Voir</th>
		</tr>
	</thead>
	<tbody>

	<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('resultatsRecherche')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
<tr>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getTitreAcquereur()->getName();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getName();?>

			</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?>
			</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</td>
		
			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','see',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>

			</td>
		</tr>
	
		
	<?php }} ?>
		</tbody>
</table>
<?php }?>
</div>

