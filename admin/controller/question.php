<?php
class questionController extends baseController {
	protected $registry;
	public function __construct($registry){
		// default behavior
		parent::__construct($registry);
		// check rights
		if(!in_array($_SESSION['role'], [
				'Administrateur',
				'Expert'
		])){
			$registry->template->show('403', true);
			die();
		}
	}
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
	public function consult($args){
		if(isset($args[0]) && is_numeric($args[0])){
			
			$question = $this->registry->db->getQuestion($args[0]);
			if($question){
				$user = $this->registry->db->getUser($question['id_user']);
				$questionStatus = $this->registry->db->getQuestionStatus();
				
				// si on change le statut de la question
				if(isset($_POST['status'], $_POST['changeStatus'], $_POST['idQuestion'])){
					if(in_array($_POST['status'], $questionStatus)){
						if($this->registry->db->changeStatusQuestion($_POST['idQuestion'], $_POST['status'])){
							$question['status'] = $_POST['status'];
						}else
							$this->registry->template->error = 'Erreur lors de la mise à jour du statut';
					}else
						$this->registry->template->error = 'Statut inconnu';
				}
				// si on ajoute une réponse à la question
				if(isset($_POST['answer'], $_POST['addAnswer'], $_POST['idQuestion'])){
					if($this->registry->db->addAnswer($_POST['answer'], $_SESSION['id'], $_POST['idQuestion'])){
						$this->registry->template->message = 'Votre réponse a bien été prise en compte';
						$PHPMailer = new MyMail();
						$PHPMailer->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
						$PHPMailer->addReplyTo(EMAIL_REPLY, EMAIL_REPLY_NAME);
						$PHPMailer->addAddress($user['email']);
						$PHPMailer->isHTML(true);
						$PHPMailer->Subject = '[' . APP_TITLE . ']Réponse à votre question';
						$PHPMailer->Body = '
                        	<p>Bonjour ' . (($user['pseudo'] != null) ? $user['pseudo'] : $user['first_name'] . ' ' . $user['last_name']) . '</p>
                        	<div>
                            	<p>Vous avez posé une question sur ' . APP_TITLE . ':</p>
                            	<p style="font-style:italic">' . $question['question_title'] . '</p>
                                <p style="font-style:italic">' . $question['question_text'] . '</p>
                                <br><br>
                                <p>Nos experts ont répondu à votre question. Vous pouvez lire là réponse en cliquant ici:</p>
                                <a href="' . BASE_URL . 'question/afficher/' . $question['id'] . '">' . BASE_URL . 'question/afficher/' . $question['id'] . '</a>
                                <p>A bientôt sur ' . APP_TITLE . '</p>
                            </div>
                        ';
						if($PHPMailer->send()){
							$this->registry->template->message = 'Un mail a été envoyé à l auteur afin de l avertir de la réponse';
						}
					}else
						$this->registry->template->error = 'Erreur lors de l insertion en base de données';
				}
				
				$this->registry->template->user = $user;
				$this->registry->template->questionStatus = $questionStatus;
				$this->registry->template->question = $question;
				$this->registry->template->show('consult');
			}else{
				$this->registry->template->show('404', true);
			}
		}else{
			$this->registry->template->show('403', true);
		}
	}
}