<?php include('partials-front/menu.php'); ?>

<section class="categories-body">

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Medicines</h2>
			

			<?php
			
				//Display all the categories that are active
				//sql query
				$sql = "SELECT * FROM tblcategory WHERE active='Yes'";
			
				//Execute the query
				$res = mysqli_query($con, $sql);
			
				//Count rows
				$count = mysqli_num_rows($res);
			
				//Check whether categories available or not
				if($count > 0)
				{
					//categories available
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
						
								if($image_name == "")
								{
									//Image not available
									echo "<div class='error'>Image not Found!</div>";
								}
								else
								{
									//Image available
									?>
								
									<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Medicine" class="img-responsive img-curve">
								
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
					//categories not available
					echo "<div class='error'>Category not Found</div>";
				}

			?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
</section>
<?php include('partials-front/footer.php'); ?>