<?php include('partials-front/menu.php'); ?>

<?php

	//Check whether id is passed or not
if(isset($_GET['categoryId']))
{
	//Category id is set and get the id
	$category_id = $_GET['categoryId'];
	//Get the category title based on category id
	$sql = "SELECT title FROM tblcategory WHERE id=$category_id";
	
	//Execute the query
	$res = mysqli_query($con, $sql);
	
	//get the value from database
	$row = mysqli_fetch_assoc($res);
	
	//Get the title
	$category_title = $row['title'];
}
else
{
	//Category not passed
	//Redirect to home page
	header('location:'.SITEURL);
}

?>

    <!-- Medicine search Section Starts Here -->
    <section class="medicine-search text-center">
        <div class="container">
            
            <h2>Medicines on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Medicine search Section Ends Here -->



    <!-- Medicine display Section Starts Here -->
    <section class="medicine-display">
        <div class="container">
            <h2 class="text-center">Medicines</h2>
			
			<?php
			
			//Create sql query to get medicine based on selected category
			$sql2 = "SELECT * FROM tblmedicine WHERE categoryId=$category_id";
			
			//Execute the query
			$res2 = mysqli_query($con, $sql2);
			
			//Count the rows
			$count2 = mysqli_num_rows($res2);
			
			//Check whether medicine is available
			if($count2 > 0)
			{
				//Medicine available
				while($row2=mysqli_fetch_assoc($res2))
				{
					$id = $row2['id'];
					$title = $row2['title'];
					$description = $row2['description'];
					$price = $row2['price'];
					$image_name = $row2['imageName'];
					
					?>
			
					<div class="medicine-display-box">
						<div class="medicine-display-img">
							
							<?php
					
							if($image_name == "")
							{
								//Image not available
								echo "<div class='error'>Image not Available!</div>";
							}
							else
							{
								//Image available
								?>
							
								<img src="<?php echo SITEURL; ?>images/medicine/<?php echo $image_name; ?>"  class="img-responsive img-curve">
							
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
				echo "<div class='error'>Medicine not Available!</div>";
			}
			
			?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Medicine display Section Ends Here -->

<?php include('partials-front/footer.php'); ?>