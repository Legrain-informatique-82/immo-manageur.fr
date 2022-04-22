<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 10:01:55
         compiled from "/var/www/aptana/extra-immo/modules/export_site/views/cms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187849388551666df3945727-54448757%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da382a1029642a9b8a9616dad0d4cc191ca95cdf' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export_site/views/cms.tpl',
      1 => 1327917325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187849388551666df3945727-54448757',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div id="blocMandate" class="bulle">
	<?php if ($_smarty_tpl->getVariable('error')->value){?>
	<ul class="contError">
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
		<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li>
	<?php }} ?>
	</ul>
	<?php }?>
	<h1><?php echo $_smarty_tpl->getVariable('cms')->value->getPrivateName();?>
</h1>

	<form action="" method="post" enctype="multipart/form-data">
	
			
	
		<p><label for="publicName">Titre du menu  :</label> <input type="text"
			name="publicName" id="publicName" value="<?php echo $_smarty_tpl->getVariable('cms')->value->getPublicName();?>
" />
		</p>
		
				
					<p><label for="title">Titre de la page  :</label> <input type="text"
			name="title" id="title" value="<?php echo $_smarty_tpl->getVariable('cms')->value->getTitle();?>
" />
		</p>
		
				<p><label for="url">Url de la page  :</label> <input type="text"
			name="url" id="url" value="<?php echo $_smarty_tpl->getVariable('cms')->value->getUrl();?>
" /></p>
		<p><label for="description">Description : </label><textarea name="description" id="description" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('cms')->value->getDescription();?>
</textarea></p>
		<p><label for="content">Texte :</label></p>
		<p class="clear"><textarea class="editor" name="content" id="content" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('cms')->value->getContent();?>
</textarea></p>
		
		<p><input type="submit" name="send" value="Valider" /></p>
	</form>
</div>
</div>
