<?php /* Smarty version Smarty-3.0.6, created on 2012-09-06 10:17:31
         compiled from "/var/www/aptana/extra-immo/modules/documents/views/pre_gen.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181678100950485c1b3b7b21-10841985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a58927f9a8ff9ada4efafb9cfc52b99b03d9196d' => 
    array (
      0 => '/var/www/aptana/extra-immo/modules/documents/views/pre_gen.tpl',
      1 => 1322123650,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181678100950485c1b3b7b21-10841985',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template('tpl_default/bigEntete.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1><?php echo $_smarty_tpl->getVariable('h1')->value;?>
</h1>
<?php if ($_smarty_tpl->getVariable('error')->value){?>
<ul class="contError">
	<?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('error')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
?>
	<li class="error"><?php echo $_smarty_tpl->tpl_vars['e']->value;?>
</li> <?php }} ?>
</ul>
<?php }?>
<div class="bulle" id="blocDoc">
<p>Vous pouvez :</p>
<ul>
	<li>Souligner un mot ou groupe de mots en l'encadrant de balise
		&lt;u&gt; et &lt;/u&gt; : &lt;u&gt; Phrase à souligner. &lt;/u&gt;
		donnera <u>Phrase à souligner.</u></li>
	<li>Mettre en italique un mot ou groupe de mots en l'encadrant de
		balise &lt;i&gt; et &lt;/i&gt; : &lt;i&gt; Phrase en italique.
		&lt;/i&gt; donnera <i>Phrase en italique.</i></li>
	<li>Mettre en gras un mot ou groupe de mots en l'encadrant de balise
		&lt;b&gt; et &lt;/b&gt; : &lt;b&gt; Phrase en gras. &lt;/b&gt; donnera
		<b>Phrase en gras.</b></li>
	<li>Mettre en gras et en italique un mot ou groupe de mots en
		l'encadrant de balise &lt;bi&gt; et &lt;/bi&gt; : &lt;bi&gt; Phrase en
		gras et en italique. &lt;/bi&gt; donnera <b><i>Phrase en gras et en
				italique.</i> </b></li>
	<li>Mettre en gras souligné un mot ou groupe de mots en l'encadrant de
		balise &lt;bu&gt; et &lt;/bu&gt; : &lt;bu&gt; Phrase en gras souligné.
		&lt;/bu&gt; donnera <b><u>Phrase en gras souligné.</u> </b></li>
	<li>Mettre en italique souligné un mot ou groupe de mots en l'encadrant
		de balise &lt;iu&gt; et &lt;/iu&gt; : &lt;iu&gt; Phrase en italique
		souligné. &lt;/iu&gt; donnera <u><i>Phrase en italique souligné.</i> </u>
	</li>
	<li>Mettre en gras italique souligné un mot ou groupe de mots en
		l'encadrant de balise &lt;biu&gt; et &lt;/biu&gt; : &lt;biu&gt; Phrase
		en gras italique souligné. &lt;/biu&gt; donnera <b><u><i>Phrase en
					gras italique souligné.</i> </u> </b></li>
	<li>les tags &lt;titreVendeur&gt; &lt;nomVendeur&gt;
		&lt;prenomVendeur&gt;
		&lt;debutMandat&gt;,&lt;typeBien&gt;,&lt;prenomDemarcheur&gt;,&lt;nomDemarcheur&gt;
		sont remplacés par le titre, le nom, le prénom du vendeur, la date du
		début de mandat,Le type de bien;Le prénom du démarcheur,le nom du
		démarcheur.</li>
</ul>
<!-- <p><a href="<?php echo Tools::create_url($_smarty_tpl->getVariable('user')->value,'terrain','see',$_GET['action']);?>
">Retour à la fiche</a></p> -->
<form action="" method="post">
	<p>
		<label for="dateDoc">Date du document :</label> <input type="text"
			value="<?php echo $_smarty_tpl->getVariable('dateDoc')->value;?>
" name="dateDoc" id="dateDoc" class="datepicker" />
		
	</p>
	<p>
		<label for="sizeTypo">Taille de la police :  </label><select name="sizeTypo"
			id="sizeTypo">
				<option <?php if ($_smarty_tpl->getVariable('sizeTypo')->value==10){?> selected="selected" <?php }?> value="10">10</option>
				<option <?php if ($_smarty_tpl->getVariable('sizeTypo')->value==12){?> selected="selected" <?php }?>  value="12">12</option>
		</select>
	</p>

	<p>
		<label for="corps">Corps :</label> <textarea name="corps" id="corps" cols="30"
				rows="10"><?php echo $_smarty_tpl->getVariable('corps')->value;?>
</textarea> 
	</p>
	<p>
		<label for="signature">Signature : </label><textarea name="signature"
				cols="30" rows="10" id="signature"><?php echo $_smarty_tpl->getVariable('signature')->value;?>
</textarea> 
	</p>
	<p>
		<input type="submit" name="generate" value="Generer" />
	</p>
</form>

</div>
</div>
