<?php
	
	//Include constants.php file here
	include('../config/constants.php');

	//Get the ID of Admin to be deleted
	$id = $_GET['id'];

	//Create SQL query to delete Admin
	$sql = "DELETE FROM tbladmin WHERE id=$id";

	//Execute the query
	$res = mysqli_query($con, $sql);

	//Check with the query executed successfully or not
	if($res==TRUE)
	{
		//Query executed susccessfully and Admin deleted
		
		//Create session variable to display message
		$_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully!</div>";
		
		//Redirect to Manage Admin page with message(success)
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
	else
	{
		//failed to delete Admin
		
		//Create session variable to display message
		$_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try Again Later.</div>";
		
		//Redirect to Manage Admin page with message(error)
		header('location:'.SITEURL.'admin/manage-admin.php');
		
	}



?>