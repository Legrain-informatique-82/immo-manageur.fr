{include file='tpl_default/entete.tpl'}

<form action="" method="post" role="form" class="form-horizontal">
    <div class="row bg-success bannerTitle">
        <div class="col-md-6">
            <h1 class="h2">{$h1}</h1>
        </div>
        <div class="col-md-6">
            <p class="h4 text-right ">
                {*
                <button type="submit" name="confirm" value="Oui" class="btn btn-danger" title="{Lang::LABEL_DELETE}">
                    <i class="fa fa-trash fa-2x"></i>
                </button>
                <button type="submit" name="cancel_delete_picture" value="Non" class="btn btn-default" title="{Lang::LABEL_CANCEL}">
                    <i class="fa fa-close fa-2x"></i>
                </button>
*}
            </p>
        </div>
    </div>
    <div class="well" id="blocDoc">
        <p>Vous pouvez :</p>
        <ul>
            <li>Souligner un mot ou groupe de mots en l'encadrant de balise
                &lt;u&gt; et &lt;/u&gt; : &lt;u&gt; Phrase à souligner. &lt;/u&gt;
                donnera <u>Phrase à souligner.</u></li>
            <li>Mettre en italique un mot ou groupe de mots en l'encadrant de
                balise &lt;i&gt; et &lt;/i&gt; : &lt;i&gt; Phrase en italique.
                &lt;/i&gt; donnera <i>Phrase en italique.</i></li>
            <li>Mettre en gras un mot ou groupe de mots en l'encadrant de balise
                &lt;b&gt; et &lt;/b&gt; : &lt;b&gt; Phrase en gras. &lt;/b&gt; donnera
                <b>Phrase en gras.</b></li>
            <li>Mettre en gras et en italique un mot ou groupe de mots en
                l'encadrant de balise &lt;bi&gt; et &lt;/bi&gt; : &lt;bi&gt; Phrase en
                gras et en italique. &lt;/bi&gt; donnera <b><i>Phrase en gras et en
                        italique.</i> </b></li>
            <li>Mettre en gras souligné un mot ou groupe de mots en l'encadrant de
                balise &lt;bu&gt; et &lt;/bu&gt; : &lt;bu&gt; Phrase en gras souligné.
                &lt;/bu&gt; donnera <b><u>Phrase en gras souligné.</u> </b></li>
            <li>Mettre en italique souligné un mot ou groupe de mots en l'encadrant
                de balise &lt;iu&gt; et &lt;/iu&gt; : &lt;iu&gt; Phrase en italique
                souligné. &lt;/iu&gt; donnera <u><i>Phrase en italique souligné.</i> </u>
            </li>
            <li>Mettre en gras italique souligné un mot ou groupe de mots en
                l'encadrant de balise &lt;biu&gt; et &lt;/biu&gt; : &lt;biu&gt; Phrase
                en gras italique souligné. &lt;/biu&gt; donnera <b><u><i>Phrase en
                            gras italique souligné.</i> </u> </b></li>
            <li>les tags &lt;titreVendeur&gt; &lt;nomVendeur&gt;
                &lt;prenomVendeur&gt;
                &lt;debutMandat&gt;,&lt;typeBien&gt;,&lt;prenomDemarcheur&gt;,&lt;nomDemarcheur&gt;
                sont remplacés par le titre, le nom, le prénom du vendeur, la date du
                début de mandat,Le type de bien;Le prénom du démarcheur,le nom du
                démarcheur.</li>
        </ul>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label" for="dateDoc">Date du document :</label>
        <div class="col-sm-8">
            <input type="text" value="{$dateDoc}" name="dateDoc" id="dateDoc" class="datepicker form-control" />
        </div>

    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="sizeTypo">Taille de la police :  </label>
        <div class="col-sm-8">
            <select name="sizeTypo" id="sizeTypo" class="form-control">
                <option {if $sizeTypo eq 10} selected="selected" {/if} value="10">10</option>
                <option {if $sizeTypo eq 12} selected="selected" {/if}  value="12">12</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"for="corps">Corps :</label>
        <div class="col-sm-8">
            <textarea name="corps" id="corps" class="form-control" cols="30" rows="10">{$corps}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="signature">Signature : </label>
        <div class="col-sm-8">
            <textarea class="form-control" name="signature" cols="30" rows="10" id="signature">{$signature}</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" name="generate" value="Generer" class="btn btn-default" >
            <i class="fa fa-print"></i> Générer
        </button>
    </div>
        </div>
</form>



