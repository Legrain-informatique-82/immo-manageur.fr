<?php /* Smarty version Smarty-3.0.6, created on 2014-07-17 16:12:22
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/modules/01documents/views/links.tpl" */ ?>
<?php /*%%SmartyHeaderCode:101126546853c7d9c6c908e0-55724479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcc80f862fab76ebbf1bf3bceb675594a58b07f3' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/modules/01documents/views/links.tpl',
      1 => 1405605962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101126546853c7d9c6c908e0-55724479',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_counter')) include '/var/www/aptana/immo-manageur.fr/libs/smarty/plugins/function.counter.php';
?>

<div class="mSep">
    <h3>Affiches</h3>
    <ul>
        <li><a target="_blank"
               href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','afficheMandat',$_GET['action']);?>
">Affiche
                classique</a>
        </li>
    </ul>
</div>
<div class="mSep">
    <h3>Documents mandat</h3>
    <ul>
        <li><a target="_blank"
               href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','fiche_photo',$_GET['action']);?>
">Fiche photo</a></li>
        <li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','fiche_acq',$_GET['action']);?>
">Fiche acquereur</a></li>


    </ul>
</div>
<?php $_smarty_tpl->tpl_vars['cat'] = new Smarty_variable('CeciNestPasUneCategorie', null, null);?>
<?php echo smarty_function_counter(array('start'=>0,'print'=>false,'assign'=>'count'),$_smarty_tpl);?>


<?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('newDocs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['d']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value){
 $_smarty_tpl->tpl_vars['d']->index++;
 $_smarty_tpl->tpl_vars['d']->first = $_smarty_tpl->tpl_vars['d']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["listCat"]['first'] = $_smarty_tpl->tpl_vars['d']->first;
?>
<?php if ($_smarty_tpl->getVariable('cat')->value!=$_smarty_tpl->getVariable('d')->value->getCategoryDocument()->getName()){?>
<?php $_smarty_tpl->tpl_vars['cat'] = new Smarty_variable($_smarty_tpl->getVariable('d')->value->getCategoryDocument()->getName(), null, null);?>
<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['listCat']['first']){?>
    </ul>
    </div>
    <?php if ($_smarty_tpl->getVariable('count')->value%2!==0){?>
        <hr class="clear invi" />
    <?php }?>
<?php }?>
<div class="mSep">
    <h3><?php echo $_smarty_tpl->getVariable('cat')->value;?>
</h3>
    <ul>
        <?php }?>
        <li><a target="_blank" href="<?php echo Tools::create_url_whith_other_parameters($_smarty_tpl->getVariable('user')->value,'documents','printDoc',$_smarty_tpl->getVariable('d')->value->getIdDocuments(),$_smarty_tpl->getVariable('arrayParametersLinks')->value);?>
"> <?php echo $_smarty_tpl->getVariable('d')->value->getName();?>
</a></li>
        <?php }} ?>
    </ul>
</div>

<hr class="clear invi" />