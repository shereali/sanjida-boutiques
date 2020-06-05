<nav class="navbar navbar-default navbar-fixed-top" style="margin-bottom:0px !important;">
	<div class="container-fluid">
	<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a href="#menu-toggle" class="navbar-brand" id="menu-toggle" style="color:#007DC6 !important;"><span class="glyphicon glyphicon-dashboard text-info" ></span> Admin Panel</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
		<li><a href="index.php" class="uk-icon-dashboard"> My Dashboard</a></li>
		<li><a href="brands.php" class="uk-icon-diamond"> Brands</a></li>
		<li><a href="categories.php" class="uk-icon-gears"> Categories</a></li>
		<li><a href="products.php" class="uk-icon-product-hunt"> Products</a></li>
		<li><a href="archive.php" class="uk-icon-archive"> Archive</a></li>
<?php if (has_permission('admin')):?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['first']; ?>!
			<span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="users.php" class="uk-icon-user"> Users</a></li>
				<li><a href="change_password.php" class="uk-icon-cog"> Change Password</a></li>
				<li><a href="logout.php" class="uk-icon-sign-out"> Sign Out</a></li>
			</ul>
		</li>
			
<?php endif;?>
		
		

			<!-- <li class="dropdown">
			<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
			<li><a href="#"></a></li>
			
			<li><a href="#">Shirts</a></li>
			<li><a href="#">Pants</a></li>
			<li><a href="#">Accessories</a></li>
			
			</ul>
			</li> -->
			
		</ul>
		</div>
	</div>
</nav>
<br>
<br>
<br>

<div class="container-fluid">		

<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
            <div class="panel-body text-center" style="background: #FB5620 !important;">
              <img src="images/admin.png" alt="image" class="img-circle" style="width:150px; height: 150px;">
            
            </div>
                <li class="sidebar-brand">
                    <a href="index.php?profile">
                        <span class="glyphicon glyphicon-leaf"></span> Sanjida Khandakar
                    </a>
                </li>
                <li>
                    <a href="index.php?order"><span class="uk-icon-shopping-basket"></span> Order</a>
                </li>

                <li>
                    <a href="index.php?inventory"><span class="glyphicon glyphicon-cog"></span> Inventory</a>
                </li>
                <li>
                    <a href="index.php?monthlysell"><span class="uk-icon-calendar"></span> Monthly Sell</a>
                </li>
                <li>
                    <a href="index.php?group"><span class="glyphicon glyphicon-th"></span> Group</a>
                </li>
                <li>
                    <a href="index.php?grouporder"><span class="uk-icon-shopping-basket"></span> Group Order</a>
                </li>
                <li>
                    <a href="index.php?groupmember"><span class="uk-icon-group"></span> Group Member</a>
                </li>
                <li>
                    <a href="index.php?address"><span class="glyphicon glyphicon-phone"></span> Contact</a>
                </li>

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->