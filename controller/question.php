<?php
class questionController extends baseController {
	public function index() {
		$this->registry->template->questions = $this->registry->db->getAllQuestions ();
		$this->registry->template->show ( 'index' );
	}
}
?>