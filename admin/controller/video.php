<?php
class videoController extends baseController {
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
        // Liste des vidéos
        $this->registry->template->listVideo = $this->registry->db->getListVideo();
        $this->registry->template->show('index');
    }

    public function add(){
        // Ajouter une vidéo
        $postExpected = ['title', 'url', 'description', 'id_category', 'id_thematic', 'submit'];
        if($postExpected == array_keys($_POST)){

            $url = '/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
            if(preg_match($url, $_POST['url'])){
                $_POST['id_user'] = $_SESSION['id'];
                foreach($postExpected as $var){
                    $$var = $_POST[$var];
                }
                $this->registry->db->addVideo($_POST);
                header('Location:'.$this->registry->config['base_url'].'/admin/video');
            }else {
                $this->registry->template->error = 'Veuillez fournir une URL Youtube valide';
                $this->registry->template->listCategory = $this->registry->db->listVideoCategory();
                $this->registry->template->listThematic = $this->registry->db->listVideoThematic();
                $this->registry->template->show('add');
            }
        }
        else {
            $this->registry->template->listCategory = $this->registry->db->listVideoCategory();
            $this->registry->template->listThematic = $this->registry->db->listVideoThematic();
            $this->registry->template->show('add');
        }
    }

    public function edit($args){
        if(isset($args[0]) && is_numeric($args[0])){
            if(!empty($video = $this->registry->db->getVideoById($args[0]))){
                $this->registry->template->video = $video;

                // Modifier une vidéo
                $postExpected = ['title', 'url', 'description', 'id_category', 'id_thematic', 'submit'];

                if($postExpected == array_keys($_POST)){

                    $url = '/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
                    if(preg_match($url, $_POST['url'])){
                        $_POST['id_user'] = $_SESSION['id'];

                        foreach($postExpected as $var){
                            $$var = $_POST[$var];
                        }

                        $this->registry->db->editVideo($_POST, $args[0]);
                        header('Location:'.$this->registry->config['base_url'].'/admin/video');
                    }else {
                        $this->registry->template->error = 'Veuillez fournir une URL Youtube valide';
                        $this->registry->template->listCategory = $this->registry->db->listVideoCategory();
                        $this->registry->template->listThematic = $this->registry->db->listVideoThematic();
                        $this->registry->template->show('edit');
                    }
                }else {
                    $this->registry->template->listCategory = $this->registry->db->listVideoCategory();
                    $this->registry->template->listThematic = $this->registry->db->listVideoThematic();
                    $this->registry->template->show('edit');
                }
            }else $this->registry->template->show('404', true);
        }else $this->registry->template->show('404', true);
    }

    public function delete($args){
        if(isset($args[0]) && is_numeric($args[0])){
            echo json_encode($this->registry->db->deleteVideo($args[0]));
        }else $this->registry->template->show('404', true);
    }
}
?>