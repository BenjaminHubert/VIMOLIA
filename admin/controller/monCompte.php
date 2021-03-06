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
    		case 'Praticien':
    			header('Location: '.BASE_URL_ADMIN.'monCompte/doctor');
    			die();
    			break;
    	}
    }
    
    public function member(){
    	if($_SESSION['role'] == 'Membre'){
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
    
    public function doctor(){
    	if($_SESSION['role'] == 'Praticien'){
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
				
				//mise à jour des spécialitées
				if($this->registry->db->updateSkills($user['id'], $user['specialities'])){
					unset($user['specialities']);
				}else $this->registry->template->error = 'La mise à jour des spécialitées a échoué';
			
				//mise à jour de l'utilisateur
				if($this->registry->db->updateUser($user)){
					$this->registry->template->message = 'Mise à jour effectuée avec succès';
					$_SESSION = $user;
				}else $this->registry->template->error = 'La mise à jour de vos informations a échoué suite à une erreur inattendue';
			}
			
			$this->registry->template->skills = $this->registry->db->getSkillsByUserId($_SESSION['id']);;
			$this->registry->template->allSkills = $this->registry->db->getSkills();;
	    	$this->registry->template->show('doctor');
    	}else $this->registry->template->show('404', true);
    }
    
    public function updatePassword(){
    	if(isset($_POST['update'])){
    		if($this->registry->db->hashPwd($_POST['currentPassword']) == $_SESSION['password']){
    			if($_POST['newPassword'] === $_POST['newPasswordConfirmation']){
    				$user = array_merge($_SESSION, ['password' => $this->registry->db->hashPwd($_POST['newPassword'])]);//mise à jour de l'utilisateur
					if($this->registry->db->updateUser($user)){
						$this->registry->template->message = 'Mise à jour effectuée avec succès';
						$_SESSION = $user;
					}else $this->registry->template->error = 'La mise à jour de vos informations a échoué suite à une erreur inattendue';
    			}else $this->registry->template->error = 'Les mots de passe ne correspondent pas';
    		}else $this->registry->template->error = 'Le mot de passe actuel n\'est pas celui saisie';
    	}
    	
    	$this->registry->template->show('updatePassword');
    }
    
}
?>