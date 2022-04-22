<?php /* Smarty version Smarty-3.0.6, created on 2013-04-11 09:26:47
         compiled from "/var/www/aptana/extra-immo/modules/documents/views/updDocument.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1096231292516665b7f42135-38112057%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a97d1f25a31aab476df19374a9f3fe2859258774' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/documents/views/updDocument.tpl',
      1 => 1328712616,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1096231292516665b7f42135-38112057',
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