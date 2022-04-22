<?php

// retaille les images dans les repertoires normal et thumb de mandat et terrain.
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/Tools.php';

// image normale fait en moyenne 30ko (ne doit pas commencer par plan)
// thumb 22k0 max
/**
 * Fonction res définie dessous
 */
res(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'mandat/*',Constant::SIZE_X_PICTURE,Constant::SIZE_Y_PICTURE,'55000');
res(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'terrain/*',Constant::SIZE_X_PICTURE,Constant::SIZE_Y_PICTURE,'55000');
res(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'mandat/thumb/*',Constant::SIZE_THUMB_X_PICTURE,Constant::SIZE_THUMB_Y_PICTURE,'22000');
res(Constant::DEFAULT_PICTURE_MODULE_DIRECTORY.'terrain/thumb/*',Constant::SIZE_THUMB_X_PICTURE,Constant::SIZE_THUMB_Y_PICTURE,'22000');
/**
 *
 * Enter description here ...
 * @param String $directory
 * @param Int $x
 * @param Int $y
 * @param Int $sizeCondition
 *
 */
function res($directory,$x,$y, $sizeCondition){
	foreach( glob( $directory) as $file  ){
		if(is_file($file)){
			$name = explode('/',$file);
			$max = count($name);
			// si le nom de l'image ne commence par par plan ET qu'il ne fait pas plus de la size Condition
			if(substr($name[$max-1],0,5)!='plan-' && filesize($file) >= $sizeCondition ){
				Tools::redimentionne($file, $x, $y);
			}

		}
	}
}