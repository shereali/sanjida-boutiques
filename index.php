<?php require_once 'core/init.php' ?>
<?php include 'includes/head.php'; ?>
<?php 	include 'includes/navigation.php';?>
<?php include 'includes/slider.php'; ?>
<?php //include 'includes/widgets/recent.php';?>
<?php include 'includes/left_sidebar.php';?>


<?php $sql="SELECT * FROM products WHERE featured=1";
$featured=$db->query($sql);
?>

	<!-- Main Content -->
<!-- <div class="col-md-10 ">
<h1><small class="custom-header-color"><b>Popular Products</b></small></h1><hr>
	<div class="uk-slidenav-position " data-uk-slider>

    <div class="uk-slider-container">
        <ul class="uk-slider uk-grid-width-medium-1-5">
        
			<?php while($product=mysqli_fetch_assoc($featured)): ?>
            <li class="img-thumbnail text-center">
            <h4><small><b><?php echo $product['title']; ?></b></small></h4>
				<?php $phtotos=explode(',', $product['image']); ?>
				<img style="height:250px;" src="<?=$phtotos[0]; ?>" alt="Levis Jeans" class="img-thumb img-responsive">
				<p class="list-price text-danger"><small>List Price: <s>$<?= $product['list_price']; ?></s></small></p>
				<p class="price"><small class="custom-header-color"><b>Our Price:$ <?= $product['price']; ?></b></small></p>
				<button type="button" class="btn btn-xs custom-button-background custom-white-color" onclick="detailsmodal(<?=$product['id'];?>)"><b>Buy Now</b></button>
			</li>
            <?php endwhile; ?>
        </ul>
    </div>

    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>

</div>
</div> -->


		<div class="col-md-10">
		<legend><small class="custom-header-color"><b><span class="glyphicon glyphicon-flash"></span>  Featured Products</b></small></legend><hr>
			<?php $all="SELECT * FROM products WHERE featured=1 ORDER BY rand()";
			$allQ=$db->query($all);
			$i=0;
			while($fetchAll=mysqli_fetch_assoc($allQ)):
				extract($fetchAll);
			$i++;?>

			<div class="text-center col-md-3 overlay" style="margin:0px;padding-left:0px;padding-right:0px; padding-top:25px; height:485px !important;" >
				<?php $photos = explode(",", $image); ?>
				

				<a href="single_products.php?id=<?=$id;?>&<?php echo $photos[$id];?>"><img id="zoom_01" style="height:300px; width:80% !important;" class="" src="<?php echo $photos[0];?>" alt="<?php echo $title; ?>" data-zoom-image="<?php echo $photos[0];?>"/></a>
				<p style="height:30px;line-height:15px; font-size:15px; padding:0px 19px;"><small class="custom-header-color"><b><a href="single_products.php?id=<?=$id;?>&<?php echo $photos[$id];?>"><?php echo substr($title,0,60); ?></a></b></small></p>
				<p class="list-price text-danger"><small>List Price: <s>৳<?= $list_price; ?></s></small></p>
				<p class="price"><small class="custom-header-color"><b>Our Price:৳ <?= $price; ?></b></small></p>
				<a href="single_products.php?id=<?=$id;?>&<?php echo $photos[$id];?>" class="btn btn-sm custom-button-background  custom-white-color" ><b>Buy Now</b></a>
			</div>

<?php endwhile; ?>

		</div>
	

<?php include 'includes/footer.php'; ?>




<!-- Left sidebar End -->
