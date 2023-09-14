<?php include('../config/constants.php');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login - UniChemist</title>
	<link rel="stylesheet" href="../css/admin.css">
</head>

<body class="login-body">
	<div>
		<a href="index.php" title="Logo">
			<img src="../images/logo.jpg" alt="Pharmacy Logo" class="img-responsive-logo">
		</a>
	</div>
	
	<div class="login">
		
		<h1 class="text-center">Login</h1><br><br>
		<?php
		
			if(isset($_SESSION['login']))
			{
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}
		
			if(isset($_SESSION['no-login-message']))
			{
				echo $_SESSION['no-login-message'];
				unset($_SESSION['no-login-message']);
			}
		?>
		<br><br>
		<!--Login form starts here-->
		
		<form action="" method="POST" class="text-center">
			Username:<br><br>
			<input type="text" name="username" placeholder="Enter Your Username"><br><br><br>
			
			Password:<br><br>
			<input type="password" name="password" placeholder="Enter Your Password"><br><br><br>
			
			<input type="submit" name="submit" value="Login" class="btn-primary"><br><br><br><br><br><br><br>
		</form>
		<!--Login form ends here-->
		<p class="text-center small">2022 All rights reserved, UniChemist. Developed By - <a href="#">Binu Pathirana</a></p>
	</div>
</body>
</html>

<?php

	//Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
	//process to login
	//Get the the data from login form
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	
	//SQL to check whether the username and password exist or not
	$sql = "SELECT * FROM tbladmin WHERE username='$username' AND password='$password'";
	
	//Execute the query
	$res = mysqli_query($con, $sql);
	
	//Count rows to check whether the user exists or not
	$count =  mysqli_num_rows($res);
	
	if($count==1)
	{
		//user available and login success
		$_SESSION['login'] = "<div class='success'>Login Successful.</div>";
		$_SESSION['user'] = $username; //To check whether the user is logged in or not and logout will unset it
		
		//Redirect to Home Page
		header('location:'.SITEURL.'admin/');
	}
	else
	{
		//user not available and login fail
		$_SESSION['login'] = "<div class='error text-center'>Incorrect Username or Password</div>";
		
		//Redirect to Home Page
		header('location:'.SITEURL.'admin/login.php');
	}
}
?>