<?php
/**
 * This is the settings file
 * @var unknown
 */

 // please change the database and the password according to the DB Settings.
	// host, user and password
	define('HOST_ADDRESS','localhost');
	define('HOST_USER','root');
	define('HOST_USER_PASS','password');
	// database
	define('DB_NAME','zoowi');
	//database settings to connect slave database
	define('MASTER_DB_HOST',HOST_ADDRESS);
	define('MASTER_DB_USER',HOST_USER);
	define('MASTER_DB_PASS',HOST_USER_PASS);
	define('MASTER_DB_PLATFORM_DBNAME',DB_NAME);
?>
