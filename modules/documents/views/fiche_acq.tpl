
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



    <div id="choosePicturegenerateAfficheMandate">
        <div class="col-sm-offset-2 col-sm-8">
        <p class="help-block">Choix de 3 vignettes :</p>

        {foreach from=$listOfPicture item=pict name=boucle}
            {if $smarty.foreach.boucle.index %3 ==0}
            {if !$smarty.foreach.boucle.first}</div>{/if}
        <div class="row">
            {/if}
            <div class="col-md-4 text-center">
                <label>
                    <p>
                        <img
                                src="{Constant::DEFAULT_URL_PICTURE_MODULE_DIRECTORY}{$module}/thumb/{$pict->getName()}"
                                alt="" class="img-thumbnail"/>
                    </p>
                    <p>
                        Sélectionner <input type="checkbox" class="arrayPicture"
                                            name="arrayPicture[]" value="{$pict->getName()}" />
                    </p> </label>
            </div>
        {/foreach}
            </div>
        </div>


   <div class="form-group">
       <div class="col-sm-offset-2 col-sm-8">
           <button type="submit" name="send" value="Generer" class="btn btn-default">
               <i class="fa fa-print"></i> Génerer
           </button>
           </div>
   </div>
        </div>
</div>

</form>
