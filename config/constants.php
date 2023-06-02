<?php
	//Session start
	session_start();

		//Create Constants to store non Repeating Values
		define('HOME', 'http://localhost:63342/lolodoks/' );
		define('LOCALHOST', '8.222.243.231');
		define('DB_USERNAME', 'koala');
		define('DB_PASSWORD', 'Koala@123');
		define('DB_NAME', 'makanyuk');
		
		// Execute Query and Save Data in Database
		$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Connect to DB
		$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error($conn)); //Select a DB
		
		

?>
