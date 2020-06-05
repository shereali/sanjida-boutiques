<?php
$cat_id=((isset($_REQUEST['cat']))?sanitize($_REQUEST['cat']):'');
 $price_sort=((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):''); 
$min_price=((isset($_REQUEST['min_price']))?sanitize($_REQUEST['min_price']):'');
$max_price=((isset($_REQUEST['max_price']))?sanitize($_REQUEST['max_price']):'');
$b=((isset($_REQUEST['brand']))?sanitize($_REQUEST['brand']):'');
$brandQ=$db->query("SELECT * FROM brand ORDER BY brand");
?>
<legend><small class="custom-header-color"><b><span class="glyphicon glyphicon-filter"></span> Filtering Search</b></small></legend>
<!-- <h4 class="">Price</h4> -->
<form action="search.php" class="form" method="post">
<ul class="list-group">
	<input type="hidden" name="cat" value="<?=$cat_id;?>">
	<input type="hidden" name="price_sort" value="0">
	<li class="list-group-item"> <input type="radio" name="price_sort" value="low"<?=(($price_sort=='low')?'checked':'');?>> <small>Low to High</small></li>
	<li class="list-group-item"> <input type="radio" name="price_sort" value="high"<?=(($price_sort=='high')?'checked':'');?>> <small>High to Low </small></li>	
</ul>
<h3 class="" style="padding:0px !important"><small class="custom-header-color">Search by price</small></h3>
<ul class="list-group">
	<input type="text" name="min_price" class="price-range form-control pull-left " placeholder="Min $" value="<?=$min_price;?>"><small>&nbsp;TO</small>
	<input type="text" name="max_price" class="price-range form-control pull-right" placeholder="Max $" value="<?=$max_price;?>">
</ul>	
	<h3 class="" style="padding:0px !important"><small class="custom-header-color">Search By Brand</small></h3>

<ul class="list-group">


	<li class="list-group-item"><input type="radio" name="brand" value=""<?=(($b=='')?'checked':'');?>> <small>All</small></li>
	<?php while($brand=mysqli_fetch_assoc($brandQ)): ?>
	<li class="list-group-item"><input type="radio" name="brand" value="<?=$brand['id'];?>" <?=(($b==$brand['id'])?'checked':'');?>> <small><?=$brand['brand'];?></small></li>

	<?php endwhile; ?><br>
	<input type="submit" value="Click To Search" name="" id="" class="btn btn-success btn-xs form-control">
</ul>
</form>




    
