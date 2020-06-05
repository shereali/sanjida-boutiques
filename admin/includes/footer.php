</div>
	<footer class="text-center" id="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<p>&copy;All right Reserved Sanjida Boutiques</p>
			</div>
		</div>
	</div>
		
	</footer>

<script type="text/javascript">


function updateSizes(){
	var sizeString='';
	for(var i=1; i<=12;i++){
		if (jQuery('#size'+i).val()!='') {
			sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+':'+jQuery('#threshold'+i).val()+',';
		}

	}

	jQuery('#sizes').val(sizeString);
}
function get_child_options(selected){
	if (typeof selected==='undefined') {
		var selected='';
	}
var parentID=jQuery('#parent').val();

jQuery.ajax({
	url:'/sanjida-boutiques/admin/parsers/child_categories.php',
	type:'POST',
	data:{parentID:parentID, selected:selected},
	success: function(data){
		jQuery('#child').html(data);
	},
	error: function(){alert('Something went to wrong with this child category')}
});

}

jQuery('select[name="parent"]').change(function(){
	get_child_options();
	
});
</script>

<!-- jquery library -->
  <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>	
</body>
</html>
<?php ob_end_flush();?>


