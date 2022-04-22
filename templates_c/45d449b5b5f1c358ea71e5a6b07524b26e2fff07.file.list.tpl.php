<?php /* Smarty version Smarty-3.0.6, created on 2013-07-23 11:38:37
         compiled from "/var/www/aptana/extra-immo/modules/action/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124889319451ee4f1d78ba00-97952333%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45d449b5b5f1c358ea71e5a6b07524b26e2fff07' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/action/views/list.tpl',
      1 => 1369380329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124889319451ee4f1d78ba00-97952333',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<h1><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
<table class="<?php if ($_smarty_tpl->getVariable('old')->value){?>triActionsBisOld<?php }else{ ?>triActionsBisBis<?php }?>">
	<thead>
		<tr>
			<?php if ($_smarty_tpl->getVariable('old')->value){?>
			<th>Fait le</th><?php }?>
			<th>Du</th>
			<!--<th>Au</th>-->
			<th>De</th>
			<th>Pour</th>
			<th>Libellé</th>
			<th>Numéro de mandat lié</th>
			
			<th>Supprimer</th>
			<th>Voir</th>
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
			<td><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('i')->value->getDoDate());?>
</td><?php }?>
			<td><?php echo date(Constant::DATE_FORMAT2,$_smarty_tpl->getVariable('i')->value->getInitDate());?>
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




			<td> <?php if ($_smarty_tpl->getVariable('i')->value->getFrom()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?> <?php if ($_GET['page']=='list'){?> <?php $_smarty_tpl->tpl_vars["redirect"] = new Smarty_variable("del", null, null);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars["redirect"] = new Smarty_variable("delO", null, null);?> <?php }?> <a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],$_smarty_tpl->getVariable('redirect')->value,$_smarty_tpl->getVariable('i')->value->getIdAction());?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
delete.png" alt="<?php echo Lang::LABEL_DELETE;?>
" /></a>
				<?php }else{ ?> - <?php }?></td>

			<td><a
				href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'see',$_smarty_tpl->getVariable('i')->value->getIdAction());?>
" title="<?php echo Lang::LABEL_SEE;?>
"  <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
			</td>
		</tr>
		<?php }} ?>

	</tbody>
</table>
</div>
