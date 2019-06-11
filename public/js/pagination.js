var total = "";
var limit = "";
var currentPage = "";
var linkBeforeCurrentPage = 3;
var container = "";
var firstLink = "First";
var lastLink = "Last";
var nextLink = "Next";
var prevLink = "Prev";

function makePagi(options){
	if(!options.total || !options.limit || !options.currentPage || !options.container){
		alert("Please provide require parameter to make pagination"); return false;
	}
	total = options.total; 
	limit = options.limit; 
	currentPage = options.currentPage; 
	linkBeforeCurrentPage = (options.linkBeforeCurrentPage)? options.linkBeforeCurrentPage : linkBeforeCurrentPage;
	container = options.container; 
	firstLink = (options.firstLink)? options.firstLink : firstLink; 
	lastLink = (options.lastLink)? options.lastLink : lastLink; 
	nextLink = (options.nextLink)? options.nextLink : nextLink; 
	prevLink = (options.prevLink)? options.prevLink : prevLink;
	
	$('#'+container).html('');
	$('#'+container).append("<ul class='pagination'></ul>");

	total = parseInt(total);
	limit = parseInt(limit);
	currentPage = parseInt(currentPage);
	var pageCount = Math.ceil(total/limit);
	var startpage = 1;
	var endpage = pageCount;
	// console.log(' ------------ page count ------------- '+pageCount+' ---------------');
	// debugger;

	// !note the condition of total is very low and cannot produce previous link and next link
	if(pageCount < ((linkBeforeCurrentPage*2)+1)){
		if(pageCount!=1){
			previous(currentPage);
		}
		
	    for(i=1; i<=pageCount; i++){
	        showLink(i,currentPage,i);
	    }
	    if(pageCount!=1){
	    	next(pageCount,currentPage);
	    }
	    return false;
	}

	// first
	if(currentPage>linkBeforeCurrentPage+1){ 
		var text = (currentPage-linkBeforeCurrentPage==2) ? "1" : firstLink;
		showFirstLink(text);
	}

	// previous
	previous(currentPage);

	// !note current page is okay to produce next links and prev links
	if(currentPage > linkBeforeCurrentPage && ((pageCount - currentPage) >= linkBeforeCurrentPage)){
		
	    for(i = (currentPage-linkBeforeCurrentPage); i <= (currentPage + linkBeforeCurrentPage); i++){
	        showLink(i,currentPage,i);
	    }
	}else{
		// !note current page is very close with link 1
	    if(currentPage <= linkBeforeCurrentPage){
	        for(i = 1; i <= ((linkBeforeCurrentPage*2)+1); i++){
	            showLink(i,currentPage,i);
	        }   
	    }
	    // !note current page is very close with latest link
	    if((pageCount - currentPage) <= linkBeforeCurrentPage){

	        for(i = (pageCount - (linkBeforeCurrentPage*2)); i <= pageCount; i++){
	            showLink(i,currentPage,i);
	        }
	    }
	}

	// next
	next(pageCount,currentPage);

	// last
	if((pageCount-currentPage) >linkBeforeCurrentPage){
		// var text = ((pageCount - currentPage )==(linkBeforeCurrentPage+1)) ? pageCount : "Last";
		showLastLink(lastLink,pageCount);
	}

	return false;
}

function showLink(i,currentPage,text){
   	var html ="";
   	var active = (currentPage == i)? 'active' : '';
	html += ` <li class="page-item `+active+`" p="`+i+`"><a class="page-link">`+text+`</a></li>`;
	$('#'+container+' ul.pagination').append(html);
}
function showFirstLink(text){
	var html="";
	html += ` <li class="page-item" p="1"><a class="page-link">`+text+`</a></li>`;
	$('#'+container+' ul.pagination').append(html);
}
function showLastLink(text,endpage){
	var html="";
	html += ` <li class="page-item" p="`+endpage+`"><a class="page-link">`+text+`</a></li>`;
	$('#'+container+' ul.pagination').append(html);
}
function previous(currentPage){
	var html = "";
	var disable = (currentPage == 1 ) ? 'disabled' : '';
	html += `<li class="page-item `+disable+`" p="`+(currentPage-1)+`"><a class="page-link">`+prevLink+`</a></li>`;
	if($('.page-link:first').text() == '1'){
		$('#'+container+' ul.pagination').prepend(html);
	}else{
		$('#'+container+' ul.pagination').append(html);
	}
}
function next(endpage,currentPage){
	var html = "";
	var disable = (currentPage == endpage ) ? 'disabled' : '';
		html += `<li class="page-item `+disable+`" p="`+(currentPage+1)+`"><a class="page-link">`+nextLink+`</a></li>`;
	$('#'+container+' ul.pagination').append(html);
}