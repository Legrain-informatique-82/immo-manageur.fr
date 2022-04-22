<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 20/08/14
 * Time: 11:39
 */

class Validforms {

    /**
     *
     * @return array
     */
    static public function validFormSendOneSms($expediteur,$dest,$date,$name,$message){
        $error=array();
        if($dest==""){$error[]="Vous devez saisir au moins un destinataire.";}


        if($message==""){$error[]="Vous ne pouvez pas envoyer un sms vide";}
        return $error;
    }


    /**
     *
     * @return array
     */
    static public function validFormSendOneEmail($dest,$subject,$date,$name,$message){
        $error=array();
        if($dest=='')$error[]='Un destinataire au minimum doit être renseigné.';
        if($subject=='')$error[]='Le sujet de l\'e-mail doit être renseigné.';
        if($message=='')$error[]='Le contenu de votre e-mail ne doit pas être vide.';
        if($dest!=''){
            foreach( explode(';',$dest) as $em){
                if(!Tools::isEmail($em)) $error[]='L\'adresse e-mail : '.$em.' est incorrecte.';
            }
        }
        return $error;
    }


} 