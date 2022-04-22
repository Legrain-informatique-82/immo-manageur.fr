<?php /* Smarty version Smarty-3.0.6, created on 2014-07-09 09:52:24
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/updDocument.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45116123953bcf4b8ce9d01-45631733%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2674a8120b8f89bdc233f29ad4f2120a242a692' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/updDocument.tpl',
      1 => 1369380600,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45116123953bcf4b8ce9d01-45631733',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Modifier le document</h1>
<form action="" method="post">
<p><label for="corps">Corps</label><textarea name="corps" id="corps" cols="30" rows="30"><?php echo $_smarty_tpl->getVariable('corps')->value;?>
</textarea></p>
<p><label for="other">Signature</label><textarea name="other" id="other" cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('signature')->value;?>
</textarea></p>
<p><input type="submit" value="Modifier" name="send"/> <input type="submit" value="Annuler" name="cancel"/></p>
</form>
</div>