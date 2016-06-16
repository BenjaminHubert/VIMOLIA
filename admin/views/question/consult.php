<div class="row">
	<div class="col s12">
		<h3>Détail question</h3>
	</div>
	<div class="col s12">
		<b>Statut : </b> <?php echo htmlentities($question['status']);?>
	</div>
	<div class="col s12 m6">
		<b>Auteur : </b> <?php echo htmlentities(($user['pseudo'] != null)?$user['pseudo']:$user['first_name']. ' '. $user['last_name']);?>
	</div>
	<div class="col s12 m6">
		<b>Date de la question : </b> <?php echo date('d/m/Y à H\hm', strtotime($question['question_date']));?>
	</div>
	<form action="" method="POST">
		<div class="col s12 m10">
			<select name="status">
				<?php foreach($questionStatus as $status){?>
					<option <?php echo ($status == $question['status'])?'selected':''?>><?php echo htmlentities($status);?></option>
				<?php }?>
			</select>
		</div>
		<div class="col s12 m2">
			<button class="btn-large waves-effect waves-light" type="submit" name="changeStatus" style="width: 100%">Valider</button>
		</div>
		<input type="hidden" name="idQuestion" value="<?php echo $question['id'];?>">
	</form>
</div>

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
		<p id="name"><i class="material-icons left">perm_identity</i> <?php echo ($question['pseudo']!=null)?$question['pseudo']:$question['first_name'].' '.$question['last_name'];?></p>
		<div class="divider"></div>
		<p id="question"><?php echo $question['question_title'];?></p>
		<p id="details"><?php echo $question['question_text'];?></p>
		<div class="divider"></div>
		<p id="datetime"><i class="material-icons right">access_time</i><?php echo date('d/m/Y à H\hm', strtotime($question['question_date']))?></p>
	</div>
</div>

<form action="" method="POST">
	<div class="row">
		<?php if(count($answers) > 0){?>
		<div class="col s12">
			<h4>Réponse(s) :</h4>
		</div>
		<?php }?>
		<?php foreach($answers as $answer){?>
		<div class="col s12 grey lighten-2">
			<div class="row">
				<div class="col s1">
					<img style="width: 100%; margin: 10px" src="<?php echo ($answer['url_avatar'] !== NULL)?$answer['url_avatar']:BASE_URL.'img/avatar/user.png';?>" alt="">
				</div>
				<div class="col s11">
					<p><?php echo $answer['answer_text'];?></p>
					<p style="text-align: right"><?php echo ($answer['pseudo'] !== NULL)?$answer['pseudo']:$answer['first_name'].' '.$answer['last_name'];?>, expert <?php echo APP_TITLE;?></p>
					<p style="text-align: right; font-style: italic"><?php echo date('d/m/Y à H\hm', strtotime($answer['answer_date']));?></p>
				</div>
			</div>
		</div>
		<?php }?>
		<div class="col s12">
			<h4>Ajouter une réponse :</h4>
		</div>
		<div class="col s12">
			<textarea name="answer" class="materialize-textarea" length="1000" placeholder="Ajouter une réponse..." required><?php echo '';?></textarea>
		</div>
		<div class="col s12 offset-m10 m2">
			<br>
			<br>
			<button class="btn waves-effect waves-light" type="submit" name="addAnswer" style="width: 100%">Enregistrer</button>
		</div>
	</div>
	<input type="hidden" name="idQuestion" value="<?php echo $question['id'];?>">
</form>