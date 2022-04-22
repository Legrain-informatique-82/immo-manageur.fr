<?php /* Smarty version Smarty-3.0.6, created on 2014-05-19 09:05:03
         compiled from "/var/www/aptana/immo-manageur.fr/modules/tpl_default/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2732747755379ad1fd129f8-68763763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5550fdf8d8e246be80dd40ac952859027c866af2' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/tpl_default/header.tpl',
      1 => 1369380374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2732747755379ad1fd129f8-68763763',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
 <meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<meta name="robots" content="noindex,nofollow" />

<?php $_smarty_tpl->tpl_vars["theme"] = new Smarty_variable(Constant::THEME, null, null);?>
<?php if ($_smarty_tpl->getVariable('user')->value){?>
	<?php if ($_smarty_tpl->getVariable('user')->value->getTheme()!=''){?>
		<?php $_smarty_tpl->tpl_vars["theme"] = new Smarty_variable($_smarty_tpl->getVariable('user')->value->getTheme(), null, null);?>
	<?php }?>
<?php }?>

<link rel="stylesheet"
	href="<?php echo Constant::DEFAULT_URL;?>
/css/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/demo_page.css" />
<link rel="stylesheet"
	href="<?php echo Constant::DEFAULT_URL;?>
/css/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/demo_table.css" />

<link href="<?php echo Constant::DEFAULT_URL;?>
/css/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/uploadify.css"
	type="text/css" rel="stylesheet" />
<link rel="stylesheet"
	href="<?php echo Constant::DEFAULT_URL;?>
/css/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/jquery-ui-1.8.16.custom.css" />

<link rel="stylesheet"
	href="<?php echo Constant::DEFAULT_URL;?>
/css/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/css.css" />
<!--[if lte IE 8]>
   <link rel="stylesheet" href="<?php echo Constant::DEFAULT_URL;?>
/css/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/lessIe9.css" />
   
<![endif]-->

<!--[if lte IE 7]>
   <link rel="stylesheet" href="<?php echo Constant::DEFAULT_URL;?>
/css/<?php echo $_smarty_tpl->getVariable('theme')->value;?>
/lessIe8.css" />
<![endif]-->
<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
</head>
<body>

	<div id="entete">
		<?php if (!$_smarty_tpl->getVariable('login')->value){?>
		<p id="headerLogo">
			<a href="<?php echo Constant::DEFAULT_URL;?>
">

			<img src="<?php echo Constant::DEFAULT_URL;?>
/images/logo.png" alt="Immo manageur" /> </a>
		</p>
		<?php }?> <?php if ($_smarty_tpl->getVariable('user')->value){?>
		<p id="headerName">
			<?php echo $_smarty_tpl->getVariable('user')->value->getName();?>
 <?php echo $_smarty_tpl->getVariable('user')->value->getFirstname();?>
 - <a
				href="<?php echo Constant::DEFAULT_URL;?>
/mod-login/disconnect">Se déconnecter</a>
		</p>
		<?php }?>
		<hr class="invi clear" />
	</div>
	<?php if ($_smarty_tpl->getVariable('login')->value!='1'){?>
	<?php $_template = new Smarty_Internal_Template('tpl_default/menuVertical.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('h1','');$_template->assign('menu',$_smarty_tpl->getVariable('mainMenu')->value);$_template->assign('idMenu',"menuPrincipal"); echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
	<div id="wrapper" class="<?php if ($_SESSION['etatMenuVertical']!='repli'){?>depli<?php }else{ ?>repli<?php }?>"><?php }?>