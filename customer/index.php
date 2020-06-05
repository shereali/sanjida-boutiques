<?php  include '../core/init.php'; ?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>
<?php if (isset($_GET['del'])) {
    $del_id=$_GET['del'];
    $delete="DELETE FROM orders WHERE id='$del_id'";
    $runDel=$db->query($delete);
    if ($runDel) {
        echo "<script>window.open('index.php?myorder','_self')</script>";
    }
} ?>
<br>
<br>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
            <div class="panel-body text-center" style="background: #FB5724 !important;">
            	<img src="images/baby-girl-pics-17.jpg" alt="image" class="img-circle" style="width:150px; height: 150px;">
            <p>
            <a href="" style="color:#fff; font-size: 20px;background:red; border-radius: 3px;"><span class="uk-icon-facebook"></span></a>
            <a href="" style="color:#fff; font-size: 20px;background:red; border-radius: 3px;"><span class="uk-icon-google-plus"></span></a>
            <a href="" style="color:#fff; font-size: 20px;background:red; border-radius: 3px;"><span class="uk-icon-twitter"></span></a>
            <a href="" style="color:#fff; font-size: 20px;background:red; border-radius: 3px;"><span class="uk-icon-youtube"></span></a>
            <a href="" style="color:#fff; font-size: 20px;background:red; border-radius: 3px;"><span class="uk-icon-pinterest"></span></a>
            <a href="" style="color:#fff; font-size: 20px;background:red; border-radius: 3px;"><span class="uk-icon-linkedin"></span></a>
            </p>
            </div>
                <li class="sidebar-brand">
                    <a href="index.php?profile">
                        <span class="glyphicon glyphicon-leaf"></span> Sanjida Khandakar
                    </a>
                </li>
                <li>
                    <a href="index.php?profile"><span class="glyphicon glyphicon-user"></span> Profile</a>
                </li>

                <li>
                    <a href="index.php?settings"><span class="glyphicon glyphicon-cog"></span> Settings</a>
                </li>
                <li>
                    <a href="index.php?myorder"><span class="glyphicon glyphicon-shopping-cart"></span> My Order</a>
                </li>
                <li>
                    <a href="index.php?group"><span class="glyphicon glyphicon-th"></span> Group</a>
                </li>
                <li>
                    <a href="index.php?grouporder"><span class="glyphicon glyphicon-shopping-cart"></span> Group Order</a>
                </li>
                <li>
                    <a href="index.php?groupmember"><span class="glyphicon glyphicon-user"></span> Group Member</a>
                </li>
                <li>
                    <a href="index.php?address"><span class="glyphicon glyphicon-phone"></span> Contact</a>
                </li>

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <?php 
                    if (isset($_GET['profile'])) {
                        include 'profile.php';
                    } 
                      if (isset($_GET['profileEdit'])) {
                        include 'profileEdit.php';
                    } 


                    if (isset($_GET['settings'])) {
                        include 'settings.php';
                    }
                     if (isset($_GET['myorder'])) {
                        include 'my_order.php';
                    }
                     if (isset($_GET['group'])) {
                        include 'myGroup.php';
                    }
                     if (isset($_GET['grouporder'])) {
                        include 'groupOrder.php';
                    }
                     if (isset($_GET['groupmember'])) {
                        include 'groupMember.php.php';
                    }
                     if (isset($_GET['address'])) {
                        include 'address.php.php';
                    }
                    ?>

                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
   

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
<?php include 'includes/footer.php';