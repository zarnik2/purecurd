<?php
require_once("base/Controller.php");
require_once("model/itemModel.php");

class ItemController extends Controller{

	private $item;

    public function __construct()
    {
        parent::__construct();
        $this->item = new Item();
    }

    public function index($info){
          $get = $_GET;
    	  $parent_category = $this->item->getCategories($get);
    	  $item_data = $this->item->getItems($get);
    	  $count = sizeof($item_data);
    	  $limit = 3;
    	  $buttonCount = $count/$limit;
    	  $this->smarty->assign('parent_category',$parent_category);
    	  $this->smarty->assign('items',$item_data);
    	  $this->smarty->assign('count',$count);
    	  $this->smarty->assign('limit',$limit);
          if(!empty($info)){
            $this->smarty->assign($info['status'],$info['msg']);
          }
    	  $this->smarty->assign('buttonCount',$buttonCount);
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
        	// 	$parent_category = $item->get_parent_category();
        	// 	$item_data = $item->all();
        	// 	$this->smarty->assign('items',$item_data);
    	  		// $this->smarty->assign('parent_category',$parent_category);
    	  		// if(array_key_exists('item_id', $_POST)){
    	  		// 	$this->smarty->assign('success','Update Data Successful');
    	  		// }else{
    	  		// 	$this->smarty->assign('success','Insert Data Successful');
    	  		// }
	           
    	  		// $this->smarty->display('item.tpl');
                if(array_key_exists('item_id', $_POST)){
                    $info = ['status' =>'success','msg' => 'Update Data Successful'];
                } else {
                    $info = ['status' =>'success','msg' => 'Insert Data Successful'];
                }
                $this->index($info);
                // header("Location:index.php");
        	}else{
        	// 	$parent_category = $item->get_parent_category();
        	// 	$item_data = $item->get_item();
        	// 	$this->smarty->assign('items',$item_data);
    	  		// $this->smarty->assign('parent_category',$parent_category);
    	  		// if(array_key_exists('item_id', $_POST)){
    	  		// 	$this->smarty->assign('error','Something wrong with updating data');
    	  		// }else{
    	  		// 	$this->smarty->assign('error','Something wrong with inserting data');
    	  		// }

        	   if(array_key_exists('item_id', $_POST)){
                    $info = ['status' =>'error','msg' => 'Something wrong with inserting data'];
               } else {
                    $info = ['status' =>'error','msg' => 'Something wrong with updating data'];
               }
    	  		
                $this->index($info);
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
        if($id=="0" || $id==""){
            $id="NULL";
        }
        $get = [];
        $get['id'] =  $id;
		$data = $this->item->getItems($get);
        $item_data = $data['items'];
        // echo "<pre>";
        // var_dump($item_data);
        $parent_category_get = [];
		$parent_category = $this->item->getCategories($parent_category_get);
		if(sizeof($item_data)>0){
			$this->smarty->assign('items',$item_data);
		  	$this->smarty->assign('parent_category',$parent_category);
			$this->smarty->display('editItem.tpl');
		}else{
			echo "<h4 style='color:red'>404 not found!</h4>";
		}
    }

	public function getItems(){
		$get = $_GET;
		$data = $this->item->getItems($get);
		// $data = [];
		// $data['items'] = $items;
        // echo "<pre>";
		echo json_encode($data, JSON_PRETTY_PRINT);
		exit;
	}

}
