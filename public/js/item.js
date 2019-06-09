$(document).ready(function(){
	var pid = $('#parent_category').val();
	if( pid != "All category"){
		showSubCategories(pid);
	}
	$('#parent_category').on('change',function(){
		// var id = $('option:selected', this).attr('myid');
		var id = $(this).val();
		if(id != "All category"){
			showSubCategories(id);
		}else{
			$('#sub_parent_category').html('');
			$('#sub_parent_category').val('');
		}
		
	});

	$('#tb_loader').delegate('.delete','click',function(){
		var id = $(this).attr('item_id');
		if(confirm('Are you sure to delete a record?')){
			$.ajax({
			    type: "POST",
			    url: "./?action=delete",
			    // The key needs to match your method's input parameter (case-sensitive).
			    data: JSON.stringify({id : id}),
			    contentType: "application/x-www-form-urlencoded",
			    dataType: "json",
			    success: function(data)
			    {  
			    	$('#tb_loader').load('index.php #itemTable');
			    },
			    failure: function(errMsg) {
			        alert(errMsg);
			    }
			});
		}
	});

	function showSubCategories(pid){
		var sid = $("#sub_parent_category").attr('sub_category');
		$.ajax({
		    type: "GET",
		    url: "./?action=getcategories",
		    // The key needs to match your method's input parameter (case-sensitive).
		    data: {parentid : pid},
		    contentType: "application/x-www-form-urlencoded",
		    dataType: "json",
		    success: function(data)
		    {  
		    	$('#sub_parent_category').html('<option value="">Plesase select sub category</option>');
		    	data.forEach(function(sub_category) {
		    		if(sub_category['id'] == sid){
		    			$('#sub_parent_category').append("<option value='"+sub_category['id']+"' selected>"+sub_category['name']+"</option>");
		    		}else{
		    			$('#sub_parent_category').append("<option value='"+sub_category['id']+"'>"+sub_category['name']+"</option>");
		    		}
				});
		    },
		    failure: function(errMsg) {
		        alert(errMsg);
		    }
	    });
	}
});