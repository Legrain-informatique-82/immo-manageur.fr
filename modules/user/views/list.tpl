{include file="tpl_default/entete.tpl"}


<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2"> Liste des utilisateurs</h1>
    </div>
    <div class="col-md-6">
        <p class="h4 text-right ">
            <a title="Ajouter un utilisateur" class="btn btn-success" href="{Tools::create_url($user,"user","add")}"> <i class="fa fa-plus-circle fa-2x"></i></a>
        </p>
    </div>
</div>



	<table class="dataTableDefault table table-striped table-bordered">
		<thead>
        <tr class="tri">
            <th class="jshide"></th>
            <th class="jshide"></th>
            <th></th>
            <th></th>
            <th class="jshide"></th>
        </tr>
			<tr>
				<th>Identifiant</th>
				<th>Nom &amp; prénom</th>
				<th>Agence</th>
				<th>Niveau de membre</th>

				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$listUsers item=u}
			<tr>
				<td>{$u.identifiant}</td>
				<td>{$u.name}</td>
				<td>{$u.agency}</td>
				<td>{$u.levelMember}</td>

				<td>

                    <div class="btn-group">

                        <a class="btn  btn-default" href="{$u.urlSee}" title="{Lang::LABEL_SEE}" {if $user->getOpenInNewTab()} target="_blank"{/if}><i class="fa fa-chevron-circle-right"></i> {Lang::LABEL_SEE} </a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        {if $user->getLevelMember()->getIdLevelMember() eq 1 or $user->getIdUser() eq $u.idUser}
                        <ul class="dropdown-menu" role="menu">

                            <li><a href="{$u.urlUpdate}" title="{Lang::LABEL_UPDATE}"><i class="fa fa-pencil-square-o"></i> {Lang::LABEL_UPDATE}</a></li>

                            {if $user->getLevelMember()->getIdLevelMember() eq 1 and $user->getIdUser() neq $u.idUser}
                            <li><a class="jsdelUser" rel="{$u.idUser}" href="{$u.urlDelete}" title="{Lang::LABEL_DELETE}"><i class="fa fa-trash"></i> {Lang::LABEL_DELETE}</a></li>
                            {/if}
                        </ul>
                        {/if}
                    </div>


                </td>
			</tr>
			{/foreach}
		</tbody>
	</table>


</div>

