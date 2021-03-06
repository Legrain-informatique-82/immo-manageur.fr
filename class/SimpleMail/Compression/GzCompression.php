<?php
require_once ('iCompression.php');
/**
 * Use the Gz Compression
 *
 * @package Compression
 * @filesource GzCompression.php
 *
 * @author Cyril Nicodème
 * @version 0.1
 *
 * @since 15/07/2008
 *
 * @license GNU/GPL
 */
class GzCompression implements iCompression {
	/**
	 * Constructor
	 * Used to check if the extensions exists
	 *
	 * @throws NotFoundException
	 */
	public function __construct () {
		if (!function_exists ('gzencode'))
		throw new Exception ('Gz extensions is missing');
	}

	/**
	 * Compress the given value to the specific compression
	 *
	 * @param String $sValue
	 * @param String $iLevel (Optionnal) : Between 0 and 9
	 *
	 * @return String
	 *
	 * @throws Exception
	 */
	public function compress ($sValue, $iLevel = null) {
		if (!is_string ($sValue))
		throw new Exception ('Invalid first argument, must be a string');

		if (isset ($iLevel) && !is_int ($iLevel))
		throw new Exception ('Invalid second argument, must be an int');

		if ($iValue < 0 || $iValue > 9)
		throw new Exception ('Invalid second argument, must be between 0 and 9');

		return gzencode ($sValue, $iLevel);
	}

	/**
	 * Decompress the given value with the specific compression
	 *
	 * @param String $sValue
	 *
	 * @return String
	 *
	 * @throws Exception
	 */
	public function decompress ($sValue) {
		if (!is_string ($sValue))
		throw new Exception ('Invalid first argument, must be a string');

		return gzdecode ($sValue);
	}
}
?>