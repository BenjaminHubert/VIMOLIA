<?php
class monCompteController extends baseController {

    public function index(){
    	switch($_SESSION['role']){
    		case 'Membre':
    			header('Location: '.BASE_URL_ADMIN.'monCompte/member');
    			die();
    			break;
    		case 'Expert':
    			header('Location: '.BASE_URL_ADMIN.'monCompte/expert');
    			die();
    			break;
    		case 'Administrateur':
    			header('Location: '.BASE_URL_ADMIN.'monCompte/administrator');
    			die();
    			break;
    		case 'Auteur':
    			header('Location: '.BASE_URL_ADMIN.'monCompte/author');
    			die();
    			break;
    	}
    }
    
    public function member(){
    	if($_SESSION['role'] == 'Member'){
			if(isset($_POST['submit'])){
				//parameters settings
				$_POST['birthday_date'] = $_POST['birthday_submit'];
				unset($_POST['birthday'], $_POST['birthday_submit'], $_POST['submit']);
				$user = array_merge($_SESSION, $_POST);
			
				//si mise à jour de l'avatar
				if(isset($_FILES['avatar_file']) && $_FILES['avatar_file']['size'] > 0){
					if($_FILES['avatar_file']['error'] == UPLOAD_ERR_OK){
						$info = pathinfo($_FILES['avatar_file']['name']);
						$ext = $info['extension'];
						$user['url_avatar'] = BASE_URL.'img/avatar/'.$user['id'].'.'.$ext;
						uploadFile($_FILES, 'avatar_file', DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$user['id'].'.'.$ext);
					}else $this->registry->template->error = 'Erreur lors de la mise à jour de la photo de profil';
				}
			
				//mise à jour
				if($this->registry->db->updateUser($user)){
					$this->registry->template->message = 'Mise à jour effectuée avec succès';
					$_SESSION = $user;
				}
			}
	    	$this->registry->template->show('member');
    	}else $this->registry->template->show('404', true);
    }
    
    public function expert(){
    	if($_SESSION['role'] == 'Expert'){
			if(isset($_POST['submit'])){
				//parameters settings
				$_POST['birthday_date'] = $_POST['birthday_submit'];
				unset($_POST['birthday'], $_POST['birthday_submit'], $_POST['submit']);
				$user = array_merge($_SESSION, $_POST);
			
				//si mise à jour de l'avatar
				if(isset($_FILES['avatar_file']) && $_FILES['avatar_file']['size'] > 0){
					if($_FILES['avatar_file']['error'] == UPLOAD_ERR_OK){
						$info = pathinfo($_FILES['avatar_file']['name']);
						$ext = $info['extension'];
						$user['url_avatar'] = BASE_URL.'img/avatar/'.$user['id'].'.'.$ext;
						uploadFile($_FILES, 'avatar_file', DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$user['id'].'.'.$ext);
					}else $this->registry->template->error = 'Erreur lors de la mise à jour de la photo de profil';
				}
			
				//mise à jour
				if($this->registry->db->updateUser($user)){
					$this->registry->template->message = 'Mise à jour effectuée avec succès';
					$_SESSION = $user;
				}
			}
	    	$this->registry->template->show('expert');
    	}else $this->registry->template->show('404', true);
    }
    
    public function administrator(){
    	if($_SESSION['role'] == 'Administrateur'){
			if(isset($_POST['submit'])){
				//parameters settings
				$_POST['birthday_date'] = $_POST['birthday_submit'];
				unset($_POST['birthday'], $_POST['birthday_submit'], $_POST['submit']);
				$user = array_merge($_SESSION, $_POST);
			
				//si mise à jour de l'avatar
				if(isset($_FILES['avatar_file']) && $_FILES['avatar_file']['size'] > 0){
					if($_FILES['avatar_file']['error'] == UPLOAD_ERR_OK){
						$info = pathinfo($_FILES['avatar_file']['name']);
						$ext = $info['extension'];
						$user['url_avatar'] = BASE_URL.'img/avatar/'.$user['id'].'.'.$ext;
						uploadFile($_FILES, 'avatar_file', DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$user['id'].'.'.$ext);
					}else $this->registry->template->error = 'Erreur lors de la mise à jour de la photo de profil';
				}
			
				//mise à jour
				if($this->registry->db->updateUser($user)){
					$this->registry->template->message = 'Mise à jour effectuée avec succès';
					$_SESSION = $user;
				}
			}
	    	$this->registry->template->show('administrator');
    	}else $this->registry->template->show('404', true);
    }
    
    public function author(){
    	if($_SESSION['role'] == 'Auteur'){
			if(isset($_POST['submit'])){
				//parameters settings
				$_POST['birthday_date'] = $_POST['birthday_submit'];
				unset($_POST['birthday'], $_POST['birthday_submit'], $_POST['submit']);
				$user = array_merge($_SESSION, $_POST);
			
				//si mise à jour de l'avatar
				if(isset($_FILES['avatar_file']) && $_FILES['avatar_file']['size'] > 0){
					if($_FILES['avatar_file']['error'] == UPLOAD_ERR_OK){
						$info = pathinfo($_FILES['avatar_file']['name']);
						$ext = $info['extension'];
						$user['url_avatar'] = BASE_URL.'img/avatar/'.$user['id'].'.'.$ext;
						uploadFile($_FILES, 'avatar_file', DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$user['id'].'.'.$ext);
					}else $this->registry->template->error = 'Erreur lors de la mise à jour de la photo de profil';
				}
			
				//mise à jour
				if($this->registry->db->updateUser($user)){
					$this->registry->template->message = 'Mise à jour effectuée avec succès';
					$_SESSION = $user;
				}
			}
	    	$this->registry->template->show('author');
    	}else $this->registry->template->show('404', true);
    }
    
}
?>