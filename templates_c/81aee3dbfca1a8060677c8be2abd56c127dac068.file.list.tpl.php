<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 09:23:55
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/action/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:222644775541fce8b05cd21-12639336%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81aee3dbfca1a8060677c8be2abd56c127dac068' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/action/views/list.tpl',
      1 => 1411370621,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '222644775541fce8b05cd21-12639336',
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
