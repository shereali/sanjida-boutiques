<?php if ($cart_id!='') {
	$cartQ=$db->query("SELECT * FROM cart WHERE id='{$cart_id}'");
	$result=mysqli_fetch_assoc($cartQ);
	$items=json_decode($result['items'],true);
	$i=1;
	$sub_total=0;
	$item_count=0;
}
?>
<?php 
$getCustomer="SELECT*FROM customers WHERE username='$user'";
$customerQ=$db->query($getCustomer);
while($fetchCustomer=mysqli_fetch_assoc($customerQ))
extract($fetchCustomer);
$customer_id=$id; 
$invoice=mt_rand();


if ($cart_id!='') {
	$cartQ=$db->query("SELECT * FROM cart WHERE id='{$cart_id}'");
	$result=mysqli_fetch_assoc($cartQ);
	$items=json_decode($result['items'],true);
	$i=1;
	$sub_total=0;
	$item_count=0;
}
?>
<div class="container-fluid">
 <div class="row">
 	<div class="col-md-12">
 		<legend >Order Details</legend>
 		<?php if ($cart_id==''): ?>
 			<div class="bg-danger">
 				<p class="text-center text-danger">Your shopping cart is empty!</p>
 			</div>
 		<?php else: ?>
		<table class="table table-bordered table-condensed table-striped">
			<thead>
			<th>#</th>
			<th>Picture</th>
			<th>Title</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Size</th>
			<th>Sub Total</th>
			</thead>
		
		<tbody>
<?php 
		foreach ($items as $item) {
			$product_id=$item['id'];
			$productQ=$db->query("SELECT * FROM products WHERE id='{$product_id}'");
			$product=mysqli_fetch_assoc($productQ);
			$sArray=explode(',', $product['sizes']);

			foreach($sArray as $sizeString){
				$s=explode(':', $sizeString);
				if ($s[0]==$item['size']) {
					$available=$s[1];
				}
			}
?>
			<tr>
			<td><?=$i;?></td>
			<?php $image=explode(',', $product['image']); ?>
			<td><img src="<?=$image[0];?>" style="width:70px;height:80px;" class="img-thambnail" alt=""></td>
			<td><?=$product['title'];?></td>
			<td><?=money($product['price']);?></td>
			<td>
			<?=$item['quantity']; ?>
			</td>
			<td><?=$item['size'];?></td>
			<td><?=money($item['quantity']*$product['price']);?></td>


			</tr>
<?php
	$i++;
	$item_count += $item['quantity'];
	$sub_total +=($product['price']*$item['quantity']);


		}

		// $tax=TAXRATE * $sub_total;
		// $tax=number_format($tax,2);
		// $grand_total=$tax+$sub_total;
?>
			
		</tbody>
 		</table>
 		<div class="col-md-6">

 			<ul>
 			<legend>Shipping Details</legend>
 				<li class="list-group-item"><?=$full_name;?></li>
 				<li class="list-group-item"><?=$address;?></li>
 				<li class="list-group-item"><?=$phone;?></li>
 				<li class="list-group-item">Bikash:<?=$bikash_no;?></li>
 			</ul>
 		</div>
 		<div class="col-md-6 ">
 		<table class="table table-bordered table-condensed table-striped text-right">
 		<legend>Totals</legend>
 			<thead>
 			<th>Total Items</th>
 			<th>Sub Total</th>
 			</thead>
 			<tbody>
 			<tr>
 			<td><?=$item_count;?></td>
 			<td class="bg-success"><?=money($sub_total);?></td>
 			</tr>
 			</tbody>
 		</table>
 		<form action="thankYou.php" method="post">
	<input type="hidden" name="username" value="<?=$user;?>">
	<input type="hidden" name="cart_id" value="<?=$cart_id;?>">
	<input type="hidden" name="product_id" value="<?=$product_id;?>">
	<input type="hidden" name="customer_id" value="<?=$customer_id ;?>">
	<input type="hidden" name="quantity" value="<?=$item['quantity'];?>">
	<input type="hidden" name="invoice" value="<?=$invoice;?>">
	<input type="hidden" name="amount" value="<?=$sub_total;?>">
	<input type="hidden" name="status" value="in progress">
	<input type="submit" name="save_order" class="btn btn-warning btn-md form-control" value="Finish">
</form>
</div>
<?php endif;?>
