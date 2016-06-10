<?php
showArray($_POST);
?>
<div class="row">
	<div class="col s12">
		<h3>Questions</h3>
	</div>
	<div class="row">
		<div class="col s12">
			<h4>Recherche :</h4>
		</div>
		<div class="input-field col m6 s12">
			<input id="keywords" name="keywords" type="text" class="validate"> <label for="keywords">Mots clés</label>
		</div>
		<div class="input-field col m6 s12">
			<select name="privacy">
				<option value="all">Toutes</option>
				<option value="1">Publié</option>
				<option value="0">Non publié</option>
			</select> <label>Publication</label>
		</div>
		<div class="input-field col m6 s12">
			<select name="satisfaction">
				<option value="all">Toutes</option>
				<option value="1">1/5</option>
				<option value="2">2/5</option>
				<option value="3">3/5</option>
				<option value="4">4/5</option>
				<option value="5">5/5</option>
			</select> <label>Satisfaction</label>
		</div>
		<div class="input-field col m6 s12">
			<select name="status">
				<option>Tous</option>
				<option>Question clôturé</option>
				<option>Question en attente de validation de réponse</option>
				<option>Question en attente du choix d'un praticien par le patient</option>
				<option>Question qui demande une liste de praticiens</option>
				<option>Question sans réponse</option>
			</select> <label>Satisfaction</label>
		</div>
		<div class="input-field col offset-m6 m6 s12">
			<p style="width: 100%; text-align: right">
				<button class="btn waves-effect waves-light" type="submit" name="submit">
					Submit <i class="material-icons right">send</i>
				</button>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<table class="bordered highlight ">
				<thead>
					<tr>
						<td>Question</td>
						<td>Publication</td>
						<td>Date</td>
						<td>Status</td>
						<td>Satisfaction</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($questions as $question){?>
					<tr>
						<td><a href="<?php echo BASE_URL_ADMIN.'question/consult/'.$question['id'];?>"><?php echo $question['question_title'];?></a></td>
						<td><?php echo ($question['is_public'] == 1)?'Publié':'Non publié';?></td>
						<td><?php echo date('d/m/Y', strtotime($question['question_date']));?></td>
						<td><?php echo $question['status'];?></td>
						<td><?php echo ($question['satisfaction'] != null)?$question['satisfaction']:'?';?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
