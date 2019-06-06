$(document).ready(function(){

		$('#search_name').on('keyup',function(){
			var cost = $('#price').val();
			var name = $('#search_name').val();
			var p_category = $('#f_parent_category').val(); 
			var s_category = $('#f_sub_category').val();
			var p = '1';
			var p_item = "";
			var limit = $('#limit').val();
			getItem(p_category,s_category,name,cost,p,p_item,limit);
			
		});

		$("#price").on('keyup',function(){
			var cost = $('#price').val();
			var name = $('#search_name').val();
			var p_category = $('#f_parent_category').val(); 
			var s_category = $('#f_sub_category').val();
			var p ='1';
			var p_item = "";
			var limit = $('#limit').val();
			getItem(p_category,s_category,name,cost,p,p_item,limit);
		})
		$("#f_parent_category").on('change',function(){
			var pid = $('#f_parent_category option:selected').attr('myid');
			var cost = $('#price').val();
			var name = $('#search_name').val();
			var p_category = $('#f_parent_category').val(); 
			var s_category = $('#f_sub_category').val();
			var p = '1';
			var p_item = "";
			var limit = $('#limit').val();
			if(typeof pid !== "undefined"){
				$("#f_sub_category").show();
				$.ajax({
				    type: "POST",
				    url: "./?action=showSubCategory",
				    // The key needs to match your method's input parameter (case-sensitive).
				    data: JSON.stringify({id : pid}),
				    contentType: "application/x-www-form-urlencoded",
				    dataType: "json",
				    success: function(data)
				    {  
				    	$('#f_sub_category').html('<option value="">Sub Category</option>');
				    	data.forEach(function(item) {
		    	            $('#f_sub_category').append("<option value='"+item['name']+"'>"+item['name']+"</option>");
						});
				    },
				    failure: function(errMsg) {
				        alert(errMsg);
				    }
	    		});
	    		getItem(p_category,s_category,name,cost,p,p_item,limit);
			}else{
				$("#f_sub_category").hide();
				getItem(p_category,s_category,name,cost,p,p_item,limit);
			}
			 // $("#itemTable td.pc:contains('" + $(this).val() + "')").parent().show();
    //     	 $("#itemTable td.pc:not(:contains('" + $(this).val() + "'))").parent().hide();
		});

		$("#limit").on('change',function(){
			var cost = $('#price').val();
			var name = $('#search_name').val();
			var p_category = $('#f_parent_category').val(); 
			var s_category = $('#f_sub_category').val();
			var p = '1';
			var p_item = "";
			var limit = $(this).val();
			getItem(p_category,s_category,name,cost,p,p_item,limit);
			alert(limit);
		});

		$("#f_sub_category").on('change',function(){
			var cost = $('#price').val();
			var name = $('#search_name').val();
			var p_category = $('#f_parent_category').val(); 
			var s_category = $('#f_sub_category').val();
			var p = '1';
			var p_item = "";
			var limit = $('#limit').val();
			getItem(p_category,s_category,name,cost,p,p_item,limit);
		});
		
		$('.page-item').click(function(){
			$('.page-item.active').removeClass('active');
			$(this).addClass('active');
			var cost = $('#price').val();
			var name = $('#search_name').val();
			var p_category = $('#f_parent_category').val(); 
			var s_category = $('#f_sub_category').val();
			var p = $(this).attr('p');
			var p_item = "set";
			var limit = $('#limit').val();
			getItem(p_category,s_category,name,cost,p,p_item,limit);
		})
		function getItem(pc,sc,n,cost,p,p_item,limit){
		    
		    if(sc==null){
		    	sc="";
		    }
		    if(pc=="All category"){
		    	pc="";
		    }
			$.ajax({
				    type: "GET",
				    url: "./?action=getitems",
				    // The key needs to match your method's input parameter (case-sensitive).
				    data: {category:pc,sub_category:sc,name:n,price:cost,page:p,limit:limit},
				    contentType: "application/x-www-form-urlencoded",
				    dataType: "json",
				    success: function(data)
				    {  
				    	console.log(data);
				    	$('#itemTableBody').html("");
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
						if(p_item==""){
						}		
				    },
				    failure: function(errMsg) {
				        alert(errMsg);
				    }
	    	});
		}
});