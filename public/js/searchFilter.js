$(document).ready(function(){
	getItem('1');

	$('#search_name').on('keyup',function(){
		getItem('1');
	});

	$("#price").on('keyup',function(){
		getItem('1');
	})
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
			getItem('1');
		}else{
			$("#f_sub_category").hide();
			$('#f_sub_category').val('');
			getItem('1');
		}
	});

	$("#limit").on('change',function(){
		getItem('1');
	});

	$("#f_sub_category").on('change',function(){
		getItem('1');
	});
	
	$('#pageLimit').delegate('.page-item','click',function(){
		if($(this).hasClass('disabled')){ return false; }
		$('.page-item.active').removeClass('active');
		$(this).addClass('active');
		var page = $(this).attr('p');
		getItem(page);
	});

	function getItem(page){
	    var price = $('#price').val();
		var name = $('#search_name').val();
		var p_category = $('#f_parent_category').val(); 
		var s_category = $('#f_sub_category').val();
		var limit = $('#limit').val();

	    if(s_category==null){
	    	s_category="";
	    }
	    if(p_category=="All category"){
	    	p_category="";
	    }

		$.ajax({
			type: "GET",
		    url: "./?action=getitems",
		    // The key needs to match your method's input parameter (case-sensitive).
		    data: {category:p_category,sub_category:s_category,name:name,price:price,page:page,limit:limit},
		    contentType: "application/x-www-form-urlencoded",
		    dataType: "json",
		    success: function(data)
		    {  
		    	$('#itemTableBody').html("");

	    		data.items.forEach(function(item) {
            		$('#itemTableBody').append(`
						<tr>
					        <td>`+item['id']+`</td>
					        <td>`+item['name']+`</td>
					        <td class="pc">`+item['parent_category']+`</td>
					        <td class="sc">`+item['sub_category']+`</td>
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
				var countItems = Object.values(data.countItems[0]);
				var total = countItems[0];
				
				/***** calling pagination plugin ******/								
				if(total!=0){
					makePagi({
						total : total, 
						limit : limit, 
						currentPage : page, 
						linkBeforeCurrentPage : 4,
						container : 'pageLimit',
						firstLink : 'First',
						lastLink : 'Last',
						nextLink : '&raquo;',
						prevLink : '&laquo;'
					});
				}
				/***************************************/
			},
			failure: function(errMsg) {
			    alert(errMsg);
			}
    	});
	}
});