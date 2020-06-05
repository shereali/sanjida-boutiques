<?php require_once $_SERVER['DOCUMENT_ROOT'].'/sanjida-boutiques/core/init.php';?>
<?php if (!is_logged_in()) {
	login_error_redirect();
}
?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>

<?php if (isset($_GET['delete'])) {
$id=sanitize($_GET['delete']);
$db->query("UPDATE products SET deleted=1 WHERE id='$id'");
header("location:products.php");
}

$dbpath='';
if (isset($_GET['add']) || isset($_GET['edit'])) {
	$brandQuery=$db->query("SELECT * FROM brand ORDER BY brand");
	$parentQuery=$db->query("SELECT * FROM categories WHERE parent=0 ORDER BY category");
	$title=((isset($_POST['title']) && $_POST['title'] !='')?sanitize($_POST['title']):'');
	$brand=((isset($_POST['brand']) && !empty($_POST['brand']) )?sanitize($_POST['brand']):'');
	$parent=((isset($_POST['parent']) && !empty($_POST['parent']) )?sanitize($_POST['parent']):'');
	$category=((isset($_POST['child']) && !empty($_POST['child']) )?sanitize($_POST['child']):'');
	$price=((isset($_POST['price']) && $_POST['price'] !='')?sanitize($_POST['price']):'');
	$list_price=((isset($_POST['list_price']) && $_POST['list_price'] !='')?sanitize($_POST['list_price']):'');
	$description=((isset($_POST['description']) && $_POST['description'] !='')?sanitize($_POST['description']):'');
	$sizes=((isset($_POST['sizes']) && $_POST['sizes'] !='')?sanitize($_POST['sizes']):'');
	$sizes=rtrim($sizes,','); 
	$saved_image='';



	if (isset($_GET['edit'])) {
	$edit_id=(int)$_GET['edit'];
	$productResult=$db->query("SELECT * FROM products WHERE id='$edit_id'");
	$product=mysqli_fetch_assoc($productResult);
	if (isset($_GET['delete_image'])) {
		$imgi=(int)$_GET['imgi'] - 1;
		$images=explode(',', $product['image']);
		$image_url=$_SERVER['DOCUMENT_ROOT'].$images[$imgi]; echo $image_url;
		unlink($image_url);
		unset($images[$imgi]);
		$imageString=implode(',', $images);
		$db->query("UPDATE products SET image='{$imageString}' WHERE id='$edit_id'");
		header('Location:products.php?edit='.$edit_id);
	}
	$category=((isset($_POST['child']) && $_POST['child'] !='')?sanitize($_POST['child']):$product['categories']);
	$title=((isset($_POST['title']) && !empty($_POST['title']))?sanitize($_POST['title']):$product['title']);
	$brand=((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):$product['brand']);
	$parentQ=$db->query("SELECT * FROM categories WHERE id='$category'");
	$parentResult=mysqli_fetch_assoc($parentQ);

	$parent=((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):$parentResult['parent']);
	$price=((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):$product['price']);
	$list_price=((isset($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']);
	$description=((isset($_POST['description']))?sanitize($_POST['description']):$product['description']);
	$sizes=((isset($_POST['sizes']) && $_POST['sizes'] !='')?sanitize($_POST['sizes']):$product['sizes']);
	$saved_image=(($product['image'] !='')?$product['image']:'');
	$dbpath=$saved_image;




	$sizes=rtrim($sizes,',');
	$saved_image=(($product['image'] !='')?$product['image']:'');
	}

			if (!empty($sizes)) {
			$sizeString=sanitize($sizes);
			$sizeString=rtrim($sizeString,',');
			$sizesArray=explode(',',$sizeString);
			$sArray=array();
			$qArray=array();
			$tArray=array();
			foreach ($sizesArray as $ss) {
				$s=explode(':', $ss);
				$sArray[]=$s[0];
				$qArray[]=$s[1];
				$tArray[]=$s[2];

			}
		}
		else{$sizeArray=array();}

	if ($_POST) {
		$errors=array();
		$required=array('title','brand','price','parent','child','sizes');
		$allowed=array('jpg','jpeg','png','gif');
		$uploadPath=array();
		$tmpLoc=array();
			foreach($required as $field){
				if ($_POST[$field]=='') {
					$errors[]="All Fields with and Astrisk Required!";
					break;
				}
			}

			
			$photoCount=count($_FILES['photo']['name']);
		
		if ($photoCount > 0) {
			for($i=0; $i<$photoCount; $i++){

				$name=$_FILES['photo']['name'][$i];	
				$nameArray=explode('.', $name);
				$fileName=$nameArray[0];
				$fileExt=$nameArray[1];
				$mime=explode('/', $_FILES['photo']['type'][$i]);
				$mimeType=$mime[0];
				$mimeExt=$mime[1];
				$tmpLoc[]=$_FILES['photo']['tmp_name'][$i];
				$fileSize=$_FILES['photo']['size'][$i];
				$uploadName=md5(microtime().$i).'.'.$fileExt;
				$uploadPath[]=BASEURL.'images/products/'.$uploadName;
				if ($i !=0) {
					$dbpath .=',';
				}

				$dbpath .='/sanjida-boutiques/images/products/'.$uploadName;

				if ($mimeType!='image') {
					$errors[]='The file must be an image';
				}
				if (!in_array($fileExt, $allowed)) {
					$errors[]='The file extension must be a png, jpg, jpeg or gif format';

				}

				if ($fileSize>15000000) {
					$errors[]='The file size must be uner 15mb';
				}

				if ($fileExt != $mimeExt && ($mimeExt== 'jpeg' && $fileExt !='jpg')) {
					$errors[]='File Extension does not match the file!';
				}

			}		
			
		}
		if (!empty($errors)) {
			echo display_errors($errors);
		}
		else{

			// Upload file and insert to the database!
			if ($photoCount > 0) {
				for($i=0; $i<$photoCount; $i++){
				move_uploaded_file($tmpLoc[$i],$uploadPath[$i]);
				}	
			}
			
			$insertSql="INSERT INTO products(title,price,list_price,brand,categories,image,sizes,description) VALUES('$title','$price','$list_price','$brand','$category', '$dbpath','$sizes','$description')";
			
			if (isset($_GET['edit'])) {
				$insertSql="UPDATE products SET title='$title', price='$price', list_price='$list_price', brand='$brand', categories='$category', sizes='$sizes', image='$dbpath', description='$description' WHERE id='$edit_id'  ";
			}
			$runPro=$db->query($insertSql);
			if ($runPro) {
				echo "<script>window.open('products.php?add=1','_self');</script>";
			}
			else{
				echo "failed".mysqli_error($db);
			}
			if (isset($_GET['edit'])) {
				header('location:products.php');
			}
			
			

		}
	}
?>
<legend><?=((isset($_GET['edit']))?'Edit':'Add new');?> product</legend>
<!-- Title -->

<!--Product added form start here -->
<form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
	<div class="form-group col-md-3">
		<label for="title">Title:</label>
		<input type="text" class="form-control" name="title" id="title" value="<?=$title;?>">
	</div>
<!-- Brand -->
	<div class="form-group col-md-3">
		<label for="brand">Brand:</label>
		<select name="brand" id="brand" class="form-control">
			<option value="" <?=(($brand=='')?'selected':'');?>></option>
			<?php while($b=mysqli_fetch_assoc($brandQuery)): ?>
			<option value="<?=$b['id'];?>"<?=(($brand==$b['id'])?'selected':'');?>><?=$b['brand'];?>
			</option>
		<?php endwhile; ?>
		</select>
	</div>
	<!-- Category -->
	<div class="form-group col-md-3">
		<label for="parent">Parent Category</label>
		<select name="parent" id="parent" class="form-control">
			<option value=""<?=(($parent=='')?'selected':'')?>></option>
			<?php while($p=mysqli_fetch_assoc($parentQuery)): ?>
			<option value="<?=$p['id'];?>"<?=(($parent==$p['id'])?'selected':'');?>><?=$p['category'];?></option>
			<?php endwhile; ?>	
		</select>
	</div>
	<!-- Child Category -->
	<div class="form-group col-md-3">
		<label for="child">Child Category</label>
		<select name="child" id="child" class="form-control">
			
		</select>
	</div>
	<!-- Price -->
	<div class="form-group col-md-3">
		<label for="price">Price</label>
		<input type="text" class="form-control" id="price" name="price" value="<?=$price;?>">
	</div>
	<!-- List price -->
	<div class="form-group col-md-3">
		<label for="list_price">List Price</label>
		<input type="text" class="form-control" id="list_price" name="list_price" value="<?=$list_price;?>">
	</div>
	<!-- Quantity and size -->
	<div class="form-group col-md-3">
		<label for="quantity_and_sizes">Quantity & Sizes*:</label>
		<button class="form-control btn btn-default" onclick="jQuery('#sizesModal').modal('toggle'); return false;">Quantity & Sizes</button>
	</div>
	<!-- Quantity and size preview -->
	<div class="form-group col-md-3">
		<label for="sizes">Sizes & Qty Preview</label>
		<input type="text" class="form-control" id="sizes" name="sizes" value="<?=$sizes;?>">
	</div>
<!-- Product image -->
	<div class="form-group col-md-6">
	<?php if($saved_image !=''): ?>
	<?php $imgi=1;
	$images=explode(',', $saved_image); ?>
	<?php foreach($images as $image):?>
		<div class="saved-image col-md-4">
		<img  src="<?=$image;?>" alt="saved image"><br>
		<a href="products.php?delete_image=1&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>" class="text-danger">Delete Image</a>
		</div>
		<?php $imgi++; ?>
		<?php endforeach; ?>
	<?php else: ?>	
		<label for="photo">Product Photo</label>
		<input type="file" class="form-control" id="photo" name="photo[]" multiple>
	<?php endif; ?>
	</div>
	<!-- Description -->
	<div class="form-group col-md-6">
		<label for="description">Description</label>
		<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?=$description; ?></textarea>
	</div>
	<div class="form-group pull-right">
	<a href="products.php" class="btn btn-default">Cancel</a>
		<input type="submit" name="" class="btn btn-success" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Product">
	</div><div class="clearfix"></div>
</form>
<!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
        <?php for($i=1; $i<=12; $i++): ?>
		<div class="form-group col-md-2">
			<label for="size<?=$i;?>">Size:</label>
			<input type="text" class="form-control" name="size<?=$i; ?>" id="size<?=$i; ?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>">
		</div>
		<div class="form-group col-md-2">
			<label for="qty<?=$i;?>">Quantity:</label>
			<input type="number" class="form-control" name="qty<?=$i; ?>" id="qty<?=$i; ?>" min="0" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>">
		</div>
		<div class="form-group col-md-2">
			<label for="threshold<?=$i;?>">Threshold:</label>
			<input type="number" class="form-control" name="threshold<?=$i; ?>" id="threshold<?=$i; ?>" min="0" value="<?=((!empty($tArray[$i-1]))?$tArray[$i-1]:'');?>">
		</div>
        <?php endfor; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes(); jQuery('#sizesModal').modal('toggle'); return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php }

else{

$sql="SELECT * FROM products WHERE deleted=0";
$presults=$db->query($sql);
if (isset($_GET['featured'])) {
	$id=(int)$_GET['id'];
	$featured=(int)$_GET['featured'];
	$featuredSql="UPDATE products SET featured='$featured' WHERE id='$id'";
	$db->query($featuredSql);
	header('location:products.php');
}
 ?>
<legend>Product page</legend>

<table class="table table-bordered table-striped">
		<thead>
			<th><a href="products.php?add=1" id="add-product-btn"><span class="glyphicon glyphicon-plus"></span></a></th>
			<th>product</th>
			<th>Price</th>
			<th>Category</th>
			<th>Features</th>
			<th>Sold</th>
		</thead>
		<tbody>
		<?php while($product=mysqli_fetch_assoc($presults)):		
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
				<a href="products.php?edit=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="products.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				<td><?=$product['title'];?></td>
				<td><?=money($product['price']);?></td>
				<td><?=$category;?></td>
				<td><a href="products.php?featured=<?=(($product['featured']==0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
				<span class="glyphicon glyphicon-<?=(($product['featured']==1)?'minus':'plus');?>"></span>

				</a>&nbsp<?=(($product['featured'])?'Featured Product':'');?></td>
				<td>0</td>
				
			</tr>
		<?php endwhile; ?>	
		</tbody>
</table>

<?php } include 'includes/footer.php'; ?>
<script>

	jQuery(document).ready(function(){
		get_child_options('<?=$category;?>');
	});
</script>