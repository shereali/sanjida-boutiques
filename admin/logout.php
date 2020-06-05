<?php require_once $_SERVER['DOCUMENT_ROOT'].'/sanjida-boutiques/core/init.php';?>
<?php 
unset($_SESSION['SBUser']);
header('Location:login.php');
?>