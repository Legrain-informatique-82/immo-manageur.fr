{include file="tpl_default/entete.tpl"}


<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">{$title}</h1>
    </div>

    <div class="col-md-6">
        <p class="h4 text-right ">

            <a title="Ajouter une agence" class="btn btn-success" href="{Tools::create_url($user,"user","addAgency")}">
                <i class="fa fa-plus-circle fa-2x"></i>
            </a>
        </p>
    </div>
</div>

	{foreach name="arrayLog" from=$agencies item=line}
	
	 {if $smarty.foreach.arrayLog.first}
	<table class="dataTableDefault table table-striped table-bordered">
		<thead>
			<tr>
				<th>Contact</th>
				<th>Nom de l'agence (interne)</th>
				<th>Téléphone(s)</th>
				<th>Email</th>
				<th>Adresse</th>
				<th>Modifier</th>
			</tr>
		</thead>
		<tbody>
			{/if}
			<tr>
				<td>{$line->getContact()|default:NC}</td>
				<td>{$line->getName()}</td>
				<td>
				{if $line->getTel1()}<p>Tél 1 : {$line->getTel1()}</p>{/if}
				{if $line->getTel2()}<p>Tél 2 : {$line->getTel2()}</p>{/if}
				{if $line->getTel3()}<p>Tél 3 : {$line->getTel3()}</p>{/if}
				</td>
				<td>{$line->getEmail()|default:'NC'}</td>
				<td>
				<p>{$line->getAddress()}</p>
				<p>{$line->getZipCode()} {$line->getCity()}</p>
				</td>
				<td>
                    <a href="{Tools::create_url($user,'user','updAgency', $line->getIdAgency() )}" title="Modifier" class="btn btn-default">
                       <i class="fa fa-pencil-square-o"></i> Modifier
                    </a></td>
			</tr>
			{if $smarty.foreach.arrayLog.last}
		</tbody>
	</table>
	{/if} {/foreach}

</div>
