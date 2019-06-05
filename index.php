<?php
	require_once("controller/ItemController.php");

	$item = new ItemController();
	if(isset($_GET['action'])){
		$header = $_GET['action'];
	} else {
		$header="index";
	}
	

	switch($header){
		case "index":
			$item->index();
			break;
		case "showSubCategory":
			$item->showSubCategory();
			break;
		case "store":
			$item->create();
			break;
		case 'delete':
			$item->delete();
			break;
	    case 'edit' : 
	    	$item->edit();
	    	break;
	    case 'getItem':
	    	$item->getItemByFilter();
	}
?>
