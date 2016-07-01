<?php
if(strpos(__SITE_PATH, DIRECTORY_SEPARATOR.'admin') !== false){
	require_once __SITE_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'php_libraries'.DIRECTORY_SEPARATOR.'securePayment'.DIRECTORY_SEPARATOR.'ExpressCheckout.class.php';
}else{
	require_once __SITE_PATH.DIRECTORY_SEPARATOR.'php_libraries'.DIRECTORY_SEPARATOR.'securePayment'.DIRECTORY_SEPARATOR.'ExpressCheckout.class.php';	
}
class MYEXPRESSCHECKOUT extends ExpressCheckout{
    
}