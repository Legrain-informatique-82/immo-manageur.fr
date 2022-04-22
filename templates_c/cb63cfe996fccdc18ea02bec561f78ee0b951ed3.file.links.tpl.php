<?php /* Smarty version Smarty-3.0.6, created on 2014-09-03 09:25:48
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/documents/views/links.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20672691285406c27c545b36-00423002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb63cfe996fccdc18ea02bec561f78ee0b951ed3' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/documents/views/links.tpl',
      1 => 1409729146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20672691285406c27c545b36-00423002',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_counter')) include '/var/www/aptana/immo-manageur.fr/libs/smarty/plugins/function.counter.php';
?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Affiches</div>
            <div class="panel-body">
                <ul>
                    <li><a target="_blank"
                           href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','afficheMandat',$_GET['action']);?>
">Affiche classique</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>




<div class="col-md-6">



    <div class="panel panel-default">

        <div class="panel-heading">Documents mandat</div>
        <div class="panel-body">

            <ul>
                <li><a target="_blank"
                       href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','fiche_photo',$_GET['action']);?>
">Fiche photo</a></li>
                <li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','fiche_acq',$_GET['action']);?>
">Fiche acquereur</a></li>


            </ul>
        </div>
    </div>

</div>

</div>
<div class="row">

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
                </div></div>
                <?php if ($_smarty_tpl->getVariable('count')->value%2!==0){?>
                    </div>
                    <div class="row">
                <?php }?>
            <?php }?>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $_smarty_tpl->getVariable('cat')->value;?>
</div>
            <div class="panel-body">
            <ul>
    <?php }?>
    <li><a target="_blank" href="<?php echo Tools::create_url_whith_other_parameters($_smarty_tpl->getVariable('user')->value,'documents','printDoc',$_smarty_tpl->getVariable('d')->value->getIdDocuments(),$_smarty_tpl->getVariable('arrayParametersLinks')->value);?>
"> <?php echo $_smarty_tpl->getVariable('d')->value->getName();?>
</a></li>
<?php }} ?>
        </ul>
        </div></div></div>

</div>