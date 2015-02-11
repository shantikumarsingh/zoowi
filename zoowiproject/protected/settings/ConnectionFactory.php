<?php
/**
 * Connection Factory Method
 * Author 			: Sunil Kumar
 * created on		: 06-Feb-2015
 * Updated on		: 
 * Updated by		:
 */

/**
 * Database Connection Factory requires PDO to be enabled
 * @author Sunil Kumar
 */
class ConnectionFactory {
	/**
	 * @var ConnectionFactory Object
	 */
	private $dbConnection;
	public function getConnection($host,$database,$user,$password){
		try{
			$this->dbConnection = new PDO("mysql:host=".$host.";dbname=".$database, $user, $password);
			$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return true;
		}catch(PDOException $e){
			print "Error: ". $e->getMessage();
		}
	}
	/**
	 * 
	 * @param String $dbIdentifier
	 * @param String $insertQuery
	 * @return boolean
	 */
	function executeInsert($dbIdentifier, $insertQuery)
	{
		try {

			$this->getConnection(MASTER_DB_HOST,MASTER_DB_PLATFORM_DBNAME,MASTER_DB_USER,MASTER_DB_PASS);
			$stmt = $this->dbConnection->prepare($insertQuery);
			if (!$stmt->execute()) {
				print "Unable to execute query : $insertQuery";
				return false;
			}
			$this->closeConnection();
			return true;
		} catch (PDOException $e) {
				$this->closeConnection();
		}
	}
	/**
	 * 
	 * @param String $dbIdentifier
	 * @param String $selectQuery
	 * @param String $fetchType
	 * @return multitype:
	 */
	public function executeSelect($dbIdentifier, $selectQuery, $fetchType){
		try {
				$this->getConnection(MASTER_DB_HOST,MASTER_DB_PLATFORM_DBNAME,MASTER_DB_USER,MASTER_DB_PASS);
			$stmt = $this->dbConnection->prepare($selectQuery);
		
			if($stmt->execute())
			{
				$fetchedData = $stmt->fetchAll($fetchType);
				$this->closeConnection();
				return $fetchedData;
				
			} else {
			}
			$this->closeConnection();
		}catch (PDOException $e) {
			$this->closeConnection();
			print "Error: ". $e->getMessage();
		}
	}
	/**
	 * 
	 * @param String $dbIdentifier
	 * @param String $selectQuery
	 * @return boolean
	 */
	public function executeUpdate($dbIdentifier, $selectQuery){
		try {
			
				$this->getConnection(MASTER_DB_HOST,MASTER_DB_PLATFORM_DBNAME,MASTER_DB_USER,MASTER_DB_PASS);
			$stmt = $this->dbConnection->prepare($selectQuery);
			if($stmt->execute())
			{
				return true;
			} else {
				print "Error : $selectQuery";
			}
			$this->closeConnection();
		}catch (PDOException $e) {
			$this->closeConnection();
			print "Error: ". $e->getMessage();
		}
	}
	/**
	 * 
	 * @param String $dbIdentifier
	 * @param String $query
	 * @return boolean
	 */
	public function executeDelete($dbIdentifier, $query){
		try {
			$this->getConnection(MASTER_DB_HOST,MASTER_DB_PLATFORM_DBNAME,MASTER_DB_USER,MASTER_DB_PASS);
			$stmt = $this->dbConnection->prepare($query);
			if($stmt->execute()) {
				return true;
			} else {
				print "Error : $query";
			}
			$this->closeConnection();
		}catch (PDOException $e) {
			$this->closeConnection();
			print "Error: ". $e->getMessage();
		}
	}
	/**
	 * Closes the Connection
	 * @return boolean
	 */
	public function closeConnection(){
		if($this->dbConnection){
			$this->dbConnection = null;
		}
		return true;
	}
} 
?>