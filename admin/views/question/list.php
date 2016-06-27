<div class="row">
	<form action="" method="post">
		<div class="col s12">
			<h3>Questions</h3>
		</div>
		<div class="row">
			<div class="col s12">
				<h4>Recherche :</h4>
			</div>
			<div class="input-field col m6 s12">
				<input id="keywords" name="keywords" type="text" class="validate" disabled> <label for="keywords">Mots clés</label>
			</div>
			<div class="input-field col m6 s12">
				<select name="privacy">
					<option value="all" <?php echo (isset($_POST['privacy']) && $_POST['privacy'] == 'all')?'selected':''?>>Toutes</option>
					<option value="1" <?php echo (isset($_POST['privacy']) && $_POST['privacy'] == '1')?'selected':''?>>Publiée</option>
					<option value="0" <?php echo (isset($_POST['privacy']) && $_POST['privacy'] == '0')?'selected':''?>>Non publiéé</option>
				</select> <label>Publication</label>
			</div>
			<div class="input-field col m6 s12">
				<select name="satisfaction">
					<option value="all" <?php echo (isset($_POST['satisfaction']) && $_POST['satisfaction'] == 'all')?'selected':''?>>Toutes</option>
					<option value="<?php echo null;?>" <?php echo (isset($_POST['satisfaction']) && $_POST['satisfaction'] == null)?'selected':''?>>Vide</option>
					<option value="1" <?php echo (isset($_POST['satisfaction']) && $_POST['satisfaction'] == '1')?'selected':''?>>1/5</option>
					<option value="2" <?php echo (isset($_POST['satisfaction']) && $_POST['satisfaction'] == '2')?'selected':''?>>2/5</option>
					<option value="3" <?php echo (isset($_POST['satisfaction']) && $_POST['satisfaction'] == '3')?'selected':''?>>3/5</option>
					<option value="4" <?php echo (isset($_POST['satisfaction']) && $_POST['satisfaction'] == '4')?'selected':''?>>4/5</option>
					<option value="5" <?php echo (isset($_POST['satisfaction']) && $_POST['satisfaction'] == '5')?'selected':''?>>5/5</option>
				</select> <label>Satisfaction</label>
			</div>
			<div class="input-field col m6 s12">
				<select name="status">
					<option value="all" <?php echo (isset($_POST['status']) && $_POST['status'] == 'all')?'selected':''?>>Tous</option>
					<option <?php echo (isset($_POST['status']) && $_POST['status'] == 'Question clôturé')?'selected':''?>>Question clôturé</option>
					<option <?php echo (isset($_POST['status']) && $_POST['status'] == 'Question en attente de validation de réponse')?'selected':''?>>Question en attente de validation de réponse</option>
					<option <?php echo (isset($_POST['status']) && $_POST['status'] == 'Question en attente du choix d\'un praticien par le patient')?'selected':''?>>Question en attente du choix d'un praticien par le patient</option>
					<option <?php echo (isset($_POST['status']) && $_POST['status'] == 'Question qui demande une liste de praticiens')?'selected':''?>>Question qui demande une liste de praticiens</option>
					<option <?php echo (isset($_POST['status']) && $_POST['status'] == 'Question sans réponse')?'selected':''?>>Question sans réponse</option>
				</select> <label>Statut</label>
			</div>
			<div class="input-field col offset-m6 m6 s12">
				<p style="width: 100%; text-align: right">
					<button class="btn waves-effect waves-light grey reset-filter" type="button">
						<i class="material-icons left">filter_list</i> Réinitialiser 
					</button>
					<button class="btn waves-effect waves-light" type="submit">
						Submit <i class="material-icons right">send</i>
					</button>
				</p>
			</div>
		</div>
	</form>
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
					<?php if(count($questions) > 0){ ?>
					<?php foreach($questions as $question){?>
					<?php if(($_POST['privacy'] == 'all' || $_POST['privacy'] == $question['is_public']) && ($_POST['satisfaction'] == 'all' || $_POST['satisfaction'] == $question['satisfaction']) && ($_POST['status'] == 'all' || $_POST['status'] == $question['status'])){?>
					<tr>
						<td><a href="<?php echo BASE_URL_ADMIN.'question/consult/'.$question['id'];?>"><?php echo htmlentities($question['question_title']);?></a></td>
						<td><?php echo ($question['is_public'] == 1)?'Publié':'Non publié';?></td>
						<td><?php echo date('d/m/Y', strtotime($question['question_date']));?></td>
						<td><?php echo htmlentities($question['status']);?></td>
						<td><?php echo ($question['satisfaction'] != null)?htmlentities($question['satisfaction']):'?';?></td>
					</tr>
					<?php }?>
					<?php }?>
					<?php }else{?>
					<tr>
						<td colspan=5>Aucune donnée</td>
					</tr>
					<?php }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
