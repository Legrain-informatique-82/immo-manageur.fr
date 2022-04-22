<?php /* Smarty version Smarty-3.0.6, created on 2014-09-19 13:17:40
         compiled from "/var/www/aptana/immo-manageur.fr/modules/documents/views/editor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1642879445541c10d4094df4-86529305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b891ae2f4f3bfb87dc27e32477ab015398133dd1' => 
    array (
      0 => '/var/www/aptana/immo-manageur.fr/modules/documents/views/editor.tpl',
      1 => 1411125458,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1642879445541c10d4094df4-86529305',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-8">
    <p class="help-block"> Liste des mots clefs que vous pouvez utilisez dans vos documents : </p>
    <div id="tabs">
        <ul>
            <li><a href="#general">general</a></li>
            <li><a href="#vendeurs">Vendeurs</a></li>
            <li><a href="#biens">Biens</a></li>
            <li><a href="#acquereurs">Acquereurs</a></li>
            <li><a href="#notairesacq">Notaires acquereurs</a></li>
            <li><a href="#notairesvds">Notaires vendeurs</a></li>
        </ul>
        <div id="general">
            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[date_jour]</li>
                        <li class="list-group-item">[nom_demarcheur]</li>
                        <li class="list-group-item">[prenom_demarcheur]</li>
                        <li class="list-group-item">[email_demarcheur]</li>
                        <li class="list-group-item">[telephone_demarcheur]</li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[agence_demarcheur]</li>
                        <li class="list-group-item">[adresse_agence_demarcheur]</li>
                        <li class="list-group-item">[code_postal_agence_demarcheur]</li>
                        <li class="list-group-item">[ville_agence_demarcheur]</li>
                        <li class="list-group-item">[tel1_agence_demarcheur]</li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[tel3_agence_demarcheur]</li>
                        <li class="list-group-item">[email_agence_demarcheur]</li>
                        <li class="list-group-item">[contact_agence_demarcheur]</li>
                        <li class="list-group-item">[siret_agence_demarcheur]</li>
                        <li class="list-group-item">[capital_agence_demarcheur]</li>

                    </ul>
                </div>

            </div>
        </div>
        <div id="vendeurs">

            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[titre_vendeur]</li>
                        <li class="list-group-item">[nom_vendeur]</li>

                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[prenom_vendeur]</li>
                        <li class="list-group-item">[adresse_vendeur]</li>

                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[code_postal_vendeur]</li>
                        <li class="list-group-item">[ville_vendeur]</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="biens">

            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[type_bien]</li>
                        <li class="list-group-item">[type_transaction_bien]</li>
                        <li class="list-group-item">[nature_accord_bien]</li>
                        <li class="list-group-item">[numero_mandat]</li>
                        <li class="list-group-item">[valeur_GES_bien]</li>
                        <li class="list-group-item">[valeur_CES_bien]</li>
                        <li class="list-group-item">[prix_fai]</li>
                        <li class="list-group-item">[prix_garage]</li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[prix_cave]</li>
                        <li class="list-group-item">[prix_net_vendeur]</li>
                        <li class="list-group-item">[commission]</li>
                        <li class="list-group-item">[marge_negoce]</li>
                        <li class="list-group-item">[estimation_mini]</li>
                        <li class="list-group-item">[estimation_maxi]</li>
                        <li class="list-group-item">[loyer] (si locataire) </li>
                        <li class="list-group-item">[rentabilite]</li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[adresse_bien]</li>
                        <li class="list-group-item">[code_postal_bien]</li>
                        <li class="list-group-item">[ville_bien]</li>
                        <li class="list-group-item">[secteur_bien]</li>
                        <li class="list-group-item">[date_debut_mandat]</li>
                        <li class="list-group-item">[date_fin_mandat]</li>
                        <li class="list-group-item">[date_libre_mandat]</li>
                        <li class="list-group-item">[numero_lot_mandat]</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="acquereurs">

            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[titre_acquereur]</li>
                        <li class="list-group-item">[nom_acquereur]</li>

                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[prenom_acquereur]</li>
                        <li class="list-group-item">[adresse_acquereur]</li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[code_postal_acquereur]</li>
                        <li class="list-group-item">[ville_acquereur]</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="notairesacq">

            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[nom_notaire_acquereur]</li>
                        <li class="list-group-item">[prenom_notaire_acquereur]</li>
                        <li class="list-group-item">[adresse_notaire_acquereur]</li>

                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[code_postal_notaire_acquereur]</li>
                        <li class="list-group-item">[ville_notaire_acquereur]</li>
                        <li class="list-group-item">[tel_notaire_acquereur]</li>

                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[tel_portable_notaire_acquereur]</li>
                        <li class="list-group-item">[tel_travail_notaire_acquereur]</li>
                        <li class="list-group-item">[fax_notaire_acquereur]</li>
                        <li class="list-group-item">[email_notaire_acquereur]</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="notairesvds">

            <div class="row">
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[nom_notaire_vendeur]</li>
                        <li class="list-group-item">[prenom_notaire_vendeur]</li>
                        <li class="list-group-item">[adresse_notaire_vendeur]</li>

                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[code_postal_notaire_vendeur]</li>
                        <li class="list-group-item">[ville_notaire_vendeur]</li>
                        <li class="list-group-item">[tel_notaire_vendeur]</li>

                    </ul>
                </div>
                <div class="col-xs-4">
                    <ul class="list-group">
                        <li class="list-group-item">[tel_portable_notaire_vendeur]</li>
                        <li class="list-group-item">[tel_travail_notaire_vendeur]</li>
                        <li class="list-group-item">[fax_notaire_vendeur]</li>
                        <li class="list-group-item">[email_notaire_vendeur]</li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
<div class="form-group">

    <label for="cdoc" class="col-sm-2 control-label">Contenu de votre document</label>
    <div class="col-sm-8">
        <textarea class="editor_document" id="cdoc" name="content"  cols="30" rows="10"><?php echo $_smarty_tpl->getVariable('content')->value;?>
</textarea>

    </div>
</div>
