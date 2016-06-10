<?php
class questionController extends baseController {
	public function index(){
		header('Location: ' . BASE_URL_ADMIN . 'question/list');
		die();
	}
	public function list(){
		$questions = $this->registry->db->getAllQuestions();
		$this->registry->template->questions = $questions;
		if(count($_POST) == 0){
			$_POST['keywords'] = '';
			$_POST['privacy'] = 'all';
			$_POST['satisfaction'] = 'all';
			$_POST['status'] = 'all';
		}
		$this->registry->template->show('list');
	}
}