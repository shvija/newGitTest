<?php
	define('DB_HOST','localhost');
	define('DB_USERNAME','sasec');
	define('DB_PASSWORD','sasec@123');
	define('DB_NAME','store');
		
	function databaseConnection(){
		$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		return $mysqli;	
	}
	
	
?>
