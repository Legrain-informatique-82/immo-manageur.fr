<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:25
         compiled from "/var/www/aptana/extra-immo/modules/login/views/connexion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:410677476519f1c3919b846-03041886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ae8e72022169661a2897cc409cbd64256781dc4' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/login/views/connexion.tpl',
      1 => 1369381942,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '410677476519f1c3919b846-03041886',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="view_login">	<p>		<img src="<?php echo Constant::DEFAULT_URL;?>
/images/logo.png" alt="" />	</p>	<form action="" method="post">		<fieldset>			<legend>Se connecter</legend>			<?php if ($_smarty_tpl->getVariable('error')->value){?>			<p class="error"><?php echo $_smarty_tpl->getVariable('error')->value;?>
</p>			<?php }?>			<p>				<label for="login">Identifiant : </label><input type="text"					name="login_login" id="login" value="<?php echo $_POST['login_login'];?>
" />							</p>			<p>				<label for="password">Mot de passe :</label> <input type="password"					name="login_password" value="<?php echo $_POST['login_password'];?>
"					id="password" /> 			</p>			<p class="center">				<input type="submit" name="login_send" value="Se connecter" />			</p>		</fieldset>	</form></div>