

 <div class="col-md-12">
 <legend>My Orders</legend>
 	<table class="table table-bordered table-condensed table-striped">
 		<tr>
 			<th>Product Name</th>
 			<th>Product Picture</th>
 			<th>Quantity</th>
 			<th>Amount</th>
 			<th>Invoice</th>
 			<th>Order Date</th>
 			<th>Status</th>
 			<th>Paid</th>
 			<th>Add to group</th>
 		</tr>

 		<?php
$customer="SELECT * FROM customers WHERE username='$user'";
$customerQ=$db->query($customer);
while($fetchCustomer=mysqli_fetch_assoc($customerQ)):
	extract($fetchCustomer);

$order="SELECT * FROM orders WHERE customer_id='$id'";
$orderQ=$db->query($order);
while($fetchO=mysqli_fetch_assoc($orderQ)):
extract($fetchO);
$odId=$id;	


$product="SELECT * FROM products WHERE id='$product_id'";
$productQ=$db->query($product);
while($fetchP=mysqli_fetch_assoc($productQ)):
	extract($fetchP);

 ?>
 		<tr>
 			<td><?=$title;?></td>
			<?php $picture=explode(',', $image); ?>
 			<td><img class="img-thumbnail" style="width:80px;height:80px;" src="<?=$picture[0];?>" alt=""></td>
 			<td><?=$quantity;?></td>
 			<td><?=$amount;?></td>
 			<td><?=$invoice;?></td>
 			<td><?=pretty_date($order_date);?></td>
 			<td><?=$status;?></td>
 			<td><?=(($paid==1)?'Paid':'Unpaid');?></td>
 			<td><a href="index.php?del=<?=$odId;?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
 		</tr>
 	<?php endwhile; ?>
 	<?php endwhile; ?>
 	<?php endwhile; ?>
 	</table>
 </div>