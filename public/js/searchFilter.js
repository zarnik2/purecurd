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
			filterTable($(this).val(),1);
		});

		$("#price").on('keyup',function(){
			filterTable($(this).val(),4);
		})
		$("#f_parent_category").on('change',function(){
			var pid = $('#f_parent_category option:selected').attr('myid');
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
			}else{
				$("#f_sub_category").hide();
			}
			 $("#itemTable td.pc:contains('" + $(this).val() + "')").parent().show();
        	 $("#itemTable td.pc:not(:contains('" + $(this).val() + "'))").parent().hide();
		});

		$("#f_sub_category").on('change',function(){
			 $("#itemTable td.sc:contains('" + $(this).val() + "')").parent().show();
	    	 $("#itemTable td.sc:not(:contains('" + $(this).val() + "'))").parent().hide();
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