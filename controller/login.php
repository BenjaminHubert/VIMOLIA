<?php
class loginController extends baseController {

    public function index(){
        if(isset($_POST['submit'])){
            if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['submit'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if(($userData = $this->registry->db->login($email, $password)) !== false){
                        $_SESSION = array_merge($_SESSION, $userData);
                    }else $this->registry->template->error = 'Email ou mot de passe incorrect';
                }else $this->registry->template->error = 'Email non valide';
            }else $this->registry->template->error = 'Formulaire incomplet';
        }
        
        $this->registry->template->show('index');
    }
    
    public function logout(){
        session_destroy();
        unset($_SESSION);
        header('Location: '.BASE_URL);
        die();
    }
}
?>