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
    }

    public function list(){
        $users = $this->registry->db->getAllUsers();
        $this->registry->template->users = $users;
        $this->registry->template->show('list');
    }

    public function add(){        
        $this->registry->template->show('add');
    }

    public function edit($args){        
        $this->registry->template->show('edit');
    }

    public function delete($args){
        if(isset($args[0]) && isset($args[1])){
            $this->registry->template->users = $users;
            $this->registry->template->show('index');
        }
    }
}
?>