{include file="tpl_default/entete.tpl"}
<div class="row bg-success bannerTitle">
    <div class="col-md-12">
        <h1 class="h2">{$title}</h1>
    </div>

</div>

<p>Ci dessous, la liste de tous les paramètres relatifs aux mandats et aux terrains</p>
<table class="standard table table-bordered table-striped">
    <thead>
    <tr>
        <th>Paramètres</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Bornages terrain</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_bornage_terrain')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Orientations</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_orientation')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Pentes</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_slope')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Zonage PLU</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_plu')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Zonage RNU</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_rnu')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Géometres</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_geometer')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Correspondant eau</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_water_corresponding')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Correspondant électicité</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_electric_corresponding')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Correspondant gaz</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_gaz_corresponding')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Correspondant assainissement</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_sanitation_corresponding')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Options COS</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_cos')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Options isolations</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_insulation')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Options de toiture</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_roof')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Options de chauffage</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_heating')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Options des parties communes</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_commonOwnership')}">Gérer</a>
        </td>
    </tr>
    <tr>
        <td>Option du type de construction</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_constructionType')}">Gérer</a>
        </td>
    </tr>
 <tr>
        <td>Option de style</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_style')}">Gérer</a>
        </td>
    </tr>
<tr>
        <td>Option de nouveautés</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_news')}">Gérer</a>
        </td>
    </tr>
<tr>
        <td>Options de condition</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_condition')}">Gérer</a>
        </td>
    </tr>
<tr>
        <td>Nature</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_nature')}">Gérer</a>
        </td>
    </tr>

    </tbody>
</table>

</div>