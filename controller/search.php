<?php
class searchController extends baseController {

    public function index(){        
        header('Location: '.BASE_URL.'search/praticien');
        die();
    }

    public function praticien(){
        $doctors = $this->registry->db->getAllDoctors();
        $skills = $this->registry->db->getSkills();
        
        
        if(isset($_GET['skill']) && strtolower($_GET['skill']) != 'all'){
            if(in_array(strtolower($_GET['skill']), array_map('strtolower', $skills))){
                foreach($doctors as $key => $doctor){
                    if(!in_array(strtolower($_GET['skill']), array_map('strtolower', $doctor['skills']))){
                        unset($doctors[$key]);
                    }
                }
            }else $doctors = [];
        }
        
        $this->registry->template->doctors = $doctors;
        $this->registry->template->skills = $skills;
        $this->registry->template->show('praticien');
    }
}
?>