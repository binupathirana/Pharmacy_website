<?php

	//Include constants.php for SITEURL
	include('../config/constants.php');	

	//Destroy th 
	session_destroy(); //unsets $_SESSION['user']

	//Redirect to login page
	header('location:'.SITEURL.'admin/login.php');
?>