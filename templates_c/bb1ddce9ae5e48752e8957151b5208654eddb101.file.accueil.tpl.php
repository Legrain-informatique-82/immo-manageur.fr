<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 10:03:30
         compiled from "/var/www/aptana/extra-immo/modules/export_site/views/accueil.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69070307951666e521d7136-53498991%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb1ddce9ae5e48752e8957151b5208654eddb101' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/export_site/views/accueil.tpl',
      1 => 1327669744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69070307951666e521d7136-53498991',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div id="blocMandate" class="bulle">
	<h1>Page d'accueil</h1>
	<form action="" method="post" enctype="multipart/form-data">
	
			
	
				
				
					<p><label for="titreAccueil">Titre  :</label> <input type="text"
			name="titreAccueil" id="titreAccueil" value="<?php echo $_smarty_tpl->getVariable('se')->value->getTitreAccueil();?>
" />
		</p>
		<p><label for="metaDescriptionAccueil">Description : </label><textarea name="metaDescriptionAccueil" id="metaDescriptionAccueil" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('se')->value->getMetaDescriptionAccueil();?>
</textarea></p>
		<p><label for="txtAccueil">Texte :</label></p>
		<p class="clear"><textarea class="editor" name="txtAccueil" id="txtAccueil" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('se')->value->getTxtIndex();?>
</textarea></p>
	
		<p><input type="submit" name="send" value="Valider" /></p>
	</form>
</div>
</div>
