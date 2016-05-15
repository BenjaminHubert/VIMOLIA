<?php
class loginController extends baseController {

    public function index(){
//        if(isset($_POST['submit'])){
//            var_dump($_POST);
//            if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['submit'])){
//                $email = $_POST['email'];
//                $password = $_POST['password'];
//                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
//                    if(strlen($password) == 0){
//                        
//                    }
//                }else $error = 'Email non valide';
//            }else $error = 'Formulaire incomplet';
//        }
        
        $this->registry->template->show('index');
    }
}
?>