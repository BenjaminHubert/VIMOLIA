<?php
class mesRendezVousController extends baseController {
	protected $registry;
	public function __construct($registry){
		// default behavior
		parent::__construct($registry);
		// check rights
		if(!in_array($_SESSION['role'], [
			'Membre',
			'Praticien',
		])){
			$registry->template->show('403', true);
			die();
		}
	}
    public function index(){
    	switch($_SESSION['role']){
    		case 'Membre':
    			$this->member();
    			break;
    		case 'Praticien':
    			$this->doctor();
    			break;
    	}
    }
    
    private function member(){
    	$appointments = $this->registry->db->getAllAppointmentsByIdUser($_SESSION['id'], $_SESSION['role']);
    	
    	$this->registry->template->appointments = $appointments;
    	$this->registry->template->show('member');
    }
    
    private function doctor(){

    	
    	$this->registry->template->show('doctor');
    }
}
?>