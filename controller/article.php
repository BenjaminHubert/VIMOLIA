<?php
class articleController extends baseController {
    public function index(){
        $this->registry->template->listArticle = $this->registry->db->getListArticle(true);
        $this->registry->template->show('index');
    }
    
    public function display($args){
        if(isset($args[0]) && is_numeric($args[0])){
			$article = $this->registry->db->getArticleById($args[0]);
			if($article){
				$this->registry->template->article = $article;
				$this->registry->template->show('display');
			}else{
				$this->registry->template->show('404', true);
			}
		}else{
			$this->registry->template->show('404', true);
		}
    }
}