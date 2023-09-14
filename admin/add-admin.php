<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>
		<br><br>
		
		<?php 
			if(isset($_SESSION['add'])) //checking whether the session is set or not
			{
				echo $_SESSION['add']; //Displaying session message
				unset($_SESSION['add']); //Removing session message
			}
		?>
		<br><br>
		
		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Full Name: </td>
					<td>
						<input type="text" name="full-name" placeholder="Enter Your Name">
					</td>
				</tr>
				
				<tr>
					<td>Username: </td>
					<td>
						<input type="text" name="username" placeholder="Enter Your Username">
					</td>
				</tr>
				
				<tr>
					<td>Password: </td>
					<td>
						<input type="password" name="password" placeholder="Enter Your Password">
					</td>
				</tr>
				
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
		
		</form>
	</div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
	//Process the value from form and save it in database
	//Check whether the submit button is clicked or not

	if(isset($_POST['submit']))
	{
		//button clicked
		//Get the data from form
		
		$fullName = $_POST['full-name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']); //Password Encryption with MD5
		
		//SQL Query to save data into database
		
		$sql = "INSERT INTO tbladmin SET
			fullName='$fullName',
			username='$username',
			password='$password'
		";
		
		//Executing quaery and saving data into databse
		$res = mysqli_query($con, $sql) or die(mysqli_error());
		
		//check whether the (query is executed) data is inserted or not and display appropriate message
		if($res==TRUE)
		{
			//Data inserted
			//create a session variable to display message
			$_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
			
			//Redirect page to manage admin
			header("location:".SITEURL.'admin/manage-admin.php');
			
		}
		else
		{
			//failed to insert data
			//create a session variable to display message
			$_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
			
			//Redirect page to add admin
			header("location:".SITEURL.'admin/add-admin.php');
			
		}
		
	}

?>