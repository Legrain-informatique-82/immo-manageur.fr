<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:35
         compiled from "/var/www/aptana/extra-immo/modules/accueil/modules/01action/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1661900185519f1c438da586-79485581%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b04b8205119f5aaf051228566b7b60336b0cbe0' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/accueil/modules/01action/views/list.tpl',
      1 => 1369380397,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1661900185519f1c438da586-79485581',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="homeModTache">
<h1>Tâches :</h1>

<?php if ($_smarty_tpl->getVariable('listActions')->value){?>
<div id="contAct">
	<hr class="separator" />
	
	<table id="actAccueil">
		<thead>
			<tr>
				<th>Du</th> 
				<th>De</th>
				<th>Pour</th>
				<th>Libellé</th>
				<th>Numéro de mandat lié</th>
				<th>Voir</th>
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
				<td><a
					href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'action','see',$_smarty_tpl->getVariable('i')->value->getIdAction());?>
"  title="<?php echo Lang::LABEL_SEE;?>
"><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
				</td>
			</tr>
			<?php }} ?>

		</tbody>
	</table>
	<div class="bulle">
	<h2>Détail de la tâche sélectionnée</h2>
	<p id="textTacheSelected" >Afficher le détail d'une tâche en sélectionnant la ligne.</p>
	</div>
	<hr class="clear invi">
</div>
<?php }else{ ?>
<div id="contAct">
<p id="textTacheSelected">Aucune tâche.</p>
</div>
<?php }?>
</div>