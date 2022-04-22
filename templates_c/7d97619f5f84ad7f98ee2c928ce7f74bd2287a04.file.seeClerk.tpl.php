<?php /* Smarty version Smarty-3.0.6, created on 2012-10-17 11:21:07
         compiled from "/var/www/aptana/extra-immo/modules/notary/views/seeClerk.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2116785355507e7883c26584-11910414%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d97619f5f84ad7f98ee2c928ce7f74bd2287a04' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/notary/views/seeClerk.tpl',
      1 => 1350465665,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2116785355507e7883c26584-11910414',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl_default/entete.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

<h1>Fiche du clerc du notaire <?php echo $_smarty_tpl->getVariable('clerk')->value->getNotary()->getName();?>
</h1>
<p> <a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'notary','see',$_smarty_tpl->getVariable('clerk')->value->getNotary()->getIdNotary());?>
">Fermer la fiche</a>
<?php if ($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<=2){?>

	- <a href="<?php echo $_smarty_tpl->getVariable('urlUpdate')->value;?>
">Modifier</a> - <a href="<?php echo $_smarty_tpl->getVariable('urlDelete')->value;?>
">Supprimer</a>

<?php }?>
</p>
<div class="bulle">

<p>Nom : <?php echo $_smarty_tpl->getVariable('clerk')->value->getName();?>
</p>
<p>Prénom : <?php echo $_smarty_tpl->getVariable('clerk')->value->getFirstname();?>
</p>
<p>Adresse : <?php echo $_smarty_tpl->getVariable('clerk')->value->getAddress();?>
</p>
<p>Code Postal : <?php echo $_smarty_tpl->getVariable('clerk')->value->getZipCode();?>
</p>
<p>Ville : <?php echo $_smarty_tpl->getVariable('clerk')->value->getCity();?>
</p>
<p>Code Postal : <?php echo $_smarty_tpl->getVariable('clerk')->value->getZipCode();?>
</p>
<p>Téléphone : <?php echo $_smarty_tpl->getVariable('clerk')->value->getPhone();?>
</p>
<p>Téléphone portable : <?php echo $_smarty_tpl->getVariable('clerk')->value->getMobilPhone();?>
</p>
<p>Téléphone travail : <?php echo $_smarty_tpl->getVariable('clerk')->value->getJobPhone();?>
</p>
<p>Fax : <?php echo $_smarty_tpl->getVariable('clerk')->value->getFax();?>
</p>
<p>Email : <?php echo $_smarty_tpl->getVariable('clerk')->value->getEmail();?>
</p>
<p>Commentaire : <?php echo $_smarty_tpl->getVariable('clerk')->value->getComments();?>
</p>
</div>



</div>