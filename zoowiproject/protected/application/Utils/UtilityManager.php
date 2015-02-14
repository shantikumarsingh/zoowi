<?php
/**
 * 
 * @author Sunil Kumar
 * An Utility Class Used for this Application
 *
 */
class UtilityManager {
	
	function __construct(){
		
	}
	/**
	 * Returns the trimmed String trimmed upto the Length provided
	 * @param $stringToTrim
	 * @param $lengthToTrim
	 */
	public static function trimStringToLength($stringToTrim, $lengthToTrim){
		$trimmedString = substr($stringToTrim, 0, (-$lengthToTrim));
		return $trimmedString ;
	}
}