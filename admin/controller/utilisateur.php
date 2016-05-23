<?php
class utilisateurController extends baseController {
    protected $registry;

    public function __construct($registry){
        //default behavior
        parent::__construct($registry);
        //check rights
        if(!in_array($_SESSION['role'], ['Administrateur'])){
            $registry->template->show('403', true);
            die();
        }
    }

    public function index(){
        header('Location: '.BASE_URL_ADMIN.'utilisateur/list');
    }

    public function list(){
        $users = $this->registry->db->getAllUsers();
        $this->registry->template->users = $users;
        $this->registry->template->show('list');
    }

    public function add(){
        showArray($_POST);

        if(isset($_POST['submit'])){

            if(isset($_POST['role'])){
                if(isset($_POST['send_mail'])){
                    $send_mail = true;
                }else $send_mail = false;

                $postExpected = ['first_name', 'last_name', 'birthday', 'birthday_submit', 'email', 'password', 'password_confirmation', 'role', 'submit'];
                if($postExpected == array_keys($_POST) || $send_mail){
                    foreach($postExpected as $var){
                        $$var = $_POST[$var];
                    }
                    //valid birthday
                    $d = DateTime::createFromFormat('Y-m-d', $birthday_submit);
                    if($d && $d->format('Y-m-d') === $birthday_submit ){
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                            if($password == $password_confirmation){
                                if(!$this->registry->db->isUserMailExist($email)){
                                    if($role == 'Administrateur'){
                                        if(!$this->registry->db->addAdministrator($_POST)){
                                            $this->registry->template->error = 'Erreur lors de la creation du compte administrateur';
                                            $error = true;
                                        }
                                    }elseif($role == 'Auteur'){
                                        if(!$this->registry->db->addAuthor($_POST)){
                                            $this->registry->template->error = 'Erreur lors de la creation du compte auteur';
                                            $error = true;
                                        }
                                    }else{  
                                        $this->registry->template->error = 'Rôle inconnu';
                                        $error = true;
                                    }
                                    if(!isset($error)){
                                        if($send_mail){
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
                                                    <p>Vous avez été inscris sur notre site par '.$_SESSION['first_name'].$_SESSION['last_name'].'.</p>
                                                    <p>Pour vous connecter, il suffit de cliquer <a href="'.BASE_URL.'login">ici</a></p>
                                                    <p>A bientôt sur '.APP_TITLE.'</p>
                                                </div>
                                            ';
                                            if($PHPMailer->send()){
                                                header('Location: '.BASE_URL_ADMIN.'utilisateur/list');
                                                die();
                                            }else $this->registry->template->error = "Le mail de confirmation n\'a pas pu être envoyé mais l\'inscription est confirmée";
                                        }else{
                                            header('Location: '.BASE_URL_ADMIN.'utilisateur/list');
                                            die();
                                        }
                                    }else $this->registry->template->error = 'Erreur lors de la creation du compte';
                                }else $this->registry->template->error = 'Email déjà existant';
                            }else $this->registry->template->error = 'La confirmation de mot de passe est fausse';
                        }else $this->registry->template->error = 'Email invalide';
                    }else $this->registry->template->error = 'Date de naissance invalide';
                }else $this->registry->template->error = 'Erreur de formulaire';
            }else $this->registry->template->error = 'Veuillez sélectionner un rôle';
        }


        $this->registry->template->roles = ['Administrateur', 'Auteur'];
        $this->registry->template->show('add');
    }

    public function edit($args){        
        $this->registry->template->show('edit');
    }

    public function delete($args){
        if(isset($args[0]) && isset($args[1])){
            $this->registry->template->users = $users;
            $this->registry->template->show('index');
        }
    }
}
?>