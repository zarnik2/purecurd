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
					var pageCount = Math.ceil(total/limit);
					var startpage = 1;
					var endpage = pageCount;
					var linkBeforeCurrentPage = 3;
					var html="";

					$('#pageLimit').html("");
					if(total!=0){
						makePagi(total, limit, page, linkBeforeCurrentPage);
						}
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
			// debugger;

			// if(pageCount == 1){
			// 	showLink(1,currentPage,1);
			// 	return false;
			// }
			if(pageCount < ((linkBeforeCurrentPage*2)+1)){
				// previous(startpage,currentPage);
			    for(i=1; i<=pageCount; i++){
			        showLink(i,currentPage,i);
			    }
			    // next(endpage,currentPage);
			    return false;
			    // alert('c1');
			}

			// first

			// previous
			if(currentPage > linkBeforeCurrentPage && ((pageCount - currentPage) >= linkBeforeCurrentPage)){
				previous(startpage,currentPage);

				if((currentPage - linkBeforeCurrentPage) == 2){ 
				showLink(startpage,currentPage,'1');
				}
				if((currentPage - linkBeforeCurrentPage) > 1 && (currentPage - linkBeforeCurrentPage) != 2  ){
				showLink(startpage,currentPage,'First');
				}

			    for(i = (currentPage-linkBeforeCurrentPage); i <= (currentPage + linkBeforeCurrentPage); i++){
			        showLink(i,currentPage,i);
			    }

			    if((pageCount-currentPage)==(linkBeforeCurrentPage+1)){
			    	showLink(endpage,currentPage,endpage);
			    }
			    if(((pageCount-currentPage)>linkBeforeCurrentPage )&& ((pageCount-currentPage)!=(linkBeforeCurrentPage+1)) ){
			    	showLink(endpage,currentPage,'Last');
			    }

			    next(endpage,currentPage);
			    alert('c2');
			}else{
			    if(currentPage <= linkBeforeCurrentPage){
			    	previous(startpage,currentPage);
			        for(i = 1; i <= ((linkBeforeCurrentPage*2)+1); i++){
			            showLink(i,currentPage,i);
			        }   
			        if(((2*linkBeforeCurrentPage)+1) != pageCount && ( pageCount - ((2*linkBeforeCurrentPage)+1)) !=1  ){
			        	showLink(endpage,currentPage,'Last'); 
			        }  
			        if(( pageCount - ((2*linkBeforeCurrentPage)+1)) ==1){
			        	showLink(endpage,currentPage,endpage); 
			        }
			        next(endpage,currentPage);
			       alert('c3');
			    }
			    if((pageCount - currentPage) <= linkBeforeCurrentPage){
			    	previous(startpage,currentPage);
			    	if(((2*linkBeforeCurrentPage)+1) != pageCount && ( pageCount - ((2*linkBeforeCurrentPage)+1)) !=1){
			    	showLink(startpage,currentPage,'First');
			    	}
			    	 if(( pageCount - ((2*linkBeforeCurrentPage)+1)) ==1){
			        	showLink(startpage,currentPage,'1'); 
			        }
			        for(i = (pageCount - (linkBeforeCurrentPage*2)); i <= pageCount; i++){
			            showLink(i,currentPage,i);
			        }
			        next(endpage,currentPage);
			        alert('c4');
			    }
			}
			return false;
			// next

			// last
		}

		function showLink(i,currentPage,text){
		   	var html ="";
			if(i==currentPage){
				html += ` <li class="page-item active" p="`+i+`"><a class="page-link">`+text+`</a></li>`;
			} else {
				html += ` <li class="page-item" p="`+i+`"><a class="page-link">`+text+`</a></li>`;
			}
			$('#pageLimit').append(html);
		}
		function previous(startpage,currentPage){
			var html = "";
			if(startpage == currentPage){
				html += `<li class="page-item disabled"><a class="page-link">&laquo;</a></li>`;
			}else{
				var previousPage = currentPage-1;
				html += `<li class="page-item" p="`+previousPage+`"><a class="page-link">&laquo;</a></li>`;
			}
			$('#pageLimit').append(html);
		}
		function next(endpage,currentPage){
			var html = "";
			if(endpage == currentPage){
				html += `<li class="page-item disabled"><a class="page-link">&raquo;</a></li>`;
			}else{
			    var nextPage =  +currentPage + 1;
				html += `<li class="page-item" p="`+nextPage+`"><a class="page-link">&raquo;</a></li>`;
			}
			
			$('#pageLimit').append(html);
		}
});