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
    	$subscription_types = $this->registry->db->getSubscriptionTypes();
    	$user_subscriptions = $this->registry->db->getSubscriptionByUser($_SESSION['id']);
    	
    	$this->registry->template->subscription_types = $subscription_types;
    	$this->registry->template->user_subscriptions = $user_subscriptions;
    	$this->registry->template->show('index');
    }
    
    public function add(){

    	$this->registry->template->show('add');
    }
}
?>