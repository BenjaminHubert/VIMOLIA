<?php
class pageController extends baseController {
	protected $registry;
	public function __construct($registry){
		// default behavior
		parent::__construct($registry);
		// check rights
		if(!in_array($_SESSION['role'], [
			'Administrateur',
			'Auteur'
		])){
			$registry->template->show('403', true);
			die();
		}
	}
    public function index(){
        // Liste des pages
        $this->registry->template->listPage = $this->registry->db->getListPage();
        $this->registry->template->show('index');
    }

    public function add($args){   
        // Ajouter une page
        $postExpected = ['title', 'content', 'date_publish', 'date_publish_submit', 'hour_publish', 'minute_publish', 'submit'];
        if($postExpected == array_keys($_POST)){
            $_POST['date_publish'] = date('Y-m-d H:i:s', strtotime($_POST['date_publish_submit']."+".$_POST['hour_publish']." hours +".$_POST['minute_publish']." minutes"));
            $_POST['id_user'] = $_SESSION['id'];
            foreach($postExpected as $var){
                $$var = $_POST[$var];
            }
            $this->registry->db->addPage($_POST);
            header('Location:'.$this->registry->config['base_url'].'/admin/page');
        }
        else $this->registry->template->show('add');
    }

    public function edit($args){
        if(isset($args[0]) && is_numeric($args[0])){
            if(!empty($page = $this->registry->db->getPageById($args[0]))){
                $this->registry->template->page = $page;

                // Modifier une page
                $postExpected = ['title', 'content', 'date_publish', 'date_publish_submit', 'hour_publish', 'minute_publish', 'submit'];
                
                if($postExpected == array_keys($_POST)){
                    
                    $_POST['date_publish'] = date('Y-m-d H:i:s', strtotime($_POST['date_publish_submit']."+".$_POST['hour_publish']." hours +".$_POST['minute_publish']." minutes"));
                    $_POST['id_user'] = $_SESSION['id'];

                    foreach($postExpected as $var){
                        $$var = $_POST[$var];
                    }

                    $this->registry->db->editPage($_POST, $args[0]);
                    header('Location:'.$this->registry->config['base_url'].'/admin/page');
                }else $this->registry->template->show('edit');
            }else $this->registry->template->show('404', true);
        }else $this->registry->template->show('404', true);
    }
    
    public function delete($args){
        if(isset($args[0]) && is_numeric($args[0])){
            echo json_encode($this->registry->db->deletePage($args[0]));
        }else $this->registry->template->show('404', true);
    }
}
?>