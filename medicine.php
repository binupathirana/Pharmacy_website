<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>medicine-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Medicine sEARCH Section Ends Here -->



    <!-- Medicine display Section Starts Here -->
     <section class="medicine-display">
        <div class="container">
            <h2 class="text-center">Medicines</h2>
			
			<?php
			
				//Display medicine that are active
			$sql = "SELECT * FROM tblmedicine WHERE active='Yes'";
			
			//Execute query
			$res = mysqli_query($con, $sql);
			
			//Count rows
			$count = mysqli_num_rows($res);
			
			//Check whether the medicine are available or not
			if($count > 0)
			{
				//Medicine available
				while($row=mysqli_fetch_assoc($res))
				{
					$id = $row['id'];
					$title = $row['title'];
					$description = $row['description'];
					$price = $row['price'];
					$image_name = $row['imageName'];
					
					?>
			
					<div class="medicine-display-box">
						<div class="medicine-display-img">
							
							<?php
								//Check whether image is available or not
								if($image_name == "")
								{
									//image not available
									echo "<div class='error'>Medicine not Available!</div>";
								}
								else
								{
									//image not available
									?>
							
									<img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>" class="img-responsive img-curve">
							
									<?php
								}
					
					
							?>
							
							
						</div>

						<div class="medicine-display-desc">
							<h4><?php echo $title; ?></h4>
							<p class="medicine-price">Rs <?php echo $price; ?></p>
							<p class="medicine-detail">
								<?php echo $description; ?>
							</p>
							<br>

							<a href="<?php echo SITEURL; ?>order.php?medicine_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
						</div>
					</div>
			
					<?php
				}
			}
			else
			{
				//Medicine not available
				echo "<div class='error'>Medicine not Found!</div>";
			}
			
			?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>