<div id="listPasserelleForExport">
	<form action="" method="post">
		{foreach from=$listPasserelle item=p}
		<p>
			<label for="{$p->getName()}">{$p->getName()} <input type="checkbox"
				{if $p->isLinked($mandate)} checked="checked" {/if}
				name="nomPasserelle[]" value="{$p->getIdPasserelle()}"
				id="{$p->getName()}" /> </label>
		</p>
		{/foreach}
		<p>
			<input type="submit" name="goListExport" value="Valider" />
		</p>
	</form>
</div>
