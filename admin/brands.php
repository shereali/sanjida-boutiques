<?php require_once '../core/init.php';?>
<?php if (!is_logged_in()) {
	login_error_redirect();
}
?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
<!-- Get brand from database -->
<div class="container">
<?php 
$sql="SELECT * FROM brand ORDER BY brand";
$results=$db->query($sql);
$errors=array(); 


//Edit

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id=(int)$_GET['edit'];
	$edit_id=sanitize($edit_id);
	$sql2="SELECT*FROM brand WHERE id='$edit_id'";
	$edit_result=$db->query($sql2);

	$eBrand=mysqli_fetch_assoc($edit_result);

}


// Delete brand
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id=(int)$_GET['delete'];
	$delete_id=sanitize($delete_id);
	$sql="DELETE FROM brand WHERE id='$delete_id'";
	$db->query($sql);
	header("location:brands.php");
}



// If add form is submitted
if (isset($_POST['add_submit'])) {
	$brand=sanitize($_POST['brand']);


// Check if brand is blank
if ($_POST['brand']=='') {
	$errors[].='You must enter a brand';
}

// Check if brand exits in database
	$sql="SELECT*FROM brand WHERE brand='$brand'";
	if (isset($_GET['edit'])) {
	$sql="SELECT*FROM brand WHERE brand='$brand' AND id !='$edit_id'";

	}
	$result=$db->query($sql);
	$count=mysqli_num_rows($result);
	if ($count>0) {
		$errors[].=$brand.'&nbsp;'.'brand is already exist. Please try another name....';
	}


// Display errors
	if (!empty($errors)) {
		echo display_errors($errors);
	}
	else{
		// Add brand to database
		$sql="INSERT INTO brand(brand) VALUES('$brand')";
		if (isset($_GET['edit'])) {
			$sql="UPDATE brand SET brand='$brand' WHERE id='$edit_id'";
		}
		$db->query($sql);
		header("location:brands.php");
	}
}
?>
<legend>Brands</legend>
<!-- Start form -->
<div class="text-center">
<form action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" class="form-inline" method="post">
<div class="form-group">
<?php 
$brand_value="";
if (isset($_GET['edit'])) {
	$brand_value=$eBrand['brand'];
} 

else{
	if (isset($_POST['brand'])) {
		$brand_value=sanitize($_POST['brand']);
	}
}

?>
	<label for="brand"><?=((isset($_GET['edit']))?'Edit':'Add A'.'&nbsp;'); ?>&nbsp;Brand:</label>
	<input type="text" name="brand" class="form-control" value="<?=$brand_value;?>">
	<?php if (isset($_GET['edit'])): ?>
	<a href="brands.php" class="btn btn-default">Cancel</a>
	<?php endif; ?>
	<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Brand" class="btn btn-success">

</div>	
</form>
</div><hr>
<table class="table table-bordered table-striped table-auto table-condensed">
	<thead>
		<th>Edit</th>
		<th>Brand</th>
		<th>Del</th>
	</thead>
	<tbody>
<?php 
	while($brand=mysqli_fetch_assoc($results)):
?>
	<tr>
	
		<td><a class="btn btn-xs btn-warning" href="brands.php?edit=<?=$brand['id'];?>"><span class="glyphicon glyphicon-edit"></span></a>
		</td>
		<td><?php echo $brand['brand']; ?></td>
		<td><a class="btn btn-xs btn-danger" href="brands.php?delete=<?=$brand['id'];?>"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
	
	</tr>
	<?php endwhile; ?>	
	</tbody>
</table>
</div><!--container end-->
<?php include 'includes/footer.php';?>