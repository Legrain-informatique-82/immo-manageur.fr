{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
<form action="" method="post">
	<div class="quatreVingt">
		<div class="accordion">

<h2><a href="#">Catégories</a></h2>
<div>

<p>Sélectionner les catégories associées à ce contact</p>
{foreach $listCategories as $cat}
	<p class="inlineBlock bulle"><label for="cat_{$cat->getIdCategoryContact()}">{$cat->getName()}</label><input {if in_array($cat->getIdCategoryContact(),$categoriesForContact)} checked="checked" {/if} type="checkbox" name="cat[]" id="cat_{$cat->getIdCategoryContact()}" value="{$cat->getIdCategoryContact()}"/></p>
{/foreach}
						


<!-- <p><a href="">Ajouter une catégorie</a></p> -->
</div>
			{foreach from=$listTC item=tc}
			<h2>
				<a href="#">{$tc->getLibel()}</a>
			</h2>
			<div>

				{foreach name=boucle from=$listCC[$tc->getIdTypeChampsContact()]
				item=cc}
				<p class="bulle">
					<input type="hidden" name="type[]"
						value="{$tc->getIdTypeChampsContact()}" /> <input type="hidden"
						name="id[]" value="{$cc->getIdChampsContact()}" /> Position : <input
						type="text" name="pos[]" value="{$cc->getPosition()}"
						class="minText" /> {* Libellé : <input type="text"
						value="{$cc->getLibel()}" name="libel[]" /> Valeur : <input
						type="text" value="{$cc->getVal()}" name="val[]" /> *} Libellé :
					<textarea class="trenteCinq" name="libel[]" cols="30" rows="10">{$cc->getLibel()}</textarea>
					Valeur :
					<textarea class="trenteCinq" name="val[]" cols="30" rows="10">{$cc->getVal()}</textarea>
					{if $cc->getIndestructible()==0}Supprimer ? <input type="checkbox"
						name="del[]" value="{$cc->getIdChampsContact()}" /> {else}
					Supprimer ? <input type="checkbox" name="del[]" disabled="disabled"
						value="" /> {/if}
				</p>
				{if $smarty.foreach.boucle.last} {*
				<p>
					<input type="hidden" name="type[]"
						value="{$tc->getIdTypeChampsContact()}" /><input type="hidden"
						name="id[]" value="" />Position : <input type="text" name="pos[]"
						value="" class="minText" /> Libellé :
					<textarea class="trenteCinq" name="libel[]" cols="30" rows="10">{$cc->getLibel()}</textarea>
					Valeur :
					<textarea class="trenteCinq" name="val[]" cols="30" rows="10">{$cc->getVal()}</textarea>
					Supprimer ? <input type="checkbox" name="del[]" disabled="disabled"
						value="" />
				</p>
				*}
				<p class="bulle">
					<input type="hidden" name="type[]"
						value="{$tc->getIdTypeChampsContact()}" /><input type="hidden"
						name="id[]" value="" />Position : <input type="text" name="pos[]"
						value="" class="minText" /> Libellé :
					<textarea class="trenteCinq" name="libel[]" cols="30" rows="10"></textarea>
					Valeur :
					<textarea class="trenteCinq" name="val[]" cols="30" rows="10"></textarea>
					Supprimer ? <input type="checkbox" name="del[]" disabled="disabled"
						value="" />
				</p>
				{/if} {foreachelse} {*
				<p>
					<input type="hidden" name="type[]"
						value="{$tc->getIdTypeChampsContact()}" /><input type="hidden"
						name="id[]" value="" />Position : <input type="text" name="pos[]"
						value="" class="minText" />Libellé : <input type="text" value=""
						name="libel[]" /> Valeur : <input type="text" value=""
						name="val[]" /> Supprimer ? <input type="checkbox" name="del[]"
						disabled="disabled" value="" />
				</p>
				*}
				<p class="bulle">
					<input type="hidden" name="type[]"
						value="{$tc->getIdTypeChampsContact()}" /><input type="hidden"
						name="id[]" value="" />Position : <input type="text" name="pos[]"
						value="" class="minText" /> Libellé :
					<textarea class="trenteCinq" name="libel[]" cols="30" rows="10"></textarea>
					Valeur :
					<textarea class="trenteCinq" name="val[]" cols="30" rows="10"></textarea>
					Supprimer ? <input type="checkbox" name="del[]" disabled="disabled"
						value="" />
				</p>
				{/foreach} {* Permet l'ajout de lignes multiple si js existe*}
				<div class="jsAddLinkNewLine" rel="{$tc->getIdTypeChampsContact()}"></div>

			</div>
			{/foreach}

		</div>
	</div>
	<div class="colDte">
		<p>
			<input type="submit" value="Valider" name="valid" />
		</p>
		<p>
			<input type="submit" value="Valider et retourner à la fiche"
				name="validAndQuit" />
		</p>
		<p>
			<input type="submit" value="Annuler" name="cancel" />
		</p>
	</div>
</form>
</div>
