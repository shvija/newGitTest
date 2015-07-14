<?php
	//Include the database information file
	
	$db_host='localhost';
	$db_username = 'sasec';
	$db_password='sasec@123';
	$db_name ='store';
	
	//creating MySQL connection
	backup_tables($db_host, $db_username, $db_password, $db_name);	
	
	function backup_tables($db_host,$db_username,$pass,$name,$tables = '*'){
	
		$link = mysql_connect($db_host,$db_username,$pass);
		mysql_select_db($name,$link);
	
	//get all of the tables
		if($tables == '*'){
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result)){
				$tables[] = $row[0];
			}
		}
		else{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
	
	//cycle through
	$setSQL="SET foreign_key_checks = 0;". "\n\n";
	$return='';
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	$setFinalSQL="SET foreign_key_checks = 1;". "\n\n";
	//save file
	$finalSQL = $setSQL.$return.$setFinalSQL;
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$finalSQL);
	fclose($handle);
}
	?>