<?php ob_start();?>
<?php require_once '../core/init.php';?>
<?php $id=$_POST['id'];
$id=(int)$id;
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
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button class="close" onclick="closeModal()" type="button" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title text-center" style="color:#FB5620;"><?=$product['title']; ?></h4>
		</div>
		<div class="modal-body">
			<div class="container-fluid">
				<div class="row">
				<span id="modal_errors" class="bg-danger"></span>
					<div class="col-sm-6 fotorama">
					<?php $photos=explode(',', $product['image']);
						foreach($photos as $photo):
						 ?>
					<img src="<?=$photo;?>" alt="<?=$product['title'];?>" class="details img-responsive">	
					<?php endforeach; ?>
					</div>
					<div class="col-sm-6">
						<h4>Details</h4>
						<p style="line-height:20px;"><?=$product['description']; ?>
						</p>
						<hr>
						<p>Price:৳ <?=$product['price']; ?></p>
						<p>Brand: <?=$brand['brand']; ?></p>
						<form action="add_cart.php" method="post" id="add_product_form">
							<input type="hidden" name="product_id" value="<?=$id;?>">
							<input type="hidden" name="available" id="available" value="">
							<div class="form-group">
								<div class="form-group">
									<div class="col-xs-6">
										<label for="quantity">Quantitry:</label>
										<input type="number" class="form-control" id="quantity" name="quantity" min="0">
									</div>
									<div class="col-xs-6"></div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
									<label for="size">Size:</label>
									<select name="size" id="size" class="form-control">
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
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-default" type="button" onclick="closeModal()" >Close</button>
			<button class="btn btn-warning" type="button" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-shopping-cart">Add To Cart</span></button>
		</div>
		</div>
	</div>
</div>
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
<?php echo ob_get_clean();?>

