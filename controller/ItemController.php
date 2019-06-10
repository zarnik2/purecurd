<?php
	require_once("base/Controller.php");
	require_once("model/itemModel.php");

	class ItemController extends Controller{

	    public function __construct()
	    {
	        parent::__construct();
	    }

	    public function index(){
	    	  $item = new Item();
        	  $parent_category = $item->get_parent_category();
        	  $item_data = $item->get_item();
              $count = sizeof($item_data);
              $this->smarty->assign('count',$count);
        	  $this->smarty->assign('parent_category',$parent_category);
        	  $this->smarty->assign('items',$item_data);
	    	  $this->smarty->display('item.tpl');
	    }

	     public function getCategories(){
        
              // $get = json_decode(file_get_contents("php://input"),true);
              $get = $_GET;
              $categories  = $this->item->getCategories($get);
              $response = json_encode($categories,JSON_PRETTY_PRINT);
              echo $response;
              exit();

        }

	    public function create(){
	    	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    		$item = new Item();
	        	$result = $item->save($_POST); 
	        	if($result==true){
	        		$parent_category = $item->get_parent_category();
	        		$item_data = $item->get_item();
	        		$this->smarty->assign('items',$item_data);
        	  		$this->smarty->assign('parent_category',$parent_category);
        	  		if(array_key_exists('item_id', $_POST)){
        	  			$this->smarty->assign('success','Update Data Successful');
        	  		}else{
        	  			$this->smarty->assign('success','Insert Data Successful');
        	  		}
		           
	    	  		$this->smarty->display('item.tpl');
	        	}else{
	        		$parent_category = $item->get_parent_category();
	        		$item_data = $item->get_item();
	        		$this->smarty->assign('items',$item_data);
        	  		$this->smarty->assign('parent_category',$parent_category);
        	  		if(array_key_exists('item_id', $_POST)){
        	  			$this->smarty->assign('error','Something wrong with updating data');
        	  		}else{
        	  			$this->smarty->assign('error','Something wrong with inserting data');
        	  		}
	        	
	    	  		$this->smarty->display('item.tpl');
	        	}   
	    	} else {
	    		echo "<h4 style='color:red'>404 not found!</h4>";
	    	}     
	    }

	    public function delete(){
	    	  $get = json_decode(file_get_contents("php://input"),true);
	    	  $id = $get['id'];
	          $item = new Item();
	          $item->destroy($id);
	          $msg = ['info' => 'Item deleted successfully'];
	          $response = json_encode($msg);
	          echo $response;
	          exit;
	    }

	    public function edit(){
    		$id = htmlspecialchars($_GET['id']);
    		$item = new Item();
    		$item_data = $item->get_item_by_id($id);
    		$parent_category = $item->get_parent_category();
    		if(sizeof($item_data)>0){
    			$this->smarty->assign('items',$item_data);
    		  	$this->smarty->assign('parent_category',$parent_category);
    			$this->smarty->display('editItem.tpl');
    		}else{
    			echo "<h4 style='color:red'>404 not found!</h4>";
    		}
	    }
	}

?>