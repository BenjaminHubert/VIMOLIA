<?php
session_start();
error_reporting(E_ALL);
ini_set('max_execution_time', 0);
define('__SITE_PATH', realpath(dirname(__FILE__)));

$conf_file = __SITE_PATH.DIRECTORY_SEPARATOR.'conf'.DIRECTORY_SEPARATOR.'config.php';
if(file_exists($conf_file)){
    include $conf_file;
}else die("<b>Error</b>: <br>Config file not exist");

include __SITE_PATH.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'baseController.class.php';
include __SITE_PATH.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'registry.class.php';
include __SITE_PATH.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'router.class.php';
include __SITE_PATH.DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'template.class.php';

function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = __SITE_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$filename;

    if(file_exists($file) == false){
        return false;
    }
    include $file;
}

// VERIFICATION DES EXTENSIONS REQUISES POUR L'APPLICATION
if(!extension_loaded('openssl')){
    die('Error 500 - Veuillez demander à votre administrateur d\'activer l\'extension openssl');
}
if(!extension_loaded('curl')){
    die('Error 500 - Veuillez demander à votre administrateur d\'activer l\'extension curl');
}

$registry = new registry;
$registry->db = DB::getInstance($registry);
$registry->router = new router($registry);
$registry->router->setPath(__SITE_PATH.DIRECTORY_SEPARATOR.'controller');
$registry->template = new template($registry);
$registry->router->loader();
?>