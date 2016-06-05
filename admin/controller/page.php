<?php
class pageController extends baseController {

    public function index(){
        // Liste des pages
        $this->registry->template->listPage = $this->registry->db->getListPage();
        $this->registry->template->show('index');
    }
    
    public function add($args){   
        // Ajouter une page
        if(isset($_POST['submit']) && $_POST['submit'] == 'create'){
            
            $this->registry->db->addPage($page);
            $this->registry->template->show('index');
        }
        $this->registry->template->show('add');
    }
    
    public function edit($args){
        // Modifier une page
        if(isset($_POST['submit']) && $_POST['submit'] == 'update'){
            
            $this->registry->db->editPage($page);
            $this->registry->template->show('index');
        }

        // Affichage par défaut
        if(isset($args[0]) && is_numeric($args[0])){
            if(!empty($page = $this->registry->db->getPageById($args[0]))){
                $this->registry->template->page = $page;
                $this->registry->template->show('page/edit');
            }else $this->registry->template->show('not_found');
        }else $this->registry->template->show('not_found');
    }
}
?>