<?php

		//Create Constants to store non Repeating Values
		define('LOCALHOST','myUser');
		define('DB_USERNAME','myUser');
		define('DB_PASSWORD','');
		define('DB_NAME','lolodoks');
		
		$conn = mysqli_connect('LOCALHOST','DB_USERNAME','DB_PASSWORD') or die(mysqli_error));//database connection
		$db_select = mysqli_select_db($conn, "DB_NAME") or die(mmysqli_error());//Selecting Database
		
		

?>
