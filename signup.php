<?php include 'core/init.php';?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
<div class="container">
	<div class="row">
	<div class="col-md-6">
	<div class="col-md-8">
<?php include 'login.php';?>
		
	</div>
	</div>
<!-- Signup column start -->
	<div class="col-md-6" >
<?php 
$reg = @$_POST['signup'];

$full_name = "";
$un = "";
$em = "";
$mb = "";
$pswd = "";
$pswd2 = "";
$d = "";
$address="";
$bikash_no = "";
$post_image = "";
$friend_array= "";
$u_check = "";

$full_name = strip_tags(@$_POST['full_name']);
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$mb = strip_tags(@$_POST['mobile']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d");

if ($reg) {
	
		$u_check=$db->query("SELECT username FROM customers WHERE username='$un'");
		$check=mysqli_num_rows($u_check);
		if ($check==0) {

			$e_check=$db->query("SELECT email FROM customers WHERE email='$em'");
			$email_check=mysqli_num_rows($e_check);
			if ($email_check==0) {
				
			
			if ($full_name&&$un&&$em&&$mb&&$pswd&&$pswd2) {
				if ($pswd==$pswd2) {
					if (strlen($full_name)>25||strlen($un)>25) {
						echo "The maximum limit for username & full_name  is 25 characters!";
					}
					if (strlen($mb)<10) {
						echo "Your mobile number is wrong!";
					}


					else{

						if (strlen($pswd)>30||strlen($pswd)<5) {
							echo "Your password must be between 5 and 25 characters!";
						}

						else{
							$pswd=md5($pswd);
							$pswd2=md5($pswd2);

							$query=$db->query("INSERT INTO customers VALUES('','$full_name','$un','$em','$pswd','$mb','$d','0','$address','$bikash_no','$post_image','$friend_array')");
							die("<h4 style='background:green;color:#fff;padding:10px;'><span class='glyphicon glyphicon-check'><span> Welcome TMU Computer club</h4>");
						}
					}
				}

				else{

					echo "Your password does not match!";
				}
			}
			else{

				echo "Please fill in all of your fields!";
			}


		 }



		 else{

		 	echo "Your email already used, try another!";
		 }
		

		}

		else{
			echo "Your username already exist!";
		}
	
}?>
		<div class="panel" style="background:#eee !important;">
			<div class="panel-heading">
				<legend>Sign Up</legend>
			</div>
			<div class="panel-body">
				<form action="" class="form" method="post">
					<div class="form-group">
						<label for="name">Name*</label>
						<input type="text" name="full_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="username">Username*</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="form-group">
						<label for="email">Email*</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label for="mobile">Mobile No*</label>
						<input type="text" name="mobile" class="form-control">
					</div>
					<div class="form-group">
						<label for="password">password*</label>
						<input type="text" name="password" class="form-control">
					</div>
					<div class="form-group">
						<label for="password2">Confirm password*</label>
						<input type="text" name="password2" class="form-control">
					</div>
					
					<input type="submit" class="btn btn-success btn-sm btn-success pull-right" name="signup" value="Sign Up+">
				</form>
			</div>
			<div class="panel-footer"></div>
		</div>
		</div>
	</div>
</div>
<?php include 'includes/footer.php';?>