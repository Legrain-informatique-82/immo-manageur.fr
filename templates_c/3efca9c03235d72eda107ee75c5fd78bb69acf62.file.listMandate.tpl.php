<?php /* Smarty version Smarty-3.0.6, created on 2014-09-11 15:20:39
         compiled from "/var/www/aptana/immo-manageur.fr/modules/acquereur/modules/rapprochement/views/listMandate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13717093065411a1a765dd46-94132466%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3efca9c03235d72eda107ee75c5fd78bb69acf62' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/acquereur/modules/rapprochement/views/listMandate.tpl',
      1 => 1410441637,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13717093065411a1a765dd46-94132466',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>



	<table class="dataTableDefault2 table table-striped table-bordered table-condensed">
		<thead>
        <tr class="tri">
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>


            <th class="jshide"></th>
        </tr>
			<tr>

                <th>image</th>
				<th>Prix fai</th>
				<th>Numéro du mandat</th>
				<th>Type de bien</th>
				<th>Type de transaction</th>
				<th>Style du bien</th>
				<th>Surface terrain</th>
				<th>Surface habitable</th>
                <th>Code postal</th>
				<th>ville</th>


				<th>Actions</th>


			</tr>
		</thead>

		<tbody>
			<?php  $_smarty_tpl->tpl_vars['mandate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandate')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['mandate']->key => $_smarty_tpl->tpl_vars['mandate']->value){
?> <?php if (BddRapprochement::relMandateAcquereurExist($_smarty_tpl->getVariable('pdo')->value,$_smarty_tpl->tpl_vars['mandate']->value,$_smarty_tpl->getVariable('acq')->value)){?>
			<?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(1, null, null);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(0, null, null);?>
			<?php }?> <?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?> <?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('terrain', null, null);?> <?php }else{ ?>
			<?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('mandat', null, null);?> <?php }?>


			<tr>
                <td><?php if ($_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()){?>
                    <a href="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_smarty_tpl->getVariable('module')->value;?>
/big/<?php echo $_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()->getName();?>
" class="fancybox">
                        <img class="img-thumbnail" src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_smarty_tpl->getVariable('module')->value;?>
/thumb/<?php echo $_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()->getName();?>
" alt="" />
                        </a><?php }?>
                </td>
				<td data-order="<?php echo $_smarty_tpl->getVariable('mandate')->value->getPriceFai();?>
"
					class="gras<?php if (($_smarty_tpl->getVariable('mandate')->value->getPriceFai()>=$_smarty_tpl->getVariable('acq')->value->getPriceMax()||$_smarty_tpl->getVariable('mandate')->value->getPriceFai()<=$_smarty_tpl->getVariable('acq')->value->getPriceMin())&&$_smarty_tpl->getVariable('acq')->value->getPriceMax()!=0){?> red<?php }?>">
					<?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceFai(),0));?>
 €</td>
				<td class="gras"><?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</td>
				<td class="gras<?php if ($_smarty_tpl->getVariable('acq')->value->getMandateType()){?><?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateType()->getIdMandateType()!=$_smarty_tpl->getVariable('acq')->value->getMandateType()->getIdMandateType()){?> red<?php }?><?php }?>">
					<?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateType()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getMandateType()->getName();?>
<?php }else{ ?>Indifferent<?php }?></td>
					
				<td <?php if ($_smarty_tpl->getVariable('mandate')->value->getTransactionType()->getId()!=$_smarty_tpl->getVariable('acq')->value->getTransactionType()->getId()){?>
					class="red"<?php }?>><?php echo $_smarty_tpl->getVariable('mandate')->value->getTransactionType()->getName();?>
</td>
					
				<td><?php if ($_smarty_tpl->getVariable('mandate')->value->getStyle()&&$_smarty_tpl->getVariable('acq')->value->getMandateStyle()){?> <?php if ($_smarty_tpl->getVariable('mandate')->value->getStyle()->getIdMandateStyle()!=$_smarty_tpl->getVariable('acq')->value->getMandateStyle()->getIdMandateStyle()){?> class="red" <?php }?>>
					<?php echo $_smarty_tpl->getVariable('mandate')->value->getStyle()->getName();?>
 <?php }else{ ?> <?php if ($_smarty_tpl->getVariable('mandate')->value->getStyle()){?><?php echo $_smarty_tpl->getVariable('mandate')->value->getStyle()->getName();?>
<?php }else{ ?>NC<?php }?>
					<?php }?></td>
				<td><?php echo $_smarty_tpl->getVariable('mandate')->value->getSuperficieTotale();?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('mandate')->value->getSurfaceHabitable();?>
</td>
                <td><?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getZipCode();?>
</td>
				<td><?php echo $_smarty_tpl->getVariable('mandate')->value->getCity()->getName();?>
</td>


				
				<td>

                    <div class="btn-group">


                        <?php if (!$_smarty_tpl->getVariable('rapproche')->value){?>
                            <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','add_rapprochement_acq',$_GET['action'],array($_smarty_tpl->getVariable('mandate')->value->getIdMandate()));?>
" title="Rapprocher">
                                <i class="fa fa-crosshairs"></i> Rapprocher
                            </a>
                        <?php }else{ ?>
                            <a class="btn btn-default" title="Voir la fiche rapprochement" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','seeByAcq',BddRapprochement::loadByMandateAndAcquereur($_smarty_tpl->getVariable('pdo')->value,$_smarty_tpl->tpl_vars['mandate']->value,$_smarty_tpl->getVariable('acq')->value)->getIdRapprochement(),array($_smarty_tpl->getVariable('acq')->value->getIdAcquereur()));?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>>
                                <i class="fa fa-chevron-circle-right"></i> Fiche rapp.</a>

                        <?php }?>


                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('module')->value,'see',$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
" title="Voir" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><i class="fa fa-chevron-circle-right"></i> Voir la fiche du bien</a>
                            </li>
                        </ul>

                    </div>

                   </td>

			</tr>
			<?php }} ?>
		</tbody>
	</table>


