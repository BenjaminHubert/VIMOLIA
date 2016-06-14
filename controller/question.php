<?php
class questionController extends baseController {
	public function index(){
		$this->registry->template->questions = $this->registry->db->getAllQuestions();
		$this->registry->template->show('index');
	}
	public function afficher($args){
		if(isset($args[0]) && is_numeric($args[0])){
			$question = $this->registry->db->getQuestion($args[0]);
			if($question){
				$this->registry->template->answers = $this->registry->db->getAnswersQuestion($args[0]);
				$this->registry->template->question = $question;
				$this->registry->template->show('afficher');
			}else{
				$this->registry->template->show('404', true);
			}
		}else{
			$this->registry->template->show('404', true);
		}
	}
	public function add(){
		if(isset($_SESSION['id'])){
			if(isset($_POST['question_title'], $_POST['question_text'], $_POST['privacy'])){
				if(!empty($_POST['question_title'])){
					if($_POST['privacy'] == 1 || $_POST['privacy'] == 0){
						if($this->registry->db->addQuestion($_POST['question_title'], $_POST['question_text'], $_POST['privacy'], $_SESSION['id'], 'Question sans réponse')){
							header('Location: ' . BASE_URL . 'question');
							die();
						}else{
							$this->registry->template->error = 'Une erreur s est produite lors de la création de votre question';
						}
					}else{
						$this->registry->template->error = 'Une erreur a eu lieu lors de la validité de la confidentialité';
					}
				}else{
					$this->registry->template->error = 'Votre question est vide';
				}
			}
			$this->registry->template->show('add');
		}else{
			header('Location: ' . BASE_URL . 'login?url=' . BASE_URL . 'question/add');
			die();
		}
	}
	public function addDetails($args){
		if(isset($args[0]) && $args[0] == 'successful'){
			$this->registry->template->show('successful');
		}elseif(isset($args[0]) && is_numeric($args[0])){
			if(isset($_SESSION['id'])){
				$question = $this->registry->db->getQuestion($args[0]);
				if($question && $question['id_user'] == $_SESSION['id'] && $question['status'] == 'Question en attente de validation de réponse'){
					if(isset($_POST['valider'])){
						if(is_numeric($_POST['age']) && $_POST['age'] > 0 && $_POST['age'] < 126){
							if(!empty($_POST['symptoms'])){
								switch($_FILES['medicalFile']['error']){
									case UPLOAD_ERR_OK:
										{
											if(strstr($_FILES['medicalFile']['type'], 'zip')){
												$ext = pathinfo($_FILES['medicalFile']['name'], PATHINFO_EXTENSION);
												if($ext == 'zip'){
													if($_FILES['medicalFile']['size'] < 10485760){
														$fileName = 'img/medical-files/' . $_FILES['medicalFile']['name'] . '_' . time();
														if(move_uploaded_file($_FILES['medicalFile']['tmp_name'], __SITE_PATH . DIRECTORY_SEPARATOR . $fileName)){
															if($this->registry->db->addQuestionnaire($_POST['symptoms'], $_POST['particularPains'], $_POST['antecedents'], $_POST['usefulInfo'], $question['id_user'], $question['id'])){
																$this->registry->db->changeStatusQuestion($question['id'], 'Question qui demande une liste de praticiens');
																
																header('Location: '.BASE_URL.'question/addDetails/successful');
																die();
															}else
																$this->registry->template->error = 'Une erreur a été rencontrée lors de la création du questionnaire remplie';
														}else
															$this->registry->template->error = 'Une erreur a été rencontrée lors du téléchargement du dossier';
													}else
														$this->registry->template->error = 'La taille du fichier ne doit pas exéder 10 Mo';
												}else
													$this->registry->template->error = 'Mauvaise extension de fichier. Le fichier doit être un fichier ZIP';
											}else
												$this->registry->template->error = 'Mauvaise extension de fichier. Le fichier doit être un fichier ZIP';
											break;
										}
									case UPLOAD_ERR_INI_SIZE:
										{
											$this->registry->template->error = 'La taille du fichier téléchargé est excède ' . ini_get('upload_max_filesize');
											break;
										}
									case UPLOAD_ERR_FORM_SIZE:
										{
											$this->registry->template->error = 'La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.';
											break;
										}
									case UPLOAD_ERR_PARTIAL:
										{
											$this->registry->template->error = 'Le fichier n a été que partiellement téléchargé.';
											break;
										}
									case UPLOAD_ERR_NO_FILE:
										{
											$this->registry->template->error = 'Aucun fichier n a été téléchargé.';
											break;
										}
									case UPLOAD_ERR_NO_TMP_DIR:
										{
											$this->registry->template->error = 'Un dossier temporaire est manquant';
											break;
										}
									case UPLOAD_ERR_CANT_WRITE:
										{
											$this->registry->template->error = 'Échec de l écriture du fichier sur le disque';
											break;
										}
									case UPLOAD_ERR_EXTENSION:
										{
											$this->registry->template->error = 'Une extension PHP a arrêté l envoi de fichier';
											break;
										}
								}
							}else
								$this->registry->template->error = 'Vous devrez renseigner les symptômes concernant votre question';
						}else
							$this->registry->template->error = 'Une erreur a été rencontrée concernant l âge renseigné';
					}
					$this->registry->template->show('addDetails');
				}else{
					$this->registry->template->show('403', true);
				}
			}else{
				header('Location: ' . BASE_URL . 'login?url=' . BASE_URL . 'question/addDetails/' . $args[0]);
				die();
			}
		}else{
			$this->registry->template->show('404', true);
		}
	}
}
?>