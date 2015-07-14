<?php
	//Include the database information file
	if(!isset($_POST['user_name'])){
		echo "Error!! Form inputs are not provided";
	}
	else{
		include('db_connect.php');
		//prepare and bind
		$mysqli = databaseConnection();
		$stmt = $mysqli->prepare(" SELECT full_name FROM tbl_users WHERE user_name=? AND password=?");
		$stmt->bind_param("ss",$user_name,$password);
		//set parameters and execute
		$user_name= $_POST['user_name'];
		$password = $_POST['user_password'];
		$password = sha1($password);
		
		$stmt->execute();
		
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$full_Name = $row['full_name'];
		$stmt->close();
		//Close the connection
		$mysqli->close();
		if(isset($full_Name)){
			echo "Login Successfull !!<br>";
			echo "Welcome ".$full_Name;
		}
		else{
			echo "User is not authenticated";
		}
	}
?>