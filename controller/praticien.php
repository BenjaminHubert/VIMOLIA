<?php
class praticienController extends baseController {

    public function index(){        
        $this->registry->template->show('404', true);
    }

    public function profile($args){
        if(isset($args[0]) && is_numeric($args[0])){

            $doctor = $this->registry->db->getDoctorById($args[0]);
            if($doctor && $doctor != ['skills' => []]){
                $this->registry->template->doctor = $doctor;
                $this->registry->template->show('profile');
            }else $this->registry->template->show('404', true);
        }else $this->registry->template->show('404', true);
    }

}
?>