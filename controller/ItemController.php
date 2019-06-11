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
              $get = $_GET;
        	  $parent_category = $item->getCategories($get);
              if(!empty($get['category'])){
                $get['parentid'] = $get['category'];
                $sub_category = $item->getCategories($get);
                $this->smarty->assign('sub_category',$sub_category);

              }
              if(empty($get['limit'])){
                $get['limit'] = 2;
              }
               if(empty($get['page'])){
                $get['page'] = 1;
              }
        	  $item_data = $item->getItems($get);
              $count = $item_data['countItems'];
              $total = array_values($count[0]);
              $total = (int)$total[0];
              $limit = $get['limit'];
              $pageCount = ceil($total/$limit);
              $this->smarty->assign('pageCount',$pageCount);
              $this->smarty->assign('total',$total);
              $this->smarty->assign('limit',$limit);
              $this->smarty->assign('currentPage',$get['page']);
              $this->smarty->assign('get',$get);
        	  $this->smarty->assign('parent_category',$parent_category);
        	  $this->smarty->assign('items',$item_data['items']);
        	  $this->smarty->display('item.tpl');
	    }

	     public function getCategories(){
        
              // $get = json_decode(file_get_contents("php://input"),true);
              $get = $_GET;
              $item = new Item();
              $categories  = $item->getCategories($get);
              $response = json_encode($categories,JSON_PRETTY_PRINT);
              echo $response;
              exit();

        }

	    public function create(){
	    	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    		$item = new Item();
	        	$result = $item->save($_POST); 
                $parent_category = $item->getCategories($_GET);
                $item_data = $item->getItems($_GET);
                $count = sizeof($item_data['items']);
                $this->smarty->assign('items',$item_data['items']);
                $this->smarty->assign('parent_category',$parent_category);
                $this->smarty->assign('count',$count);

	        	if($result==true){
        	  		if(array_key_exists('item_id', $_POST)){
        	  			$this->smarty->assign('success','Update Data Successful');
        	  		}else{
        	  			$this->smarty->assign('success','Insert Data Successful');
        	  		}
		           
	        	}else{
        	  		if(array_key_exists('item_id', $_POST)){
        	  			$this->smarty->assign('error','Something wrong with updating data');
        	  		}else{
        	  			$this->smarty->assign('error','Something wrong with inserting data');
        	  		}
	        	}

                $this->smarty->display('item.tpl');   
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
            $get = $_GET;
    		$item = new Item();
    		$item_data = $item->getItems($get);
    		$parent_category = $item->getCategories($get);
    		if(sizeof($item_data['items'])>0){
    			$this->smarty->assign('items',$item_data['items']);
    		  	$this->smarty->assign('parent_category',$parent_category);
    			$this->smarty->display('editItem.tpl');
    		}else{
    			echo "<h4 style='color:red'>404 not found!</h4>";
    		}
	    }
	}

?>