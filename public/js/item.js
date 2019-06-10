$(document).ready(function(){

	var pid = $('#parent_category').val();
	if(pid !== ""){
		var sid = $("#sub_parent_category").attr('sub_category');
		console.log(sid);
		$.ajax({
		    type: "GET",
		    url: "./?action=getcategories",
		    // The key needs to match your method's input parameter (case-sensitive).
		    data: {parentid :pid},
		    contentType: "application/x-www-form-urlencoded",
		    dataType: "json",
		    success: function(data)
		    {  
		    	$('#sub_parent_category').html('<option value="">Plesase select sub category</option>');
		    	data.forEach(function(subCategory) {
		    		if(subCategory['id'] == sid){
		    			$('#sub_parent_category').append("<option value='"+subCategory['id']+"' selected>"+subCategory['name']+"</option>");
		    		}else{
		    			$('#sub_parent_category').append("<option value='"+subCategory['id']+"'>"+subCategory['name']+"</option>");
		    		}
				});
				console.log(data);
		    },
		    failure: function(errMsg) {
		        alert(errMsg);
		    }
	    });
	}
	$('#parent_category').on('change',function(){
		var id = $(this).val();
		$.ajax({
		    type: "GET",
		    url: "./?action=getcategories",
		    // The key needs to match your method's input parameter (case-sensitive).
		    data: {parentid : id},
		    contentType: "application/x-www-form-urlencoded",
		    dataType: "json",
		    success: function(data)
		    {  
		    	$('#sub_parent_category').html('<option value="">Plesase select sub category</option>');
		    	data.forEach(function(subCategory) {
    	            $('#sub_parent_category').append("<option value='"+subCategory['id']+"'>"+subCategory['name']+"</option>");
				});
		    },
		    failure: function(errMsg) {
		        alert(errMsg);
		    }
	    });
	});

	$("#f_parent_category").on('change',function(){
		// var pid = $('#f_parent_category option:selected').attr('myid');
		var id = $('#f_parent_category').val();
		if(id != "All category"){
			$("#f_sub_category").show();
			$.ajax({
			    type: "GET",
			    url: "./?action=getcategories",
			    // The key needs to match your method's input parameter (case-sensitive).
			    data: {parentid : id},
			    contentType: "application/x-www-form-urlencoded",
			    dataType: "json",
			    success: function(data)
			    {  
			    	$('#f_sub_category').html('<option value="">Sub Category</option>');
			    	data.forEach(function(sub_category) {
			            $('#f_sub_category').append("<option value='"+sub_category['id']+"'>"+sub_category['name']+"</option>");
					});
					console.log(data);
			    },
			    failure: function(errMsg) {
			        alert(errMsg);
			    }
			});
			$('#f_sub_category').val('');
			// getItem('1');
		}else{
			$("#f_sub_category").hide();
			$('#f_sub_category').val('');
			// getItem('1');
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
	})
});