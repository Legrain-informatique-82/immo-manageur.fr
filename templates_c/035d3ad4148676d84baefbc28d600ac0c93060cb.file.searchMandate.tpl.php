<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 08:36:11
         compiled from "/var/www/aptana/immo-manageur.fr/modules/rechercheMulti/views/searchMandate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1380842792541bcedbd5e263-01071103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '035d3ad4148676d84baefbc28d600ac0c93060cb' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/rechercheMulti/views/searchMandate.tpl',
      1 => 1411052378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1380842792541bcedbd5e263-01071103',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/entete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<form action="" method="post" class="form-inline">
    <div class="row bg-success bannerTitle">
        <div class="col-md-12">
            <h1 class="h2">Rechercher de biens</h1>
        </div>
    </div>




    <?php if ($_POST){?>

        <?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable;
 $_from = $_POST['critere']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["boucle"]['index']++;
?>
            <?php if ($_smarty_tpl->tpl_vars['it']->value!=''){?>
                <p class="lineCritere">
                    <select name="critere[]" class="chooseCritereMandate form-control">
                        <option value="" class="empty">_____</option>
                        <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCritere')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
                            <option value="<?php echo $_smarty_tpl->getVariable('i')->value->getChampsCorrespondant();?>
" <?php if ($_smarty_tpl->getVariable('i')->value->getChampsCorrespondant()==$_smarty_tpl->tpl_vars['it']->value){?>selected="selected"<?php }?> class="<?php if ($_smarty_tpl->getVariable('i')->value->getType()!='list'){?><?php echo $_smarty_tpl->getVariable('i')->value->getType();?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('i')->value->getNameTable();?>
<?php }?>"><?php echo $_smarty_tpl->getVariable('i')->value->getNom();?>
 </option>
                        <?php }} ?>
                    </select>
                    <span class="complementWithJs">
		 <?php if ($_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='simple'){?>
             <span class="complementWithJs"><input type="text"  name="val1[]" value="<?php echo $_POST['val1'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/> <input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="<?php echo $_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/><input type="hidden" name="table[]" value=""/></span>
		<?php }elseif($_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='double'){?>
			<span class="complementWithJs"><input type="text"  name="val1[]" value="<?php echo $_POST['val1'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/> et <input type="text" name="val2[]" value="<?php echo $_POST['val2'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/><input type="hidden" name="type[]" value="<?php echo $_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/><input type="hidden" name="table[]" value=""/></span>
		<?php }elseif($_POST['type'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='list'){?>
		<select name="val1[]" class="form-control">
             <?php ob_start();?><?php echo $_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
<?php $_tmp1=ob_get_clean();?><?php  $_smarty_tpl->tpl_vars['elemList'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listElement')->value[$_tmp1]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['elemList']->key => $_smarty_tpl->tpl_vars['elemList']->value){
?>

                 <option  <?php if ($_smarty_tpl->getVariable('elemList')->value->getId()==$_POST['val1'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]){?>selected="selected"<?php }?> value="<?php echo $_smarty_tpl->getVariable('elemList')->value->getId();?>
">
                     <?php if ($_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='User'){?> <?php echo $_smarty_tpl->getVariable('elemList')->value->getFirstname();?>
<?php }?>
                     <?php if ($_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']]=='City'){?> <?php echo $_smarty_tpl->getVariable('elemList')->value->getZipCode();?>
<?php }?>
                     <?php echo $_smarty_tpl->getVariable('elemList')->value->getName();?>
</option>
             <?php }} ?>
         </select>
             <input type="hidden" name="val2[]" value=""/><input type="hidden" name="type[]" value="list"/><input type="hidden" name="table[]" value="<?php echo $_POST['table'][$_smarty_tpl->getVariable('smarty')->value['foreach']['boucle']['index']];?>
"/>
         <?php }?>
		</span>
                    <a href="#" class="delLineRecherche btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></a>
                </p>

            <?php }?>
        <?php }} ?>


    <?php }?>
    <hr class="lineCritere"/>

        <div class="form-group ">
            <p class="lineCritere">
                <select class="chooseCritereMandate form-control" name="critere[]">
                    <option value="" class="empty">_____</option>
                    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listCritere')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('i')->value->getChampsCorrespondant();?>
" class="<?php if ($_smarty_tpl->getVariable('i')->value->getType()!='list'){?><?php echo $_smarty_tpl->getVariable('i')->value->getType();?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('i')->value->getNameTable();?>
<?php }?>"><?php echo $_smarty_tpl->getVariable('i')->value->getNom();?>
</option>
                    <?php }} ?>
                </select>
                <span class="complementWithJs"></span>
                <a href="#" class="delLineRecherche btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></a>
            </p>
        </div>

    <p><a href="#" id="addNewRecherchLine" class="Critere_mandate">Ajouter une nouvelle ligne</a></p>
    <p><input type="submit" value="Rechercher" name="rechercher" /></p>
</form>
<?php if ($_POST){?>
    <form action="" method="post">


        <table class="dataTableDefault table table-striped table-bordered">
            <thead>

            <tr>
                <th>Sélectionner</th>
                <th>Prix (FAI en euros)</th>
                <th>Ref mandat</th>
                <th>Type transaction</th>
                <th>Type bien</th>
                <th>Surface habitable</th>
                <th>Surface terrain</th>
                <th>Nb piece</th>
                <th>Adresse du mandat</th> <?php if ($_POST['confidentialMode']!='ok'&&!empty($_POST)){?>
                    <th>Nature</th>

                    <th>Nom &amp; prénom du vendeur</th>
                    <th>Coordonnées vendeur par defaut</th> <?php }?>


                <th>Voir la fiche</th>
            </tr>
            </thead>
            <tbody>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('resultatsRecherche')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>

                <tr rel="<?php echo $_smarty_tpl->getVariable('item')->value->getIdMandate();?>
">

                    <td><input type="checkbox" name="idSellers[]" value="<?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getIdSeller();?>
"/></td>
                    <td data-order="<?php echo $_smarty_tpl->getVariable('item')->value->getPriceFai();?>
"><b><?php echo Tools::grosNombre(round($_smarty_tpl->getVariable('item')->value->getPriceFai(),2));?>
 €</b></td>
                    <td class="gras"><?php echo $_smarty_tpl->getVariable('item')->value->getNumberMandate();?>
</td>
                    <td><?php echo $_smarty_tpl->getVariable('item')->value->getTransactionType()->getName();?>
</td>
                    <td class="gras maj"><?php echo $_smarty_tpl->getVariable('item')->value->getMandateType()->getName();?>
</td>
                    <td><?php if ($_smarty_tpl->getVariable('item')->value->getSurfaceHabitable()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value->getSurfaceHabitable();?>
<?php }?></td>
                    <td><?php if ($_smarty_tpl->getVariable('item')->value->getSuperficieTotale()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value->getSuperficieTotale();?>
<?php }?></td>
                    <td><?php if ($_smarty_tpl->getVariable('item')->value->getNbPiece()==0){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value->getNbPiece();?>
<?php }?></td>
                    <td><?php if ($_POST['confidentialMode']!='ok'&&!empty($_POST)){?> <?php echo $_smarty_tpl->getVariable('item')->value->getAddress();?>
<br /> <?php }?>
                        <?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getZipCode();?>

                        <?php echo $_smarty_tpl->getVariable('item')->value->getCity()->getName();?>
</td> <?php if ($_POST['confidentialMode']!='ok'&&!empty($_POST)){?>
                        <td><?php if ($_smarty_tpl->getVariable('item')->value->getNature()==null){?>NC<?php }else{ ?><?php echo $_smarty_tpl->getVariable('item')->value->getNature()->getName();?>
<?php }?></td>

                        <td><?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getFirstname();?>

                            <?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getName();?>
</td>

                        <td><?php if ($_smarty_tpl->getVariable('item')->value->getDefaultSeller()){?> <?php if ($_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getPhone()){?>
                                <p>Téléphone : <?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getPhone();?>
</p><?php }?>
                                <?php if ($_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getMobilPhone()){?>
                                    <p>Téléphone portable:
                                    <?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getMobilPhone();?>
 <a href="<?php echo Constant::DEFAULT_URL;?>
/modules/openmail/formFancybox/sendSms.php?<?php echo time();?>
&amp;dest=<?php echo str_replace('+','%2B',$_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getMobilPhone());?>
" class="fancyboxAjax fancybox.ajax"> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAABKElEQVRYR+1XOwoCQQzdtRbxJOIh7LVQsbfxEIKgx9ATaGVtby8WXsDe1kp9kR2JIbMOMh/BHQiYsOa9vCTsbJ4lPnli/OynCKyhxiCSIhvgDAmLK3CPBG5gntgVgUoBFwW0ZyimDS2Pf8rtNIQSyPgmOSfBY7b/8UX7igBfIQLnhDS/bLOdCNhWVUptlPDeAlmBrNgQ1AhIueXMOClQNgNlQ+htBlxaYKvUyxaEfD04taAi8F8KJL8RcblXcMaK/lvEej77YruUHgDSEkBL+BPYLTSBBgAusBoDmuH33Cfw28VQJO7A3xUxqpaqpuqDHK0FCyBNYVfYCEZ9D3Y0AlR9G9aF7YMhF4klAer7EdaHnUKDU35JoIlYHXaOAa4RiIX7wkn+cfoA3JFLISd2YxsAAAAASUVORK5CYII=" alt="Envoyer un sms"/></a></p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getWorkPhone()){?>
                                    <p>Téléphone travail:
                                    <?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getWorkPhone();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getFax()){?>
                                    <p>Fax : <?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getFax();?>
</p><?php }?> <?php if ($_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getEmail()){?>
                                    <p>Email : <?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getEmail();?>
 <a href="<?php echo Constant::DEFAULT_URL;?>
/modules/openmail/formFancybox/sendEmail.php?<?php echo time();?>
&amp;dest=<?php echo $_smarty_tpl->getVariable('item')->value->getDefaultSeller()->getEmail();?>
" class="fancyboxAjax fancybox.ajax"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACEklEQVRIS92VS0iUURTHz2PGYkAziDBcJBUhhTQpBpMNDRG4mJE2BRXYg0BX0SaQCFoELQRp1SISehO2NUWMWk3vGMYisGAkiB6iEDigxXzeezpXGnFgchzlW9jdXc45/9/9n3u4F8HnhT7rg/+AcDQeZ6CgH06MlRw27T8kfojnNecBInYCBO8Iil0JEAVJT3yaCDc4nQIHYu3TXzO59tHU8I/lQLZHDtSGOHSfmWMFDqyVcUH7hZH3qJNJMXAy/fzRUDkQd5cIfNudXIy8ApItiLRxzoFexieeqWmQ0PgVnavzTtiAXA1Mb7qQSt3wFgcdqWiM/u4GxHMAogu708n+S7v3tX0kpq3zgJFkf70T2hWNtzLSXUe3Im+9We/YhxdDY8UgOyKt29YGgn1I3OS6AGLa088Gn7hcBWSKAlxwZ3OspmJN1T1iPKiQrBZ2ppODfQsh4ZbEcWC6zoiVYs3w1FTuxNj7xxP5nEUBf5MoHE10IdBl7WtAQTdp+tvZr56Htes2X0OiU1aMJwIXR5IDPVpTMO5LAcxxGvYmIkHGBypYJ2JGxZJ2BOsV+Nl69ui7lwNvirVvyQBXXBeOVa+vrOpVJ4fdXkEPs98nOzKZ19l/DUBZgLxIY0tbpyWx2pLeUiO8LEAp0YXx/w0g5qcA3iqnBaVyWeCMTl61/8+1expA/PlwwH04payuNL76AX8A/oQnJB2c4dAAAAAASUVORK5CYII=" alt="E-mail"/></a></p><?php }?>
                            <?php }else{ ?> NC <?php }?></td> <?php }?>



                    <td>
                        <?php if ($_smarty_tpl->getVariable('item')->value->getMandateType()->getIdMandateType()==Constant::ID_PLOT_OF_LAND){?>
                            <?php $_smarty_tpl->tpl_vars['typeBien'] = new Smarty_variable("terrain", null, null);?>
                        <?php }else{ ?>
                            <?php $_smarty_tpl->tpl_vars['typeBien'] = new Smarty_variable("mandat", null, null);?>
                        <?php }?>
                        <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_smarty_tpl->getVariable('typeBien')->value,'see',$_smarty_tpl->getVariable('item')->value->getIdMandate());?>
" <?php if ($_smarty_tpl->getVariable('user')->value->getOpenInNewTab()){?> target="_blank"<?php }?>><img src="<?php echo Constant::DEFAULT_URL_PICTURE_DIRECTORY;?>
see.png" alt="<?php echo Lang::LABEL_SEE;?>
" /></a>
                    </td>

                </tr>

            <?php }} ?>
            </tbody>
        </table>
        <p><input type="submit" value="Envoyer un SMS à la sélection" name="searchMandateSendSms"/>
            <input type="submit" value="Envoyer un E-mail à la sélection" name="searchMandateSendEmail"/></p>
    </form>
<?php }?>

</div>

