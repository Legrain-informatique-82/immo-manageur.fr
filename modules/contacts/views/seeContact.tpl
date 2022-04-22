{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
<form action="" method="post">
	<div class="quatreVingt">
		<div class="accordion">
		<h2><a href="#">Catégories</a></h2>
		<div>
		{foreach from=$categories item=cat name=boucle}
			{if $smarty.foreach.boucle.first} <p>Catégorie(s) associée(s) au contact :  </p> {/if}
		<p class="inlineBlock bulle">{$cat->getName()}</p>
		{foreachelse}
		<p>Aucune catégorie associée à ce contact</p>
		{/foreach}

</div>
			{foreach from=$listTC item=tc}
			<h2>
				<a href="#">{$tc->getLibel()}</a>
			</h2>
			<div>

				{foreach name=boucle from=$listCC[$tc->getIdTypeChampsContact()]
				item=cc}
				<p>{$cc->getLibel()} : {$cc->getVal()}</p>
				{/foreach}
			</div>
			{/foreach}

		</div>
	</div>
	<div class="colDte">
		<p>
			<a 
				href="{Tools::create_url($user,'contacts','upd',$smarty.get.action)}">Modifier
				le contact</a>
		</p>
		<p>
			<a
				href="{Tools::create_url($user,'contacts','del',$smarty.get.action)}">supprimer
				le contact</a>
		</p>
		<p>
			<a href="{Tools::create_url($user,'contacts','list')}">Revenir à la
				liste</a>
		</p>

	</div>
</form>
</div>
