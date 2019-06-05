$(document).ready(function(){

	// $('#search_name').bind("enterKey",function(e){
	// 	filter = $(this).val().toUpperCase();
	// 	table = document.getElementById("itemTable");
	// 	tr = table.getElementsByTagName("tr");
	// 	for (i = 0; i < tr.length; i++) {
	// 	    td = tr[i].getElementsByTagName("td")[1];
	// 	    if (td) {
	// 	      txtValue = td.textContent || td.innerText;
	// 	      if (txtValue.toUpperCase().indexOf(filter) > -1) {
	// 	        tr[i].style.display = "";
	// 	      } else {
	// 	        tr[i].style.display = "none";
	// 	      }
	// 	    }       
 //  		}
	// });
	// $('#search_name').keyup(function(e){
	//     if(e.keyCode == 13)
	//     {
	//         $(this).trigger("enterKey");
	//     }
	// });	
		
		$('#search_name').on('keyup',function(){
			var name = $(this).val();
			var price = $('#price').val();
			var p_category = $('#f_parent_category').val(); 
			var s_category = $('#f_sub_category').val();
			getItem(p_category,s_category,name);
			
		});

		$("#price").on('keyup',function(){
			filterTable($(this).val(),4);
		})
		$("#f_parent_category").on('change',function(){
			var pid = $('#f_parent_category option:selected').attr('myid');
			var pc = $('#f_parent_category option:selected').val();
			var sc = null;
			var n = $('#search_name').val();
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
	    		getItem(pc,sc,n);
			}else{
				$("#f_sub_category").hide();
				$("#f_sub_category").val('');
				getItem(pc,sc,n);
			}
			 // $("#itemTable td.pc:contains('" + $(this).val() + "')").parent().show();
    //     	 $("#itemTable td.pc:not(:contains('" + $(this).val() + "'))").parent().hide();
		});

		$("#f_sub_category").on('change',function(){
			 var pc = $('#f_parent_category').val();
			 var sc = $(this).val();
			 var n  = $('#search_name').val();
			 getItem(pc,sc,n);
		});
		
		function filterTable(value,column){
			filter = value.toUpperCase();
			table = document.getElementById("itemTable");
			tr = table.getElementsByTagName("tr");
			for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[column];
			    if (td) {
			      txtValue = td.textContent || td.innerText;
			      if (txtValue.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }       
	  		}
		}



		function getItem(pc,sc,n){
			$.ajax({
				    type: "POST",
				    url: "./?action=getItem",
				    // The key needs to match your method's input parameter (case-sensitive).
				    data: JSON.stringify({p_category:pc,s_category:sc,name:n}),
				    contentType: "application/x-www-form-urlencoded",
				    dataType: "json",
				    success: function(data)
				    {  
				    	$('#itemTableBody').html("");
			    		data.forEach(function(item) {
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
				        alert(errMsg);
				    }
	    	});
		}
		// function filterTable(value,column){
		// 	 $("#itemTable tr").each(function(index) {
		//         if (index != 0) {

		//             $row = $(this);

		//             var id = $row.find("td:first").text();

		//             if (id.indexOf(value) != 0) {
		//                 $(this).hide();
		//             }
		//             else {
		//                 $(this).show();
		//             }
		//         }
  //   		});
		// }
});