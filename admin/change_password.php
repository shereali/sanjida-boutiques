<?php require_once $_SERVER['DOCUMENT_ROOT'].'/sanjida-boutiques/core/init.php';?>
<?php if (!is_logged_in()) {
	login_error_redirect();
}
include 'includes/head.php';
?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
<?php   
$hashed=$user_data['password'];
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$password=trim($password);
$old_password=((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password=trim($old_password);
$confirm=((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm=trim($confirm);
$new_hashed=password_hash($password, PASSWORD_DEFAULT);
$user_id=$user_data['id'];
$errors=array();


// Form validation
if ($_POST) {
	if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
		$errors[]='Fill out all fields';

	}

	// if new password matches fonfirm
	if ($password!=$confirm) {
		$errors[]='The new password and confirm password does not match';
	}

	



	if (strlen($password)<6) {
		$errors[]='Password must be at least 6 characters';
	}

	
	if (!password_verify($old_password, $hashed)) {
	$errors[]='Your old password doest not match in our records!';
}

if (!empty($errors)) {
	echo display_errors($errors);
}
else{
	// change password
	$db->query("UPDATE users SET password='$new_hashed' WHERE id='$user_id'");
	$_SESSION['success_flash']='Your password has been updated!';
	header('Location:index.php');
}
}

 ?>

		<div class="panel">
			<div class="panel-heading">
				<div class="page-header"><h3 class="text-center">Change Password</h3></div>
			</div>
			<div class="panel-body">
				<form action="change_password.php" class="form" method="post">
					<div class="form-group">
						<label for="old_password">Old Password</label>
						<input type="password" name="old_password" value="<?=$old_password;?>"  class="form-control">
					</div>
					<div class="form-group">
						<label for="password">New Password</label>
						<input type="password" name="password" value="<?=$password;?>" class="form-control">

					</div>
					<div class="form-group">
						<label for="confirm">Confirm</label>
						<input type="password" name="confirm" value="<?=$confirm;?>" class="form-control">

					</div>

					<input type="submit" class="btn btn-success" value="Save Changes">

					<a href="index.php" class="btn btn-default">Cancel</a>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>



<?php include 'includes/footer.php'; ?>