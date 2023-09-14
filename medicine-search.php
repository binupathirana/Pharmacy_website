<?php include('partials-front/menu.php'); ?>

    <!-- Medicine search Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">
			<?php
			
			//Get the searched keyword
			$search = $_POST['search'];
			
			?>
            
            <h2>Medicines on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Medicine search Section Ends Here -->



    <!-- Medicine display Section Starts Here -->
    <section class="medicine-display">
        <div class="container">
            <h2 class="text-center">Medicines</h2>
			
			<?php
			
			//sql query to get medicine based on search keyword
			$sql = "SELECT * FROM tblmedicine WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
			
			//Execute the query
			$res = mysqli_query($con, $sql);
			
			//Count rows
			$count = mysqli_num_rows($res);
			
			//Check whether medicine available or not
			if($count > 0)
			{
				//Medicine available
				while($row = mysqli_fetch_assoc($res))
				{
					$id = $row['id'];
					$title = $row['title'];
					$price = $row['price'];
					$description = $row['description'];
					$image_name = $row['imageName'];
					
					?>
			
					<div class="medicine-display-box">
						<div class="medicine-display-img">
							<?php 
					
							//Check whether image is available
							if($image_name == "")
							{
								//Image not available
								echo "<div class='error'>Image not Available</div>";
							}
							else
							{
								//Image available
								?>
							
								<img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>" class="img-responsive img-curve">
							
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
				//Medicine not available
				echo "<div class='error'>Medicine not Available</div>";
			}
			
			?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Medicine display Section Ends Here -->

<?php include('partials-front/footer.php'); ?>