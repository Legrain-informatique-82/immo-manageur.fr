<?php /* Smarty version Smarty-3.0.6, created on 2014-05-19 16:59:48
         compiled from "/var/www/aptana/immo-manageur.fr/modules/seller/views/see_seller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:109646566537a1c64396aa5-56245121%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ba5fc417bd0aca4234abee61524114aaffc1e0a' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/seller/views/see_seller.tpl',
      1 => 1400511585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109646566537a1c64396aa5-56245121',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo Lang::LABEL_SELLER_SEE_H1;?>
</h1>
<?php if ($_smarty_tpl->getVariable('seller')->value->getUser()->getIdUser()==$_smarty_tpl->getVariable('user')->value->getIdUser()||$_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3){?>
<a href="<?php echo $_smarty_tpl->getVariable('urlUpdate')->value;?>
"><?php echo Lang::LABEL_UPDATE;?>
</a>
-
<a href="<?php echo $_smarty_tpl->getVariable('urlDelete')->value;?>
"><?php echo Lang::LABEL_DELETE;?>
</a>
<?php }?>
<div class="bulle">
<p><?php echo Lang::LABEL_SELLER_ADD_TITLE;?>

	<?php echo $_smarty_tpl->getVariable('seller')->value->getSellerTitle()->getLibel();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_NAME;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getName();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_FIRSTNAME;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getFirstname();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_ADDRESS;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getAddress();?>
</p>
<p><?php echo $_smarty_tpl->getVariable('seller')->value->getCity()->getZipCode();?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getCity()->getName();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_PHONE;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getPhone();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_MOBIL_PHONE;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getMobilPhone();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_WORK_PHONE;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getWorkPhone();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_FAX;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getFax();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_EMAIL;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getEmail();?>
</p>
<p><?php echo Lang::LABEL_SELLER_ADD_COMMENT;?>
 <?php echo $_smarty_tpl->getVariable('seller')->value->getComments();?>
</p>
<p>Possède un compte client sur le site vitrine ? <?php if ($_smarty_tpl->getVariable('seller')->value->getVitrine_account()){?>Oui<?php }else{ ?>Non<?php }?></p>
<p>Etat : <?php if ($_smarty_tpl->getVariable('seller')->value->getAsset()==1){?>Actif<?php }else{ ?>Inactif<?php }?></p>
</div>
 <?php $_template = new Smarty_Internal_Template("tpl_default/hook.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('position',"hook_fin_corps_droite"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
</div>