<?php include('partials-front/menu.php'); ?>


<!-- Medicine search Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>medicine-search.php" method="POST">
                <input type="search" name="search" placeholder="Search.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Medicine search Section Ends Here -->

	<?php
	
		if(isset($_SESSION['order']))
		{
			echo $_SESSION['order'];
			unset($_SESSION['order']);
		}
	?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Medicines</h2>
			<?php
			
				//Create sql query to display categories from database
				$sql = "SELECT * FROM tblcategory WHERE active='Yes' AND featured='Yes' LIMIT 3";
			
				//Execute query
				$res = mysqli_query($con, $sql);
			
				//Count to check whether the category is available or not
				$count = mysqli_num_rows($res);
			
				if($count > 0)
				{
					//Categories available
					while($row=mysqli_fetch_assoc($res))
					{
						//Get the values
						$id = $row['id'];
						$title = $row['title'];
						$image_name = $row['imageName'];
						
						?>
			
						 <a href="<?php echo SITEURL; ?>category-medicine.php?categoryId=<?php echo $id; ?>">
							<div class="box-3 float-container">
								<?php
						
								//Check whether image is available or not
								if($image_name == "")
								{
									//Image not available, display message
									echo "<div class='error'>Image not Available!</div>";
								}
								else
								{
									//Image Available
									?>
									
									<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Lotions" class="img-responsive img-curve">
								
									<?php
								}
								?>
								

							   <h3 class="float-text text-white te"><?php echo $title; ?></h3>
							</div>
						</a>
			
						<?php
					}
				}
				else
				{
					//Categories not available
					echo "<div class ='error'>Category not Available!</div>";
				}
			
			?>

           


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Medicines Section Starts Here -->
    <section class="medicine-display">
        <div class="container">
            <h2 class="text-center">Featured Products</h2>
			
			<?php
			
			//Getting medicines from database that are active and featured
			//sql query
			$sql2 = "SELECT * FROM tblmedicine WHERE active='Yes' AND featured='Yes' LIMIT 6";
			
			//Execute query
			$res2 = mysqli_query($con, $sql2);
			
			//count rows
			$count2 = mysqli_num_rows($res2);
			
			//Check whether medicine available or not
			if($count2 > 0)
			{
				//medicine available
				while($row = mysqli_fetch_assoc($res2))
				{
					//Get all the values
					$id = $row['id'];
					$title = $row['title'];
					$description = $row['description'];
					$price = $row['price'];
					$image_name = $row['imageName'];
					
					?>
			
					<div class="medicine-display-box">
						<div class="medicine-display-img">
							
							<?php
					
							if($image_name == "")
							{
								echo "<div class='error'>Image not Available!</div>";
							}
							else
							{
								?>
							
								<img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>" alt="3plyfacemask" class="img-responsive img-curve">
							
								<?php
							}
					
							?>
							
						</div>

						<div class="medicine-display-desc">
							<h4><?php echo $title; ?></h4>
							<p class="medicine-price">Rs <?php echo $price; ?></p>
							<p class="medicine-detail"><?php echo $description; ?></p>
							<br>

							<a href="<?php echo SITEURL; ?>order.php?medicine_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
						</div>
					</div>
			
					<?php
				}
			}
			else
			{
				//medicine not available
				echo "<div class='error'>Medicine not Available</div>";
			}
			
			?>

            

          
            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>medicine.php">See All Medicines</a>
        </p>
    </section>
    <!-- Medicine Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>