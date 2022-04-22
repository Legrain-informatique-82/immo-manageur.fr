<?php /* Smarty version Smarty-3.0.6, created on 2013-05-24 09:52:47
         compiled from "/var/www/aptana/extra-immo/modules/mandat/modules/documents/views/links.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1833463350519f1c4f116917-12498882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '928a7dd5d626dbb629a31882bd5d8c497f4570b6' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/mandat/modules/documents/views/links.tpl',
      1 => 1369380358,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1833463350519f1c4f116917-12498882',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_counter')) include '/var/www/aptana/extra-immo/libs/smarty/plugins/function.counter.php';
?><?php echo smarty_function_counter(array('start'=>0,'print'=>false,'assign'=>'compt'),$_smarty_tpl);?>

    <?php if (!$_smarty_tpl->getVariable('isCompromis')->value){?>
  <?php echo smarty_function_counter(array(),$_smarty_tpl);?>

  <div class="mSep">
 <h3>Affiches</h3>
 <ul>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','afficheMandat',$_GET['action']);?>
">Affiche
			classique</a>
	</li>
	</ul>
	</div>
	<?php }?>

	<!--
    <li> <a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','afficheEscalTerrain',$_GET['action']);?>
">Affiche classique</a></li>
	<li> <a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','afficheEscalTerrainExclu',$_GET['action']);?>
">Affiche exclu</a></li>
	<li> <a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','afficheEscalTerrainVendu',$_GET['action']);?>
">Affiche vendu par escalimmo</a></li>
	-->
	<?php if ($_smarty_tpl->getVariable('isCompromis')->value){?>
	  <?php echo smarty_function_counter(array(),$_smarty_tpl);?>

	<div class="mSep">
	<h3>Etude de maître</h3>
	<ul>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','etudeMaitreAcquereurs',$_GET['action']);?>
">Acquereurs</a></li>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','etudeMaitreVendeur',$_GET['action']);?>
">Vendeurs</a></li>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','etudeMaitreVA',$_GET['action']);?>
">Vendeurs et acquereurs</a></li>
			</ul></div>
			<?php }?>
	<?php if ($_smarty_tpl->getVariable('compt')->value%2==0){?>
	<hr class="invi clear" />
	<?php }?>
	<div class="mSep">
	  <?php echo smarty_function_counter(array(),$_smarty_tpl);?>

	<h3>Documents vendeurs</h3>
	<ul>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','vendeur1',$_GET['action']);?>
">Courrier envoi comp.</a>
	</li>
	<?php if (!$_smarty_tpl->getVariable('isCompromis')->value){?>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','lettre_renouvellement_vendeur',$_GET['action']);?>
">Lettre
			renouvellement vendeur</a></li>

	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','lettre_envoi_vendeur',$_GET['action']);?>
">Lettre
			envoi vendeur</a></li>
					<?php }?>
			<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','estimation_bien',$_GET['action']);?>
">Lettre estimation du bien</a></li>
		<li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','lettre_mandat',$_GET['action']);?>
">Lettre mandat</a></li>
		<li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','avenant_modif_type',$_GET['action']);?>
">Avenant modificatif de type</a></li>
		<li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','avenant_baisse_prix',$_GET['action']);?>
">Avenant baisse de prix</a></li>
	</ul>
	</div>
	<?php if ($_smarty_tpl->getVariable('compt')->value%2==0){?>
	<hr class="invi clear" />
	<?php }?>
	
	 <?php if ($_smarty_tpl->getVariable('isCompromis')->value){?>
	<div class="mSep">
	  <?php echo smarty_function_counter(array(),$_smarty_tpl);?>

	<h3>Documents acquereurs</h3>
	<ul>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','compte_rendu_simple',$_GET['action']);?>
">Compte rendu simple</a></li>
	<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','envoi_comp_acq',$_GET['action']);?>
">Envoi comp acquereur</a></li>
	<!-- <li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','avenant_modif_acq',$_GET['action']);?>
">Avenant modif. acquereur</a></li> -->
	<li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','lettreSru',$_GET['action']);?>
">Lettre SRU</a></li>
	</ul>
	</div>	
	<?php }?>
	<?php if ($_smarty_tpl->getVariable('compt')->value%2==0){?>
	<hr class="invi clear" />
	<?php }?>
	<div class="mSep">
	  <?php echo smarty_function_counter(array(),$_smarty_tpl);?>

	<h3>Documents mandat</h3>
	<ul>
		<li><a target="_blank"
		href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','fiche_photo',$_GET['action']);?>
">Fiche photo</a></li>	
<li><a target="_blank" href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'documents','fiche_acq',$_GET['action']);?>
">Fiche acquereur</a></li> 

	
	</ul>
	</div>		
<hr class="clear invi" />