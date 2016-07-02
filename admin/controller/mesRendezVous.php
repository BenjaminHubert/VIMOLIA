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
    	$appointments = $this->registry->db->getAllAppointmentsByIdUser($_SESSION['id'], $_SESSION['role']);
    	$this->registry->template->appointments = $appointments;
    	$this->registry->template->show('doctor');
    }
    
    // AJAX
    public function cancel(){
    	$json = [];
    	if(isset($_POST['id_appointment']) && is_numeric($_POST['id_appointment'])){
    		$appointment = $this->registry->db->getAppointment($_POST['id_appointment']);
    		if($appointment){
    			$json['appointment'] = $appointment;
    			if($appointment['id_member'] == $_SESSION['id']){
	    			if($appointment['is_canceled'] == 0){
	    				if($appointment['is_validated'] == 0){
	    					$appointment['is_canceled'] = 1;
	    					if($this->registry->db->updateAppointment($appointment)){
	    						// GOOD
	    					}else{
		    					$json['error'] = 'Un problème est survenu alors de l\'annulation du rendez vous';
			    			}
	    				}else{
	    					$json['error'] = 'Ce rendez vous a déjà été effectué';
	    				}
	    			}else{
						$json['error'] = 'Ce rendez vous est déjà annulé';
					}
    			}else{
					$json['error'] = 'Ceci rendez vous n\'est pas le votre';
				}
    		}else{
				$json['error'] = 'Aucun rendez vous trouvé';
			}
    	}else{
			$json['error'] = 'Parameter missing';
		}
		
		echo json_encode($json);
    }
    
    // AJAX
    public function valid(){
    	$json = [];
    	if(isset($_POST['id_appointment']) && is_numeric($_POST['id_appointment'])){
    		$appointment = $this->registry->db->getAppointment($_POST['id_appointment']);
    		$json['$_POST'] = $_POST;
    		$json['$appointment'] = $appointment;
    		if($appointment){
    			$json['appointment'] = $appointment;
    			if($appointment['id_doctor'] == $_SESSION['id'] ){
	    			if($appointment['is_canceled'] == 0){
	    				if($appointment['is_validated'] == 0){
	    					$appointment['is_validated'] = 1;
	    					if($this->registry->db->updateAppointment($appointment)){
	    						// GOOD
	    					}else{
		    					$json['error'] = 'Un problème est survenu alors de la validation du rendez vous';
			    			}
	    				}else{
	    					$json['error'] = 'Ce rendez vous a déjà été effectué';
	    				}
	    			}else{
						$json['error'] = 'Ce rendez vous est déjà annulé';
					}
    			}else{
					$json['error'] = 'Ceci rendez vous n\'est pas le votre';
				}
    		}else{
				$json['error'] = 'Aucun rendez vous trouvé';
			}
    	}else{
			$json['error'] = 'Parameter missing';
		}
		
		echo json_encode($json);
    }
    
    // AJAX
    public function rate(){
    	$json = [];
    	if(isset($_POST['id_appointment'], $_POST['rate'], $_POST['comment']) && is_numeric($_POST['id_appointment'])&& is_numeric($_POST['rate'])){
    		if($_POST['rate'] <= 5 && $_POST['rate'] >= 1){
	    		$appointment = $this->registry->db->getAppointment($_POST['id_appointment']);
	    		if($appointment){
	    			$json['appointment'] = $appointment;
	    			if($appointment['id_member'] == $_SESSION['id']){
	    				if($appointment['is_canceled'] == 0){
	    					if($appointment['is_validated'] == 1){
	    						$appointment['rating'] = $_POST['rate'];
	    						$appointment['recommendation'] = $_POST['comment'];
	    						if($this->registry->db->updateAppointment($appointment)){
	    							// GOOD
	    						}else{
	    							$json['error'] = 'Un problème est survenu alors de l\'annulation du rendez vous';
	    						}
	    					}else{
	    						$json['error'] = 'Ce rendez vous a déjà été effectué';
	    					}
	    				}else{
	    					$json['error'] = 'Ce rendez vous est déjà annulé';
	    				}
	    			}else{
	    				$json['error'] = 'Ceci rendez vous n\'est pas le votre';
	    			}
	    		}else{
	    			$json['error'] = 'Aucun rendez vous trouvé';
	    		}
    		}else{
    			$json['error'] = 'La note doit être entre 1 et 5';
    		}
    	}else{
    		$json['error'] = 'Parameter missing';
    	}
    
    	echo json_encode($json);
    }
}
?>