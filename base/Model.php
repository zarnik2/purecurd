<?php
require_once('config/connect.php');

class Model{
	protected $db;
	protected $dbName;
    public function __construct()
    {
		$this->dbName ="pos";
    	$this->db = $this->dbName;
		msi_db_getConnect($this->db);
	}

	public function checkWhere($where){
		return (strpos($where, 'WHERE'))? ' AND ' : ' WHERE ';
	}
}

?>