{include file='tpl_default/bigEntete.tpl'}
<h1>{$h1}</h1>
{if $error}
<ul class="contError">
	{foreach from=$error item=e}
	<li class="error">{$e}</li> {/foreach}
</ul>
{/if}
<div class="bulle">
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
<!-- <p><a href="{Tools::create_url($user,'terrain','see',$smarty.get.action)}">Retour à la fiche</a></p> -->
<form action="" method="post">
<div class="accordion">
    {foreach from=$lettres item=l name="boucle"}

    <h3><a href="#">{$l.entete.nom} {$l.entete.prenom}</a></h3>
    <div>
    <input type="hidden" name="civilite[]"  value="{$l.entete.civilite}" />
    <input type="hidden" name="prenom[]"  value="{$l.entete.prenom}" />
    <input type="hidden" name="nom[]"  value="{$l.entete.nom}" />
    <input type="hidden" name="adresse[]"  value="{$l.entete.adresse}" />
    <input type="hidden" name="cp[]"  value="{$l.entete.cp}" />
    <input type="hidden" name="ville[]"  value="{$l.entete.ville}" />
    <input type="hidden" name="villeAgence[]"  value="{$l.entete.villeAgence}" />
	<p>
		<label for="dateDoc_{$smarty.foreach.boucle.index}">Date du document :</label> <input type="text"
			value="{$l.entete.date}" name="date[]" id="dateDoc_{$smarty.foreach.boucle.index}" class="datepicker" />
		
	</p>
	<p>
		<label for="sizeTypo_{$smarty.foreach.boucle.index}">Taille de la police :</label> <select name="sizeTypo[]"
			id="sizeTypo_{$smarty.foreach.boucle.index}">
				<option {if $l.size eq 10} selected="selected" {/if} value="10">10</option>
				<option {if $l.size eq 12} selected="selected" {/if}  value="12">12</option>
		</select>
	</p>

	<p>
		<label for="corps_{$smarty.foreach.boucle.index}">Corps :</label> <textarea name="corps[]" id="corps_{$smarty.foreach.boucle.index}" cols="30"
				rows="10">{$l.corps}</textarea> 
	</p>
	<p>
		<label for="signature_{$smarty.foreach.boucle.index}">Signature :</label> <textarea name="signature[]"
				cols="30" rows="10" id="signature_{$smarty.foreach.boucle.index}">{$l.signature}</textarea> 
	</p>
	
	</div>
	{/foreach}
	</div>
	<p>
		<input type="submit" name="generate" value="Generer" />
	</p>
</form>
</div>
</div>
