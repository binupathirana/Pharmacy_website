<?php
	
	include('../config/constants.php');

	//Check whether the id and image_name value is set or not
	if(isset($_GET['id']) AND isset($_GET['image_name']))
	{
		//Get the value and delete
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];
		
		//Remove the physical image file available
		if($image_name != "")
		{
			//Image is available. So remove it
			$path = "../images/category/".$image_name;
			
			//Remove the image
			$remove = unlink($path);
			
			//If failed to remove image, add an error message and stop the process
			if($remove == false)
			{
				//set the session message
				$_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image!</div>";
				
				//redirect to manage category page
				header('location:'.SITEURL.'admin/manage-category.php');
				
				//stop the process
				die();
			}
		}
		
		
		//Delete data from database
		$sql = "DELETE FROM tblcategory WHERE id=$id";
		
		//Execute the query
		$res = mysqli_query($con, $sql);
		
		//Check whether the data is deleted from database or not
		if($res==true)
		{
			//set success message and redirect
			$_SESSION['delete'] = "<div class='success'>Category Deleted Successfully!</div>";
			
			//Redirect to manage category
			header('location:'.SITEURL.'admin/manage-category.php');
		}
		else
		{
			//set fail message and redirect
			$_SESSION['delete'] = "<div class='error'>Failed to Remove Category Image!</div>";
			
			//Redirect to manage category
			header('location:'.SITEURL.'admin/manage-category.php');
		}
		
	}
	else
	{
		//redirect to manage category page
		header('location:'.SITEURL.'admin/manage-category.php');
	}

?>
