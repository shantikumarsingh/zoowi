<?php 
	require_once(__DIR__.'/protected/settings/settings.php');
	require_once(__DIR__."./protected/settings/ConnectionFactory.php");
	$config = array(
		'AuthenticateManager' => __DIR__.'/protected/Services/AuthenticateManager/AuthenticateManager.php',
		'AuthenticateManagerConstants' => __DIR__.'/protected/Services/AuthenticateManager/AuthenticateManagerConstants.php',
		'Countries' => __DIR__.'/protected/Services/Countries/Countries.php',
		'UserBusinessServices' => __DIR__.'/protected/Services/business/user/UserBusinessServices.php',
		'UserDataServices' => __DIR__.'/protected/Services/data/user/UserDataServices.php',
		'UtilityManager' => __DIR__.'/protected/application/Utils/UtilityManager.php',
	);	
	
	
	
	/** 
		loading Classes From Array
	*/
	foreach ($config as $key=> $conf){
		require_once ($conf);
	}