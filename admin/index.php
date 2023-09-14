<?php include('partials/menu.php'); ?>

	<!--Main Content section Starts-->
	<div class="main-content">
		<div class="wrapper">
			<h1>Dashboard</h1>
			<br><br>
			
			<?php

				if(isset($_SESSION['login']))
				{
					echo $_SESSION['login'];
					unset($_SESSION['login']);
				}
			?>
			
			<div class="col-4 text-center">
				<?php
				
					$sql = "SELECT * FROM tblcategory";
					$res = mysqli_query($con, $sql);
				
					$count = mysqli_num_rows($res);
				
				?>
				<h1><?php echo $count; ?></h1>
				<br>
				Categories
			</div>
			
			<div class="col-4 text-center">
				<?php
				
					$sql2 = "SELECT * FROM tblmedicine";
					$res2 = mysqli_query($con, $sql2);
				
					$count2 = mysqli_num_rows($res2);
				
				?>
				<h1><?php echo $count2; ?></h1>
				<br>
				Medicines
			</div>
			
			<div class="col-4 text-center"><?php
				
					$sql3 = "SELECT * FROM tblorder";
					$res3 = mysqli_query($con, $sql3);
				
					$count3 = mysqli_num_rows($res3);
				
				?>
				<h1><?php echo $count3; ?></h1>
				<br>
				Total Orders
			</div>
			
			<div class="col-4 text-center">
				<?php
				
					//Create sql to get total Revenue generated
					//Aggregate function in sql
					$sql4 = "SELECT SUM(total) AS Total FROM tblorder WHERE status='Delivered'";
					$res4 = mysqli_query($con, $sql4);
				
					//Get the value
					$row4 = mysqli_fetch_assoc($res4);
				
					//get the total revenue
					$total_revenue = $row4['Total'];
				
				?>
				<h1>Rs <?php echo $total_revenue; ?></h1>
				<br>
				Revenue Generated
			</div>
			
			<div class="clearfix">
			
			</div>
		</div>
	</div>
	<!--Main Content section Ends-->


<?php include('partials/footer.php'); ?>