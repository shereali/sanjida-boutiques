<?php if (isset($_GET['edit'])) {
	$edit_id=$_GET['edit'];
	$editSql="SELECT * FROM customers WHERE username='$edit_id'";
	$editR=$db->query($editSql);
	while($edit=mysqli_fetch_assoc($editR)){
		extract($edit);
	}
} 
?>
<?php $sql="SELECT address,bikash_no FROM customers WHERE username='$user'";
$run=$db->query($sql);
$check=mysqli_num_rows($run);
while($fetch=mysqli_fetch_assoc($run)){
extract($fetch);
}
?>

<div class="col-md-6">
<?php 
if (isset($_POST['add_record'])) {
	
	$address=sanitize($_POST['address']);
	$bikash_no=sanitize($_POST['bikash_no']);
	$insertAddress="INSERT INTO customers(address,bikash_no) VALUES('$address','$bikash_no') WHERE username='$user'";
	if (isset($_GET['edit'])) {
		$insertAddress="UPDATE customers SET address='$address', bikash_no='$bikash_no' WHERE username='$user'";
	}

	$insertQ=$db->query($insertAddress);
	if ($insertQ) {
		if (isset($_GET['edit'])) {
			echo "<h4 class='alert-success'>Address Updated</h4>";
		}
		
	}
	else{
		echo "<script>window.open('checkout.php?finish','_')</script>";
	}
	
}
?>
<legend>Provide shipping address</legend><hr>
<?php if ($address=="" && $bikash_no=="" || isset($_GET['edit'])): ?>
	<form action="" class="form" method="post">
	<div class="form-group">
		<label for="address">Address</label>
		<input type="text" name="address" class="form-control" value="<?=((isset($_GET['edit']))? $address:'')?>">
	</div>
	<div class="form-group">
		<label for="bikash_no">Bikash Number</label>
		<input type="text" name="bikash_no" class="form-control" value="<?=((isset($_GET['edit']))? $bikash_no:'');?>">
	</div>
	<a href="checkout.php?finish" style="margin:3px;" class="btn btn-sm btn-warning pull-right"><span class="glyphicon glyphicon-send"></span> Next</a>
	<a href="cart.php" style="margin:3px;" class="btn btn-sm btn-warning pull-right"><span class="glyphicon glyphicon-shopping-cart"></span>Back To Cart</a>

	<input type="submit" name="add_record" style="margin:3px;" class="btn btn-success btn-sm pull-right" value="<?=((isset($_GET['edit']))? 'Upadate':'Save');?>">
</form>

<?php else: ?>

<ul class="list-group">
	<li class="list-group-item"><span class="glyphicon glyphicon-home"></span> <?=$address;?></li>
	<li class="list-group-item"><span class="glyphicon glyphicon-phone"></span> <?=$bikash_no;?></li><br>
	<a href="checkout.php?finish" style="margin:3px;" class="btn btn-sm btn-warning pull-right"><span class="glyphicon glyphicon-send"></span> Next</a>
	<a href="cart.php" style="margin:3px;" class="btn btn-sm btn-warning pull-right"><span class="glyphicon glyphicon-shopping-cart"></span>Back To Cart</a>

	<a href="checkout.php?edit=<?=$user;?>" style="margin:3px;" class="btn btn-sm btn-success pull-right"><span class="glyphicon glyphicon-edit"></span> Edit</a>
	
</ul>

</div>
<?php endif ?>

