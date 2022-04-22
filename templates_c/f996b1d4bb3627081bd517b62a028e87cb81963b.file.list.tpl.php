<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 10:26:16
         compiled from "/var/www/aptana/immo-manageur.fr/modules/action/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:242597968541be8a8cbfd77-24296257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f996b1d4bb3627081bd517b62a028e87cb81963b' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/action/views/list.tpl',
      1 => 1411115175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242597968541be8a8cbfd77-24296257',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right">
            <a class="btn btn-success" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','add');?>
" title="Ajouter une tâche">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <?php if ($_smarty_tpl->getVariable('old')->value){?>
        <th ></th>
        <?php }?>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>

        <th class="jshide"></th>
    </tr>
		<tr>
			<?php if ($_smarty_tpl->getVariable('old')->value){?>
			<th>Fait le</th>
            <?php }?>
			<th>Du</th>
			<!--<th>Au</th>-->
			<th>De</th>
			<th>Pour</th>
			<th>Libellé</th>
			<th>Numéro de mandat lié</th>
			

			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actions')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
		<tr>
			<?php if ($_smarty_tpl->getVariable('old')->value){?>
			<td data-order="<?php echo $_smarty_tpl->getVariable('i')->value->getDoDate();?>
"><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('i')->value->getDoDate());?>
</td>
            <?php }?>
			<td data-order="<?php echo $_smarty_tpl->getVariable('i')->value->getInitDate();?>
"><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('i')->value->getInitDate());?>
</td>
			<!--<td><?php if ($_smarty_tpl->getVariable('i')->value->getDeadDate()){?><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('i')->value->getDeadDate());?>
<?php }?></td>-->
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

			<td>


                <!-- Split button -->
                <div class="btn-group">
                    <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'see',$_smarty_tpl->getVariable('i')->value->getIdAction());?>
" class="btn btn-default"><i class="fa fa-chevron-circle-right"></i> <?php echo lang::LABEL_SEE;?>
</a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">

                        <?php if ($_smarty_tpl->getVariable('i')->value->getFrom()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
                            <?php if ($_GET['page']=='list'){?>
                                <?php $_smarty_tpl->tpl_vars["redirect"] = new Smarty_variable("del", null, null);?>
                            <?php }else{ ?>
                                <?php $_smarty_tpl->tpl_vars["redirect"] = new Smarty_variable("delO", null, null);?>
                            <?php }?>
                           <li> <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_smarty_tpl->getVariable('redirect')->value,$_smarty_tpl->getVariable('i')->value->getIdAction());?>
"">
                               <i class="fa fa-trash"></i> <?php echo Lang::LABEL_DELETE;?>

                            </a>
                           </li>
                        <?php }else{ ?>
                            <li class="disabled">
                                <a href="javascript:return false;"><i class="fa fa-trash"></i> <?php echo Lang::LABEL_DELETE;?>
</a>
                            </li>
                        <?php }?>


                    </ul>
                </div>





            </td>
		</tr>
		<?php }} ?>

	</tbody>
</table>
</div>
