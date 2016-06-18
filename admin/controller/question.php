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
				$doctors = $this->registry->db->getAllDoctors();
				
				// supprimer un praticien proposé
				if(isset($_POST['deleteProposedDoctor']) && is_numeric($_POST['deleteProposedDoctor'])){
					$this->registry->db->deleteProposedDoctor($_POST['deleteProposedDoctor']);
				}
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
				if(isset($_POST['answer'], $_POST['reply'], $_POST['idQuestion'])){
					if($_POST['reply'] == 'addAnswer'){
						$action = $this->registry->db->addAnswer($_POST['answer'], $_SESSION['id'], $_POST['idQuestion']);
					}else{
						$action = $this->registry->db->updateAnswer($_POST['answer'], $_SESSION['id'], $_POST['reply']);
					}
					if($action){
						$this->registry->template->message = 'Votre réponse a bien été prise en compte';
						if($_POST['reply'] == 'addAnswer'){
							$PHPMailer = new MyMail();
							$PHPMailer->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
							$PHPMailer->addReplyTo(EMAIL_REPLY, EMAIL_REPLY_NAME);
							$PHPMailer->addAddress($user['email']);
							$PHPMailer->isHTML(true);
							$PHPMailer->Subject = '[' . APP_TITLE . '] Réponse à votre question';
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
						}
					}else{
						$this->registry->template->error = 'Erreur lors de l insertion en base de données';
					}
				}
				
				// si on propose un ou plusieurs praticien(s)
				if(isset($_POST['setProposedPraticien'], $_POST['id_question'], $_POST['id_praticien'])){
					if(is_numeric($_POST['id_question'])){
						$success = 0;
						foreach($_POST['id_praticien'] as $id_praticien){
							if($this->registry->db->addPropopsedPraticien($_SESSION['id'], $id_praticien, $_POST['id_question'])){
								$success++;
							}else
								$this->registry->template->error = 'Ajout interrompu';
						}
						
						if($success == count($_POST['id_praticien']) && isset($_POST['sendMail'])){
							$PHPMailer = new MyMail();
							$PHPMailer->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
							$PHPMailer->addReplyTo(EMAIL_REPLY, EMAIL_REPLY_NAME);
							$PHPMailer->addAddress($user['email']);
							$PHPMailer->isHTML(true);
							$PHPMailer->Subject = '[' . APP_TITLE . '] Proposition de praticiens suite à votre question';
							$PHPMailer->Body = '
	                        	<p>Bonjour ' . (($user['pseudo'] != null) ? $user['pseudo'] : $user['first_name'] . ' ' . $user['last_name']) . '</p>
	                        	<div>
	                            	<p>Vous avez posé une question sur ' . APP_TITLE . ':</p>
	                            	<p style="font-style:italic">' . $question['question_title'] . '</p>
	                                <p style="font-style:italic">' . $question['question_text'] . '</p>
	                                <br><br>
	                                <p>Nos experts ont répondu à votre question mais vous n\'en avez pas été satisfait. Nous vous proposons donc une liste de praticiens avec lesquels vous pourrez entrer en contact pour avoir plus de réponses.</p>
	                                <a href="' . BASE_URL . 'question/afficher/' . $question['id'] . '">Cliquer ici pour voir la réponse</a>
	                                <p>A bientôt sur ' . APP_TITLE . '</p>
	                            </div>
	                        ';
							$PHPMailer->send();
						}
						
						$this->registry->db->changeStatusQuestion($_POST['id_question'], "Question en attente du choix d'un praticien par le patient");
						
						header('Location: ' . BASE_URL_ADMIN . 'question/consult/' . $_POST['id_question']);
						die();
					}else
						$this->registry->template->error = 'Les paramètres attendus sont incorrects';
				}
				
				$this->registry->template->answer = $this->registry->db->getAnswerQuestion($question['id']);
				$this->registry->template->user = $user;
				$this->registry->template->proposed_doctors = $this->registry->db->getProposedDoctors();
				$this->registry->template->doctors = $doctors;
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