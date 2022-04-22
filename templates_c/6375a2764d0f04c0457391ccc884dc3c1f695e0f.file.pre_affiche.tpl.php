<?php /* Smarty version Smarty-3.0.6, created on 2012-09-06 10:09:58
         compiled from "/var/www/aptana/extra-immo/modules/documents/views/pre_affiche.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110657467750485a5681c610-45477918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6375a2764d0f04c0457391ccc884dc3c1f695e0f' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/documents/views/pre_affiche.tpl',
      1 => 1322123872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110657467750485a5681c610-45477918',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="bulle" class="blocDoc">
	<form action="" method="post">
		<p>
			Utilisation :</p>
<p><label for="ville">Ville :</label> <?php echo $_smarty_tpl->getVariable('ville')->value;?>
<input
				type="radio" checked="checked" name="villeSecteur" id="ville"
				value="ville" /> </label></p><p> <label for="secteur">Secteur :</label>
				<?php echo $_smarty_tpl->getVariable('secteur')->value;?>
<input type="radio" name="villeSecteur" id="secteur"
				value="secteur" /> 
		</p>
		<p>
			<label for="corps">Corps : </label><textarea name="corps" id="corps"
					cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('corps')->value;?>
</textarea> 
		</p>
		<p>
			<input type="submit" name="send" value="Generer" />
		</p>
	</form>
</div>
</div>


