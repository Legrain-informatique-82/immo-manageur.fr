<?php /* Smarty version Smarty-3.0.6, created on 2014-10-20 16:51:26
         compiled from "/var/www/aptana/immo-manageur.fr/modules/login/views/connexion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10411555325445216e902666-93657741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ddc3ff9a7cf1924ff5e4040169f36f4fc6a8194' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/login/views/connexion.tpl',
      1 => 1413470904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10411555325445216e902666-93657741',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="logo-non-log">    <div class="container-902 text-right">        <img src="/images/logo-Immo-manageur-login.png" alt="Immo-manageur : Logiciel de transactions immobiliers - full web"/>    </div></div><div class="container-902" id="bloc-connexion">        <div class="row">            <form role="form" method="post" class="col-md-3 col-md-offset-9">                <div class="contform">                    <h1 class="h5">Bienvenue sur Immo-Manageur</h1>                    <?php if ($_smarty_tpl->getVariable('error')->value){?>                        <div class="form-group">                            <div class="alert-danger" role="alert"><?php echo $_smarty_tpl->getVariable('error')->value;?>
</div>                        </div>                    <?php }?>                    <div class="form-group">                        <input type="text" class="form-control" name="login_login" placeholder="Identifiant"  id="login" value="<?php echo $_POST['login_login'];?>
" />                    </div>                    <div class="form-group">                        <input type="password" placeholder="Mot de passe"  name="login_password" value="<?php echo $_POST['login_password'];?>
" id="password" class="form-control"/>                    </div>                    <input type="submit" class="btn btn-success" name="login_send" value="Se connecter" />                </div>            </form>        </div>    <div id="footer-login">    <div class="container-902">        <p class="text-right">Développé par la société <a href="http://legrain.fr">Legrain Informatique</a></p>    </div>    </div>