<?php
/* Smarty version 3.1.33, created on 2019-06-04 10:21:44
  from 'C:\xampp\htdocs\POS\view\editItem.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cf62a18c10691_01624002',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd10b1a3d487f31e346a52789f1de70ff126f962f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\POS\\view\\editItem.tpl',
      1 => 1559635542,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cf62a18c10691_01624002 (Smarty_Internal_Template $_smarty_tpl) {
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
	<div class="container border p-3 mt-3">
		<div class="row">
			<div class="col-md-12 text-danger">
				<h3>Items Edit</h3>
				<hr>
			</div>
			<div class="col-md-12">
				<form method="POST" action="./index.php?action=store">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
						<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" name="item_id">
					  <div class="form-group">
					    <label for="item_name">Item Name : </label>
					    <input type="text" class="form-control col-md-5" id="item_name" name="item_name" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
">
					  </div>
					  <div class="form-group">
					    <label for="parent_category">Parent_category :</label>
						    <select class="form-control col-md-5" id="parent_category" name="parent_category">
						    	<option value=""></option>
							    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parent_category']->value, 'pc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pc']->value) {
?>
							    	<?php if ($_smarty_tpl->tpl_vars['pc']->value['name'] == $_smarty_tpl->tpl_vars['item']->value['p_category']) {?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
" myid="<?php echo $_smarty_tpl->tpl_vars['pc']->value['id'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
</option>
									<?php } else { ?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
" myid="<?php echo $_smarty_tpl->tpl_vars['pc']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['pc']->value['name'];?>
</option>
									<?php }?>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							</select>
					  </div>
					  <div class="form-group">
					    <label for="sub_parent_category"> Sub Parent_category :</label>
						    <select class="form-control col-md-5" id="sub_parent_category" name="sub_parent_category" sub_category="<?php echo $_smarty_tpl->tpl_vars['item']->value['s_category'];?>
">
						    	<option value=""></option>
							</select>
					  </div>
					   <div class="form-group">
					    <label for="current_price"> Item Current Price :</label>
					    <input type="number" class="form-control col-md-5" id="current_price" name="current_price" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['current_price'];?>
">
					  </div>
					   <div class="form-group">
					    <label for="cost">Item cost:</label>
					    <input type="number" class="form-control col-md-5" id="cost" name="cost"
					    value="<?php echo $_smarty_tpl->tpl_vars['item']->value['cost'];?>
">
					  </div>
					   <div class="form-group">
					    <label for="d_type">Discount Type :</label>
						    <select class="form-control col-md-5" id="d_type" name="d_type">
						    	<?php if ($_smarty_tpl->tpl_vars['item']->value['d_type'] == '%') {?>
						    	<option value="%" selected="selected">%</option>
						    	<?php } else { ?>
						    	<option value="%">%</option>
						    	<?php }?>
						    	<?php if ($_smarty_tpl->tpl_vars['item']->value['d_type'] == '$') {?>
						    	<option value="$" selected="selected">$</option>
						    	<?php } else { ?>
						    	<option value="$">$</option>
						    	<?php }?>
							</select>
					  </div>
					   <div class="form-group">
					    <label for="d_amount">Discount amount:</label>
					    <input type="number" class="form-control col-md-5" id="d_amount" name="d_amount" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['d_amount'];?>
">
					  </div>
					   <div class="form-group">
					    <label for="bar">Barcode:</label>
					    <input type="number" class="form-control col-md-5" id="bar" name="bar" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['barcode'];?>
">
					  </div>
					   <div class="form-group">
					      <button class="btn btn-primary" type="submit"> Update </button>
					      <butoon class="btn btn-light" onclick="window.location.href='index.php'">Cancel</butoon>
					  </div>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</form>
			</div>
		</div>
	</div>
</body>
</html><?php }
}
