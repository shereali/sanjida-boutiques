<?php require_once $_SERVER['DOCUMENT_ROOT'].'/sanjida-boutiques/core/init.php';?>
<?php if (!is_logged_in()) {
	login_error_redirect();
}
?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
<?php
$sql="SELECT*FROM categories WHERE parent=0";
$result=$db->query($sql);
$errors=array();
$category='';
$post_parent='';
// Edit category
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id=(int)$_GET['edit'];
	$edit_id=sanitize($edit_id);
	$edit_sql="SELECT * FROM categories WHERE id='$edit_id'";
	$edit_result=$db->query($edit_sql);
	$eCategory=mysqli_fetch_assoc($edit_result);

}
// Delete category
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id=(int)$_GET['delete'];
	$delete_id=sanitize($delete_id);
	$sql="SELECT * FROM categories WHERE id='$delete_id'";
	$result=$db->query($sql);
	$category=mysqli_fetch_assoc($reuslt);
	if ($category['parent']==0) {
	$sql="DELETE FROM categories WHERE parent='$delete_id'";
	$db->query($sql);
	}
	$dsql="DELETE FROM categories WHERE id='$delete_id'";
	$db->query($dsql);
	header('location:categories.php');
}


//Process from
if (isset($_POST) && !empty($_POST)) {
	$post_parent=sanitize($_POST['parent']);
	$category=sanitize($_POST['category']);
	$sqlform="SELECT * FROM categories WHERE category='$category' AND parent='$post_parent'";
	if (isset($_GET['edit'])) {
		$id=$eCategory['id'];
		$sqlform="SELECT * FROM categories WHERE category='$category' AND parent='post_parent' AND id='$id'";
	}
	$fresult=$db->query($sqlform);
	$count=mysqli_num_rows($fresult);

	// If category is blank
	if ($category=='') {
		$errors[] .='The Category can not be letf blank';
	}

	// If category exit in the database
	if ($count > 0) {
		$errors[] .=$category.'&nbsp;'.'Category already exist. Please choose a new category';
	}

	// Display error or Update database
	if (!empty($errors)) {
		// Display error
		$display=display_errors($errors);?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#errors').html('<?=$display;?>');
			});
		</script>
	<?php }else{
		// Update category
		$updatesql="INSERT INTO categories(category,parent) VALUES('$category','$post_parent')";
		if (isset($_GET['edit'])) {
		$updatesql="UPDATE categories SET category='$category', parent='$post_parent' WHERE id='$edit_id'";
		
		}
		$db->query($updatesql);
		header('lcoation:categories.php');

	}
}

$category_value='';
$parent_value=0;
if (isset($_GET['edit'])) {
	$category_value=$eCategory['category'];
	$parent_value=$eCategory['parent'];
}else{
	if (isset($_POST)) {
		$category_value=$category;
		$parent_value=$post_parent;
	}

}


 ?>

<div class="container-fluid">
<div class="row">
	<!-- Form -->
	<div class="col-md-4">
		<form action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" class="form" method="post">
		<legend><?=((isset($_GET['edit']))?'Edit':'Add A'.'&nbsp;');?>&nbsp;Category</legend>
		<div id="errors"></div>
			<div class="form-group">
				<label for="parent">Parent</label>
				<select name="parent" id="parent" class="form-control">
					<option value="0"<?=(($parent_value==0)?'selected="selected"':'');?>>Parent</option>
					<?php while($parent=mysqli_fetch_assoc($result)): ?>
					<option value="<?=$parent['id'];?>"<?=(($parent_value==$parent['id'])?'selected="selected"':'')?>><?=$parent['category'];?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="category">Category</label>
				<input type="text" class="form-control" name="category" id="category" value="<?=$category_value;?>" >
			</div>
			<div class="form-group">
				<input type="submit" name="" value="<?=((isset($_GET['edit']))?'Edit':'Add');?>&nbsp;Category" class="btn btn-success">
			</div>
		</form>
	</div>

	<!-- Category table -->
	<div class="col-md-8">
	<legend>Categories</legend>
	<table class="table table-bordered">
		<thead class="custom-primary-color">
			<th>Category</th>
			<th>Parent</th>
			<th></th>
		</thead>
		<tbody>
		<?php 
		$sql="SELECT*FROM categories WHERE parent=0";
		$result=$db->query($sql);
		while($parent=mysqli_fetch_assoc($result)): 
		$parent_id=(int)$parent['id'];
		$parent_id=sanitize($parent_id);
		$sql2="SELECT * FROM categories WHERE parent='$parent_id'";
		$cresult=$db->query($sql2);

		?>
			<tr class="bg-info" >
				<td><?=$parent['category']; ?></td>
				<td>Parent</td>
				<td>
				<a href="categories.php?edit=<?=$parent['id']; ?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
				<a href="categories.php?delete=<?=$parent['id']; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-sign"></span></a>
				
				</td>
			</tr>
			<?php while($child=mysqli_fetch_assoc($cresult)): ?>
				<tr class="">
				<td><?=$child['category']; ?></td>
				<td><?=$parent['category']; ?></td>
				<td>
				<a href="categories.php?edit=<?=$child['id']; ?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
				<a href="categories.php?delete=<?=$child['id']; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-sign"></span></a>
				
				</td>
			</tr>
			<?php endwhile; ?>
		<?php endwhile; ?>
		</tbody>
	</table>
	</div>
</div>
</div><!-- Container fluid end -->
 <?php include 'includes/footer.php'; ?>