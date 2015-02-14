<?php
/**
 * @author Sunil Kumar
 * Created On 			: 
 * Update By			:
 * Updated On			:
 * Reviewed By			:
 * Reviewer Comments	:
 * File Comments		:
 * 
 */
class UserDataServices {
	
	private $dbConnection;
	function __construct(){
		$this->dbConnection =	new ConnectionFactory();
	}
	
	
	
	/**
	 * This function adds users into the website.
	 * @param unknown_type $userData
	 */
	public function registerUser($userData, $salt){
		
		$userName = 	$userData['inputEmail'];
		$firstName = 	$userData['inputFirstName'];
		$authKey = mb_strtoupper(str_shuffle(trim($firstName)));
		$authKey = 		(strlen($authKey)> 25 )?UtilityManager::trimStringToLength(($authKey), STRING_TRIM_LENGTH):$authKey;
		$lastName = 	$userData['inputLastName'];
		$password_hash = 	$userData['InputPassword'];
		$resetKey = 	$salt . str_shuffle(mb_strtoupper($password_hash));
		$country = 	$userData['Country'];
		$mobileNumber = 	$userData['InputPhoneNumber'];
		$status = 	STATUS_ACTIVE;
		$createdOn = 	'unix_timestamp(now())';
		$updatedOn = 	'unix_timestamp(now())';
		try{
			
			$isExists = self::isUserExists($userName);
			if(!$isExists ){
				
				$insertQuery = "insert into `user` ( username, auth_key, firstname, lastname, mobileno, password_hash, password_reset_token, country, status, createdon, updatedon) values( '$userName',  '$authKey',  '$firstName', '$lastName','$mobileNumber',md5('$password_hash'), '$resetKey', '$country',  '$status',  $createdOn, $updatedOn );";
				$queryResult 	=	$this->dbConnection->executeInsert(MASTER_DB_PLATFORM_DBNAME, $insertQuery);
				return true;
			}
			return false;
		} catch (Exception $exception){
			throw new DataServiceException(__CLASS__,__FUNCTION__,'Data Insertion Failed due to Some Technical Error',$exception);
		}		
	}
	/**
	 * 
	 * validate a user
	 * @param unknown_type $userName
	 * @param unknown_type $password
	 */
	public function validateUserExists($userName, $password){
		try{
			$fetchType=  PDO::FETCH_OBJ; 
			$userQuery = "select username, firstname, lastname, password_hash from user where username = '$userName' and password_hash = md5('$password')"; 
			$resultSet = $this->dbConnection->executeSelect(MASTER_DB_PLATFORM_DBNAME, $userQuery , $fetchType);
			return $resultSet[0];
		} catch (Exception $exception){
			throw new DataServiceException(__CLASS__,__FUNCTION__,'Unable to fetch Data',$exception);
		}
	}
	
	protected function isUserExists($userName){
		$fetchType=  PDO::FETCH_BOTH; 
		$userQuery = "select username from `user` where username = '$userName'";
		error_log(' Query ' .  $userQuery); 
		$resultSet = $this->dbConnection->executeSelect(MASTER_DB_PLATFORM_DBNAME, $userQuery , $fetchType);
		error_log(count($resultSet) . ' count ' . print_r($resultSet, true));
		if(count($resultSet)> 0 )
			return true; // record exists
		return false;
	} 
}