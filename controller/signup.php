<?php
class signupController extends baseController {

    public function index(){
        if(isset($_POST['type']) && is_callable([$this, $_POST['type']])){
            $type = $_POST['type'];
            try{
                $this->$type();
            }catch(Exception $e){
                $this->registry->template->error = $e->getMessage();
            }

            if(!isset($e)){
                //inscription effectuée
                $this->registry->template->message = 'Inscription effectuée';
                //rediriger
                header('Location: '.BASE_URL.'login');
                die();
            }
        }
        $this->registry->template->show('index');
    }

    private function member(){        
        $postExpected = ['first_name', 'last_name', 'pseudo', 'birthday', 'birthday_submit', 'address', 'postal_code', 'city', 'phone', 'mobile', 'email', 'password', 'password_confirmation', 'submit', 'type'];
        if($postExpected == array_keys($_POST)){
            foreach($postExpected as $var){
                $$var = $_POST[$var];
            }
            //valid birthday
            $d = DateTime::createFromFormat('Y-m-d', $birthday_submit);
            if($d && $d->format('Y-m-d') === $birthday_submit ){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if($password == $password_confirmation){
                        if(!$this->registry->db->isUserMailExist($email)){
                            $_POST['pseudo'] = ($_POST['pseudo'] != '')?$_POST['pseudo']:null;
                            if($this->registry->db->addMember($_POST)){
                                //send mail
                                require __SITE_PATH.DIRECTORY_SEPARATOR.'php_libraries'.DIRECTORY_SEPARATOR.'PHPMailer-5.2.15'.DIRECTORY_SEPARATOR.'PHPMailerAutoload.php';
                                $PHPMailer = new PHPMailer;
                                $PHPMailer->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
                                $PHPMailer->addReplyTo(EMAIL_REPLY, EMAIL_REPLY_NAME);
                                $PHPMailer->addAddress($email);
                                $PHPMailer->isHTML(true);
                                $PHPMailer->Subject = 'Inscription sur '.APP_TITLE;
                                $PHPMailer->Body= '<p>Bonjour,</p><div>Vous vous êtes inscris sur notre site et nous vous remercions...</div>';
                                if(!$PHPMailer->send()){
                                    $this->registry->template->warning = "Le mail de confirmation n\'a pas pu être envoyé mais l\'inscription est confirmée";
                                }
                            }else throw new Exception('Erreur lors de la creation de votre compte');
                        }else throw new Exception('Email déjà existant');
                    }else throw new Exception('La confirmation de mot de passe est fausse');
                }else throw new Exception('Email invalide');
            }else throw new Exception('Date de naissance invalide');
        }else throw new Exception('Erreur de formulaire');
    }
}
?>