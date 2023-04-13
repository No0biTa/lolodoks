<?php
	//Session start
	// session_start();

		//Create Constants to store non Repeating Values
		// define('ADMIN_PAGE', );
		define('LOCALHOST', '34.101.114.64');
		define('DB_USERNAME', 'koala');
		define('DB_PASSWORD', 'Koala@123');
		define('DB_NAME', 'lolodoks');
		
		// Execute Query and Save Data in Database
		$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Connect to DB
		$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error($conn)); //Select a DB
		
		

?>
