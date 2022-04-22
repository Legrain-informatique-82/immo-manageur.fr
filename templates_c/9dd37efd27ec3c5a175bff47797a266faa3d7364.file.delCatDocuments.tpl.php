<?php /* Smarty version Smarty-3.0.6, created on 2014-07-09 16:25:08
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/delCatDocuments.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127717249353bd50c4c2a0d9-88784402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9dd37efd27ec3c5a175bff47797a266faa3d7364' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/delCatDocuments.tpl',
      1 => 1404915907,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127717249353bd50c4c2a0d9-88784402',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
<?php $_template = new Smarty_Internal_Template("tpl_default/viewsErrors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<p>Êtes-vous certain de vouloir supprimer cette catégorie ? </p>
<form action="" method="post">



    <p>
        <input type="submit" value="Oui" name="delete"/>
        <input type="submit" value="Non" name="cancel"/>
    </p>

</form>
</div>
