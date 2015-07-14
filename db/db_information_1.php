<?php
	//Include the database information file
	include('db_information.php');
	//creating MySQL connection
	$connection = new mysqli($db_host, $db_username, $db_password, $db_name);
// Check connection
if ($connection->connect_error){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 else{
	echo "Connection successful !!";
}

?>
