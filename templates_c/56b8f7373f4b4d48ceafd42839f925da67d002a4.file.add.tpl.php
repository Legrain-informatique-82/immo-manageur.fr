<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 09:28:09
         compiled from "/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142661845754212109eb1233-02279540%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56b8f7373f4b4d48ceafd42839f925da67d002a4' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/add.tpl',
      1 => 1411457288,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142661845754212109eb1233-02279540',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">À partir de cet acquereur :</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Annuler et revenir à la liste" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"rapprochement","list");?>
">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<table class="dataTableDefault table table-striped table-bordered">
	<thead>
    <tr class="tri">
        <th class="jshide"></th>
        <th></th>
        <th></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
        <th class="jshide"></th>
    </tr>
		<tr>
			<th>Nom &amp; prénom</th>
			<th>Titre</th>
			<th>Opérateur lié</th>
			<th>téléphones</th>
			<th>email</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listAcq')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
		<tr>

			<td><?php echo $_smarty_tpl->getVariable('item')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getName();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getTitreAcquereur()->getName();?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('item')->value->getUser()->getName();?>

			</td>
			<td><?php if ($_smarty_tpl->getVariable('item')->value->getPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getMobilPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getMobilPhone();?>
</p><?php }?>
				<?php if ($_smarty_tpl->getVariable('item')->value->getWorkPhone()){?>
				<p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
<?php echo $_smarty_tpl->getVariable('item')->value->getWorkPhone();?>
</p><?php }?>
			</td>
			<td><?php echo $_smarty_tpl->getVariable('item')->value->getEmail();?>
</td>
			<td>

                <div class="btn-group">
                    <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','chooseMandate',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><i class="fa fa-check"></i> Utiliser </a>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'acquereur','see',$_smarty_tpl->getVariable('item')->value->getIdAcquereur());?>
"><i class="fa fa-chevron-circle-right"></i> Fiche de l'acquéreur</a></li>
                        <?php $_template = new Smarty_Internal_Template("tpl_default/menu_send_sms_mail.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('email',$_smarty_tpl->getVariable('item')->value->getEmail());$_template->assign('phonenumber',$_smarty_tpl->getVariable('item')->value->getMobilPhone); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
                    </ul>

                </div>
			</td>
		</tr>
		<?php }} ?>
	</tbody>
</table>
</div>
