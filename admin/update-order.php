<?php include('partials/menu.php'); ?>

<div class="main-content">
		<div class="wrapper">
			<h1>Update Order</h1>

			<br><br>
			
			<?php
			
				//Check whether id is set or not
			if(isset($_GET['id']))
			{
				//get the order details
				$id=$_GET['id'];
				
				//get other details based on the id
				//sql query to get order details
				$sql = "SELECT * FROM tblorder WHERE id=$id";
				
				//Execute the query
				$res = mysqli_query($con,$sql);
				
				//count rows
				$count = mysqli_num_rows($res);
				
				if($count==1)
				{
					//detail Available
					$row=mysqli_fetch_assoc($res);
					
					$medicine = $row['medicine'];
					$price = $row['price'];
					$quantity = $row['qty'];
					$status = $row['status'];
					$customer_name = $row['customer_name'];
					$customer_contact = $row['customer_contact'];
					$customer_email = $row['customer_email'];
					$customer_address = $row['customer_address'];
				}
				else
				{
					//detail not available
					//redirect to manage order
					header('location:'.SITEURL.'admin/manage-order.php');
				}
			}
			else
			{
				//Redirect to Manage order page
				header('location:'.SITEURL.'admin/manage-order.php');
			}
			
			?>
			
			<form action="" method="POST">
				
				<table class="tbl-30">
				
					<tr>
						<td>Medicine Name</td>
						<td><b><?php echo $medicine; ?></b></td>
					</tr>
					
					<tr>
						<td>Price</td>
						<td><b>Rs <?php echo $price; ?></b></td>
					</tr>
					
					<tr>
						<td>Quantity</td>
						<td><input type="number" name="qty" value="<?php echo $quantity; ?>"></td>
					</tr>
					
					<tr>
						<td>Status</td>
						<td>
							<select name="status">
								<option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
								<option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
								<option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
								<option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Customer Name</td>
						<td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
					</tr>
					
					<tr>
						<td>Customer Contact</td>
						<td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
					</tr>
					
					<tr>
						<td>Customer Email</td>
						<td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
					</tr>
					
					<tr>
						<td>Customer Address</td>
						<td><textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
					</tr>
					
					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>"> <!--To know which id we are passing-->
							<input type="hidden" name="price" value="<?php echo $price; ?>">  <!--Cuz we need to calculate the total and need price for that-->
							<input type="submit" name="submit" value="Update Order" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
			
			<?php
			
				//check whether update button is clicked or not
			if(isset($_POST['submit']))
			{
				//get values from form
				$id = $_POST['id'];
				$price = $_POST['price'];
				$qty = $_POST['qty'];
				$total = $price * $qty;
				$status = $_POST['status'];
				$customer_name = $_POST['customer_name'];
				$customer_contact = $_POST['customer_contact'];
				$customer_email = $_POST['customer_email'];
				$customer_address = $_POST['customer_address'];
				
				//update the value
				$sql2 = "UPDATE tblorder SET
				qty = $qty,
				total = $total,
				status = '$status',
				customer_name = '$customer_name',
				customer_contact = '$customer_contact',
				customer_email = '$customer_email',
				customer_address = '$customer_address'
				WHERE id=$id
				";
				
				//execute query
				$res2 = mysqli_query($con, $sql2);
				
				//check whether updated or not
				//And redirect to manage order with message
				if($res2 ==  true)
					{
						//medicine updated
						$_SESSION['update'] = "<div class='success'>Order Updated Successfully!</div>";
						header('location:'.SITEURL.'admin/manage-order.php');
					}
				else
				{
					//Failed to update medicine
					$_SESSION['update'] = "<div class='error'>Failed to Update Order!</div>";
					header('location:'.SITEURL.'admin/manage-order.php');
				}
			}
			
			?>
			
	</div>
</div>



<?php include('partials/footer.php'); ?>