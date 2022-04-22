<?php
/**
 *  Gere les exports, mets les date +1 dans un zip, et supprime les zip de plus de 6 jours.
 */
require_once dirname(__FILE__).'/../libs/php_functions_missing.php';
require_once dirname(__FILE__).'/../const/config.php';
require_once dirname(__FILE__).'/../class/interfaceController.php';
require_once dirname(__FILE__).'/../class/CoreController.class.php';
require_once dirname(__FILE__).'/../class/Tools.php';


foreach( glob(dirname(__FILE__).'/../modules/*/model/requires.php') as $require){
	require_once $require;
}

// Récupération de tout les fichiers
foreach( glob( Constant::DEFAULT_LOGS_DIRECTORY.'exports/*') as $i){


	// On explode le tout
	$nameOfDir = explode('/',$i);
	$lastElem = $nameOfDir[count($nameOfDir)-1];
	// date de la veille strftime("%Y%m%d", mktime(0, 0, 0, date('m'), date('d')-1, date('Y')) )
	if( $lastElem <= strftime("%Y%m%d", mktime(0, 0, 0, date('m'), date('d')-4, date('Y')) ) ){
		// delete
		recursive_rmdir($i );
	}
}

function recursive_rmdir($dirname, $followLinks = false)
{
	if (is_dir($dirname) && !is_link($dirname))
	{
		if (!is_writable($dirname))
		throw new Exception('You do not have renaming permissions!');

		$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($dirname),
		RecursiveIteratorIterator::CHILD_FIRST
		);

		while ($iterator->valid())
		{
			if (!$iterator->isDot())
			{
				if (!$iterator->isWritable())
				{
					throw new Exception(sprintf(
                        'Permission Denied: %s.',
					$iterator->getPathName()
					));
				}
				if ($iterator->isLink() && false === (boolean) $followLinks)
				{
					$iterator->next();
				}
				if ($iterator->isFile())
				{
					unlink($iterator->getPathName());
				}
				else if ($iterator->isDir())
				{
					@rmdir($iterator->getPathName());
				}
			}

			$iterator->next();
		}
		unset($iterator); // Fix for Windows.

		return rmdir($dirname);
	}
	else
	{
		throw new Exception(sprintf('Directory %s does not exist!', $dirname));
	}
}