<?php $customer="SELECT * FROM customers WHERE username='$user'";
$customerQ=$db->query($customer);
while($fetchC=mysqli_fetch_assoc($customerQ)){
	extract($fetchC);
}
?>
<div class="col-md-6"><legend class="text-info">My profile</legend>
<ul class="list-group">
	<li class="list-group-item"><span class="glyphicon glyphicon-user text-info"></span> <strong>Name:</strong> <?=$full_name;?></li>
	<li class="list-group-item"><span class="glyphicon glyphicon-envelope text-info"></span> <strong>Email:</strong> <?=$email;?></li>
	<li class="list-group-item"><span class="glyphicon glyphicon-phone text-info"></span> <strong>Contact:</strong> <?=$phone;?></li>
	<li class="list-group-item"><span class="glyphicon glyphicon-map-marker text-info"></span> <strong>Address:</strong> <?=$address;?></li>
	<li class="list-group-item"><span class="glyphicon glyphicon-phone text-info"></span> <strong>Bikash No:</strong> <?=$bikash_no;?></li>
	<li class="list-group-item"><span class="glyphicon glyphicon-calendar text-info"></span> <strong>Join Date:</strong> <?=pretty_date($join_date);?></li>
	<li class="list-group-item pull-right" style="border:none;"><a href="index.php?profileEdit=<?=$user;?>" class="btn btn-md btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a></li>
</ul>
</div>