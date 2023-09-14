<?php include('partials/menu.php'); ?>
	
<!--Main Content section Starts-->
<div class="main-content">
	<div class="wrapper">
		<h1>Manage Medicine</h1>
		
		<br><br>
		<!--Button to add Admin-->
		<a href="<?php echo SITEURL; ?>admin/add-medicine.php" class="btn-primary">Add Medicine</a>
		
		<br><br><br>
		
		<?php
		
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
		
			if(isset($_SESSION['delete']))
			{
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			}
		
			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
		
			if(isset($_SESSION['unauthorized']))
			{
				echo $_SESSION['unauthorized'];
				unset($_SESSION['unauthorized']);
			}
		
			if(isset($_SESSION['update']))
			{
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}
		
		?>
		
		<table class="tbl-full">
			<tr>
				<th>Serial Number</th>
				<th>Title</th>
				<th>Price</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Action</th>
			</tr>
			
			<?php
			
				//Create a sql query to get all the medicine
				$sql = "SELECT * FROM tblmedicine";

				//Execute query
				$res = mysqli_query($con, $sql);
			
				//Count rows to check whether we have medicine or not
				$count = mysqli_num_rows($res);
			
				//Create serial number variable and set default value as 1
				$sn=1;

				if($count > 0)
				{
					//we have medicine in our database
					//Get the medicine from database and display
					while($row=mysqli_fetch_assoc($res))
					{
						//get values from individual columns
						$id = $row['id'];
						$title = $row['title'];
						$price = $row['price'];
						$image_name = $row['imageName'];
						$featured = $row['featured'];
						$active = $row['active'];

						?>

						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $title; ?></td>
							<td><?php echo $price; ?></td>
							<td>
								<?php 
								
									//Check whether we have imae or not
						if($image_name == "")
						{
							//No image
							echo "<div class='error'>Image not Added!</div>";
						}
						else
						{
							?>
								
								<img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name?>" width="100px">
								
							<?php
						}
						
								?>
							</td>
							<td><?php echo $featured; ?></td>
							<td><?php echo $active; ?></td>
							<td>
								<a href="<?php echo SITEURL; ?>admin/update-medicine.php?id=<?php echo $id; ?>" class="btn-secondary">Update Medicine</a>
								<a href="<?php echo SITEURL; ?>admin/delete-medicine.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Medicine</a>
							</td>
						</tr>

						<?php
					}
				}
				else
				{
					//medicine not added in database
					echo "<tr><td colspan='7' class='error'> Medicine Not Added Yet!</td><tr>";
				}
			
			?>
		
		</table>
		
	</div>
</div>
<!--Main Content section Ends-->
	
<?php include('partials/footer.php'); ?>