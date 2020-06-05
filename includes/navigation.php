<?php 
$sql="SELECT * FROM categories WHERE parent=0";
$pquery= $db->query($sql);
?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="color:#000;"><b>SANJIDA BOUTIQUES</b></a>
    </div>
	<!-- <a href="index.php" class="navbar-brand custom-header-color">Dumlong</a> -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
    <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
		<?php while($parent=mysqli_fetch_assoc($pquery)): ?>
			<?php $parent_id=$parent['id'] ;
			$sql2="SELECT * FROM categories WHERE parent='$parent_id'";
			$cquery=$db->query($sql2);
			?>
			<li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
			<?php while($child=mysqli_fetch_assoc($cquery)): ?>
			<li><a href="category.php?cat=<?=$child['id']; ?>"><?php echo $child['category']; ?></a></li>
			<?php endwhile; ?>
			
			</ul>
			</li>
			<?php endwhile; ?>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<li><a href="cart.php" class="uk-icon-shopping-basket"></a>
			</li>
			<?php if (!$user): ?>
			<li><a href="signup.php" class="uk-icon-sign-in"> Sign Up+/Login</a></li>
		<?php else: ?>
				
				<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?=$user; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="customer/index.php?profile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
            <li><a href="customer/index.php?settings"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
            <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-shopping-cart"></span> My Order</a></li>
            <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-th"></span> My Group</a></li>
            <li><a href="customer/index.php?myorder" class="uk-icon-group"> Group Member</a></li>
            <li><a href="customer/index.php?myorder" class="uk-icon-shopping-basket"> Group Order</a></li>
            <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-question-sign"></span> FQA</a></li>
            <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-comment"></span> Submit Query</a></li>
            <li><a href="customer/index.php?myorder"><span class="glyphicon glyphicon-exclamation-sign"></span> Help</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
          </ul>
        </li>
			<?php endif; ?>
		</ul>
		</div>
	</div>
</nav>

<br>
<br>

<div class="container-fluid">
	<div class="row custom-primary-color" style="padding: 15px 0px !important; margin-top:11px;">
		<div class="col-md-3"><h1 class="custom-white-color"></h1></div>
		<div class="col-md-6 ">
			<form action="searchItem.php" method="post">

		    <div class="input-group">
		      <input type="text" class="form-control" name="search_item" placeholder="Search for...">
		      <span class="input-group-btn">
		        <button type="submit" class="btn btn-primary" name="search" type="button">
		        <span class="glyphicon glyphicon-search"></span>
		        </button>
		      </span>
		    </div><!-- /input-group -->
 
		</form>
		</div>
		<div class="col-md-3 custom-white-color text-right">
			 <span class="glyphicon glyphicon-phone "><b>01749768986</b></span>
			<span class="uk-icon-wechat"></span>
		</div>
	</div>
</div>

