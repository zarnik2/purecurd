<?php
require_once("../smarty/libs/Smarty.class.php");

class Controller{
	
	protected $smarty;

    public function __construct()
    {
        define("PROGRAM_NAME","POS");
		$this->smarty = new Smarty();
		$this->smarty->template_dir = "view/";
		$this->smarty->compile_dir = "templates_c/";
    }
}
?>