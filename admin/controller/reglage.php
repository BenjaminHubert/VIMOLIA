<?php
class reglageController extends baseController {

    public function index(){        
        $this->registry->template->show('index');
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
                    }else $this->registry->template->show('not_found');
                    break;
                case 'delete':
                    if(isset($args[1]) && is_numeric($args[1])){
                        $this->deleteVideoCategory($args[1]);
                    }else $this->registry->template->show('not_found');
                    break;
                case 'list':
                    $this->listVideoCategory();
                    break;
                default:
                    break;
            }
        }else $this->registry->template->show('not_found');
    }
    
    private function createVideoCategory(){
        $this->registry->db->addVideoCategory($_POST['category']);
    }
    
    private function editVideoCategory($id){
        
    }
    
    private function deleteVideoCategory($id){
        
    }
    
    private function listVideoCategory(){
        $this->registry->template->listCategory = $this->registry->db->listVideoCategory();
        $this->registry->template->show('vcategories_list');
    }
}
?>