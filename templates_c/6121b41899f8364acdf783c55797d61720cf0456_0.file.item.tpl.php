<?php
/* Smarty version 3.1.33, created on 2019-06-10 20:44:48
  from 'C:\xampp\htdocs\pureCRUD\view\item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cfea5201acfc3_17441820',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6121b41899f8364acdf783c55797d61720cf0456' => 
    array (
      0 => 'C:\\xampp\\htdocs\\pureCRUD\\view\\item.tpl',
      1 => 1560192285,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cfea5201acfc3_17441820 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<?php echo '<script'; ?>
 type="text/javascript" 
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="./public/js/item.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<head>
	<title>Simple POS</title>
	<?php echo '<script'; ?>
 src =""><?php echo '</script'; ?>
>
</head>
<body>
	<?php if (isset($_smarty_tpl->tpl_vars['success']->value)) {?>
		<div class="alert alert-success alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a> 
                <?php echo $_smarty_tpl->tpl_vars['success']->value;?>

        </div>
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['error']->value)) {?>
		<div class="alert alert-danger alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a> 
                <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

        </div>
	<?php }?>
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

					<input type="text" class="form-control col-md-2 mr-2" placeholder="name" id="search_name" name="name" value="<?php echo !empty($_smarty_tpl->tpl_vars['get']->value['name']) ? $_smarty_tpl->tpl_vars['get']->value['name'] : '';?>
">

					<input type="text" class="form-control col-md-2 mr-2" placeholder="price" id="price" name="price" value="<?php echo !empty($_smarty_tpl->tpl_vars['get']->value['price']) ? $_smarty_tpl->tpl_vars['get']->value['price'] : '';?>
">

					<select class="form-control col-md-2 mr-2" id="f_parent_category" 
					name="category">
				    	<option value="">All category</option>
					    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parent_category']->value, 'pc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pc']->value) {
?>
					       
					    <option <?php echo !empty($_smarty_tpl->tpl_vars['get']->value['category']) && $_smarty_tpl->tpl_vars['get']->value['category'] == $_smarty_tpl->tpl_vars['pc']->value['id'] ? 'selected' : '';?>
 value="<?php echo $_smarty_tpl->tpl_vars['pc']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
</option>	
						   
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	  				</select>
	  				<?php if (isset($_smarty_tpl->tpl_vars['sub_category']->value)) {?>
	  				<select class="form-control col-md-2 mr-2" id="f_sub_category" 
					name="sub_category">
						<option value="">Sub Category</option>
						 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_category']->value, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value) {
?>
							 <option <?php echo !empty($_smarty_tpl->tpl_vars['get']->value['sub_category']) && $_smarty_tpl->tpl_vars['get']->value['sub_category'] == $_smarty_tpl->tpl_vars['sc']->value['id'] ? 'selected' : '';?>
 value="<?php echo $_smarty_tpl->tpl_vars['sc']->value['id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['sc']->value['name'];?>
</option>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	  				</select>
	  				<?php }?>
	  				<select class="form-control col-md-1" id="limit" name="limit">
	  					<option value="2" 
	  					<?php echo (!empty($_smarty_tpl->tpl_vars['get']->value['limit'])) && $_smarty_tpl->tpl_vars['get']->value['limit'] == 2 ? 'selected' : '';?>
>2</option>
	  					<option value="5"
	  					<?php echo (!empty($_smarty_tpl->tpl_vars['get']->value['limit'])) && $_smarty_tpl->tpl_vars['get']->value['limit'] == 5 ? 'selected' : '';?>
>5</option>
	  					<option value="10"
	  					<?php echo (!empty($_smarty_tpl->tpl_vars['get']->value['limit'])) && $_smarty_tpl->tpl_vars['get']->value['limit'] == 10 ? 'selected' : '';?>
>10</option>
	  					<option value="20"
	  					<?php echo (!empty($_smarty_tpl->tpl_vars['get']->value['limit'])) && $_smarty_tpl->tpl_vars['get']->value['limit'] == 20 ? 'selected' : '';?>
>20</option>
	  				</select>
	  				<input type="hidden" name="page" id="page">
				</form>

			</div>
			<div class="col-md-12 mb-3">
			</div>
			<div class="col-md-12">
				<div id="tb_loader">
					<div id="td">
						<?php if (sizeof($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
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
							    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
							      <tr>
							        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
							        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
							        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['parent_category'];?>
</td>
							        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['sub_category'];?>
</td>
							        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['current_price'];?>
</td>
							        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['cost'];?>
</td>
							        <td>
							        	<button class="btn btn-outline-primary" onclick="window.location.href='./index.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
'">
							        		Edit
							        	</button>
							        	<button class="btn btn-outline-danger delete" item_id="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
							        		Delete
							        	</button>
							        </td>
							      </tr>
							    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							    </tbody>
			  				</table>
		  				<?php }?>
						<nav aria-label="Page navigation example">
						  <ul class="pagination">
						  	<?php if ($_smarty_tpl->tpl_vars['pageCount']->value != 1 && $_smarty_tpl->tpl_vars['pageCount']->value != 0) {?>
						    <li class="page-item <?php echo (!empty($_smarty_tpl->tpl_vars['get']->value['page'])) && $_smarty_tpl->tpl_vars['get']->value['page'] == 1 ? 'disabled' : '';?>
"
						    p="<?php echo $_smarty_tpl->tpl_vars['get']->value['page']-1;?>
">
						      <a class="page-link" href="#" aria-label="Previous">
						        <span aria-hidden="true">&laquo;</span>
						        <span class="sr-only">Previous</span>
						      </a>
						    </li>
						    <?php }?>
						    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['pageCount']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['pageCount']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
							    <li class="page-item <?php echo (!empty($_smarty_tpl->tpl_vars['get']->value['page'])) && $_smarty_tpl->tpl_vars['get']->value['page'] == $_smarty_tpl->tpl_vars['i']->value ? 'active' : '';?>
" p='<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
'><a class="page-link" href="#"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a></li>
							<?php }
}
?>
							<?php if ($_smarty_tpl->tpl_vars['pageCount']->value != 1 && $_smarty_tpl->tpl_vars['pageCount']->value != 0) {?>
						    <li class="page-item <?php echo (!empty($_smarty_tpl->tpl_vars['get']->value['page'])) && $_smarty_tpl->tpl_vars['get']->value['page'] == $_smarty_tpl->tpl_vars['pageCount']->value ? 'disabled' : '';?>
"  p="<?php echo $_smarty_tpl->tpl_vars['get']->value['page']+1;?>
">
						      <a class="page-link" href="#" aria-label="Next">
						        <span aria-hidden="true">&raquo;</span>
						        <span class="sr-only">Next</span>
						      </a>
						    </li>
						    <?php }?>
						  </ul>
						</nav>
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
								    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parent_category']->value, 'pc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pc']->value) {
?>
    									<option value="<?php echo $_smarty_tpl->tpl_vars['pc']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
</option>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
</html><?php }
}
