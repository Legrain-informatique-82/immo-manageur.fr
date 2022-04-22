<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 09:39:12
         compiled from "/var/www/aptana/immo-manageur.fr/modules/terrain/modules/action/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1951494897541fd2209ed4f4-80513884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '514af0c1033a8b6f91039e69cd953880c6d682d3' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/terrain/modules/action/views/list.tpl',
      1 => 1411370670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1951494897541fd2209ed4f4-80513884',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('listActions')->value){?>


        <table class="dataTablewithoutSearch dataTable  table table-striped table-bordered table-condensed table-responsive">
            <thead>
            <tr>
                <th>Du</th> 
                <th>Pour</th>
                <th>Libellé de la tâche</th>
                <th>Détail</th>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listActions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
                <tr>
                    <td data-order="<?php echo $_smarty_tpl->getVariable('i')->value->getInitDate();?>
"><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('i')->value->getInitDate());?>
</td> 
                    <td><?php echo $_smarty_tpl->getVariable('i')->value->getTo()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getTo()->getName();?>
</td>
                    <td><?php echo $_smarty_tpl->getVariable('i')->value->getLibel();?>
</td>
                    <td><a class="btn  btn-default btn-xs" title="<?php echo Lang::LABEL_SEE;?>
"
                           href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','see',$_smarty_tpl->getVariable('i')->value->getIdAction());?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><i class="fa fa-chevron-circle-right"></i> <?php echo Lang::LABEL_SEE;?>
</a>

                    </td>
                </tr>
            <?php }} ?>
            </tbody>
        </table>

<?php }else{ ?>
    <p>Actuellement, aucune action sur ce mandat.</p>
<?php }?>
