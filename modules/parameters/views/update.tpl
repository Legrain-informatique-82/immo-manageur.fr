{include file="tpl_default/entete.tpl"}

<form action="" method="post" class="form-horizontal">
<div class="row bg-success bannerTitle">
    <div class="col-md-6">
        <h1 class="h2">Paramètres généraux :</h1>
    </div>

    <div class="col-md-6">
       <p class="h4 text-right">
           <button type="submit" class="btn btn-success" name="send">
               <i class="fa fa-save fa-2x"></i>
           </button>
       </p>


    </div>

</div>
{include file="tpl_default/viewsErrors.tpl"}

    <fieldset>
        <legend>Habitats et terrains : </legend>
        <h2>Alerte : mandats en couleur rouge</h2>
        <p><label for="N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1">Nombre de jours avant que les mandats arrivent à échéance : </label><input type="text" name="N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1" id="N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1" value="{$N_DAYS_BEFORE_WARRANT_EXPIRE_ALERT_1}"/></p>


        <h2>Alerte : mandat couleur violet</h2>
        <p><label for="N_DAYS_AFTER_WARRANT_CREATION_ALERT_1">Création du mandat comprise entre : </label><input type="text" name="N_DAYS_AFTER_WARRANT_CREATION_ALERT_1" id="N_DAYS_AFTER_WARRANT_CREATION_ALERT_1" value="{$N_DAYS_AFTER_WARRANT_CREATION_ALERT_1}"/>
         <label for="N_DAYS_AFTER_WARRANT_CREATION_ALERT_2"> et : </label><input type="text" name="N_DAYS_AFTER_WARRANT_CREATION_ALERT_2" id="N_DAYS_AFTER_WARRANT_CREATION_ALERT_2" value="{$N_DAYS_AFTER_WARRANT_CREATION_ALERT_2}"/> jours.</p>
    </fieldset>
    <fieldset>
        <legend>Api Open-mail : </legend>
        <p><label for="identifiant_opm">Identifiant Open-Mail : </label><input type="text" value="{$identifiant_opm}" name="identifiant_opm" id="identifiant_opm"/></p>
        <p><label for="password_opm">Mot de passe Open-Mail : </label><input type="text" name="password_opm" value="{$password_opm}" id="password_opm"/></p>
    </fieldset>
    <fieldset>
        <legend>Export Facebook : </legend>
        <p><label for="id_app_fb">Id App Facebook : </label><input type="text" name="id_app_fb" value="{$id_app_fb}" id="id_app_fb"/></p>
        <p><label for="id_secret_fb">App Secret Facebook : </label><input type="text" name="id_secret_fb" value="{$id_secret_fb}" id="id_secret_fb"/></p>
    </fieldset>
    <p><input type="submit" value="Valider" name="send"/></p>
</form>
</div>
