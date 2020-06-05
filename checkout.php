<?php include 'core/init.php'; ?>
<?php include 'includes/head.php'; ?>
<?php include 'includes/navigation.php'; ?>
<div class="container-fluid">
<div class="row">
	 <div class="col-md-12">
<?php if (!$user):?>

	 <div class="col-md-8">
<?php include 'login.php';?>
	 	<p class="text-left">If you don't have account <strong class="text-success"><a href="signup.php">Create Account</a></strong></p>
	 	
	 </div>	
	</div>
	<?php else:?>
		<?php if (!isset($_GET['finish'])):?>
<?php include 'confirm_address.php';?>
		
		<!-- <div class="col-md-6"> -->
		<?php else: ?>
<?php include 'finish_checkout.php';?>
		<?php endif;?>	
		<!-- </div><hr> -->
<?php endif;?>
</div>
</div>
<?php include 'includes/footer.php';?>