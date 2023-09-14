<?php include('partials/menu.php');

	//Check whether id is set or not
	if(isset($_GET['id']))
	{
		//get all the details
		$id = $_GET['id'];
		
		//SQL query to get the selected food
		$sql2 = "SELECT * FROM tblmedicine WHERE id=$id";
		
		//Execute the query
		$res2 = mysqli_query($con, $sql2);
		
		//get the value based on query executed
		$row2 = mysqli_fetch_assoc($res2);
		
		//get the individual values of the medicine
		$title = $row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$current_image = $row2['imageName'];
		$current_category = $row2['categoryId'];
		$featured = $row2['featured'];
		$active = $row2['active'];
	}
	else
	{
		//Redirect to manage medicine
		header('location:'.SITEURL.'admin/manage-medicine.php');
	}

?>



	<div class="main-content">
		<div class="wrapper">
			<h1>Update Medicine</h1>

			<br><br>
			
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
					<tr>
						<td>Title: </td>
						<td>
							<input type="text" name="title" value="<?php echo $title; ?>">
						</td>
					</tr>
					
					<tr>
						<td>Description: </td>
						<td>
							<textarea name="description" rows="5" cols="30"><?php echo $description; ?></textarea>
						</td>
					</tr>
					
					<tr>
						<td>Price: </td>
						<td>
							<input type="number" name="price" value="<?php echo $price; ?>">
						</td>
					</tr>
					
					<tr>
						<td>Current Image: </td>
						<td>
							<?php
								if($current_image != "")
								{
									//Image available, display the image
									?>
							
									<img src="<?php echo SITEURL; ?>images/medicine/<?php echo $current_image; ?>" width="150px">
									<?php
								}
								else
								{
									//Image not available, display message
									echo "<div class='error'>Image not Available!</div>";
								}
							?>
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
								
									//query to get active categories
									$sql = "SELECT * FROM tblcategory WHERE active='Yes'";

									//Execute the query
									$res = mysqli_query($con, $sql);

									//count rows
									$count = mysqli_num_rows($res);

									//Check whether category available or not
									if($count > 0)
									{
										//category available
										while($row=mysqli_fetch_assoc($res))
										{
											$category_title = $row['title'];
											$category_id = $row['id'];

											?>
								
											<option <?php if($current_category == $category_id){ echo "selected"; }?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
											
											<?php
										}
											
									}
									else
									{
										//category not available
										echo "<option value='0'>Category not Available</option>";
									}
								
								?>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Featured: </td>
						<td>
							<input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
							<input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
						</td>
					</tr>
					
					<tr>
						<td>Active </td>
						<td>
							<input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
							<input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
						</td>
					</tr>
					
					<tr>
						<td>
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Update Medicine" class="btn-secondary">
						</td>
					</tr>
				</table>
			
			</form>
			
			<?php
			
				if(isset($_POST['submit']))
				{
					//get all the details from the form
					$id = $_POST['id'];
					$title = $_POST['title'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$current_image = $_POST['current_image'];
					$category = $_POST['category'];
					$featured = $_POST['featured'];
					$active = $_POST['active'];
					
					//Upload the image if selected
					if(isset($_FILES['image']['name']))
					{
						//Get the Image details
						$image_name = $_FILES['image']['name'];
						
						//Check whether the image is available or not
						if($image_name != "")
						{
							//Image available
							//Upload the new image and remove current image
							//Auto rename our image
							//get the extension of our image
							$ext = end(explode('.', $image_name));

							//rename the image
							$image_name = "Medicine_".rand(0000,9999).'.'.$ext; 

							$source_path = $_FILES['image']['tmp_name'];

							$destination_path = "../images/medicine/".$image_name;

							//Upload the image
							$upload = move_uploaded_file($source_path, $destination_path);
							
							//check whether the image is uploaded or not
							//And if the image is not uploaded then we will stop the process and redirect with error message
							if($upload==false)
							{
								$_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";

								//Redirect to manage medicine page
								header('location:'.SITEURL.'admin/manage-medicine.php');

								//Stop the process
								die();
							}
							
							//Remove the current image if available
							if($current_image != "")
							{
								$remove_path = "../images/medicine/".$current_image;
								$remove = unlink($remove_path);

								//Check whether the image is removed or not
								//If failed to remove, then display message and stop process
								if($remove == false)
								{
									//Failed to remove image
									$_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image.</div>";
									header('location:'.SITEURL.'admin/manage-medicine.php');
									die(); //stop the process
								}
							}
							
						}
						else
						{
							$image_name = $current_image;
						}
						
					}
					else
					{
						$image_name = $current_image;
					}
					//Update medicine in database
					$sql3 = "UPDATE tblmedicine SET
						title = '$title',
						description = '$description',
						price = $price,
						imageName = '$image_name',
						categoryId = $category,
						featured = '$featured',
						active = '$active'
						WHERE id=$id
					";
					
					//Execute the sql query
					$res3 = mysqli_query($con, $sql3);
					
					//Redirect to manage medicine with message
					//Check whether executed or not
					if($res3 ==  true)
					{
						//medicine updated
						$_SESSION['update'] = "<div class='success'>Medicine Updated Successfully!</div>";
						header('location:'.SITEURL.'admin/manage-medicine.php');
					}
					else
					{
						//Failed to update medicine
						$_SESSION['update'] = "<div class='error'>Failed to Update Medicine!</div>";
						header('location:'.SITEURL.'admin/manage-medicine.php');
					}
				}
			
			?>
		</div>
	</div>


<?php include('partials/footer.php'); ?>