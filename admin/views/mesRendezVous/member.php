<div class="row">
	<div class="col s12">
		<table>
			<thead>
				<tr>
					<th>Praticien</th>
					<th colspan="2" style="text-align:center">Statut</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if($appointments){?>
				<?php foreach($appointments as $appointment){?>
				<tr data-id-appointment="<?php echo $appointment['id'];?>">
					<!-- NAME -->
					<td><a target="_blank" href="<?php echo BASE_URL.'praticien/profile/'.$appointment['id_doctor'];?>"><?php echo htmlentities($appointment['first_name_doctor'].' '.$appointment['last_name_doctor']);?></a></td>
					<!-- IS VALIDATED -->
					<td style="text-align:right">
						<?php if($appointment['is_canceled'] == 1){?>
						<!--  nothing -->
						<?php }elseif($appointment['is_validated'] == 0){?>
						<div class="chip chip-is-validated">Non consulté</div>
						<?php }elseif($appointment['is_validated'] == 1){?>
						<div class="chip chip-is-validated">Consulté</div>
						<?php }?>
					
					
					</td>
					<!-- IS CANCEL -->
					<td style="text-align:left">
						<?php if($appointment['is_validated'] == 1){?>
						<!--  nothing -->
						<?php }elseif($appointment['is_canceled'] == 0){?>
						<div class="chip chip-is-canceled">Non annulé</div>
						<?php }elseif($appointment['is_canceled'] == 1){?>
						<div class="chip chip-is-canceled">Annulé</div>
						<?php }?>
					</td>
					<!-- ACTION BUTTON -->
					<?php if($appointment['is_canceled'] == 0 && $appointment['is_validated'] == 0){?>
					<td style="text-align:right"><a class="waves-effect waves-light btn BUTTON_BACKGROUND-COLOR cancel" data-id-appointment="<?php echo $appointment['id'];?>"><i class="material-icons right">cancel</i>Annuler le rdv</a></td>
					<?php }elseif($appointment['is_validated'] == 1 && $appointment['rating'] == null){?>
					<td style="text-align:right"><a href="#rate-modal" class="modal-trigger waves-effect waves-light btn BUTTON_BACKGROUND-COLOR rate" data-id-appointment="<?php echo $appointment['id'];?>"><i class="material-icons right">star_border</i>Noter</a></td>
					<?php }elseif($appointment['is_validated'] == 1 && $appointment['rating'] != null){?>
					<td style="text-align:right"><a href="#history-modal" class="modal-trigger waves-effect waves-light btn BUTTON_BACKGROUND-COLOR watch" data-id-appointment="<?php echo $appointment['id'];?>" data-rate="<?php echo $appointment['rating'];?>" data-comment="<?php echo htmlentities($appointment['recommendation']);?>" ><i class="material-icons right">history</i>Voir</a></td>
					<?php }?>
				</tr>
				<?php }?>
				<?php }else{?>
				<tr>
					<td colspan="4" style="text-align:center">Aucun rendez-vous</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>

<!-- MODAL RATE -->
<form action="" method="post" class="rate-appointment">
	<div id="rate-modal" class="modal bottom-sheet">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">
					<p>Afin de conserver un service de qualité, n'hésitez pas à nous faire un retour de cette prestation en répondant au formulaire suivant</p>
				</div>
				<div class="col s12 m6">
					<select id="rate-select">
						<option value=""></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="col s12 m6 input-field">
					<textarea id="comment" class="materialize-textarea" length="1000"></textarea>
	          		<label for="comment">Commentaire</label>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="modal-action waves-effect waves-light green lighten-2 btn-flat">Valider</button>
			<button type="button" class="modal-action modal-close waves-effect waves-red btn-flat">Annuler</button>
		</div>
	</div>
</form>
<!-- MODAL HISTORY -->
<form action="" method="post" class="history-appointment">
	<div id="history-modal" class="modal bottom-sheet">
		<div class="modal-content">
			<div class="row">
				<div class="col s12">
					<select id="history-select">
						<option value=""></option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="col s12">
					<p class="comment"></p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="modal-action modal-close waves-effect waves-red btn-flat">Fermer</button>
		</div>
	</div>
</form>

<!-- Rating library -->
<!-- Doc: http://antenna.io/demo/jquery-bar-rating/examples/ -->
<script src="<?php echo BASE_URL;?>js/jquery.barrating.min.js"></script>
<link rel="stylesheet" href="<?php echo BASE_URL;?>css/css-stars.css">