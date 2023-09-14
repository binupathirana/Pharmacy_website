<?php
	
	include('../config/constants.php');

	if(isset($_GET['id']) && isset($_GET['image_name']))
	{
		//Process to delete
		//Get id and image_name
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
		
		//Remove image if available
		//Check whether image is available or not only if available
		if($image_name != "")
		{
			//If it has image need to remove from folder
			//get image path
			$path = "../images/medicine/".$image_name;
			
			//Remove image file from folder
			$remove = unlink($path);
			
			//Check whether image is removed or not
			if($remove == false)
			{
				//failed to remove image
				$_SESSION['upload'] = "<div class='error'>Failed to remove Image!</div>";
				header('location:'.SITEURL.'admin/manage-medicine.php');
				die(); //stop the process of deleting medicine
			}
		}
		//Delete medicine from database
		$sql = "DELETE FROM tblmedicine WHERE id=$id";
		
		//Execute query
		$res = mysqli_query($con, $sql);
		
		//Check whether the query executed or not ans set the session message respectively
		if($res == true)
		{
			//deleted medicine
			$_SESSION['delete'] = "<div class='success'>Medicine Deleted Successfully!</div>";
			header('location:'.SITEURL.'admin/manage-medicine.php');
		}
		else
		{
			//Failed to delete medicine
			$_SESSION['delete'] = "<div class='error'>Failed to Delete Medicine!</div>";
			header('location:'.SITEURL.'admin/manage-medicine.php');
		}
		
		
	}
	else
	{
		//Redirect to manage medicine page
		$_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access!</div>";
		header('location:'.SITEURL.'admin/manage-medicine.php');
	}


?>