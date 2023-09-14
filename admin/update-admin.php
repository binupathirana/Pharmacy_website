<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Admin</h1>
		
		<br><br>
		
		<?php 
		
			//Get the Id of selected Admin
			$id=$_GET['id'];
		
			//Create sql query to get the details
			$sql = "SELECT * FROM tbladmin WHERE id=$id";
		
			//Execute query
			$res = mysqli_query($con, $sql);
		
			//Check whether the query is executed or not
			if($res==TRUE)
			{
				//Check whether the data is available or not
				$count = mysqli_num_rows($res);

				//Check whether we have admindata or not
				if($count==1)
				{
					//Get the details
					$row = mysqli_fetch_assoc($res);

					$fullName = $row['fullName'];
					$username = $row['username'];
				}
				else
				{
					//redirect to manage admin page
					header('location:'.SITEURL.'admin/manage-admin.php');
				}
			}
		
		?>
		
		<form action=""  method="POST">
		
			<table class="tbl-30">
				<tr>
					<td>Full Name</td>
					<td>
					
						<input type="text" name="full-name" value="<?php echo  $fullName; ?>">
					</td>
				</tr>
				
				<tr>
					<td>Username</td>
					<td>
					
						<input type="text" name="username" value="<?php echo  $username; ?>">
					</td>
				</tr>
				
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
		
		</form>
	</div>
</div>

<?php

	//Check whether the submit button is clicked or not
	if(isset($_POST['submit']))
	{
		//Get all the value from form to update
		$id = $_POST['id'];
		$fullName = $_POST['full-name'];
		$username = $_POST['username'];
		
		//Create a sql query to update admin
		$sql = "UPDATE tbladmin SET
		fullName = '$fullName',
		username = '$username' 
		WHERE id='$id'
		";
		
		//Execute the query
		$res = mysqli_query($con, $sql);
		
		//Check whether the query executed successfully or not
		if($res==TRUE)
		{
			//Query executed and admin updated
			$_SESSION['update'] = "<div class='success'>Admin Updated Successfully!</div>";
			
			//redirect to Manage admin page
			header("location:".SITEURL.'admin/manage-admin.php');
		}
		else
		{
			//failed to update admin
			$_SESSION['update'] = "<div class='error'>Failed to Update Admin!</div>";
			
			//redirect to Manage admin page
			header("location:".SITEURL.'admin/manage-admin.php');
		}
	}

?>



<?php include('partials/footer.php'); ?>