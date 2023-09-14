<?php
	//starts session
	session_start();

	//create constants to store non repeating values
	define('SITEURL', 'http://localhost/Pharmacy/');
	define('LOCALHOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'pharmacy');
		
	$con = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD)or die(mysqli_error()); //Database connection
		
	$db_select = mysqli_select_db($con, DB_NAME)or die(mysqli_error());  //selecting database
		
?>