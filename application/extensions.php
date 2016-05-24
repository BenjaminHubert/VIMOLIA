<?php

// VERIFICATION DES EXTENSIONS REQUISES POUR L'APPLICATION
if(!extension_loaded('openssl')){
    die('Error 500 - OPENSSL extension not loaded');
}
if(!extension_loaded('curl')){
    die('Error 500 - CURL extension not loaded');
}


?>