<?php require_once 'core/init.php';?>
<?php $domain=($_SERVER['HTTP_HOST']!='localhost')?'.'.$_SERVER['HTTP_HOST']:false;
  setcookie(CART_COOKIE,'',1,"/",$domain,false);
// Create a charge: this will charge the user's card
if (isset($_POST['save_order'])) {
  $username=sanitize($_POST['username']);
$cart_id=sanitize($_POST['cart_id']);
$product_id=sanitize($_POST['product_id']);
$customer_id=sanitize($_POST['customer_id']);
$quantity=sanitize($_POST['quantity']);
$invoice=sanitize($_POST['invoice']);
$sub_total=sanitize($_POST['amount']);
$status=sanitize($_POST['status']);

$paid=1;

$paid=1;
$metadata=array(
  "cart_id" => $cart_id,
  "sub_total"=>$sub_total,
  );

  // adjust inventory
  $itemQ=$db->query("SELECT * FROM cart WHERE id='{$cart_id}'");
  $iresults=mysqli_fetch_assoc($itemQ);
  $items=json_decode($iresults['items'],true);
  foreach($items as $item){
    $newSizes=array();
    $item_id=$item['id'];
    $productQ=$db->query("SELECT sizes FROM products WHERE id='{$item_id}'");
    $product=mysqli_fetch_assoc($productQ);
    $sizes=sizesToArray($product['sizes']);
    foreach ($sizes as $size) {
     if ($size['size']==$item['size']) {
       $q=$size['quantity'] - $item['quantity'];
       $newSizes[]=array('size' => $size['size'], 'quantity'=>$q);
     }else{
      $newSizes[]=array('size'=>$size['size'],'quanity'=>$size['quantity']);
     }
   }
}


    $sizeString=sizesToString($newSizes);
    $db->query("UPDATE products SET sizes='{$sizeString}' WHERE id='{$item_id}' ");

  

  // Update cart
  $db->query("UPDATE cart SET paid=1 WHERE id='{$cart_id}");

  // insert cart
  $db->query("INSERT INTO orders(username,cart_id,product_id,customer_id,quantity,amount,invoice,status,paid) VALUES('$username','$cart_id','$product_id','$customer_id','$quantity','$sub_total','$invoice','$status','$paid')");
  
}
  include 'includes/head.php';
  include 'includes/navigation.php';
  $getC="SELECT * FROM customers WHERE username='$user'";
$queryC=$db->query($getC);
while ($fetchC=mysqli_fetch_assoc($queryC)) {
 extract($fetchC);
}
  ?>
  
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="list-group">
  <legend>Thank You</legend>
  <p class="custom-header-color">Your bikash payment has been successfully charged <?=money($sub_total);?>. You have been emailed a receipt!</p>

  <p>Your receipt number is: <strong><?=$cart_id;?></strong>
  <p>Your order will be shipped to the address below.</p>
    <li class="list-group-item"><span class="glyphicon glyphicon-user"></span> <?=$full_name;?></li>
    <li class="list-group-item"><span class="glyphicon glyphicon-map-marker"></span> <?=$address;?></li>
    <li class="list-group-item"><span class="glyphicon glyphicon-phone"></span> <?=$phone;?></li>
  </ul>
    </div>
    
  </div>
</div>
<?php  include 'includes/footer.php'; ?>