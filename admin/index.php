<?php require_once '../core/init.php';?>
<?php if (!is_logged_in()) {
	header('Location:login.php');
}
?>
<?php if (isset($_GET['del'])) {
    $del_id=$_GET['del'];
    $delete="DELETE FROM orders WHERE id='$del_id'";
    $runDel=$db->query($delete);
    if ($runDel) {
        echo "<script>window.open('index.php?order','_self')</script>";
    }
} ?>
<?php
// update order status
  if (isset($_GET['completed'])) {
    $completed=$_GET['completed'];
    $statuses='Completed';
    $updateStatus="UPDATE orders SET status='$statuses' WHERE id='$completed'";
    $runStatus=$db->query($updateStatus);
    if ($runStatus) {
      echo "<script>window.open('index.php?order','_self');</script>";
    }

  }
?>
<?php include 'includes/head.php';?>
<?php include 'includes/navigation.php';?>



        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <?php 
                    if (isset($_GET['order'])) {
                        include 'order.php';
                    } 
                      if (isset($_GET['inventory'])) {
                        include 'inventory.php';
                    } 


                    if (isset($_GET['monthlysell'])) {
                        include 'sales_by_month.php';
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
<?php include 'includes/footer.php';?>
 