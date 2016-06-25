<?php
Abstract Class baseController {

    protected $registry;

    function __construct($registry) {
        $this->registry = $registry;
        
        //REFRESH SESSION 
        if(isset($_SESSION['id'])){
        	$_SESSION = array_merge($_SESSION, $this->registry->db->getUser($_SESSION['id']));
        }
    }

    abstract function index();
}
