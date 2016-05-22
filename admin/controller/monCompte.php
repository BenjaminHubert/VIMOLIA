<?php
class monCompteController extends baseController {

    public function index(){        
        $this->registry->template->show('index');
    }
}
?>