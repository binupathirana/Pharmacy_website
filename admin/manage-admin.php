<?php include('partials/menu.php'); ?>
	
<!--Main Content section Starts-->
<div class="main-content">
	<div class="wrapper">
		<h1>Manage Admin</h1>
		<br><br>
		
		<?php 
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add']; //Displaying session message
				unset($_SESSION['add']); //Removing session message
			}
		
			if(isset($_SESSION['delete']))
			{
				echo $_SESSION['delete']; //Displaying session message
				unset($_SESSION['delete']); //Removing session message
			}
		
			if(isset($_SESSION['update']))
			{
				echo $_SESSION['update']; 
				unset($_SESSION['update']); 
			}
		
			if(isset($_SESSION['user-not-found']))
			{
				echo $_SESSION['user-not-found']; 
				unset($_SESSION['user-not-found']); 
			}
		
			if(isset($_SESSION['pw-not-match']))
			{
				echo $_SESSION['pw-not-match']; 
				unset($_SESSION['pw-not-match']); 
			}
		
			if(isset($_SESSION['change-pw']))
			{
				echo $_SESSION['change-pw']; 
				unset($_SESSION['change-pw']); 
			}
		?>
		<br><br>
		<!--Button to add Admin-->
		<a href="add-admin.php" class="btn-primary">Add Admin</a>
		
		<br><br>
		
		<table class="tbl-full">
			<tr>
				<th>Serial Number</th>
				<th>Full Name</th>
				<th>UserName</th>
				<th>Actions</th>
			</tr>
			
			<?php
				//Query to get all admin
				$sql = "SELECT * FROM tbladmin";
				
				//Execute the query
				$res = mysqli_query($con, $sql);

				//Check whether the query is execured or not
				if($res==TRUE)
				{
					//Count rows to check whether we have data in the database or not
					$count = mysqli_num_rows($res); //Function to get all the rows in database
					
					$sn=1; //Create variable and assign the value

					//Check the num of rows
					if($count>0)
					{
						//we have data in database
						while($rows = mysqli_fetch_assoc($res))
						{
							//using while loop to get all the data from database
							//And while loop will execute as long as we have data in our database

							//Get individual data
							$id = $rows['id'];
							$fullName = $rows['fullName'];
							$username = $rows['username'];

							//Display the vales in our table
							?>

							<tr>
								<td><?php echo $sn++; ?></td>
								<td><?php echo $fullName; ?></td>
								<td><?php echo $username; ?></td>
								<td>
									<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-secondary">Change Password</a>
									<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
									<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
								</td>
							</tr>

							<?php
						}
					}

					else
					{
						//we do not have data in database
					}
				}
				else
				{

				}
			?>
			
		
		</table>
			
	</div>
</div>
<!--Main Content section Ends-->

<?php include('partials/footer.php'); ?>