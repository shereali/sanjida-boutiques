<?php require_once 'core/init.php' ?>
<?php include 'includes/head.php'; ?>
<?php 	include 'includes/navigation.php'; ?>
<?php include 'includes/slider.php'; ?>
<?php include 'includes/left_sidebar.php'; ?>
<?php 
$sql="SELECT * FROM products";

$cat_id=(($_POST['cat']!='')?sanitize($_POST['cat']):'');
if ($cat_id=='') {
	$sql .=' WHERE deleted=0';
}
else{
	$sql .=" WHERE categories='{$cat_id}' AND deleted=0 ";
}


$price_sort=(($_POST['price_sort'] !='')?sanitize($_POST['price_sort']):'');
$min_price=(($_POST['min_price'] !='')?sanitize($_POST['min_price']):'');
$max_price=(($_POST['max_price'] !='')?sanitize($_POST['max_price']):'');
$brand=(($_POST['brand'] !='')?sanitize($_POST['brand']):'');

if ($min_price!='') {
	$sql .=" AND price >='{$min_price}' ";
}

if ($max_price !='') {
	$sql .=" AND price <='{$max_price}' ";
}

if ($brand !='') {
	$sql .=" AND brand='{$brand}' ";
}

if ($price_sort =='low') {
	$sql .=" ORDER BY price";
}

if ($price_sort =='high') {
	$sql .=" ORDER BY price DESC ";
}


$productQ=$db->query($sql);
$category=get_category($cat_id);
 ?>

	<!-- Main Content -->
	<div class="col-md-10">
		<div class="row">
		<?php if($cart_id!=''): ?>
			<legend class="text-center"><?=$category['parent'].' '.$category['child']; ?></legend>
		<?php else: ?>
			<h1><small class="custom-header-color"><b>Search From Dumlong...</b></small></h1><hr>
		<?php endif; ?>
			<?php 
			$i=0;
			while($product=mysqli_fetch_assoc($productQ)): 
			extract($product);
			$i=0;?>
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

<?php include 'includes/footer.php'; ?>
</div>
<!-- Modal -->

<!-- Left sidebar End -->
