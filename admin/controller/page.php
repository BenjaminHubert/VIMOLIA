<?php
class pageController extends baseController {

    public function index(){        
        $this->registry->template->show('index');
    }
    public function add(){        
        $this->registry->template->show('add');
    }
    public function edit(){        
        $this->registry->template->show('edit');
    }
}
?>