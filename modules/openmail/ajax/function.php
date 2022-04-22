<?php

function loadPjs($token){
    $return='<h2>Pièce(s) jointe(s) :</h2>';
    $totalFilesize = 0;
    if(!empty($_SESSION['emails_pj'][$token])){
        foreach($_SESSION['emails_pj'][$token] as $key => $pj){
            $totalFilesize+=$pj['filesize'];

            $return.='<div class="well">';
            $return.='<div class="row">';
             $return.='<div class="col-md-6">';
            $return.='<a href="'.Constant::DEFAULT_URL.'/modules/openmail/script/downloadpj.php?index='.$key.'&amp;token='.$token.'" target="_blank">'.$pj['filename'].' </a>';
            $return.='</div><div class="col-md-6 text-right"> '. Tools::format_bytes(  $pj['filesize']).' ';
            $return.=' <input type="checkbox" name="delpj[]" id="delpj_'.$key.'" value="'.$key.'"/>';
            $return.='<label for="delpj_'.$key.'"><img src="'.Constant::DEFAULT_URL.'/images/trash.png" alt="Supprimer la pièce jointe"/></label>
     </div></div></div>';
        }
        $return.='<div id="piedPagePj"  class="row"><div class="col-md-6"><p>Poids total des pièces jointes : '.Tools::format_bytes($totalFilesize).' </p></div>';
        $return.='<div class="col-md-6 text-right"><button id="submitDeleteSendEmail" type="submit" name="submitDelPj" value="Supprimer les pièces jointes sélectionnées" class="btn btn-danger"><i class="fa fa-trash"></i> Supprimer les pièces jointes sélectionnées</button></div></div>';
    }else{
        $return.=' <p>Aucune pièce jointe</p>';
    }

    return $return;
}