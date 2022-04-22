<?php /* Smarty version Smarty-3.0.6, created on 2014-09-11 14:46:40
         compiled from "/var/www/aptana/immo-manageur.fr/modules/user/views/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1452986644541199b0ea91d2-27964544%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92bd1548391c7d5cfaeaa18694b01d091b2873c7' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/user/views/list.tpl',
      1 => 1410439599,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1452986644541199b0ea91d2-27964544',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>


<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> Liste des utilisateurs</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un utilisateur" class="btn btn-success" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"user","add");?>
"> <i class="fa fa-plus-circle fa-2x"></i></a>
        </p>
    </div>
</div>



	<table class="dataTableDefault table table-striped table-bordered">
		<thead>
        <tr class="tri">
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th></th>
            <th></th>
            <th class="jshide"></th>
        </tr>
			<tr>
				<th>Identifiant</th>
				<th>Nom &amp; prénom</th>
				<th>Agence</th>
				<th>Niveau de membre</th>

				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listUsers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value){
?>
			<tr>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['identifiant'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['agency'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['u']->value['levelMember'];?>
</td>

				<td>

                    <div class="btn-group">

                        <a class="btn  btn-default" href="<?php echo $_smarty_tpl->tpl_vars['u']->value['urlSee'];?>
" title="<?php echo Lang::LABEL_SEE;?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><i class="fa fa-chevron-circle-right"></i> <?php echo Lang::LABEL_SEE;?>
 </a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->tpl_vars['u']->value['idUser']){?>
                        <ul class="dropdown-menu" role="menu">

                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['u']->value['urlUpdate'];?>
" title="<?php echo Lang::LABEL_UPDATE;?>
"><i class="fa fa-pencil-square-o"></i> <?php echo Lang::LABEL_UPDATE;?>
</a></li>

                            <?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()==1&&$_smarty_tpl->getVariable('user')->value->getIdUser()!=$_smarty_tpl->tpl_vars['u']->value['idUser']){?>
                            <li><a class="jsdelUser" rel="<?php echo $_smarty_tpl->tpl_vars['u']->value['idUser'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['u']->value['urlDelete'];?>
" title="<?php echo Lang::LABEL_DELETE;?>
"><i class="fa fa-trash"></i> <?php echo Lang::LABEL_DELETE;?>
</a></li>
                            <?php }?>
                        </ul>
                        <?php }?>
                    </div>


                </td>
			</tr>
			<?php }} ?>
		</tbody>
	</table>


</div>

