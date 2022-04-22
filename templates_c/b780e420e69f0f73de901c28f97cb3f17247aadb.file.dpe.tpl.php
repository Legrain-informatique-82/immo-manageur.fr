<?php /* Smarty version Smarty-3.0.6, created on 2014-09-02 12:29:04
         compiled from "/var/www/aptana/immo-manageur.fr/modules/mandat/modules/dpe/views/dpe.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62349761754059bf0adb7b0-94709484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b780e420e69f0f73de901c28f97cb3f17247aadb' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/mandat/modules/dpe/views/dpe.tpl',
      1 => 1409653743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62349761754059bf0adb7b0-94709484',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

  <div class="row">

      <div class="col-xs-6">



          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">CES</h3>
              </div>
              <div class="panel-body text-center">
                  <?php if ($_smarty_tpl->getVariable('ces')->value){?>   <img src="<?php echo $_smarty_tpl->getVariable('ces')->value;?>
" alt="ces" /><?php }else{ ?>Aucune information enregistrée<?php }?>
              </div>
              </div>

      </div>
      <div class="col-xs-6">



          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">GES</h3>
              </div>
              <div class="panel-body text-center">
                  <?php if ($_smarty_tpl->getVariable('ges')->value){?>   <img src="<?php echo $_smarty_tpl->getVariable('ges')->value;?>
" alt="ges" /><?php }else{ ?>Aucune information enregistrée<?php }?>
              </div>
          </div>
    </div>
  </div>



