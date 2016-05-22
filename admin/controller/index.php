<?php
class indexController extends baseController {

    public function index(){        
        header('Location: '.BASE_URL_ADMIN.'monCompte');
    }
}
?>