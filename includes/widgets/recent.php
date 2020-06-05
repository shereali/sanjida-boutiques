<legend><small class="custom-header-color"><b><span class="glyphicon glyphicon-eye-open"></span> Popular Products</b></small></legend>
<?php 
$transQ=$db->query("SELECT * FROM orders WHERE paid=1 ORDER BY id DESC LIMIT 5");
while($fetchOr=mysqli_fetch_assoc($transQ)):
	extract($fetchOr);

// $results=array();
// while($row=mysqli_fetch_assoc($transQ)){
// 	$results[]=$row;
// 	} 

// $row_count=$transQ->num_rows;
// $used_ids=array();
// for($i=0; $i<$row_count;$i++){
// 	$json_items=$results[$i]['items'];
// 	$items=json_decode($json_items,true);
// 	foreach($items as $item){
// 		if (!in_array($item['id'],$used_ids)) {
// 			$used_ids[]=$item['id'];
// 		}
// 	}
// }
?>


<div id="recent_widget">

	<table class="table table-condensed">
		<?php //foreach($used_ids as $id):
		$productQ=$db->query("SELECT * FROM products WHERE id='{$product_id}'");
		while($product=mysqli_fetch_assoc($productQ)){
			extract($product);
		}; ?>
		<tr>
			<td><?=substr($title,0,15);?></td>
			<td><a class="btn btn-success btn-xs" onclick="detailsmodal('<?=$product_id;?>')" class="text-success">Buy Now</a></td>
		</tr>
	<?php //endforeach; ?>
	</table>
<?php endwhile; ?>
</div>