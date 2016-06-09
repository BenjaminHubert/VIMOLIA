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
							header('Location: '.BASE_URL.'question');
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
}
?>