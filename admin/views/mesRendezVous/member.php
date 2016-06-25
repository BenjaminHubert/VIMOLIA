<div class="row">
	<div class="col s12">
		<table>
			<thead>
				<tr>
					<th>Praticien</th>
					<th colspan="2" style="text-align:center">Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php if($appointments){?>
				<?php foreach($appointments as $appointment){?>
				<tr data-id-appointment="<?php echo $appointment['id'];?>">
					<!-- NAME -->
					<td><a target="_blank" href="<?php echo BASE_URL.'praticien/profile/'.$appointment['id_doctor'];?>"><?php echo $appointment['first_name_doctor'].' '.$appointment['last_name_doctor'];?></a></td>
					<!-- IS VALIDATED -->
					<td style="text-align:right">
						<div class="chip chip-is-validated"><?php echo ($appointment['is_validated'] == 0)?'Non consulté':'Consulté';?></div>
					</td>
					<!-- IS CANCEL -->
					<td style="text-align:left">
						<div class="chip chip-is-canceled"><?php echo ($appointment['is_canceled'] == 0)?'Non annulé':'Annulé';?></div>
					</td>
					<!-- ACTION BUTTON -->
					<?php if($appointment['is_canceled'] == 0 && $appointment['is_validated'] == 0){?>
					<td style="text-align:right"><a class="waves-effect waves-light btn green lighten-2 cancel" data-id-appointment="<?php echo $appointment['id'];?>"><i class="material-icons right">cancel</i>Annuler le rdv</a></td>
					<?php }elseif($appointment['is_validated'] == 1 && $appointment['rating'] == null){?>
					<td style="text-align:right"><a class="waves-effect waves-light btn green lighten-2 rate" data-id-appointment="<?php echo $appointment['id'];?>"><i class="material-icons right">star_rate</i>Noter</a></td>
					<?php }elseif($appointment['is_validated'] == 1 && $appointment['rating'] != null){?>
					<td style="text-align:right"><a class="waves-effect waves-light btn green lighten-2 watch" data-id-appointment="<?php echo $appointment['id'];?>"><i class="material-icons right">history</i>Voir</a></td>
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