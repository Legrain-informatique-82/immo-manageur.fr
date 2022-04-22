<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 10:33:51
         compiled from "/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/chooseMandate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14745072895421306fc79604-02658318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'babcbf55c13e7f2afc0440a6741940874b4eeb6d' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/rapprochement/views/chooseMandate.tpl',
      1 => 1411461230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14745072895421306fc79604-02658318',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<div class="row bg-success bannerTitle">
    <div class="col-md-7">
        <h1 class="h2">Rapprocher des mandats pour : <?php echo $_smarty_tpl->getVariable('acq')->value->getFirstname();?>
 <?php echo $_smarty_tpl->getVariable('acq')->value->getName();?>
</h1>
    </div>

    <div class="col-md-5">
        <p class="h4 text-right ">
            <a title="Ajouter un rapprochement" class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,"rapprochement","list");?>
">
                <i class="fa fa-close fa-2x"></i>
            </a>
        </p>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Critères</div>
    <div class="panel-body">




        <p>Type de transaction : <?php echo $_smarty_tpl->getVariable('acq')->value->getTransactionType()->getName();?>
</p>
        <p>Type de bien : <?php if ($_smarty_tpl->getVariable('acq')->value->getMandateType()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getMandateType()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
        <p>Style : <?php if ($_smarty_tpl->getVariable('acq')->value->getMandateStyle()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getMandateStyle()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
        <p>Prix compris entre <?php echo $_smarty_tpl->getVariable('acq')->value->getPriceMin();?>
 et <?php echo $_smarty_tpl->getVariable('acq')->value->getPriceMax();?>
 €.</p>
        <p>Surface de terrain entre <?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceTerrainMin();?>
 et
            <?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceTerrainMax();?>
 m²</p>
        <p>Surface habitable entre <?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceHabitableMin();?>
 et
            <?php echo $_smarty_tpl->getVariable('acq')->value->getSurfaceHabitableMax();?>
 m²</p>
        <p>Secteur souhaité : <?php if ($_smarty_tpl->getVariable('acq')->value->getRechercheSector()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getRechercheSector()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
        <p>Ville souhaitée : <?php if ($_smarty_tpl->getVariable('acq')->value->getRechercheCity()){?><?php echo $_smarty_tpl->getVariable('acq')->value->getRechercheCity()->getName();?>
<?php }else{ ?>Indifferent<?php }?></p>
    </div>
</div>
<form action="" method="post" class="form-horizontal">

    <div class="row bg-success bannerTitle">
        <div class="col-md-7">
            <h1 id="h2Change" class="h2"><?php echo $_smarty_tpl->getVariable('h2')->value;?>
</h1>
        </div>

        <div class="col-md-5">
            <div class="h4 text-right ">
                <div class="form-group checkbox">
                    <label for="allMandat" class="checkbox">
                        <input
                                type="checkbox" rel="<?php echo $_smarty_tpl->getVariable('acq')->value->getIdAcquereur();?>
" name="allMandat"
                                <?php if ($_smarty_tpl->getVariable('allMandat')->value=='on'){?>  checked="checked" <?php }?>  id="allMandat" />
                        Afficher tous les mandats
                    </label>
                    <input class="jsNone" type="submit" value="Ok" />
                </div>
            </div>
        </div>
    </div>



    <div id="contentMandates">
        <table class="dataTableDefault table table-striped table-bordered">
            <thead>
            <tr class="tri">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th class="jshide"></th>
                <th class="jshide"></th>
            </tr>
            <tr>
                <th>Prix fai</th>
                <th>Numéro du mandat</th>
                <th>Type de bien</th>
                <th>Type de transaction</th>
                <th>Style du bien</th>
                <th>Surface terrain</th>
                <th>Surface habitable</th>
                <th>Code postal</th>
                <th>ville</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php  $_smarty_tpl->tpl_vars['mandate'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listMandats')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['mandate']->key => $_smarty_tpl->tpl_vars['mandate']->value){
?>
                <?php if (BddRapprochement::relMandateAcquereurExist($_smarty_tpl->getVariable('pdo')->value,$_smarty_tpl->tpl_vars['mandate']->value,$_smarty_tpl->getVariable('acq')->value)){?>
                    <?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(1, null, null);?> <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['rapproche'] = new Smarty_variable(0, null, null);?>
                <?php }?> <?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?> <?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('terrain', null, null);?>
            <?php }else{ ?> <?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('mandat', null, null);?> <?php }?>


                <tr>
                    <td data-order="<?php echo $_smarty_tpl->getVariable('mandate')->value->getPriceFai();?>
" class="gras<?php if (($_smarty_tpl->getVariable('mandate')->value->getPriceFai()>=$_smarty_tpl->getVariable('acq')->value->getPriceMax()||$_smarty_tpl->getVariable('mandate')->value->getPriceFai()<=$_smarty_tpl->getVariable('acq')->value->getPriceMin())&&$_smarty_tpl->getVariable('acq')->value->getPriceMax()!=0){?> red<?php }?>">
                        <?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('mandate')->value->getPriceFai(),0));?>
 €
                    </td>
                    <td class="gras"><?php echo $_smarty_tpl->getVariable('mandate')->value->getNumberMandate();?>
</td>

                    <td class="gras
					<?php if ($_smarty_tpl->getVariable('acq')->value->getMandateType()){?>
					<?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateType()->getIdMandateType()!=$_smarty_tpl->getVariable('acq')->value->getMandateType()->getIdMandateType()){?> red<?php }?><?php }?>">

                        <?php echo $_smarty_tpl->getVariable('mandate')->value->getMandateType()->getName();?>

                    </td>
                    <td 	<?php if ($_smarty_tpl->getVariable('acq')->value->getMandateType()){?><?php if ($_smarty_tpl->getVariable('mandate')->value->getMandateType()->getIdMandateType()!=$_smarty_tpl->getVariable('acq')->value->getMandateType()->getIdMandateType()){?> class="red"<?php }?><?php }?>><?php echo $_smarty_tpl->getVariable('mandate')->value->getTransactionType()->getName();?>
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

                    <td><?php if ($_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()){?>
                        <a class="fancybox" href="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_smarty_tpl->getVariable('module')->value;?>
/big/<?php echo $_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()->getName();?>
">
                            <img src="<?php echo Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY;?>
/<?php echo $_smarty_tpl->getVariable('module')->value;?>
/thumb/<?php echo $_smarty_tpl->getVariable('mandate')->value->getPictureByDefault()->getName();?>
" alt="" class="img-thumbnail"/> <?php }else{ ?> NC <?php }?>
                        </a>
                    </td>
                    <td>


                        <div class="btn-group">

                            <?php if (!$_smarty_tpl->getVariable('rapproche')->value){?>
                                <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','add_rapprochement_chooseM',$_GET['action'],array($_smarty_tpl->getVariable('mandate')->value->getIdMandate()));?>
" title="Rapprocher">
                                    <i class="fa fa-crosshairs"></i> Rapprocher
                                </a>
                            <?php }else{ ?>
                                <a class="btn btn-default" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'rapprochement','seeByChooseM',BddRapprochement::loadByMandateAndAcquereur($_smarty_tpl->getVariable('pdo')->value,$_smarty_tpl->tpl_vars['mandate']->value,$_smarty_tpl->getVariable('acq')->value)->getIdRapprochement(),array($_smarty_tpl->getVariable('acq')->value->getIdAcquereur()));?>
" title="Fiche rapprochement"><i class="fa fa-chevron-circle-right"></i> Fiche rapprochement</a>
                            <?php }?>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('module')->value,'see',$_smarty_tpl->getVariable('mandate')->value->getIdMandate());?>
" title="Voir"><i class="fa fa-chevron-circle-right"></i> Voir la fiche du bien </a></li>
                            </ul>

                        </div>




                    </td>

                </tr>
            <?php }} ?>
            </tbody>
        </table>


    </div>
</form>
</div>
