<?php
class videoController extends baseController {

    public function index(){
        // Liste des vidéos
        $this->registry->template->listVideo = $this->registry->db->getListVideo();
        $this->registry->template->show('index');
    }

    public function add(){
        // Ajouter une vidéo
        $postExpected = ['title', 'url', 'id_category', 'id_thematic', 'submit'];
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

    }

    public function delete($args){

    }
}
?>