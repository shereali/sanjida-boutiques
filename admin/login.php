<?php require_once $_SERVER['DOCUMENT_ROOT'].'/sanjida-boutiques/core/init.php';?>
<?php include 'includes/head.php';?>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
<?php   
$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
$email=trim($email);
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$password=trim($password);
//$hashed=password_hash($password, PASSWORD_DEFAULT);
$errors=array();
// Form validation
if ($_POST) {
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$errors[]='Email or password is missing';

	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[]='You must enter a valid email';
	}



	if (strlen($password)<6) {
		$errors[]='Password must be at least 6 characters';
	}

	$query=$db->query("SELECT * FROM users WHERE email='$email' ");
	$user=mysqli_fetch_assoc($query);
	$userCount=mysqli_num_rows($query);

	if ($userCount<1) {
		$errors[]='That email does not exit!';
	}
// 	if (!password_verify($password, $user['password'])) {
// 	$errors[]='The password doest not match!';
// }

if (!empty($errors)) {
	echo display_errors($errors);
}
else{
	$user_id=$user['id'];
	login($user_id);
}
}
?>

		<div class="panel">
			<div class="panel-heading">
				<div class="page-header"><h3 class="text-center">Login</h3></div>
			</div>
			<div class="panel-body">
				<form action="login.php" class="form" method="post">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" name="email" value="<?=$email;?>"  class="form-control">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" value="<?=$password;?>" class="form-control">

					</div>
					<input type="submit" class="btn btn-success pull-right" value="Login">
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>
<?php include 'includes/footer.php'; ?>