<?php
class monAbonnementController extends baseController {
	private $facilitatorUsername = 'younes.sadmi-facilitator_api1.gmail.com';
	private $facilitatorPassword = 'Y8L9MQSJL7MEPJSJ';
	private $facilitatorSignature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31Aqkx9PCclDaHbdmVkgfpneMdajEk';
	
	protected $registry;
	public function __construct($registry){
		// default behavior
		parent::__construct($registry);
		// check rights
		if(!in_array($_SESSION['role'], [
			'Praticien'
		])){
			$registry->template->show('403', true);
			die();
		}
	}
    public function index(){
    	$subscription_types = $this->registry->db->getSubscriptionTypes();
    	$user_subscriptions = $this->registry->db->getSubscriptionByUser($_SESSION['id']);
    	
    	$this->registry->template->subscription_types = $subscription_types;
    	$this->registry->template->user_subscriptions = $user_subscriptions;
    	$this->registry->template->show('index');
    }
    
    public function add(){
    	$subscription_types = $this->registry->db->getSubscriptionTypes();
    	
    	if(count($_POST) > 0){
    		if(isset($_POST['subscription_type'])){
    			if(is_numeric($_POST['subscription_type'])){
    				$subscriptionTrueID = false;
    				foreach($subscription_types as $subscriptionType){
    					if($subscriptionType['id'] == $_POST['subscription_type']){
    						$subscriptionTrueID = true;
    						break;
    					}
    				}
    				if($subscriptionTrueID){
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
    						if($this->registry->db->addSubscription($_SESSION['id'], $_POST['subscription_type'], $token)){
    							$payPal->setExpressCheckout();
    						}else $this->registry->template->error = 'Echec lors de l insertion en base de données';
    					}else $this->registry->template->error = 'Création de la transaction interrompu';
    				}else $this->registry->template->error = 'Type d abonnement incorrect';
    			}else $this->registry->template->error = 'Erreur formulaire';
    		}else $this->registry->template->error = 'Veuillez sélectionner un abonnement avant de valider';
    	}

    	$this->registry->template->subscription_types = $subscription_types;
    	$this->registry->template->show('add');
    }
}
?>