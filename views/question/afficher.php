<div class="row">
	<div class="col s12">
		<h4>Question</h4>
	</div>
	<div class="question col s12 grey lighten-2">
		<div id="status">
			<div class="chip right  blue-grey">
		    	<?php echo $question['status'];?>
		  	</div>
		</div>
		<p id="name">
			<i class="material-icons left">perm_identity</i> <?php echo ($question['pseudo']!=null)?htmlentities($question['pseudo']):htmlentities($question['first_name'].' '.$question['last_name']);?></p>
		<div class="divider"></div>
		<p id="question"><?php echo htmlentities($question['question_title']);?></p>
		<p id="details"><?php echo htmlentities($question['question_text']);?></p>
		<div class="divider"></div>
		<p id="datetime">
			<i class="material-icons right">access_time</i><?php echo date('d/m/Y à H\hm', strtotime($question['question_date']))?></p>
	</div>
</div>
<p style="font-weight: bold">Réponse de notre expert</p>
<?php if($answer){?>
<div class="row">
	<div class="col s12 grey lighten-2">
		<div class="row">
			<div class="col s1">
				<img style="width: 100%; margin: 10px" src="<?php echo ($answer['url_avatar'] !== NULL)?$answer['url_avatar']:BASE_URL.'img/avatar/user.png';?>" alt="">
			</div>
			<div class="col s11">
				<p><?php echo $answer['answer_text'];?></p>
				<p style="text-align: right"><?php echo ($answer['pseudo'] !== NULL)?htmlentities($answer['pseudo']):htmlentities($answer['first_name'].' '.$answer['last_name']);?>, expert <?php echo APP_TITLE;?></p>
				<p style="text-align: right; font-style: italic"><?php echo date('d/m/Y à H\hm', strtotime($answer['answer_date']));?></p>
			</div>
		</div>
	</div>
</div>
<!-- Question en attente de validation de réponse -->
<?php if(isset($_SESSION['id']) && $question['id_user'] == $_SESSION['id'] && $question['status'] == 'Question en attente de validation de réponse'){?>
<div class="row">
	<div class="col s12">
		<div class="right">
			<a href="<?php echo BASE_URL.'question/addDetails/'.$question['id'];?>" class="waves-effect waves-light btn BUTTON_BACKGROUND-COLOR">Je souhaite plus de détails</a>
			<a href="<?php echo BASE_URL.'question/close/'.$question['id'];?>" class="waves-effect waves-light btn BUTTON_BACKGROUND-COLOR">Cette réponse me convient</a>
		</div>
	</div>
</div>
<?php }?>
<!-- Question en attente du choix d'un praticien par le patient -->
<?php if(isset($_SESSION['id']) && $question['id_user'] == $_SESSION['id'] && $question['status'] == 'Question en attente du choix d\'un praticien par le patient'){?>
<div class="row">
	<div class="col s12">
		<div class="right">
			<a href="<?php echo BASE_URL.'question/makeAnAppointment/'.$question['id'];?>" class="waves-effect waves-light btn BUTTON_BACKGROUND-COLOR">Prendre un rendez-vous</a>
			<a href="<?php echo BASE_URL.'question/close/'.$question['id'];?>" class="waves-effect waves-light btn BUTTON_BACKGROUND-COLOR">Clôturer la question</a>
		</div>
	</div>
</div>
<?php }?>
<?php }else{?>
<div class="row">
	<div class="col s12 grey lighten-2">
		<p>Cette question n'a pas encore trouvé réponse</p>
	</div>
</div>
<?php }?>

<!--  FLOATING BUTTON -->
<?php if(isset($_SESSION['id']) && in_array($_SESSION['role'], ['Administrateur', 'Expert'])){ ?>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a href="<?php echo BASE_URL.'admin/question/consult/'.$question['id'];?>" class="btn-floating btn-large BUTTON_BACKGROUND-COLOR">
		<i class="large material-icons">mode_edit</i>
	</a>
</div>
<?php }?>