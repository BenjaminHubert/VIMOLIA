<?php
Abstract Class baseController {

    protected $registry;

    function __construct($registry){
        $this->registry = $registry;
        if(!isset($_SESSION['id'])){
            header('Location: '.BASE_URL.'login');
            die();
        }
    }

    abstract function index();
}
