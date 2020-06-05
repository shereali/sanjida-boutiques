<?php if (isset($_GET['profileEdit'])) {
	
	$editProfile="SELECT * FROM customers WHERE username='$user'";
	$editQ=$db->query($editProfile);
	while($fetchE=mysqli_fetch_assoc($editQ)){
		extract($fetchE);
	}
} 

if (isset($_POST['update'])) {
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$bikash_no=$_POST['bikash_no'];
	$upadateProfile="UPDATE customers SET full_name='$name',email='$email',phone='$phone',address='$address',bikash_no='$bikash_no' ";
	$queryUpdate=$db->query($upadateProfile);
if ($queryUpdate) {
	echo "<script>window.open('index.php?profile','_self')</script>";
}

}

?>
<div class="col-md-6">
<legend><span class="glyphicon glyphicon-pencil"></span> Update Profile</legend>
<form action="" class="form" method="post">
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" value="<?=$full_name;?>" class="form-control">
	</div>
	<div class="form-group">
		<label for="name">Email</label>
		<input type="text" name="email" value="<?=$email;?>" class="form-control">
	</div>
	<div class="form-group">
		<label for="name">Contact</label>
		<input type="text" name="phone" value="<?=$phone;?>" class="form-control">
	</div>
	<div class="form-group">
		<label for="name">Address</label>
		<input type="text" name="address" value="<?=$address;?>" class="form-control">
	</div>
	<div class="form-group">
		<label for="name">Bikash No</label>
		<input type="text" name="bikash_no" value="<?=$bikash_no;?>" class="form-control">
	</div>
	<button type="submit" name="update" class="btn btn-success btn-md "><span class="glyphicon glyphicon-send"></span> Update</button>
</form>
</div>