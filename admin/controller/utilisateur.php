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
        die();
    }

    public function list(){
        $users = $this->registry->db->getAllUsers();
        $this->registry->template->users = $users;
        $this->registry->template->show('list');
    }

    public function add(){
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

        $this->registry->template->roles = ['Administrateur', 'Auteur', 'Expert'];
        $this->registry->template->show('add');
    }

    public function edit($args){
        if(isset($args[0])){
            $user = $this->registry->db->getUser($args[0], 'sha1');

            if(isset($_POST['submit'])){
                $postExpected = ['first_name', 'last_name', 'birthday', 'birthday_submit', 'email', 'submit'];
                if($postExpected == array_keys($_POST)){
                    foreach($postExpected as $var){
                        $$var = $_POST[$var];
                    }
                    $d = DateTime::createFromFormat('Y-m-d', $birthday_submit);
                    if($d && $d->format('Y-m-d') === $birthday_submit ){
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                            if($user['email'] == $email || !$this->registry->db->isUserMailExist($email)){
                                $user['first_name'] = $_POST['first_name'];
                                $user['last_name'] = $_POST['last_name'];
                                $user['birthday_date'] = $_POST['birthday_submit'];
                                $user['email'] = $_POST['email'];
                                if($this->registry->db->updateUser($user)){
                                    $this->registry->template->message = 'Utilisateur modifié avec succès';
                                }else $this->registry->template->error = 'Email non valide';
                            }else $this->registry->template->error = 'Email existant';
                        }else $this->registry->template->error = 'Email non valide';
                    }else $this->registry->template->error = 'Date de naissance invalide';
                }else $this->registry->template->error = 'Erreur de formulaire';
            }

            $this->registry->template->user = $user;
            $this->registry->template->show('edit');
        }else{
            header('Location: '.BASE_URL_ADMIN.'utilisateur/list');
            die();
        }
    }

    public function delete($args){
        if(isset($args[0])){
            var_dump($this->registry->db->deleteUser($args[0], 'sha1'));
            header('Location: '.BASE_URL_ADMIN.'utilisateur/list');
            die();
        }else{
            header('Location: '.BASE_URL_ADMIN.'utilisateur/list');
            die();
        }
    }
}
?>