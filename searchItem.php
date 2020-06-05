<?php include 'core/init.php'; ?>
<?php include 'includes/head.php'; ?>
<?php include 'includes/navigation.php'; ?>
<div class="container-fluid">
<div class="row">
<?php include 'includes/left_sidebar.php'; ?>


<div class="col-md-10">

<legend>You are searching.. <small class="custom-header-color"><b><?php echo $_POST['search_item']; ?></b></small></legend>
<?php 
if (isset($_POST['search'])):
	$search_item=$_POST['search_item'];
	$sql="SELECT*FROM products WHERE title LIKE '%$search_item%' AND featured=1";
	$query=$db->query($sql);
	while($fetchAll=mysqli_fetch_assoc($query)):
		extract($fetchAll);
?>


				
		<div class="text-center col-md-3 overlay" style="margin:0px;padding-left:0px;padding-right:0px; padding-top:25px; height:485px !important;" >
				
				<?php $photos=explode(',', $image); ?>
				

				<a href="single_products.php?id=<?=$id;?>&<?=$photos[$id]?>"><img id="zoom_01" style="height:300px; width:80% !important;" class="" src="<?=$photos[0]; ?>" alt="<?php echo $title; ?>" data-zoom-image="<?=$photos[0]; ?>"/></a>
				<p style="height:30px;line-height:15px; font-size:15px; padding:0px 19px;"><small class="custom-header-color"><b><a href="single_products.php?id=<?=$id;?>&<?=$photos[$id]?>"><?php echo substr($title,0,60); ?></a></b></small></p>
				<p class="list-price text-danger"><small>List Price: <s>৳<?= $list_price; ?></s></small></p>
				<p class="price"><small class="custom-header-color"><b>Our Price:৳ <?= $price; ?></b></small></p>
				<a href="single_products.php?id=<?=$id;?>&<?=$photos[$id]?>" class="btn btn-sm custom-button-background  custom-white-color" ><b>Buy Now</b></a>
			</div>
<?php endwhile;?>
<?php endif;?>
</div>
</div>
</div>
<?php include 'includes/footer.php'; ?>



