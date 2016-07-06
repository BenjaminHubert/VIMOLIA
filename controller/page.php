<?php
class pageController extends baseController {
    public function index(){
        $this->registry->template->listPage = $this->registry->db->getListPage();
        $this->registry->template->show('index');
    }
    
    public function display($args){
        if(isset($args[0]) && is_numeric($args[0])){
			$page = $this->registry->db->getPageById($args[0]);
			if($page){
				$this->registry->template->page = $page;
				$this->registry->template->show('display');
			}else{
				$this->registry->template->show('404', true);
			}
		}else{
			$this->registry->template->show('404', true);
		}
    }
}