<?php
class signupController extends baseController {

    private $facilitatorUsername = 'younes.sadmi-facilitator_api1.gmail.com';
    private $facilitatorPassword = 'Y8L9MQSJL7MEPJSJ';
    private $facilitatorSignature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31Aqkx9PCclDaHbdmVkgfpneMdajEk';

    public function index(){
        $this->registry->template->skills = $this->registry->db->getSkills();
        $this->registry->template->subscriptionTypes = $this->registry->db->getSubscriptionTypes();

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
        $postExpected = ['first_name', 'last_name', 'birthday', 'birthday_submit', 'pseudo', 'url_avatar', 'address', 'postal_code', 'city', 'phone', 'mobile', 'email', 'password', 'password_confirmation', 'submit', 'type'];
        $fileExpected = ['avatar_file'];
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
                            $_POST['url_avatar'] = ($_POST['url_avatar'] != '')?$_POST['url_avatar']:null;
                            if($this->registry->db->addMember($_POST)){

                                if($_POST['url_avatar'] != null){
                                    $idUser = $this->registry->db->getIDUserByEmail($_POST['email']);
                                    $user = $this->registry->db->getUser($idUser);

                                    $info = pathinfo($_FILES['avatar_file']['name']);
                                    $ext = $info['extension'];
                                    $_POST['url_avatar'] = $idUser.'.'.$ext;
                                    $user['url_avatar'] = BASE_URL.'img/avatar/'.$_POST['url_avatar'];
                                    $this->registry->db->updateUser($user);
                                    uploadFile($_FILES, 'avatar_file', DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$_POST['url_avatar']);
                                }

                                $PHPMailer = new MyMail();
                                $PHPMailer->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
                                $PHPMailer->addReplyTo(EMAIL_REPLY, EMAIL_REPLY_NAME);                               
                                $PHPMailer->addAddress($email);
                                $PHPMailer->isHTML(true);
                                $PHPMailer->Subject = 'Inscription sur '.APP_TITLE;
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

    private function doctor(){
        $postExpected = ['first_name', 'last_name', 'birthday', 'birthday_submit', 'pseudo', 'url_avatar', 'address', 'postal_code', 'city', 'phone', 'mobile', 'email', 'password', 'password_confirmation', 'specialities', 'siret', 'presentation', 'subscription_type', 'agreement', 'submit', 'type'];
        $fileExpected = ['avatar_file'];
        if(isset($_POST['specialities'])){
            if(isset($_POST['agreement'])){
                if($postExpected == array_keys($_POST)){
                    foreach($postExpected as $var){
                        $$var = $_POST[$var];
                    }
                    //valid birthday
                    $d = DateTime::createFromFormat('Y-m-d', $birthday_submit);
                    if($d && $d->format('Y-m-d') === $birthday_submit ){
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                            if($password == $password_confirmation){
                                if(strlen($_POST['siret']) == 14){
                                    if(!$this->registry->db->isUserMailExist($email)){
                                        $subscriptionTypes = $this->registry->db->getSubscriptionTypes();
                                        $subscriptionTrueID = false;
                                        foreach($subscriptionTypes as $subscriptionType){
                                            if($subscriptionType['id'] == $_POST['subscription_type']){
                                                $subscriptionTrueID = true;
                                                break;
                                            }
                                        }
                                        if($subscriptionTrueID){
                                            $_POST['pseudo'] = ($_POST['pseudo'] != '')?$_POST['pseudo']:null;
                                            if($_POST['url_avatar'] != ''){
                                                $info = pathinfo($_FILES['avatar_file']['name']);
                                                $ext = $info['extension'];
                                                $_POST['url_avatar'] = '/img/avatar/'.$_SESSION['id'].'.'.$ext;
                                                uploadFile($_FILES, 'avatar_file', $_POST['url_avatar']);
                                            }else $_POST['url_avatar'] = null;

                                            $payPal = new MyExpressCheckout();
                                            $payPal->setReturnUrl(BASE_URL.'signup/returnTransaction');
                                            $payPal->setCancelUrl(BASE_URL.'signup/cancelTransaction');
                                            $payPal->setAmount($subscriptionType['amount']);
                                            $payPal->setCurrencyCode($subscriptionType['currencycode']);
                                            $payPal->setLocaleCode('FR');
                                            $payPal->isSandbox(true);
                                            $payPal->setLogo(BASE_URL.'img/logo_250x84.png');
                                            $payPal->setUsername_facilitator($this->facilitatorUsername);
                                            $payPal->setPassword_facilitator($this->facilitatorPassword);
                                            $payPal->setSignature_facilitator($this->facilitatorSignature);
                                            $token = $payPal->getToken();
                                            if($this->registry->db->addTransaction($token, $subscriptionType['amount'], $subscriptionType['currencycode'], 'FR')){
                                                if($this->registry->db->addDoctor($_POST)){
                                                    $idUser = $this->registry->db->getIDUserByEmail($_POST['email']);
                                                    foreach($_POST['specialities'] as $skill){
                                                        if(!$this->registry->db->addSkillToUser($idUser, $skill)){
                                                            throw new Exception('Echec de l ajout des specialités ');
                                                        }
                                                    }

                                                    if($this->registry->db->addSubscription($idUser, $_POST['subscription_type'], $token)){
                                                        $payPal->setExpressCheckout();
                                                    }else throw new Exception('Echec lors de l insertion en base de données');
                                                }else throw new Exception('Echec lors de l insertion en base de données');
                                            }else throw new Exception('Création de la transaction interrompu');
                                        }else throw new Exception('Type d abonnement incorrect');
                                    }else throw new Exception('Email déjà existant');
                                }else throw new Exception('Numéro de SIRET invalide');
                            }else throw new Exception('La confirmation de mot de passe est fausse');
                        }else throw new Exception('Email invalide');
                    }else throw new Exception('Date de naissance invalide');
                }else throw new Exception('Erreur de formulaire');
            }else throw new Exception('Veuillez accepter les conditions générales d utilisation');
        }else throw new Exception('Veuillez sélectionner au moins une spécialité');
    }

    public function validation($args){
        if(isset($args[0]) && isset($args[1])){
            if($this->registry->db->confirmEmail($args[0], $args[1])){
                $this->registry->template->show('validation');
            }else $this->registry->template->show('404', true);
        }else $this->registry->template->show('404', true);
    }

    public function cancelTransaction(){
        if(isset($_GET['token'])){
            $updateTransaction = $this->registry->db->cancelTransactionByToken($_GET['token']);
            $this->registry->template->error = 'Le paiement a été annulé';
            $this->registry->template->show('cancelTransaction');
        }else $this->registry->template->show('404', true);
    }

    public function returnTransaction(){
        if(isset($_GET['token'])){
            $transaction = $this->registry->db->getTransactionByToken($_GET['token']);
            if($transaction['id_status'] == 1){
                $payPal = new MyExpressCheckout();
                $payPal->setAmount($transaction['paypal_amount']);
                $payPal->setCurrencyCode($transaction['paypal_currencycode']);
                $payPal->setLocaleCode($transaction['paypal_localecode']);
                $payPal->isSandbox(true);
                $payPal->setLogo(BASE_URL.'img/logo_250x84.png');
                $payPal->setUsername_facilitator($this->facilitatorUsername);
                $payPal->setPassword_facilitator($this->facilitatorPassword);
                $payPal->setSignature_facilitator($this->facilitatorSignature);
                try{
                    $transaction = $payPal->doExpressCheckout();
                    if($transaction['ACK'] == 'Success'){
                        if($this->registry->db->updateTransaction($transaction) !== false){
                            $this->registry->template->message = 'Inscription effectuée';
                            //envoyer un mail récapitulatif
                            //...
                            //...
                            //...
                        }else $this->registry->template->error = 'Paiement effectué mais enregistrement en base de données impossible...';
                    }else $this->registry->template->error = $transaction['L_LONGMESSAGE0'];
                }catch(Exception $e){
                    $this->registry->template->error = $e->getMessage();
                }
                $this->registry->template->show('returnTransaction');
            }elseif($transaction['id_status'] == 2){
                $this->registry->template->error = 'Cette transaction a déjà été annulé';
                $this->registry->template->show('returnTransaction');
            }elseif($transaction['id_status'] == 3){
                $this->registry->template->message = 'Cette transaction a déjà été payé';
                $this->registry->template->show('returnTransaction');
            }else $this->registry->template->show('404', true);
        }else $this->registry->template->show('404', true);
    }
}
?>