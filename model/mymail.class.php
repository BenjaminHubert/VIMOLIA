<?php
if(strpos(__SITE_PATH, DIRECTORY_SEPARATOR.'admin') !== false){
    require_once __SITE_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'php_libraries'.DIRECTORY_SEPARATOR.'PHPMailer-5.2.15'.DIRECTORY_SEPARATOR.'class.phpmailer.php';
    require_once __SITE_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'php_libraries'.DIRECTORY_SEPARATOR.'PHPMailer-5.2.15'.DIRECTORY_SEPARATOR.'class.smtp.php';
}else{
    require_once __SITE_PATH.DIRECTORY_SEPARATOR.'php_libraries'.DIRECTORY_SEPARATOR.'PHPMailer-5.2.15'.DIRECTORY_SEPARATOR.'class.phpmailer.php';
    require_once __SITE_PATH.DIRECTORY_SEPARATOR.'php_libraries'.DIRECTORY_SEPARATOR.'PHPMailer-5.2.15'.DIRECTORY_SEPARATOR.'class.smtp.php';
}
class MYMAIL extends PHPMailer{
    public function __construct() {
        $this->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        $this->isSMTP();
        $this->Host = EMAIL_SMTP_HOST;
        $this->Username = EMAIL_SMTP_ADDRESS;
        $this->Password = EMAIL_SMTP_PWD;
        $this->SMTPAuth = true;
        $this->CharSet = 'UTF-8';
        $this->Port = EMAIL_SMTP_PORT;
        $this->SMTPSecure = 'ssl';
        //        $this->SMTPDebug = 2;
    }
}