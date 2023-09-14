<!doctype html>

<?php include('../config/constants.php'); 
	  include('login-check.php');
?>

<html>
<head>
<meta charset="utf-8">
<title>UniChemist - Home Page</title>
	<link rel="stylesheet" href="../css/admin.css">
</head>

<body>
	<!--Menu section Starts-->
	<div class="menu text-center">
		<a href="index.php" title="Logo">
			<img src="../images/logo.jpg" alt="Pharmacy Logo" class="img-responsive-logo">
		</a>
		<div class="wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="manage-admin.php">Admin</a></li>
				<li><a href="manage-category.php">Category</a></li>
				<li><a href="manage-medicine.php">Medicines</a></li>
				<li><a href="manage-order.php">Order</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
	</div>
	<!--Menu section Ends-->
