<?php
	require_once("controller/ItemController.php");

	$item = new ItemController();
	if(isset($_GET['action'])){
		$header = $_GET['action'];
	} else {
		$header="index";
	}
	$status="";

	switch($header){
		case "index":
			$item->index($status);
			break;
		case "getcategories":
			$item->getCategories();
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
	    case 'startUpGetItem':
	    	$item->getStartUpItem();


	   	case 'getitems':
			$item->getItems();	
		default :
			echo '404';   	
	}
?>
