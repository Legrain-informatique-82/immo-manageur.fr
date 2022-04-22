{include file='tpl_default/entete.tpl'}
<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2"> {$title}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">

                <button type="submit" name="send" value="Generer" class="btn btn-default">
                    <i class="fa fa-print fa-2x"></i>
                </button>


            </p>
        </div>
    </div>

    <div class="well">
	<ul>
	<li>Pour changer la position d'une photo, modifier le numéro présent sous celle-ci.</li>
	<li>Pour ne pas imprimer une photo, supprimez le numéro présent sous celle-ci</li>
	</ul>
    </div>

    <div class="col-sm-offset-2 col-sm-8">

        {foreach from=$listPictures item=i name=boucle}


        {if $smarty.foreach.boucle.index %3 ==0}
        {if !$smarty.foreach.boucle.first}</div>{/if}
    <div class="row">
        {/if}

        <div class="col-md-4 text-center">
            <img src="{$chemImage}thumb/{$i.name}" alt="" class="img-thumbnail" />
            <input  class="form-control" type="text" name="position_{$i.idPhoto}" value="{$smarty.foreach.boucle.iteration}" placeholder="position de la photo (ex : {$smarty.foreach.boucle.iteration} )"/>
            <p></p>
        </div>

        {/foreach}
    </div>







    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
			<button type="submit" name="send" value="Generer" class="btn btn-default">
                <i class="fa fa-print"></i> Générer
			</button>
		</div>
        </div>
	</form>
	</div>

