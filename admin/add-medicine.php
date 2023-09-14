<?php include('partials/menu.php'); ?>

	<div class="main-content">
		<div class="wrapper">
			<h1>Add Medicine</h1>
				
			<br><br>
			
			<?php
			
				if(isset($_SESSION['upload']))
				{
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}
			
			?>
				
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
						
					<tr>
						<td>Title: </td>
						<td>
							<input type="text" name="title" placeholder="Title of the Medicine">
						</td>
					</tr>
						
					<tr>
						<td>Description: </td>
						<td>
							<textarea name="description" cols="30" rows="5" placeholder="Description of the Medicine"></textarea>
						</td>
					</tr>
						
					<tr>
						<td>Price: </td>
						<td>
							<input type="number" name="price" placeholder="Price of the Medicine">
						</td>
					</tr>
						
					<tr>
						<td>Select Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>
						
					<tr>
						<td>Category: </td>
						<td>
							<select name="category">
								<?php
									
									//Create php code to display categories from database
									//Create sql query to get all active categories from database
									$sql = "SELECT * FROM tblcategory WHERE active='Yes'";
								
									//executing query
									$res = mysqli_query($con, $sql);
								
									//Count rows to check whether w ehave categories or not
									$count = mysqli_num_rows($res);
								
									//If count is greater than 0, we have categories else we do not
									if($count > 0)
									{
										//have categories
										while($row=mysqli_fetch_assoc($res))
										{
											//get the detailes of the categories
											$id = $row['id'];
											$title = $row['title'];
											?>
								
											<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
											
											<?php
										}
									}
									else
									{
										//We do not have categories
										?>
		
										<option value="0">No Category Found</option>
										
										<?php
									}
								?>	
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
							<input type="submit" name="submit" value="Add Medicine" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
			
			<?php
			
				//Check wheter the button is clicked or not
				if(isset($_POST['submit']))
				{
					//Add the medicine in database
					//Get the data from form
					$title = $_POST['title'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$category = $_POST['category'];
					
					//Check whether radio buttons for featured and active are checked or not
					if(isset($_POST['featured']))
					{
						$featured = $_POST['featured'];
					}
					else
					{
						$featured = "No";
					}
					
					if(isset($_POST['active']))
					{
						$active = $_POST['active'];
					}
					else
					{
						$active = "No";
					}
					
					
					//Upload the image if selected
					//Check whether the select image is clicked or not and upload only if it is clicked
					if(isset($_FILES['image']['name']))
					{
						//Create the details of the selected image
						$image_name = $_FILES['image']['name'];
						
						//Check whether image is selected or not and upload image onliy if selected
						if($image_name != "")
						{
							//image is selected
							//Rename the image 
							//Get extension of selected image
							$ext = end(explode('.', $image_name));
							
							//Create new name for image
							$image_name = "Medicine_Name_".rand(0000, 9999).".".$ext;
							
							//Upload the image
							//Get the source path(current location of the image) and destination path(location the image should be upload to)
							
							$src = $_FILES['image']['tmp_name'];
							$dst = "../images/medicine/".$image_name;
							
							//finally upload the medicine image
							$upload = move_uploaded_file($src, $dst);
							
							//Check whether image uploaded or not
							if($upload == false)
							{
								//failed to upload image
								//Redirect to add medicine page with error message
								$_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
								
								//Redirect to add category page
								header('location:'.SITEURL.'admin/add-medicine.php');
								
								die(); //stop process
							}
							
							
						}
					}
					else
					{
						$image_name = ""; //setting default value as blank
					}
					//Insert into database
					//Create a sql query to save or add medicine
					$sql2 = "INSERT INTO tblmedicine SET
						title = '$title',
						description = '$description',
						price = $price,
						imageName = '$image_name',
						categoryId = $category,
						featured = '$featured',
						active = '$active'
					";
					
					//Execute the query
					$res2 = mysqli_query($con, $sql2);
					
					//check whether data is added or not
					if($res == TRUE)
					{
						//Query executed and medicine added
						$_SESSION['add'] = "<div class='success'>Medicine Added Successfully!</div>";

						//Redirect to Manage medicine page
						header('location:'.SITEURL.'admin/manage-medicine.php');
					}
					else
					{
						//failed to add medicine
						$_SESSION['add'] = "<div class='error'>Failed to Add Medicine!</div>";

						//Redirect to Add medicine page
						header('location:'.SITEURL.'admin/manage-medicine.php');
					}
					
					
					
				}
			
			?>

		</div>
	</div>

<?php include('partials/footer.php'); ?>