<?php
class articleController extends baseController {

    public function index(){
        // Liste des articles
        $this->registry->template->listArticle = $this->registry->db->getListArticle();
        $this->registry->template->show('index');
    }
    
    public function add($args){   
        // Ajouter un article
        if(isset($_POST['submit']) && $_POST['submit'] == 'create'){
            
            $this->registry->db->addArticle($article);
            $this->registry->template->show('index');
        }
        $this->registry->template->show('add');
    }
    
    public function edit($args){
        // Modifier un article
        if(isset($_POST['submit']) && $_POST['submit'] == 'update'){
            
            $this->registry->db->editArticle($article);
            $this->registry->template->show('index');
        }

        // Affichage par défaut
        if(isset($args[0]) && is_numeric($args[0])){
            if(!empty($article = $this->registry->db->getArticleById($args[0]))){
                $this->registry->template->article = $article;
                $this->registry->template->show('article/edit');
            }else $this->registry->template->show('not_found');
        }else $this->registry->template->show('not_found');
    }
}
?>