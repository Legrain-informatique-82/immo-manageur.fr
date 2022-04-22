{include file="tpl_default/entete.tpl"}
<h1>{$title}</h1>
<div class="bulle">
<p>Êtes-vous certain de vouloir supprimer la catégorie {$cat->getNAme()}</p>
{if $listContact}
<p>Elle est actuellement utilisée par : </p>
<ul>
{foreach $listContact as $c}
<li>{$c}</li>
{/foreach} 
</ul>
{else}
<p>Cette catégorie n'est pas utilisée</p>
{/if}

<form action="" method="post">
<p><input type="submit" value="Confirmer" name="submit"/> <input type="submit" value="Annuler" name="cancel"/></p>
</form>
</div>
</div>