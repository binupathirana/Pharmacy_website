<?php include('partials-front/menu.php'); ?>

	
<?php

	//Check whether medicine id is set or not
	if(isset($_GET['medicine_id']))
	{
		//get the medicine id and details of the selected medicine
		$medicine_id = $_GET['medicine_id'];
		
		//Get the details of the selected medicine
		$sql = "SELECT * FROM tblmedicine WHERE id=$medicine_id";
		
		//Execute query
		$res = mysqli_query($con, $sql);
		
		//count the rows
		$count = mysqli_num_rows($res);
		
		if($count == 1)
		{
			//Medicine available
			//Get the data from database
			$row = mysqli_fetch_assoc($res);
			
			$title = $row['title'];
			$price = $row['price'];
			$image_name = $row['imageName'];
			
			
		}
		else
		{
			//Medicine not available
			header('location:'.SITEURL);
		}
	}
	else
	{
		//Redirect to home page
		header('location:'.SITEURL);
	}

?>
    <!-- Medicine search Section Starts Here -->
    <section class="order-body">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2><br>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Medicine</legend>

                    <div class="medicine-display-img">
						
						<?php
						
							//Check whether image is available or not
							if($image_name == "")
							{
								//Image is not available
								echo "<div class='error'>Image not Available!</div>";
							}
							else
							{
								//Image is available
								?>
						
								<img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>" class="img-responsive img-curve">
						
								<?php
							}
						
						?>
                        
                    </div>
    
                    <div class="medicine-display-desc">
                        <h3><?php echo $title; ?></h3>
						<input type="hidden" name="medicine" value="<?php echo $title; ?>">
						
                        <p class="medicine-price">Rs <?php echo $price; ?></p>
						<input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Binu Pathirana" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 07xxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. binu@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
			
			
			<?php
				
				//Check whether submit button is clicked or not
				if(isset($_POST['submit']))
				{
					//get all the details from the form
					$medicine = $_POST['medicine'];
					$price = $_POST['price'];
					$qty = $_POST['qty'];
					$total = $price * $qty;
					$order_date = date("Y-m-d h:i:s");
					$status = "Ordered";
					
					$customer_name = $_POST['full-name'];
					$customer_contact = $_POST['contact'];
					$customer_email = $_POST['email'];
					$customer_address = $_POST['address'];
					
					//Save the order in the database
					//create sql to save the data
					$sql2 = "INSERT INTO tblorder SET
						medicine = '$medicine',
						price = '$price',
						qty = '$qty',
						total = '$total',
						order_date = '$order_date',
						status = '$status',
						customer_name = '$customer_name',
						customer_contact = '$customer_contact',
						customer_email = '$customer_email',
						customer_address = '$customer_address'
					";
					
					//echo $sql2;die();
					
					//Execute the query
					$res2 = mysqli_query($con, $sql2);
					
					//Check whether query executed successfully or ntot
					if($res2 == true)
					{
						//query executed and order saved
						$_SESSION['order'] = "<div class='success text-center'>Order placed Successfully!</div>";
						header('location:'.SITEURL);
					}
					else
					{
						//Failed to save order
						$_SESSION['order'] = "<div class='error text-center'>Failed to place Order!</div>";
						header('location:'.SITEURL);
					}
				}
			?>

        </div>
	
    </section>
    <!-- Medicine search Section Ends Here -->

<?php include('partials-front/footer.php'); ?>