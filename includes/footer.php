</div>
</div>
<div class="container-fluid bg-primary" style="height:auto; margin-top:10%;">
	<div class="row">
		<div class="col-md-6">
			<!-- this is the like box showing start-->
       
		</div>
		<div class="col-md-3"><center>
			<h4 class="custom-white-color custom-padding">&copy;All right Reserve Sanjida Boutiques</h4>
		</center></div>
		<div class="col-md-3"></div>
	</div>
</div>

	<script type="text/javascript">
	

jQuery(document).ready(function(){

jQuery(window).scroll(function(){
		var vscroll=jQuery(this).scrollTop();
		jQuery('#logotext').css({
			"transform":"translate(0px, "+vscroll/2+" px)"
		});
		var vscroll=jQuery(this).scrollTop();
		jQuery('#back-flower').css({
			"transform":"translate(0px, -"+vscroll/2+"px)"
		});

		var vscroll=jQuery(this).scrollTop();
		jQuery('#fore-flower').css({
			"transform":"translate(0px,-"+vscroll/2+"px)"
		});
	});


	
});

function detailsmodal(id){
var data = {"id" : id};
jQuery.ajax({
	url :'/includes/detailsmodal.php',
	method : "post",
	data : data,
	success : function(data){
		jQuery('body').append(data);
		jQuery('#details-modal').modal('toggle');
	},
	error : function(){
		alert("Something went wrong!");
	}
});

}


function update_cart(mode,edit_id,edit_size){
	var data={"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
	jQuery.ajax({
		url:'/sanjida-boutiques/admin/parsers/update_cart.php',
		method:'post',
		data : data,
		success:function(){
			location.reload();
		},
		error:function(){
			alert('Something went wrong');
		}
	});

}



function add_to_cart(){
	jQuery('#modal_errors').html("");
	var size = jQuery('#size').val();
	var quantity =jQuery('#quantity').val();
	var available = jQuery('#available').val();
	
	var error = '';
	var data =jQuery('#add_product_form').serialize();
	if (size=='' || quantity == '' || quantity ==0) {
		error +='<p class="text-danger text-center">You must choose size & quantity</p>';
		jQuery('#modal_errors').html(error);
		return;
	}

	else if(quantity>available){
		error +='<p class="text-danger text-center">There only '+available+' available </p>';
		jQuery('#modal_errors').html(error);
		return;


	}else{
		jQuery.ajax({
			url : '/sanjida-boutiques/admin/parsers/add_cart.php',
			method : 'post',
			data : data,
			success : function(){
				location.reload();
			},
			error : function(){
				alert("Something went wrong");
			},
		});
	}
}
</script>
</body>
</html>