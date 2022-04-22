<?php /* Smarty version Smarty-3.0.6, created on 2014-09-23 14:39:38
         compiled from "/var/www/aptana/immo-manageur.fr/modules/export_site/views/generalite.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207141764054216a0ad45478-36921284%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e918cfe11267828f2b2cc30aff33b6b029a0f607' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/export_site/views/generalite.tpl',
      1 => 1411475976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207141764054216a0ad45478-36921284',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">Généralités</h1>
        </div>

        <div class="col-md-6">

            <p class="h4 text-right ">

                <button type="submit" name="send" value="Valider" class="btn btn-success" title="Sauvegarder">
                    <i class="fa-save fa fa-2x"></i>
                </button>


            </p>
        </div>
    </div>




    <div class="form-group">
        <label class="col-sm-2 control-label"  for="nomSite">Nom du site : </label>
        <div class="col-sm-8">
            <input type="text" name="nomSite" id="nomSite" value="<?php echo $_smarty_tpl->getVariable('se')->value->getNomSite();?>
" class="form-control"/>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label"  for="emailContact">Email de contact :</label>
        <div class="col-sm-8">
            <input type="text" name="emailContact" id="emailContact" value="<?php echo $_smarty_tpl->getVariable('se')->value->getEmailContact();?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="nameAgency">Nom de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="nameAgency" id="nameAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getNameAgency();?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="addressAgency">Adresse de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="addressAgency" id="addressAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getAddressAgency();?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="zipCodeAgency">Code postal de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="zipCodeAgency" id="zipCodeAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getZipCodeAgency();?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="cityAgency">Ville de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="cityAgency" id="cityAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getCityAgency();?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="phoneAgency">téléphone de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="phoneAgency" id="phoneAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getPhoneAgency();?>
" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="faxAgency">Fax de l'agence :</label>
        <div class="col-sm-8">
            <input type="text" name="faxAgency" id="faxAgency" value="<?php echo $_smarty_tpl->getVariable('se')->value->getFaxAgency();?>
" class="form-control" />
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label"  for="robots">Référençable : </label>
        <div class="col-sm-8">
            <select name="robots" id="robots" class="form-control">
                <option <?php if ($_smarty_tpl->getVariable('se')->value->getRobots()==0){?> selected="selected"<?php }?> value="0">Non</option>
                <option <?php if ($_smarty_tpl->getVariable('se')->value->getRobots()==1){?> selected="selected"<?php }?> value="1">Oui</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="theme">Thème : </label>
        <div class="col-sm-8">
            <select name="theme" id="theme" class="form-control">
                <?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('themes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
?>
                    <option <?php if ($_smarty_tpl->getVariable('it')->value->getId()==$_smarty_tpl->getVariable('se')->value->getTheme()->getId()){?> selected="selected" <?php }?> value="<?php echo $_smarty_tpl->getVariable('it')->value->getId();?>
"><?php echo $_smarty_tpl->getVariable('it')->value->getName();?>
</option>
                <?php }} ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="nbNouveauteParAgence">Nouveautés par agence :</label>
        <div class="col-sm-8">
            <select name="nbNouveauteParAgence" id="nbNouveauteParAgence" class="form-control">
                <option <?php if ($_smarty_tpl->getVariable('se')->value->getNbNouveauteParAgence()==2){?> selected="selected" <?php }?> value="2">2</option>
                <option <?php if ($_smarty_tpl->getVariable('se')->value->getNbNouveauteParAgence()==4){?> selected="selected" <?php }?> value="4">4</option>
                <option <?php if ($_smarty_tpl->getVariable('se')->value->getNbNouveauteParAgence()==6){?> selected="selected" <?php }?> value="6">6</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="nbAnnonceParPage">Annonces par page : </label>
        <div class="col-sm-8">
            <select name="nbAnnonceParPage" id="nbAnnonceParPage" class="form-control">

                <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['name'] = 'foo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] = is_array($_loop=101) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] = 1;
            $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'];
            $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total']);
?>
                    <option <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['foo']['index']==$_smarty_tpl->getVariable('se')->value->getNbAnnoncesParPage()){?> selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['foo']['index'];?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['foo']['index'];?>
</option>
                <?php endfor; endif; ?>
            </select>
        </div>
    </div>


    <?php if ($_smarty_tpl->getVariable('se')->value->getHeader()){?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/<?php echo $_GET['module'];?>
/images/<?php echo $_smarty_tpl->getVariable('se')->value->getHeader();?>
" alt="" class="img-thumbnail" />
            </div>
        </div>
    <?php }?>

    <div class="form-group">
        <label class="col-sm-2 control-label"  for="header">Entête (jpg) :</label>
        <div class="col-sm-8">
            <input type="file" name="header" id="header" />
        </div>
    </div>


    <?php if ($_smarty_tpl->getVariable('se')->value->getLogo()){?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <p ><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
modules/<?php echo $_GET['module'];?>
/images/<?php echo $_smarty_tpl->getVariable('se')->value->getLogo();?>
" alt="" class="img-thumbnail"/></p>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <label class="col-sm-2 control-label"  for="logo">Logo (png) :</label>
        <div class="col-sm-8">
            <input type="file" name="logo" id="logo" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send" value="Valider" class="btn btn-success">
                <i class="fa-save fa"></i> Sauvegarder
            </button>
        </div>
    </div>
</form>
</div>

