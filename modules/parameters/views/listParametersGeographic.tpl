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
        <td>Secteurs</td>
        <td> <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_sectors')}">Gérer</a></td>
    </tr>
    <tr>
        <td>Villes</td>
        <td>
            <a class="btn btn-default" href="{Tools::create_url($user,'parameters','list_cities')}">Gérer</a>

        </td>
    </tr>

    </tbody>
</table>

</div>