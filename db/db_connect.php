<?php
	//Include the database information file
	include('db_information.php');
	//creating MySQL connection
	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);	
	if($mysqli->connect_error){
		die("Could not connect to the database : <br>". $mysqli->connect_error);
	}
	//prepare and bind
	$stmt = $mysqli->prepare("SELECT * FROM tbl_books WHERE author_id=?");
	$stmt->bind_param("i",$author_id);
	//set parameters and execute
	$author_id=1;
	$stmt->execute();
	$result = $stmt->get_result();
	echo "<table><tr><th>Author ID</th><th>Book  Name</th><th>Pages</th></tr>";
	while($row = $result->fetch_assoc()){
		echo "<tr>";
		echo "<td>".$row['author_id']."</td>";
		echo "<td>".$row['title_name']."</td>";
		echo "<td>".$row['pages']."</td>";
		echo "</tr>";
	}
	$stmt->close();
	//Close the connection
	$mysqli->close();

?>
