<?php
class questionController extends baseController {
	public function index(){
		header('Location: ' . BASE_URL_ADMIN . 'question/list');
		die();
	}
	public function list(){
		$questions = $this->registry->db->getAllQuestions();
		$this->registry->template->questions = $questions;
		$this->registry->template->show('list');
	}
}