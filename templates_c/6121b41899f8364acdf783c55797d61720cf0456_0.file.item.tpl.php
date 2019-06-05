<?php
/* Smarty version 3.1.33, created on 2019-06-04 20:11:03
  from 'C:\xampp\htdocs\pureCRUD\view\item.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cf6b437f05087_61665943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6121b41899f8364acdf783c55797d61720cf0456' => 
    array (
      0 => 'C:\\xampp\\htdocs\\pureCRUD\\view\\item.tpl',
      1 => 1559671861,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cf6b437f05087_61665943 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<head>
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
 src="./public/js/searchFilter.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"><?php echo '</script'; ?>
>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Simple POS</title>
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
			<?php if (sizeof($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
			<div class="col-md-12 ">
				<form class="form-inline">
					<input type="text" class="form-control col-md-2 mr-2" placeholder="name" id="search_name">
					<input type="text" class="form-control col-md-2 mr-2" placeholder="price" id="price">
					<select class="form-control col-md-2 mr-2" id="f_parent_category" 
					name="f_parent_category">
				    	<option value="">All category</option>
					    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parent_category']->value, 'pc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pc']->value) {
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
" myid="<?php echo $_smarty_tpl->tpl_vars['pc']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
</option>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	  				</select>
	  				<select class="form-control col-md-2" id="f_sub_category" 
					name="f_sub_category" style="display:none;">
	  				</select>
				</form>
			</div>
			<?php }?>
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
							        <td class="pc"><?php echo $_smarty_tpl->tpl_vars['item']->value['p_category'];?>
</td>
							        <td class="sc"><?php echo $_smarty_tpl->tpl_vars['item']->value['s_category'];?>
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
		  				<?php if (sizeof($_smarty_tpl->tpl_vars['items']->value) == 0) {?>
							<center>
								<h3 class="text-info" style="font-size:16px;opacity:0.8"> No item recorded yet ...</h3>
							</center>
						<?php }?>
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
    									<option value="<?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
" myid="<?php echo $_smarty_tpl->tpl_vars['pc']->value['id'];?>
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
