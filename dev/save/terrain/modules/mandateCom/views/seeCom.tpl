{if $elementMandateCom} {if $elementMandateCom->getOtherCom() !=''}
<div class="blocEnteteMandat">
	<h1>Observations :</h1>
	<p>{Tools::substr($elementMandateCom->getOtherCom(),0,250)} {if
		Tools::strlen( $elementMandateCom->getOtherCom() ) > 250} [...] {/if}
	</p>
</div>
{/if} {/if}
