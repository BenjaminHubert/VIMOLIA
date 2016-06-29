<?php
class monAbonnementController extends baseController {
	protected $registry;
	public function __construct($registry){
		// default behavior
		parent::__construct($registry);
		// check rights
		if(!in_array($_SESSION['role'], [
			'Praticien'
		])){
			$registry->template->show('403', true);
			die();
		}
	}
    public function index(){
    	
    	
    	$this->registry->template->show('index');
    }
}
?>