<?php
class questionController extends baseController {
	public function index() {
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
			}else $this->registry->template->show('404', true);
		}else $this->registry->template->show('404', true);
	}
	
	public function add(){
		if(isset($_SESSION['id'])){
			$this->registry->template->show('add');
		}else $this->registry->template->show('403', true);
	}
}
?>