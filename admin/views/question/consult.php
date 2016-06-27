<div class="row" style="border: solid 1px black; margin-top: 10px">
	<div class="col s12">
		<h3>Détail question</h3>
	</div>
	<div class="col s12">
		<b>Statut : </b> <?php echo htmlentities($question['status']);?>
	</div>
	<div class="col s12 m6">
		<b>Auteur : </b> <?php echo ($user['pseudo'] != null)?htmlentities($user['pseudo']):htmlentities($user['first_name']). ' '. htmlentities($user['last_name']);?>
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
			<button class="btn-large waves-effect waves-light blue-grey" type="submit" name="changeStatus" style="width: 100%">Valider</button>
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
		<p id="name">
			<i class="material-icons left">perm_identity</i> <?php echo ($question['pseudo']!=null)?htmlentities($question['pseudo']):htmlentities($question['first_name']).' '.htmlentities($question['last_name']);?></p>
		<div class="divider"></div>
		<p id="question"><?php echo $question['question_title'];?></p>
		<p id="details"><?php echo $question['question_text'];?></p>
		<div class="divider"></div>
		<p id="datetime">
			<i class="material-icons right">access_time</i><?php echo date('d/m/Y à H\hm', strtotime($question['question_date']))?></p>
	</div>
</div>

<div class="row" style="border: solid 1px black; padding-bottom: 10px">
	<form action="" method="POST">
		<?php if(count($answer) == 0){?>
		<div class="col s12">
			<h4>Ajouter une réponse :</h4>
		</div>
		<?php }?>
		<div class="col s12">
			<label for="answer">Réponse</label>
			<textarea id="answer" name="answer" class="materialize-textarea" length="1000" placeholder="Ajouter une réponse..." required><?php echo (isset($answer['answer_text'])?htmlentities($answer['answer_text']):'');?></textarea>
		</div>
		<div class="col s12 offset-m9 m3">
			<br>
			<br>
			<button class="btn waves-effect waves-light blue-grey" type="submit" name="reply" style="width: 100%" value="<?php echo (!isset($answer['answer_text'])?'addAnswer':$answer['id']);?>"><?php echo (isset($answer['answer_text'])?'Mettre à jour':'Ajouter');?></button>
		</div>
		<input type="hidden" name="idQuestion" value="<?php echo $question['id'];?>">
	</form>
</div>
<div class="row" style="border: solid 1px black; padding-bottom: 10px">
	<div class="col s12">
		<h5>Praticiens proposés:</h5>
	</div>
	<div class="col s12">
		<?php if($proposed_doctors){?>
		<table class="bordered centered doctors">
			<thead>
				<tr>
					<th>Praticien</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($proposed_doctors as $proposed_doctor){?>
				<tr>
					<td><?php echo htmlentities($proposed_doctor['first_name_praticien'].' '.$proposed_doctor['last_name_praticien']);?></td>
					<td><?php echo implode(', ', htmlentities($proposed_doctor['skills']));?></td>
					<td>
						<form action="" method="post">
							<button type="submit" name="deleteProposedDoctor" value="<?php echo $proposed_doctor['id'];?>" class="btn-floating waves-effect waves-light blue-grey delete"><i class="material-icons">delete_forever</i></button>
						</form>
					</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<?php }else{?>
		<table class="bordered centered doctors">
			<thead>
				<tr>
					<th>Praticien</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr class="no-doctor">
					<td colspan="3" style="text-align: center">Aucun praticien proposé</td>
				</tr>
			</tbody>
		</table>
		<?php }?>
		<br>
		<br>
	</div>
	<div class="col s12 m10">
		<select id="doctors">
			<option disabled selected value="-1">Sélectionner un praticien</option>
			<?php
			foreach($doctors as $doctor){
				$found = false;
				foreach($proposed_doctors as $proposed_doctor){
					if($doctor['id'] == $proposed_doctor['id_praticien']){
						$found = true;
					}
				}
				if(!$found){
					?>
					<option data-praticien="<?php echo htmlentities($doctor['first_name'].' '.$doctor['last_name']); ?>" data-skills="<?php echo implode(', ', htmlentities($doctor['skills']));?>" value="<?php echo $doctor['id'];?>">
						<?php echo htmlentities($doctor['first_name'].' '.$doctor['last_name'].' - '.implode(', ', $doctor['skills']));?>
					</option>
			<?php
				}
			}
			?>
		</select>
	</div>
	<div class="col s12 m2">
		<button class="btn-large waves-effect waves-light blue-grey" type="submit" name="addDoctor" style="width: 100%">Ajouter</button>
	</div>
	<form action="" method="post">
		<div class="col s12">
			<p class="right">
				<input type="checkbox" id="sendMail" name="sendMail" checked>
				<label for="sendMail">Souhaitez-vous avertir l'auteur par mail ?</label>
				<button class="btn waves-effect waves-light blue-grey disabled" type="submit" name="setProposedPraticien" value="submit" disabled>Enregistrer</button>
			</p>
		</div>
		<div class="col s12 proposedPraticien">
			<input type="hidden" name="id_question" value="<?php echo $question['id'];?>">
		</div>
	</form>
</div>