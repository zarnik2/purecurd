$(document).ready(function(){
		getItem('1');
		$('#search_name').on('keyup',function(){
			getItem('1');
		});

		$("#price").on('keyup',function(){
			getItem('1');
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
					var countItems = Object.values(data.countItems[0]);
					var total = countItems[0];
					var pageCount = Math.ceil(total/limit);
					var startpage = 1;
					var endpage = pageCount;
					var linkBeforeCurrentPage = 3;
					var html="";

					$('#pageLimit').html("");
					if(total!=0){
						// if(pageCount != 1){
						// 	if(page == startpage ){
						// 		html += `<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>`;
						// 	} else {
						// 		previous_page = page-1;
						// 		html += `<li class="page-item" p="`+previous_page+`"><a class="page-link" href="#">Previous</a></li>`;
						// 	}
						// 	for(var i=1; i<pageCount+1; i++){

						// 		if(page == i){

						// 			html += ` <li class="page-item active" p="`+i+`">
						//     					<a class="page-link" href="#">`+i+`</a>
						//     			  </li>`;
						// 		} else {
						// 			html += ` <li class="page-item" p="`+i+`">
						//     					<a class="page-link" href="#">`+i+`</a>
						//     			  </li>`;
						// 		}
  							
						// 	}
						// 	if(page == endpage){
						// 		html += `<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>`;
						// 	} else {
						// 		next_page = +page+1;
						// 		html += `<li class="page-item" p="`+next_page+`"><a class="page-link" href="#">Next</a></li>`;
						// 	}
							
						// }else{

						// 	html += ` <li class="page-item active" p="1">
						//     			<a class="page-link" href="#">1</a>
						//     		</li>`;
						// }
						makePagi(total, limit, page, linkBeforeCurrentPage);
						}
						
						// $('#pageLimit').append(html);

				    },
				    failure: function(errMsg) {
				        alert(errMsg);
				    }
	    	});
		}

		function makePagi(total, limit, currentPage, linkBeforeCurrentPage){
			total = parseInt(total);
			limit = parseInt(limit);
			currentPage = parseInt(currentPage);

			var pageCount = Math.ceil(total/limit);
			var startpage = 1;
			var endpage = pageCount;
			// console.log(' ------------ page count ------------- '+pageCount+' ---------------');
			//debugger;

			if(pageCount == 1){
				showLink(1,currentPage);
				return false;
			}
			if(pageCount < ((linkBeforeCurrentPage*2)+1)){
				previous(startpage,currentPage);
			    for(i=1; i<=pageCount; i++){
			        showLink(i,currentPage);
			    }
			    next(endpage,currentPage);
			    return false;
			    alert('c1');
			}

			// first

			// previous
			if(currentPage > linkBeforeCurrentPage && ((pageCount - currentPage) >= linkBeforeCurrentPage)){
				previous(startpage,currentPage);
			    for(i = (currentPage-linkBeforeCurrentPage); i <= (currentPage + linkBeforeCurrentPage); i++){
			        showLink(i,currentPage);
			    }
			    if((pageCount-currentPage)>linkBeforeCurrentPage){
			    	last(endpage);
			    }
			    next(endpage,currentPage);
			    alert('c2');
			}else{
			    if(currentPage <= linkBeforeCurrentPage){
			    	previous(startpage,currentPage);
			        for(i = 1; i <= ((linkBeforeCurrentPage*2)+1); i++){
			            showLink(i,currentPage);
			        }   
			        last(endpage); 
			        next(endpage,currentPage);
			        alert('c3');
			    }
			    if((pageCount - currentPage) <= linkBeforeCurrentPage){
			    	previous(startpage,currentPage);
			        for(i = (pageCount - (linkBeforeCurrentPage*2)); i <= pageCount; i++){
			            showLink(i,currentPage);
			        }
			        next(endpage,currentPage);
			        alert('c4');
			    }
			}
			return false;
			// next

			// last
		}

		function showLink(i,page){
		   	var html ="";
			if(i==page){
				html += ` <li class="page-item active" p="`+i+`"><a class="page-link" href="#">`+i+`</a></li>`;
			} else {
				html += ` <li class="page-item" p="`+i+`"><a class="page-link" href="#">`+i+`</a></li>`;
			}
			$('#pageLimit').append(html);
		}
		function previous(startpage,currentPage){
			var html = "";
			if(startpage == currentPage){
				html += `<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>`;
			}else{
				var previousPage = currentPage-1;
				html += `<li class="page-item" p="`+previousPage+`"><a class="page-link" href="#">&laquo;</a></li>`;
			}
			$('#pageLimit').append(html);
		}
		function next(endpage,currentPage){
			var html = "";
			if(endpage == currentPage){
				html += `<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>`;
			}else{
			    var nextPage =  +currentPage + 1;
				html += `<li class="page-item" p="`+nextPage+`"><a class="page-link" href="#">&raquo;</a></li>`;
			}
			
			$('#pageLimit').append(html);
		}

		function last(endpage){
			var html = "";
			html += `<li class="page-item" p="`+endpage+`"><a class="page-link" href="#">Last</a></li>`;
			$('#pageLimit').append(html);
		}
			
});