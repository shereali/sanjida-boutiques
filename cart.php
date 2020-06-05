<?php require_once 'core/init.php';?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>

<?php if ($cart_id!='') {
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
 		<legend class="uk-shopping-basket">My Shopping Cart || <strong class="text-right"><span class="glyphicon glyphicon-phone"><b>Our<img src="images/bkash.jpg" style="width:100px; height:45px;" alt=""> 01732778812</b></span></strong></legend>
 		
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
			<button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?=$product['id'];?>','<?=$item['size'];?>');">-</button>	
			<?=$item['quantity'];?>
			<?php if($item['quantity'] < $available):?>
			<button class="btn btn-xs btn-default" onclick="update_cart('addone','<?=$product['id'];?>','<?=$item['size'];?>');">+</button>
			<?php else: ?>
			<span class="text-danger">Max Reached</span>
			<?php endif; ?>
				
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
 		<table class="table table-bordered table-condensed table-striped text-right">
 		<legend>Totals</legend>
 			<thead>
 			<th>Total Items</th>
 			<th>Sub Total</th>
 			<!-- <th>Tax</th> -->
 			<th>Grand Total</th>
 			</thead>
 			<tbody>
 			<tr>
 			<td><?=$item_count;?></td>
 			<td><?=money($sub_total);?></td>
 			<!-- <td><?=money($tax);?></td> -->
 			<td class="bg-success"><?=money($sub_total);?></td>
 			</tr>
 			</tbody>
 		</table>
 		<!-- checkout button -->


<a href="checkout.php" class="btn btn-lg btn-warning pull-right" style="border-radius: 0px !important;"><span class="glyphicon glyphicon-shopping-cart"></span> <strong style="color:#E1106C !important;">b</strong><strong style="color:#000 !important;">Kash</strong> Payment</a>
<!-- Modal -->
<?php endif;?>
<?php include 'includes/footer.php';?>