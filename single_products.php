<?php require_once 'core/init.php';?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
<script type="text/javascript">
	
</script>
<?php 
if (isset($_GET['id'])):
	$id=$_GET['id'];


$sql="SELECT * FROM products WHERE id='$id'";
$result=$db->query($sql);
$product=mysqli_fetch_assoc($result);
$brand_id=$product['brand'];
$sql="SELECT brand FROM brand WHERE id='$brand_id'";
$brand_query=$db->query($sql);
$brand=mysqli_fetch_assoc($brand_query);
$sizestring=$product['sizes'];
$sizestring=rtrim($sizestring,',');
$size_array=explode(',', $sizestring);
?>
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-6  page-header fotorama">
			<?php 
			$i=0;
			$photos=explode(',', $product['image']);
						foreach($photos as $photo):
							$i++;
						 ?>
					<a href="single_products.php?id=<?=$id;?>&<?=$photos[$i];?>"><img src="<?=$photo;?>" alt="<?=$product['title'];?>" class="details img-responsive"></a>	
					<?php endforeach; ?>
		</div>
		<div class="col-md-5">
		<div class="page-header"><a href="single_products.php?id=<?=$id;?>&<?=$photos[$i];?>"><h3><?=$product['title']; ?></h3></a>
			
			<p>Mens~T-Shirt</p>
			<h2>৳<?=$product['price'];?></h2>
			</div>
			<?php
			$i=0;
			$photos=explode(',', $product['image']);
						foreach($photos as $photo):
							$i++;
						 ?>
					<a href="single_products.php?id=<?=$id;?>&<?=$photos[$i] ;?>"><img src="<?=$photo;?>" alt="<?=$product['title'];?>" class="" style="width:80px;height:80px;"></a>	
					<?php endforeach; ?>
			<!-- <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg" style="width:80px;height:80px;" alt="">
			<img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg" style="width:80px;height:80px;" alt="">
			<img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg" style="width:80px;height:80px;" alt="">
			<img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg" style="width:80px;height:80px;" alt="">
			<img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Blue_Tshirt.jpg" style="width:80px;height:80px;" alt=""> -->

<div class="page-header">
<span id="modal_errors" class="bg-danger"></span>
	Provide Size & Quantity
	</div>

			<form action="add_cart.php" method="post" id="add_product_form">
							<input type="hidden" name="product_id" value="<?=$id;?>">
							<input type="hidden" name="available" id="available" value="">
							
									
								
								<div class="form-inline col-md-3">
									
									<label for="size">Size:</label>
									<select name="size" id="size" class="form-control" style="margin:5px;border-radius:0px !important; width:115px !important;">
										<option >Select quantity</option>
										<?php 
											foreach($size_array as $string){
											$string_array=explode(':', $string);
											$size=$string_array[0];
											$available=$string_array[1];
											if ($available > 0) {
												echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.'('.$available.' Available)</option>';
											}
										 
										}
										?>
										
									</select>	
								</div>
								<div class="form-inline col-md-3">
							<label for="quantity">Quantitry:</label>
										<input type="number" class="form-control" id="quantity" name="quantity" min="0" style="margin:5px;border-radius:0px !important; width:110px !important;">
							</div>
								<div class="form-inline col-md-3">
										<button class="btn custom-primary-color" type="button" onclick="add_to_cart();return false;" style="margin:30px 0px;border-radius:0px !important; width:120px !important;"><span class="glyphicon glyphicon-shopping-cart">AddToCart</span></button>
									</div>
							</div>

						</form>
				
		</div>
		<hr>
		<div class="col-md-12"></div>
	</div>
</div>
<?php endif; ?>
<script type="text/javascript">
jQuery('#size').change(function(){
	var available = jQuery('#size option:selected').data("available");
	jQuery('#available').val(available);
});


	function closeModal(){
		jQuery('#details-modal').modal('hide');
		setTimeout(function(){
			jQuery('#details-modal').remove();
		},500);
	};

	$(function () {
  $('.fotorama').fotorama({'loop':true, 'autoplay':true });
});
</script>
<?php include 'includes/footer.php'; ?>