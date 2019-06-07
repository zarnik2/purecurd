<?php
	require_once("Base/Model.php");

	class Item extends Model{

	    public function __construct() 
	    { 
	        parent::__construct();
	    }
	    public function save($param){
	    	$res = true;

	    	$input_name = trim($param["item_name"]);
		    if(empty($input_name)){
		        $res = false;
		    // } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
		    //     $res = false;
		    // }
		    } else{
		        $name = $input_name;
		    }
		   
		    $input_p_category = trim($param["parent_category"]);
		    if(empty($input_p_category)){
		        $res = false;     
		    } else{
		        $parent_category = $input_p_category;
		    }
		    
		    $input_sub_category = trim($param["sub_parent_category"]);
		    if(empty($input_sub_category)){
		        $res = false;     
		    } else{
		        $sub_category = $input_sub_category;
		    }

		    $input_current_price = trim($param["current_price"]);
		    if(empty($input_current_price)){
		        $res = false;     
		    } elseif(!ctype_digit($input_current_price)){
		        $res = false;
		    } else{
		        $current_price = $input_current_price;
		    }

		    $input_cost = trim($param["cost"]);
		    if(empty($input_cost)){
		        $res = false;     
		    } elseif(!ctype_digit($input_cost)){
		        $res = false;
		    } else{
		        $cost = $input_cost;
		    }
		     $input_d_type = trim($param["d_type"]);
		    if(empty($input_d_type)){
		        $res = false;     
		    } else{
		        $d_type = $input_d_type;
		    }
		      $input_d_amount = trim($param["d_amount"]);
		    if(empty($input_d_amount)){
		        $res = false;     
		    } elseif(!ctype_digit($input_d_amount)){
		        $res = false;
		    } else{
		        $d_amount = $input_d_amount;
		    }

		     $input_bar = trim($param["bar"]);
		    if(empty($input_bar)){
		        $res = false;     
		    } elseif(!ctype_digit($input_bar)){
		        $res = false;
		    } else{
		        $bar = $input_bar;
		    }

		    if($res!=false){
		    	if (array_key_exists("item_id",$param)){
		    		$id = $param['item_id'];
		    		$result = $this->updateData($id,$name,$parent_category,$sub_category,$current_price,$cost, $d_type,$d_amount,$bar);
			    	if($result){
			    	 	$res = true;
			    	 }else {
			    	 	$res = false;
			    	 }
			    	 return $res;

		    	}else{

		    	 $result = $this->saveData($name,$parent_category,$sub_category,$current_price,$cost, $d_type,$d_amount,$bar);
		    	 if($result){
		    	 	$res = true;
		    	 }else {
		    	 	$res = false;
		    	 }
		    	 return $res;

		    	}
		    	 
		    }
		    else{
		    	return $res;
		    }

	    }
	    public function saveData($n,$pc,$sc,$cp,$c,$dt,$d_amt,$bar){

	    	 $sql = "INSERT INTO item (name,p_category,s_category,current_price,cost,d_type,d_amount,barcode) VALUES ('$n','$pc','$sc',$cp,$c,'$dt',$d_amt,$bar)";
	    	 $stmt = $this->db->prepare($sql);
	    	 $insertQry = $stmt->execute();
	    	 return $insertQry;

	    }
	    public function updateData($id,$n,$pc,$sc,$cp,$c,$dt,$d_amt,$bar){
	    	 $sql = "UPDATE item SET name='$n',p_category='$pc',s_category='$sc',current_price=$cp,cost=$c,d_type='$dt',d_amount=$d_amt,barcode=$bar WHERE id=$id";
	    	 $stmt = $this->db->prepare($sql);
	    	 $updateQry = $stmt->execute();
	    	 return $updateQry;
	    }
	    public function all(){
	    	$sql = "SELECT * FROM item";
	       	$res = $this->runQuery($sql);
	    	return $res;
	    }
	    public function get_item_by_id($id){
	    	$sql = "SELECT * FROM item WHERE id='".$id."'";
	    	$res = $this->runQuery($sql);
	    	return $res;
	    }
	    public function get_parent_category(){
	    	$sql = "SELECT * FROM parent_category";
	       	$res = $this->runQuery($sql);
	    	return $res;
	    }
	    public function get_sub_category($id){
	    	$sql = "SELECT * FROM sub_category WHERE pid='".$id."'";
	    	$res = $this->runQuery($sql);
	    	return $res;
	    }

	    public function destroy($id){
	    	$sql = "DELETE FROM item WHERE id='".$id."'";
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute();
	    }


	    function runQuery($sql){
	    	$stmt = $this->db->prepare($sql);
	        $stmt->execute();
	        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        	return $row;
	    }

	    public function getItems($get){
	    	$sql = ' select * from item ';
	    	$totalSql = 'select count(*) from item';
	    	$where = "";
	    	// var_dump($get);
	    	if(!empty($get['category'])){
	    		$where .= $this->checkWhere($where). " p_category='".$get['category']."' ";
	    	}

	    	// sub
	    	if(!empty($get['sub_category'])){
	    	    $where .= $this->checkWhere($where). " s_category='".$get['sub_category']."' ";
	    	}
	    	// name
	    	if(!empty($get['name'])){
	    		 $where .= $this->checkWhere($where). " name LIKE '%".$get['name']."%' ";
	    	}
	    	// cost
	    	if(!empty($get['price'])){
	    		$where .= $this->checkWhere($where). " current_price LIKE '%".$get['price']."%' ";
	    	}
	    	// order by

	    	// limit
	    	$limitSql = "";
	    	if(!empty($get['page'])){
	    		$limit = $get['limit'];
	    		$offset = ($get['page'] - 1) * $limit;  // 6
	    		$limitSql = " limit ".$limit." offset ".$offset;
	    	}

	    	$sql = $sql.$where.$limitSql;
	    	$countSql = $totalSql.$where;

	    	// echo $sql;    // to return 2 query (total , normal)
	    	$items =  $this->runQuery($sql);
	    	$countItems = $this->runQuery($countSql);
	    	$data = ['items' => $items,'countItems' => $countItems];
	    	return $data;
	    }	    
	}
?>