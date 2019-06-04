<!doctype html>
<script type="text/javascript" 
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./public/js/item.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
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
			<div class="col-md-12 ">
				<form class="form-inline">
					<input type="text" class="form-control col-md-2 mr-2" placeholder="name">
					<input type="text" class="form-control col-md-2 mr-2" placeholder="price">
					<select class="form-control col-md-2" id="parent_category" 
					name="parent_category">
				    	<option value="">All category</option>
					    {foreach from=$parent_category item=pc}
							<option value="{$pc.name}" myid="{$pc.id}">{$pc.name}</option>
						{/foreach}
	  				</select>
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
							        <td>{$item.p_category}</td>
							        <td>{$item.s_category}</td>
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
		  				{if sizeof($items)==0}
							<center>
								<h3 class="text-info" style="font-size:16px;opacity:0.8"> No item recorded yet ...</h3>
							</center>
						{/if}
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
    									<option value="{$pc.name}" myid="{$pc.id}">{$pc.name}</option>
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