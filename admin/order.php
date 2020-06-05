<?php $txnQuery="SELECT t.id,t.cart_id,t.full_name,t.description,t.txn_date,t.grand_total,c.items,c.paid,c.shipped FROM transactions t LEFT JOIN cart c ON t.cart_id=c.id WHERE c.paid=1 AND c.shipped=0 ORDER BY t.txn_date";
$txnResults=$db->query($txnQuery);
?>
 <legend class="text-info"><span class="glyphicon glyphicon-shopping-cart"></span> Order by card</legend>
	<table class="table table-condensed table-stripe table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Description</th>
				<th>Order</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
		<?php while($order=mysqli_fetch_assoc($txnResults)): ?>

			<tr>
				<td><a href="orders.php?txn_id=<?=$order['id'];?>" class="btn btn-success btn-sm">Details</a></td>
				<td><?=$order['full_name'];?></td>
				<td><?=$order['description'];?></td>
				<td><?=money($order['grand_total']);?></td>
				<td><?=pretty_date($order['txn_date']);?></td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>



<legend class="text-info"><span class="glyphicon glyphicon-shopping-cart"></span> Order Bkash</legend>
  <table class="table table-bordered table-condensed table-striped">
    <tr>
      <th class="text-info bg-info">Customer Name</th>
      <th>Address</th>
      
      <th class="text-info bg-info">Product Title</th>
      <th class="text-success bg-success">Product Picture</th>
      <th class="text-danger bg-danger">Quantity</th>
      <th class="text-danger bg-danger">Amount</th>
      <th class="text-info bg-info">Invoice</th>
      <th class="text-warning bg-warning">Order Date</th>
      <th class="text-success bg-success">Status</th>
     
      <th class="alert-warning">Add to group</th>
    </tr>
<?php
$order="SELECT * FROM orders ";
$orderQ=$db->query($order);
while($fetchO=mysqli_fetch_assoc($orderQ)):
extract($fetchO);
$odId=$id; 

$customer="SELECT * FROM customers WHERE id='$customer_id'";
$customerQ=$db->query($customer);
while($fetchCustomer=mysqli_fetch_assoc($customerQ)):
  extract($fetchCustomer);





$product="SELECT * FROM products WHERE id='$product_id'";
$productQ=$db->query($product);
while($fetchP=mysqli_fetch_assoc($productQ)):
  extract($fetchP);
?>
    <tr>
     <td class="text-info"><?=$full_name;?></td>
      <td>
      <strong>Address: </strong><?=$address;?><br>
      <strong>Contact: </strong><?=$phone;?><br>
      <strong>Bikash No: </strong><?=$bikash_no;?><br>
      <strong>Email: </strong><?=$email;?></td>
      <td class="text-info"><?=$title;?></td>
      <?php $picture=explode(',', $image); ?>
      <td><img class="img-thumbnail" style="width:80px;height:80px;" src="<?=$picture[0];?>" alt=""></td>
     
      
      <td class="text-info"><?=$quantity;?></td>
      <td class="text-info">$<?=$amount;?></td>
      <td class="text-info"><?=$invoice;?></td>
      <td class="text-info"><?=pretty_date($order_date);?></td>
      <td class="text-info"><a href="index.php?completed=<?=$fetchO['id'];?>" id="order"  class="btn btn-success btn-sm <?=(($status=='Completed')?'disabled btn-danger':'');?>" ><?=$status; ?></a></td>
      
      <td><a href="index.php?del=<?=$odId;?>" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
    </tr>
<?php endwhile; ?>
<?php endwhile; ?>
<?php endwhile; ?>
  </table>

  <script type="text/javascript">
    jQuery.ajax({
  url:'/admin/parsers/orderSubmit.php',
    method:'post',
    data :data,
    success:function(data){
      
    },
})
  </script>

   