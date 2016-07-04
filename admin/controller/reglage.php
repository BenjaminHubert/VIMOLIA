<?php
class reglageController extends baseController {
	protected $registry;
	public function __construct($registry){
		// default behavior
		parent::__construct($registry);
		// check rights
		if(!in_array($_SESSION['role'], [
			'Administrateur',
		])){
			$registry->template->show('403', true);
			die();
		}
	}
    public function index(){
        $this->registry->template->subscriptionTypes = $this->registry->db->getSubscriptionTypes();
    	$this->registry->template->show('index');
    }
    
    public function updateColors(){
    	if(isset($_POST['updateColors'])){
    		foreach($_POST as $key => $value){
    			$this->registry->db->updateSetting($key, $value);
    		}
    		header('Location: '.BASE_URL_ADMIN.'reglage');
    		die();
    	}else{
			$registry->template->show('404', true);
			die();
		}
    }

    public function videoCategories($args){
        $expectedArgs = ['create', 'edit', 'delete', 'list'];

        if(isset($args[0]) && in_array($args[0], $expectedArgs)){
            switch($args[0]){
                case 'create':
                    $this->createVideoCategory();
                    break;
                case 'edit':
                    if(isset($args[1]) && is_numeric($args[1])){
                        $this->editVideoCategory($args[1]);
                    }else $this->registry->template->show('404', true);
                    break;
                case 'delete':
                    if(isset($args[1]) && is_numeric($args[1])){
                        $this->deleteVideoCategory($args[1]);
                    }else $this->registry->template->show('404', true);
                    break;
                case 'list':
                    $this->listVideoCategory();
                    break;
                default:
                    $this->registry->template->show('404', true);
                    break;
            }
        }else $this->registry->template->show('404', true);
    }
    
    private function createVideoCategory(){
        echo json_encode($this->registry->db->addVideoCategory($_POST['category']));
    }
    
    private function editVideoCategory($id){
        echo json_encode($this->registry->db->editVideoCategory($_POST['category'], $id));
    }
    
    private function deleteVideoCategory($id){
        echo json_encode($this->registry->db->deleteVideoCategory($id));
    }
    
    private function listVideoCategory(){
        $this->registry->template->listCategory = $this->registry->db->listVideoCategory();
        $this->registry->template->show('listVideoCategory');
    }
    
    
    public function videoThematics($args){
        $expectedArgs = ['create', 'edit', 'delete', 'list'];

        if(isset($args[0]) && in_array($args[0], $expectedArgs)){
            switch($args[0]){
                case 'create':
                    $this->createVideoThematic();
                    break;
                case 'edit':
                    if(isset($args[1]) && is_numeric($args[1])){
                        $this->editVideoThematic($args[1]);
                    }else $this->registry->template->show('404', true);
                    break;
                case 'delete':
                    if(isset($args[1]) && is_numeric($args[1])){
                        $this->deleteVideoThematic($args[1]);
                    }else $this->registry->template->show('404', true);
                    break;
                case 'list':
                    $this->listVideoThematic();
                    break;
                default:
                    $this->registry->template->show('404', true);
                    break;
            }
        }else $this->registry->template->show('404', true);
    }
    
    private function createVideoThematic(){
        echo json_encode($this->registry->db->addVideoThematic($_POST['thematic']));
    }
    
    private function editVideoThematic($id){
        echo json_encode($this->registry->db->editVideoThematic($_POST['thematic'], $id));
    }
    
    private function deleteVideoThematic($id){
        echo json_encode($this->registry->db->deleteVideoThematic($id));
    }
    
    private function listVideoThematic(){
        $this->registry->template->listThematic = $this->registry->db->listVideoThematic();
        $this->registry->template->show('listVideoThematic');
    }
    
    public function advanced(){
    	if(count($_POST) > 0){
    		showArray($_POST);
    		$content = "<?php\n";
    		foreach($_POST as $key => $val){
    			$content .= "DEFINE('".$key."', ".var_export($val, true).");\n";
    		}
    		$content .= "?>";
    		if(file_put_contents(__SITE_PATH.'/../conf/config.php', $content)){
    			header('Location: '.BASE_URL_ADMIN.'reglage/advanced');
    			die();
    		}
    	}    	
    	$this->registry->template->show('advanced');
    }
    
    public function subscription($args){
    	if(isset($args[0])){
	    	switch($args[0]){
	    		case 'add':
	    			$this->addSubscription($args);
	    			break;
	    		case 'edit':
	    			$this->editSubscription($args);
	    			break;
	    		case 'delete':
	    			$this->deleteSubscription($args);
	    			break;
	    		default:
	    			$this->registry->template->show('404', true);
	    			break;
	    	}
    	}else{
    		$this->registry->template->show('404', true);
    	}
    }
    
    private function addSubscription($args){
    	if(count($_POST) > 0){
    		showArray($_POST);
    		if(isset($_POST['name'], $_POST['description'], $_POST['amount'], $_POST['currencycode'], $_POST['duration_days'])){
    			if(is_numeric($_POST['amount']) && $_POST['amount'] > 0.01){
    				if(is_numeric($_POST['duration_days']) && $_POST['duration_days'] > 1 && !is_float($_POST['duration_days'])){
    					
    				}else $this->registry->template->error = "Le nombre de jours est incorrect";
    			}else $this->registry->template->error = "Le montant est incorrect";
    		}else $this->registry->template->error = "Erreur de formulaire";
    	}
    	$this->registry->template->show('addSubscription');
    }
    
    private function editSubscription($args){
    	
    }
    
    private function deleteSubscription($args){
    	
    }
}
?>