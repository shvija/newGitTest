<?php
	$main_password ="test1234";
	$encryptType = array('md5','sha1');
	echo "Raw password :".$main_password;
	echo "<br>";
	foreach($encryptType  as $key=>$value){
		echo " Encrypted password by ".$value.": ".hash($value,$main_password);
		echo "<br>";
	}
?>
