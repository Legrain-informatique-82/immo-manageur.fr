
 {counter start=0 print=false assign=compt}
   

  {if !$isCompromis}
  {counter}
  <div class="mSep">
 <h3>Affiches</h3>
<ul>
<li><a target="_blank"
		href="{Tools::create_url($user,'documents','afficheEscalTerrain',$smarty.get.action)}">Affiche
			classique</a></li>
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','afficheEscalTerrainExclu',$smarty.get.action)}">Affiche
			exclu</a>
	</li>
		<li><a target="_blank"
		href="{Tools::create_url($user,'documents','afficheEscalTerrainNouv',$smarty.get.action)}">Affiche
			nouveauté</a>
	</li>
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','afficheEscalTerrainVendu',$smarty.get.action)}">Affiche
			vendu par escalimmo</a>
	</li> </ul>
	</div>
	{/if}
<ul>
	
	
{if $isCompromis}
	  {counter}
	<div class="mSep">
	<h3>Etude de maître</h3>
	<ul>
	
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','etudeMaitreAcquereurs',$smarty.get.action)}">Acquereurs</a></li>
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','etudeMaitreVendeur',$smarty.get.action)}">Vendeurs</a></li>
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','etudeMaitreVA',$smarty.get.action)}">Vendeurs et acquereurs</a></li>
			</ul></div>
			{/if}
	{if $compt %2 == 0}
	<hr class="invi clear" />
	{/if}
	
	
	
	<div class="mSep">
	  {counter}
	<h3>Documents vendeurs</h3>
	<ul>
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','vendeur1',$smarty.get.action)}">Courrier envoi comp.</a>
	</li>
	{if !$isCompromis}
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','lettre_renouvellement_vendeur',$smarty.get.action)}">Lettre
			renouvellement vendeur</a></li>

	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','lettre_envoi_vendeur',$smarty.get.action)}">Lettre
			envoi vendeur</a></li>
					{/if}
			<li><a target="_blank"
		href="{Tools::create_url($user,'documents','estimation_bien',$smarty.get.action)}">Lettre estimation du bien</a></li>
		<li><a target="_blank" href="{Tools::create_url($user,'documents','lettre_mandat',$smarty.get.action)}">Lettre mandat</a></li>
		<li><a target="_blank" href="{Tools::create_url($user,'documents','avenant_modif_type',$smarty.get.action)}">Avenant modificatif de type</a></li>
		<li><a target="_blank" href="{Tools::create_url($user,'documents','avenant_baisse_prix',$smarty.get.action)}">Avenant baisse de prix</a></li>
	</ul>
	</div>
	{if $compt %2 == 0}
	<hr class="invi clear" />
	{/if}
	
	
	
	
	 {if $isCompromis}
	<div class="mSep">
	  {counter}
	<h3>Documents acquereurs</h3>
	<ul>

			
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','compte_rendu_simple',$smarty.get.action)}">Compte
			rendu simple</a></li>
	<li><a target="_blank"
		href="{Tools::create_url($user,'documents','envoi_comp_acq',$smarty.get.action)}">Envoi
			comp acquereur</a></li>
			
			
	<li><a target="_blank" href="{Tools::create_url($user,'documents','avenant_modif_acq',$smarty.get.action)}">Avenant modif. acquereur</a></li> 
	<li><a target="_blank" href="{Tools::create_url($user,'documents','lettreSru',$smarty.get.action)}">Lettre SRU</a></li>
	</ul>
	</div>	
	{/if}
	{if $compt %2 == 0}
	<hr class="invi clear" />
	{/if}
<div class="mSep">
	  {counter}
	<h3>Documents mandat</h3>
	<ul>
		<li><a target="_blank"
		href="{Tools::create_url($user,'documents','fiche_photo',$smarty.get.action)}">Fiche photo</a></li>	
{*<li><a target="_blank" href="{Tools::create_url($user,'documents','fiche_acq',$smarty.get.action)}">Fiche acquereur</a></li>*} 

			
	</ul>
	</div>		
<hr class="clear invi" />
	