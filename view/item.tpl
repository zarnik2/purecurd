<!doctype html>
<script type="text/javascript" 
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./public/js/item.js"></script>
<script src="./public/js/pagination.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<head>
	<title>Simple POS</title>
	<script src =""></script>
</head>
<body>
	{if isset($success)}
		<div class="alert alert-success alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a> 
                {$success}
        </div>
	{/if}
	{if isset($error)}
		<div class="alert alert-danger alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a> 
                {$error}
        </div>
	{/if}
	<div class="container border p-3 mt-3">
		<div class="row">
			<div class="col-md-12 text-danger">
				<h3>Items</h3>
			</div>
			<div class="col-md-12 ">
				<button  type="button" class="btn btn-outline-success float-right" data-toggle="modal" data-target="#myModal">Create Items</button>
			</div>
			<div class="col-md-12">

				<form class="form-inline" id="filterForm" action="index.php">

					<input type="text" class="form-control col-md-2 mr-2" placeholder="name" id="search_name" name="name" value="{(!empty($get['name'])) ? $get['name'] : ''}">

					<input type="text" class="form-control col-md-2 mr-2" placeholder="price" id="price" name="price" value="{(!empty($get['price'])) ? $get['price'] : ''}">

					<select class="form-control col-md-2 mr-2" id="f_parent_category" 
					name="category">
				    	<option value="">All category</option>
					    {foreach from=$parent_category item=pc}
					       
					    <option {(!empty($get['category']) && $get['category'] == $pc.id) ? 'selected' : ''} value="{$pc.id}" >{$pc.name}</option>	
						   
						{/foreach}
	  				</select>
	  				{if isset($sub_category) }
	  				<select class="form-control col-md-2 mr-2" id="f_sub_category" 
					name="sub_category">
						<option value="">Sub Category</option>
						 {foreach from=$sub_category item=sc}
							 <option {(!empty($get['sub_category']) && $get['sub_category'] == $sc.id)? 'selected' : ''} value="{$sc.id}" >{$sc.name}</option>
						{/foreach}
	  				</select>
	  				{/if}
	  				<select class="form-control col-md-1" id="limit" name="limit">
	  					<option value="2" 
	  					{(!empty($get['limit'])) && ($get['limit']== 2 )? 'selected' : ''}>2</option>
	  					<option value="5"
	  					{(!empty($get['limit'])) && ($get['limit']== 5) ? 'selected' : ''}>5</option>
	  					<option value="10"
	  					{(!empty($get['limit'])) && ($get['limit']== 10) ? 'selected' : ''}>10</option>
	  					<option value="20"
	  					{(!empty($get['limit'])) && ($get['limit']== 20 )? 'selected' : ''}>20</option>
	  				</select>
	  				<input type="hidden" name="page" id="page">
				</form>

			</div>
			<div class="col-md-12 mb-3">
			</div>
			<div class="col-md-12">
				<div id="tb_loader">
					<div id="td">
						{if sizeof($items)>0}
							<table class="table table-hover" id="itemTable">
							    <thead>
							      <tr>
							        <th>ID</th>
							        <th>Item Name</th>
							        <th>Category</th>
							        <th>Sub Category</th>
							        <th>Current Price</th>
							        <th>Cost</th>
							        <th>Action</th>
							      </tr>
							    </thead>
							    <tbody>
							    {foreach from=$items item=item}
							      <tr>
							        <td>{$item.id}</td>
							        <td>{$item.name}</td>
							        <td>{$item.parent_category}</td>
							        <td>{$item.sub_category}</td>
							        <td>{$item.current_price}</td>
							        <td>{$item.cost}</td>
							        <td>
							        	<button class="btn btn-outline-primary" onclick="window.location.href='./index.php?action=edit&id={$item.id}'">
							        		Edit
							        	</button>
							        	<button class="btn btn-outline-danger delete" item_id="{$item.id}">
							        		Delete
							        	</button>
							        </td>
							      </tr>
							    {/foreach}
							    </tbody>
			  				</table>
		  				{/if}
						<!-- <nav aria-label="Page navigation example">
						  <ul class="pagination">
						  	{if $pageCount ne 1 && $pageCount ne 0}
						    <li class="page-item {(!empty($get['page'])) && ($get['page']==1) ? 'disabled' : ''}"
						    p="{$get['page']-1}">
						      <a class="page-link" href="#" aria-label="Previous">
						        <span aria-hidden="true">&laquo;</span>
						        <span class="sr-only">Previous</span>
						      </a>
						    </li>
						    {/if}
						    {for $i=1 to $pageCount}
							    <li class="page-item {(!empty($get['page'])) && ($get['page']==$i) ? 'active' : ''}" p='{$i}'><a class="page-link" href="#">{$i}</a></li>
							{/for}
							{if $pageCount ne 1 && $pageCount ne 0}
						    <li class="page-item {(!empty($get['page'])) && ($get['page']==$pageCount) ? 'disabled' : ''}"  p="{$get['page']+1}">
						      <a class="page-link" href="#" aria-label="Next">
						        <span aria-hidden="true">&raquo;</span>
						        <span class="sr-only">Next</span>
						      </a>
						    </li>
						    {/if}
						  </ul>
						</nav> -->
						 <input type="hidden" value="{$total}" id="total">
						 <input type="hidden" value="{$limit}" id="limit">
						 <input type="hidden" value="{$currentPage}" id="currentPage">
						 <div id="pageLimit"></div>
	  				</div>
  			    </div>   
			</div>
		</div>

				<!-- The Modal -->
		<div class="modal fade" id="myModal" style='font-size:13px;font-weight:bold'>
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Items</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        	<form method="POST" action="./index.php?action=store">
						  <div class="form-group">
						    <label for="item_name">Item Name : </label>
						    <input type="text" class="form-control col-md-7" id="item_name" name="item_name">
						  </div>
						  <div class="form-group">
						    <label for="parent_category">Parent_category :</label>
							    <select class="form-control col-md-7" id="parent_category" name="parent_category">
							    	<option value=""></option>
								    {foreach from=$parent_category item=pc}
    									<option value="{$pc.id}">{$pc.name}</option>
									{/foreach}
	  							</select>
						  </div>
						  <div class="form-group">
						    <label for="sub_parent_category"> Sub Parent_category :</label>
							    <select class="form-control col-md-7" id="sub_parent_category" name="sub_parent_category">
							    	<option value=""></option>
	  							</select>
						  </div>
						   <div class="form-group">
						    <label for="current_price"> Item Current Price :</label>
						    <input type="number" class="form-control col-md-7" id="current_price" name="current_price">
						  </div>
						   <div class="form-group">
						    <label for="cost">Item cost:</label>
						    <input type="number" class="form-control col-md-7" id="cost" name="cost">
						  </div>
						   <div class="form-group">
						    <label for="d_type">Discount Type :</label>
							    <select class="form-control col-md-7" id="d_type" name="d_type">
							    	<option value="%">%</option>
							    	<option value="$">$</option>
	  							</select>
						  </div>
						   <div class="form-group">
						    <label for="d_amount">Discount amount:</label>
						    <input type="number" class="form-control col-md-7" id="d_amount" name="d_amount">
						  </div>
						   <div class="form-group">
						    <label for="bar">Barcode:</label>
						    <input type="number" class="form-control col-md-7" id="bar" name="bar">
						  </div>
					
		      </div>
		      <!-- Modal footer -->
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-success mr-auto">Save</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
	</div>
</body>
</html>