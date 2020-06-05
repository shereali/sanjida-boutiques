<?php ob_start();?>
<?php if(isset($_SESSION["user_login"])){

$user = $_SESSION["user_login"];
}
else{

	$user = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sanjida Boutiques</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/uikit.min.css">
	<link rel="stylesheet" href="css/components/slider.min.css">
	<link rel="stylesheet" href="css/components/slideshow.min.css">
	<link rel="stylesheet" href="css/components/slider.gradient.min.css">
	<link rel="stylesheet" type="text/css" href="css/uikit.almost-flat.min.css">
	<link rel="stylesheet" type="text/css" href="css/uikit.gradient.min.css">
	<link rel="stylesheet" href="css/components/dotnav.almost-flat.min.css">
	<link rel="stylesheet" href="css/components/dotnav.gradient.min.css">
	<link rel="stylesheet" href="css/components/dotnav.min.css">
	<link rel="stylesheet" href="css/components/slidenav.almost-flat.min.css">
	<link rel="stylesheet" href="css/components/slidenav.gradient.min.css">
	<link rel="stylesheet" href="css/components/slideshow.gradient.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/uikit.min.js"></script>
	<script type="text/javascript" src="js/components/slideshow-fx.min.js"></script>
	<script type="text/javascript" src="js/components/slider.min.js"></script>
	<script type="text/javascript" src="js/components/slideset.min.js"></script>
	<script type="text/javascript" src="js/components/slideshow.min.js"></script>
	<script type="text/javascript" src="js/jquery.elevateZoom-3.0.8.min.js"></script>

	<!-- <script type="text/javascript" src="js/
slideshow-fx.min.js"></script> -->
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	
	<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>
<body>
<!-- facebook like box start-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- facebook like box jquery sdk end-->