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
		$('#f_sub_category').val('');
		$('#filterForm').submit();
	});
	$("#f_sub_category").on('change',function(){
		$('#filterForm').submit();
	});

	$('#search_name').bind("enterKey",function(e){
   		$('#filterForm').submit();
	});

	$('#price').bind("enterKey",function(e){
   		$('#filterForm').submit();
	});
	$('#search_name,#price').keyup(function(e){
	    if(e.keyCode == 13)
	    {
	        $(this).trigger("enterKey");
	    }
	});
	$("#limit").on('change',function(){
		$('#filterForm').submit();
	});

	$('#pageLimit').delegate('.page-item','click',function(){
		if($(this).hasClass('disabled')){ return false; }
		var page = $(this).attr('p');
		$('#page').val(page);
		$('#filterForm').submit();
	})

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

	var total = $('#total').val();
	var limit = $('#limit').val();
	var currentPage = $('#currentPage').val();

	if(total!=0){
		makePagi({
			total : total, 
			limit : limit, 
			currentPage : currentPage, 
			linkBeforeCurrentPage : 4,
			container : 'pageLimit',
			firstLink : 'First',
			lastLink : 'Last',
			nextLink : '&raquo;',
			prevLink : '&laquo;'
		});
	}
});