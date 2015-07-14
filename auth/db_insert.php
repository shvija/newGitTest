<?php
	//Include the database information file
	include('db_connect.php');
	//prepare and bind
	$mysqli = databaseConnection();
	$stmt = $mysqli->prepare("INSERT INTO tbl_users(user_name,password,full_name) VALUES (?,?,?)");
	$stmt->bind_param("sss",$user_name,$password,$full_name);
	//set parameters and execute
	$user_name= "hari";
	$password ="Hari@123";
	$password = sha1($password);
	$full_name = "Hari Lal";
	$stmt->execute();
  	
	$user_name= "sam";
	$password ="Sam@123";
	$password = sha1($password);
	$full_name = "Sam Prasad";
	$stmt->execute();
	
	$user_name= "gita";
	$password ="Gita@123";
	$password = sha1($password);
	$full_name = "Gita Shrestha";
	$stmt->execute();
	
	echo "New records created successfully";
	$stmt->close();
	//Close the connection
	$mysqli->close();

?>