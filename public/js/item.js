$(document).ready(function(){
	startUpGetItem();
	var pid = $('#parent_category option:selected').attr('myid');
	if(typeof pid !== "undefined"){
		var sub_category = $("#sub_parent_category").attr('sub_category');
		$.ajax({
		    type: "POST",
		    url: "./?action=showSubCategory",
		    // The key needs to match your method's input parameter (case-sensitive).
		    data: JSON.stringify({id : pid}),
		    contentType: "application/x-www-form-urlencoded",
		    dataType: "json",
		    success: function(data)
		    {  
		    	$('#sub_parent_category').html('<option value="">Plesase select sub category</option>');
		    	data.forEach(function(item) {
		    		if(item['name'] == sub_category){
		    			$('#sub_parent_category').append("<option value='"+item['name']+"' selected>"+item['name']+"</option>");
		    		}else{
		    			$('#sub_parent_category').append("<option value='"+item['name']+"'>"+item['name']+"</option>");
		    		}
				});
		    },
		    failure: function(errMsg) {
		        alert(errMsg);
		    }
	    });
	}
	$('#parent_category').on('change',function(){
		var id = $('option:selected', this).attr('myid');
		$.ajax({
		    type: "POST",
		    url: "./?action=showSubCategory",
		    // The key needs to match your method's input parameter (case-sensitive).
		    data: JSON.stringify({id : id}),
		    contentType: "application/x-www-form-urlencoded",
		    dataType: "json",
		    success: function(data)
		    {  
		    	$('#sub_parent_category').html('<option value="">Plesase select sub category</option>');
		    	data.forEach(function(item) {
    	            $('#sub_parent_category').append("<option value='"+item['name']+"'>"+item['name']+"</option>");
				});
		    },
		    failure: function(errMsg) {
		        alert(errMsg);
		    }
	    });
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

	function startUpGetItem(){
		$.ajax({
		    type: "GET",
		    url: "./?action=getitems",
		    // The key needs to match your method's input parameter (case-sensitive).
		    data: {page:"1",limit:"3"},
		    contentType: "application/x-www-form-urlencoded",
		    dataType: "json",
		    success: function(data)
		    {  
		    	data.items.forEach(function(item) {
            		$('#itemTableBody').append(`
						<tr>
					        <td>`+item['id']+`</td>
					        <td>`+item['name']+`</td>
					        <td class="pc">`+item['p_category']+`</td>
					        <td class="sc">`+item['s_category']+`</td>
					        <td>`+item['current_price']+`</td>
					        <td>`+item['cost']+`</td>
					        <td>
					        	<button class="btn btn-outline-primary" onclick="window.location.href='./index.php?action=edit&id=`+item['id']+`'">
					        		Edit
					        	</button>
					        	<button class="btn btn-outline-danger delete" item_id="`+item['id']+`">
					        		Delete
					        	</button>
					        </td>
						</tr>
					`);
				});	
		    },
		    failure: function(errMsg) {
		       console.log(errMsg);
		    }
	    });
	}
});