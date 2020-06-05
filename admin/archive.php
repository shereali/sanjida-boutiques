<?php require_once $_SERVER['DOCUMENT_ROOT'].'/sanjida-boutiques/core/init.php';?>
<?php if (!is_logged_in()) {
	login_error_redirect();
}
?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
<?php $sql="SELECT * FROM products WHERE deleted=1";
$query=$db->query($sql);
if (isset($_GET['delete'])) {
$id=sanitize($_GET['delete']);
$db->query("UPDATE products SET deleted=0 WHERE id='$id'");
header("location:archive.php");
}
?>
<div class="container-fluid">
	<div class="row">
		
	
<legend>Archive</legend>
<a href="products.php?add=1" id="add-product-btn" class="btn btn-success pull-right">Add Product</a><div class="clearfix"></div><hr>
<table class="table table-bordered table-striped">
		<thead>
			<th></th>
			<th>product</th>
			<th>Price</th>
			<th>Category</th>
			
			<th>Sold</th>
		</thead>
		<tbody>
		<?php while($product=mysqli_fetch_assoc($query)):		
		$childID=$product['categories'];
		$catSql="SELECT * FROM categories WHERE id='$childID'";
		$result=$db->query($catSql);
		$child=mysqli_fetch_assoc($result);
		$parentID=$child['parent'];
		$pSql="SELECT * FROM categories WHERE id='$parentID'";
		$presult=$db->query($pSql);
		$parent=mysqli_fetch_assoc($presult);
		$category=$parent['category'].'-'.$child['category'];
		?>
			<tr>
				<td>
				
				<a href="archive.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-success"><span class="uk-icon-spin uk-icon-refresh"></span></a>
				</td>
				<td><?=$product['title'];?></td>
				<td><?=money($product['price']);?></td>
				<td><?=$category;?></td>
				
				<td>0</td>
				
			</tr>
		<?php endwhile; ?>	
		</tbody>
</table>
</div>
</div>
<?php include 'includes/footer.php'; ?>


