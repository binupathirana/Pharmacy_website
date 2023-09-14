<?php include('partials/menu.php'); ?>

	<div class="main-content">
		<div class="wrapper">
			<h1>Add Category</h1>

			<br><br>

			<?php

				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}
			
				if(isset($_SESSION['upload']))
				{
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}
			?>
			<br><br>

			<!--Add Category form Starts-->
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
					<tr>
						<td>Title: </td>
						<td>
							<input type="text" name="title" placeholder="Category Title">
						</td>
					</tr>
					
					<tr>
						<td>Select Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>

					<tr>
						<td>Featured: </td>
						<td>
							<input type="radio" name="featured" value="Yes">Yes
							<input type="radio" name="featured" value="No">No
						</td>
					</tr>

					<tr>
						<td>Active: </td>
						<td>
							<input type="radio" name="active" value="Yes">Yes
							<input type="radio" name="active" value="No">No
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Category" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
			<!--Add Category form Ends-->

			<?php

				//Check whether the submit button is clicked or not
				if(isset($_POST['submit']))
				{
					//get the value from Category form
					$title = $_POST['title'];

					//For radio input type we need to check whether the button is selected or not

					//Featured
					if(isset($_POST['featured']))
					{
						//Get the value from form
						$featured = $_POST['featured'];
					}
					else
					{
						//Set the default value
						$featured = "No";
					}

					//Active
					if(isset($_POST['active']))
					{
						//Get the value from form
						$active = $_POST['active'];
					}
					else
					{
						//Set the default value
						$active = "No";
					}
					
					//Check whether the image is selected or not and set the value for image name accordingly
					
					if(isset($_FILES['image']['name']))
					{
						//upload the image
						//To upload the image we need an image name and source path and destination path
						$image_name = $_FILES['image']['name'];
						
						//Upload image only if image is selected
						if($image_name != "")
						{
							//Auto rename our image
							//get the extension of our image
							$ext = end(explode('.', $image_name));

							//rename the image
							$image_name = "Medicine_Category_".rand(000,999).'.'.$ext; 

							$source_path = $_FILES['image']['tmp_name'];

							$destination_path = "../images/category/".$image_name;

							//Finally upload the image
							$upload = move_uploaded_file($source_path, $destination_path);

							//check whether the image is uploaded or not
							//And if the image is not uploaded then we will stop the process and redirect with error message
							if($upload==false)
							{
								$_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";

								//Redirect to add category page
								header('location:'.SITEURL.'admin/add-category.php');

								//Stop the process
								die();
							}
						}
						
					}
					else
					{
						//Do not upload the image and set the image_name value as blank
						$image_name="";
					}

					//Create sql query to insert category into database
					$sql = "INSERT INTO tblcategory SET
						title='$title',
						imageName='$image_name',
						featured='$featured',
						active='$active'
					";
					

					//Execute the query and save in database
					$res = mysqli_query($con, $sql);

					//Check whether the query executed or not and data added or not
					if($res==TRUE)
					{
						//Query executed and category added
						$_SESSION['add'] = "<div class='success'>Category Added Successfully!</div>";

						//Redirect to Manage category page
						header('location:'.SITEURL.'admin/manage-category.php');
					}
					else
					{
						//failed to add category
						$_SESSION['add'] = "<div class='error'>Failed to Add Category!</div>";

						//Redirect to Add category page
						header('location:'.SITEURL.'admin/add-category.php');
					}
				}
			?>
		</div>
	</div>


<?php include('partials/footer.php'); ?>