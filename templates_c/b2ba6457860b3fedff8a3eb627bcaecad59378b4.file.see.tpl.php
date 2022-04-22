<?php /* Smarty version Smarty-3.0.6, created on 2014-09-02 11:33:19
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/mandateCom/views/see.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144445690054058edfcd1353-66615168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2ba6457860b3fedff8a3eb627bcaecad59378b4' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/mandateCom/views/see.tpl',
      1 => 1409650398,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144445690054058edfcd1353-66615168',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h3>
	<a href="#">Commentaire / Infos visite</a>
</h3>
<div>
	 <?php if (($_smarty_tpl->getVariable('user')->value->getLevelMember()->getIdLevelMember()<3||$_smarty_tpl->getVariable('user')->value->getIdUser()==$_smarty_tpl->getVariable('mandate')->value->getUser()->getIdUser())&&$_smarty_tpl->getVariable('mandate')->value->getEtap()->getIdMandateEtap()==Constant::ID_ETAP_TO_SELL){?>

	<p>
		<a
			href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,$_GET['module'],'updateCom',$_GET['action']);?>
" class="btn btn-default"><i class="fa fa-pencil-square-o"></i>
			<?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> Modifier le commentaire et/ou l'info visite.
			<?php }else{ ?> Ajouter un commentaire et/ou l'info visite <?php }?> </a>
	</p>

	<?php }?>
    <div class="row">

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Commentaire</h3>
                </div>
                <div class="panel-body">
                    <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value->getCom()!=''){?>
                        <?php echo $_smarty_tpl->getVariable('elementMandateCom')->value->getCom();?>
 <?php }else{ ?>
                        <p>Aucun commentaire actuellement.</p>
                    <?php }?> <?php }else{ ?>
                        <p>Aucun commentaire actuellement.</p>
                    <?php }?>
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Infos visite</h3>
                </div>
                <div class="panel-body">
                    <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value->getInfoVisite()!=''){?>
                        <?php echo $_smarty_tpl->getVariable('elementMandateCom')->value->getInfoVisite();?>
 <?php }else{ ?>
                        <p>Aucune info visite actuellement.</p>
                    <?php }?> <?php }else{ ?>
                        <p>Aucune info visite actuellement.</p>
                    <?php }?>
                </div>
            </div>
        </div>


        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Observations</h3>
                </div>
                <div class="panel-body">
                    <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value){?> <?php if ($_smarty_tpl->getVariable('elementMandateCom')->value->getOtherCom()!=''){?>
                        <?php echo $_smarty_tpl->getVariable('elementMandateCom')->value->getOtherCom();?>
 <?php }else{ ?>
                        <p>Aucune observation actuellement.</p>
                    <?php }?> <?php }else{ ?>
                        <p>Aucune observation actuellement.</p>
                    <?php }?>
                </div>
            </div>
        </div>



    </div>
</div>
