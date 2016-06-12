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
		<h4>Question :</h4>
	</div>
	<div class="col s12">
		<p><?php echo htmlentities($question['question_title']);?></p>
		<p><?php echo htmlentities($question['question_text']);?></p>
	</div>
</div>

<form action="" method="POST">
	<div class="row">
		<div class="col s12">
			<h4>Réponse :</h4>
		</div>
		<div class="col s12">
			<textarea name="answer" class="materialize-textarea" length="1000" placeholder="Ajouter une réponse..." required><?php echo '';?></textarea>
		</div>
		<div class="col s12 offset-m10 m2">
			<br><br>
			<button class="btn waves-effect waves-light" type="submit" name="addAnswer" style="width: 100%">Enregistrer</button>
		</div>
	</div>
	<input type="hidden" name="idQuestion" value="<?php echo $question['id'];?>">
</form>