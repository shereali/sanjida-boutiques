<?php require_once 'core/init.php' ?>
<?php include 'includes/head.php'; ?>
<?php 	include 'includes/navigation.php'; ?>
<?php include 'includes/slider.php'; ?>
<?php include 'includes/left_sidebar.php'; ?>
<?php if (isset($_GET['cat'])) {
	$cat_id=sanitize($_GET['cat']);
}else{
	$cat_id='';
	}
?>
<?php $sql="SELECT * FROM products WHERE categories='$cat_id'";
$productQ=$db->query($sql);
$category=get_category($cat_id);
?>

	<!-- Main Content -->
	<div class="col-md-10">
		<div class="row">
			<legend ><?=$category['parent'].' '.$category['child']; ?></legend>
			<?php while($product=mysqli_fetch_assoc($productQ)): 
			extract($product);?>
			<div class="text-center col-md-3 overlay" style="margin:0px;padding-left:0px;padding-right:0px; padding-top:25px; height:485px !important;" >
				
				<?php $photos=explode(',', $image); ?>
				

				<a href="single_products.php?id=<?=$id;?>&<?=$photos[$id]?>"><img id="zoom_01" style="height:300px; width:80% !important;" class="" src="<?=$photos[0]; ?>" alt="<?php echo $title; ?>" data-zoom-image="<?=$photos[0]; ?>"/></a>
				<p style="height:30px;line-height:15px; font-size:15px; padding:0px 19px;"><small class="custom-header-color"><b><a href="single_products.php?id=<?=$id;?>&<?=$photos[$id]?>"><?php echo substr($title,0,60); ?></a></b></small></p>
				<p class="list-price text-danger"><small>List Price: <s>৳<?= $list_price; ?></s></small></p>
				<p class="price"><small class="custom-header-color"><b>Our Price:৳ <?= $price; ?></b></small></p>
				<a href="single_products.php?id=<?=$id;?>&<?=$photos[$id]?>" class="btn btn-sm custom-button-background  custom-white-color" ><b>Buy Now</b></a>
			</div>
		<?php endwhile; ?>
		</div>
	</div>

</div>
<!-- Modal -->
<!-- Left sidebar End -->
<?php include 'includes/footer.php'; ?>