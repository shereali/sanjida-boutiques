<?php if (isset($_POST["user_login"])&&isset($_POST["login_pass"])) {
	$user_login = preg_replace('#[^A-Za-z0-9]#i','', $_POST["user_login"]);
	$login_pass = preg_replace('#[^A-Za-z0-9]#i','', $_POST["login_pass"]);
	$passowrd_login_md5 = md5($login_pass);

	$sql =$db->query("SELECT id FROM customers WHERE username = '$user_login' AND password = '$passowrd_login_md5' LIMIT 1");
	$userCount = mysqli_num_rows($sql);
	if ($userCount==1) {
		while ($row=mysqli_fetch_array($sql)) {
			$id=$row["id"];

			}
			$_SESSION["user_login"]=$user_login;
			echo "<script>window.open('checkout.php','_self')</script>";
			exit();

		
		
	}

	else{

			echo'This information is incorrect';
			exit();
		}
};
?>
	<div class="panel-heading"><legend>Sign In</legend></div>
	<div class="panel-body">
		<form action="" class="form" method="post">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="user_login" class="form-control">
			</div>
			<div class="form-group">
				<label for="password">password</label>
				<input type="text" name="login_pass" class="form-control">
			</div>
			<input type="submit" name="signin" class="btn btn-success btn-sm pull-right" value="Sign In">
		</form>
	</div>
	<div class="panel-footer"></div>
