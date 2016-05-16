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
                $this->registry->template->message = 'Inscription effectuée';
                $this->registry->template->show('successful');
            }else $this->registry->template->show('index');
        }else $this->registry->template->show('index');
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
                                $PHPMailer = new MyMail();
                                $PHPMailer->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
                                $PHPMailer->addReplyTo(EMAIL_REPLY, EMAIL_REPLY_NAME);                               
                                $PHPMailer->addAddress($email);
                                $PHPMailer->isHTML(true);
                                $PHPMailer->Subject = 'Inscription sur '.APP_TITLE;
                                $PHPMailer->CharSet = 'UTF-8';
                                $PHPMailer->Body= '
                                    <p>Bonjour,</p>
                                    <div>
                                        <p>Vous vous êtes inscris sur notre site et nous vous remercions.</p>
                                        <p>Pour confirmer votre inscription, veuillez <a href="'.BASE_URL.'signup/validation/'.md5($email).'/'.md5($this->registry->db->hashPwd($password)).'">cliquer sur ce lien</a>.</p>
                                        <p>A bientôt sur '.APP_TITLE.'</p>
                                    </div>
                                ';
                                if(!$PHPMailer->send()){
                                    throw new Exception("Le mail de confirmation n\'a pas pu être envoyé mais l\'inscription est confirmée");
                                }
                            }else throw new Exception('Erreur lors de la creation de votre compte');
                        }else throw new Exception('Email déjà existant');
                    }else throw new Exception('La confirmation de mot de passe est fausse');
                }else throw new Exception('Email invalide');
            }else throw new Exception('Date de naissance invalide');
        }else throw new Exception('Erreur de formulaire');
    }

    public function validation($args){
        if(isset($args[0]) && isset($args[1])){
            if($this->registry->db->confirmEmail($args[0], $args[1])){
                $this->registry->template->show('validation');
            }else $this->registry->template->show('404', true);
        }else $this->registry->template->show('404', true);
    }
}
?>