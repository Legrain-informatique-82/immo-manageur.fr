<?php /* Smarty version Smarty-3.0.6, created on 2014-09-22 16:38:17
         compiled from "/var/www/aptana/immo-manageur.fr/modules/accueil/modules/01action/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:430429621542034594532d8-85699607%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b84e193bb2461b50368c47d977ede9b385e1589' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/accueil/modules/01action/views/list.tpl',
      1 => 1411396696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '430429621542034594532d8-85699607',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Mes tâches</h3>
    </div>
    <div class="panel-body">

        <?php if ($_smarty_tpl->getVariable('listActions')->value){?>
            <div class="row">
                <div class="col-md-6">
                    <table id="actAccueil" class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>Du</th> 
                            <th>De</th>
                            <th>Pour</th>
                            <th>Libellé</th>
                            <th>Numéro de mandat lié</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listActions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>

                            <tr rel="<?php echo $_smarty_tpl->getVariable('i')->value->getId();?>
">
                                <td><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('i')->value->getInitDate());?>
</td> 
                                <td><?php echo $_smarty_tpl->getVariable('i')->value->getFrom()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getFrom()->getName();?>
</td>
                                <td><?php echo $_smarty_tpl->getVariable('i')->value->getTo()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('i')->value->getTo()->getName();?>
</td>
                                <td><?php echo $_smarty_tpl->getVariable('i')->value->getLibel();?>
</td>
                                <td><?php if ($_smarty_tpl->getVariable('i')->value->getMandate()){?><?php echo $_smarty_tpl->getVariable('i')->value->getMandate()->getNumberMandate();?>
<?php }else{ ?>Aucun<?php }?></td>
                                <td><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','see',$_smarty_tpl->getVariable('i')->value->getIdAction());?>
"  title="<?php echo Lang::LABEL_SEE;?>
" class="btn btn-default btn-xs"> <i class="fa fa-chevron-circle-right"></i> <?php echo Lang::LABEL_SEE;?>
</a>
                                </td>
                            </tr>
                        <?php }} ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="well">
                        <h2>Détail de la tâche sélectionnée</h2>
                        <p id="textTacheSelected" >Afficher le détail d'une tâche en sélectionnant la ligne.</p>
                    </div>
                </div>
            </div>
        <?php }else{ ?>

            <p id="textTacheSelected">Aucune tâche.</p>

        <?php }?>
    </div>
</div>
