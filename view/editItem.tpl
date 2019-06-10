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
	<div class="container border p-3 mt-3">
		<div class="row">
			<div class="col-md-12 text-danger">
				<h3>Items Edit</h3>
				<hr>
			</div>
			<div class="col-md-12">
				<form method="POST" action="./index.php?action=store">
					{foreach from=$items item=item}
						<input type="hidden" value="{$item.id}" name="item_id">
					  <div class="form-group">
					    <label for="item_name">Item Name : </label>
					    <input type="text" class="form-control col-md-5" id="item_name" name="item_name" value="{$item.name}">
					  </div>
					  <div class="form-group">
					    <label for="parent_category">Parent_category :</label>
						    <select class="form-control col-md-5" id="parent_category" name="parent_category">
						    	<option value=""></option>
							    {foreach from=$parent_category item=pc}
							    	{if $pc.id eq $item.p_category}
									<option value="{$pc.id}"  selected="selected">{$pc.name}</option>
									{else}
									<option value="{$pc.id}">{$pc.name}</option>
									{/if}
								{/foreach}
							</select>
					  </div>
					  <div class="form-group">
					    <label for="sub_parent_category"> Sub Parent_category :</label>
						    <select class="form-control col-md-5" id="sub_parent_category" name="sub_parent_category" sub_category="{$item.s_category}">
						    	<option value=""></option>
							</select>
					  </div>
					   <div class="form-group">
					    <label for="current_price"> Item Current Price :</label>
					    <input type="number" class="form-control col-md-5" id="current_price" name="current_price" value="{$item.current_price}">
					  </div>
					   <div class="form-group">
					    <label for="cost">Item cost:</label>
					    <input type="number" class="form-control col-md-5" id="cost" name="cost"
					    value="{$item.cost}">
					  </div>
					   <div class="form-group">
					    <label for="d_type">Discount Type :</label>
						    <select class="form-control col-md-5" id="d_type" name="d_type">
						    	{if $item.d_type eq '%'}
						    	<option value="%" selected="selected">%</option>
						    	{else}
						    	<option value="%">%</option>
						    	{/if}
						    	{if $item.d_type eq '$'}
						    	<option value="$" selected="selected">$</option>
						    	{else}
						    	<option value="$">$</option>
						    	{/if}
							</select>
					  </div>
					   <div class="form-group">
					    <label for="d_amount">Discount amount:</label>
					    <input type="number" class="form-control col-md-5" id="d_amount" name="d_amount" value="{$item.d_amount}">
					  </div>
					   <div class="form-group">
					    <label for="bar">Barcode:</label>
					    <input type="number" class="form-control col-md-5" id="bar" name="bar" value="{$item.barcode}">
					  </div>
					   <div class="form-group">
					      <button class="btn btn-primary" type="submit"> Update </button>
					      <butoon class="btn btn-light" onclick="window.location.href='index.php'">Cancel</butoon>
					  </div>
					{/foreach}
				</form>
			</div>
		</div>
	</div>
</body>
</html>