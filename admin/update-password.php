<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Change Admin Password</h1>
		<br><br>
		
		<?php
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];
			}
		?>
		
		<form action="" method="POST">
			
			<table class="tbl-30">
				<tr>
					<td>Current Password: </td>
					<td>
						<input type="password" name="current_password" placeholder="Current Password">
					</td>
				</tr>
				
				<tr>
					<td>New Password: </td>
					<td>
						<input type="password" name="new_password" placeholder="New Password">
					</td>
				</tr>
				
				<tr>
					<td>Confirm Password: </td>
					<td>
						<input type="password" name="confirm_password" placeholder="Confirm Password">
					</td>
				</tr>
				
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
		//Get the data from form
		$id=$_POST['id'];
		$current_password = md5($_POST['current_password']);
		$new_password = md5($_POST['new_password']);
		$confirm_password = md5($_POST['confirm_password']);
		
		//Check whether the user with current id and current password exist or not
		$sql = "SELECT * FROM tbladmin WHERE id=$id AND password='$current_password'";
		
		//Execute the query
		$res = mysqli_query($con, $sql);
		
		if($res==TRUE)
		{
			$count = mysqli_num_rows($res);
			
			if($count==1)
			{
				//User exists and password can be changed
				//Check whether the new password and confirm password matches or not
				if($new_password == $confirm_password)
				{
					//Update password
					$sql2 = "UPDATE tbladmin SET
						password='$new_password'
						WHERE id=$id
					";
					
					//Execute the query
					$res2 = mysqli_query($con, $sql2);
					
					//Check whether the query selected or not
					if($res2==TRUE)
					{
						//display success message
						$_SESSION['change-pw'] = "<div class='success'>Password changed Successfully!</div>";

						//Redirect the user to manage admin page with error mesaage
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
					else
					{
						//display error message
						$_SESSION['change-pw'] = "<div class='error'>Failed to change Password!</div>";

						//Redirect the user to manage admin page with error mesaage
						header('location:'.SITEURL.'admin/manage-admin.php');
					}
				}
				else
				{
					//user does not exist. Set message and redirect
					$_SESSION['pw-not-match'] = "<div class='error'>Password did not match!</div>";

					//Redirect the user to manage admin page with error mesaage
					header('location:'.SITEURL.'admin/manage-admin.php');
					}
			}
			else
			{
				//user does not exist. Set message and redirect
				$_SESSION['user-not-found'] = "<div class='error'> User not found!</div>";
				
				//Redirect the user to manage admin page
				header('location:'.SITEURL.'admin/manage-admin.php');
			}
		}
		
		
		//Change password if all above is true
	}

?>

<?php include('partials/footer.php'); ?>