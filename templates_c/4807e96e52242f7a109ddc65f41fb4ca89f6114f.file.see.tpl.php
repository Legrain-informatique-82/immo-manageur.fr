<?php /* Smarty version Smarty-3.0.6, created on 2013-04-12 12:04:55
         compiled from "/var/www/aptana/extra-immo/modules/action/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3881863295167dc47260344-41314733%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4807e96e52242f7a109ddc65f41fb4ca89f6114f' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/action/views/see.tpl',
      1 => 1323155944,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3881863295167dc47260344-41314733',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<h1>Voir la tâche</h1>
<div class="bulle">
<?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('action')->value->getFrom()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser())&&!$_smarty_tpl->getVariable('action')->value->getDoDate()){?>
<p>
	<a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'update',$_GET['action']);?>
">Modifier
		l'action.</a>
</p>
<?php }?>
<p>De la part de : <?php echo $_smarty_tpl->getVariable('action')->value->getFrom()->getFirstname();?>

	<?php echo $_smarty_tpl->getVariable('action')->value->getFrom()->getName();?>
</p>
<p>Pour : <?php echo $_smarty_tpl->getVariable('action')->value->getTo()->getFirstname();?>

	<?php echo $_smarty_tpl->getVariable('action')->value->getTo()->getName();?>
</p>
<p>Date de début de l'action :
	<?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('action')->value->getInitDate());?>
</p>
<p>Date de fin de l'action : <?php if ($_smarty_tpl->getVariable('action')->value->getDeadDate()){?><?php echo date(Constant::DATE_FORMAT,$_smarty_tpl->getVariable('action')->value->getDeadDate());?>
<?php }else{ ?>NC<?php }?></p>
<p>Libellé : <?php echo $_smarty_tpl->getVariable('action')->value->getLibel();?>
</p>
<?php if ($_smarty_tpl->getVariable('action')->value->getMandate()){?>
			
			<?php if ($_smarty_tpl->getVariable('action')->value->getMandate()->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>
		 	<?php $_smarty_tpl->tpl_vars["module"] = new Smarty_variable('terrain', null, null);?>
		 <?php }else{ ?>
		 	<?php $_smarty_tpl->tpl_vars["module"] = new Smarty_variable('mandat', null, null);?>
		 <?php }?>
<p>
	Attribué au mandat : <a
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('module')->value,'see',$_smarty_tpl->getVariable('action')->value->getMandate()->getIdMandate());?>
">Numéro
		mandat : <?php echo $_smarty_tpl->getVariable('action')->value->getMandate()->getNumberMandate();?>
</a>
</p>
<?php }?> <?php if ($_smarty_tpl->getVariable('action')->value->getComment()){?>
<p>Detail : <?php echo $_smarty_tpl->getVariable('action')->value->getComment();?>
</p>
<?php }?> <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('action')->value->getTo()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('action')->value->getFrom()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser())&&!$_smarty_tpl->getVariable('action')->value->getDoDate()){?>
<form action="" method="post">
	<p>
		<label for=comment">Commentaire : <textarea name="comment"
				id="comment" cols="30" rows="10"><?php echo $_POST['comment'];?>
</textarea> </label>
	</p>
	<p>
		<input type="submit" name="cancel" value="Annuler" /> <input
			type="submit" name="valid" value="Action traitée" />
	</p>

</form>
<?php }else{ ?>
<form action="" method="post">
	<p>
		<input type="submit" name="cancel" value="Fermer" />
	</p>
</form>
<?php }?>

</div>
</div>