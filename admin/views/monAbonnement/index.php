<div class="row">
	<div class="col s12">
		<table class="table">
			<thead>
				<tr>
					<th>Type d'abonnement</th>
					<th>Description</th>
					<th>Montant</th>
					<th>Date de validité</th>
				</tr>
			</thead>
			<tbody>
				<?php if($user_subscriptions){?>
				<?php foreach($user_subscriptions as $subscription){?>
				<tr>
					<td><?php echo htmlentities($subscription['name']);?></td>
					<td><?php echo htmlentities($subscription['description']);?></td>
					<td><?php echo htmlentities($subscription['amount'].' '.$subscription['currencycode']);?></td>
					<td><?php echo htmlentities(date('d/m/Y', strtotime($subscription['start_date'])).' au '.date('d/m/Y', strtotime($subscription['end_date'])));?></td>
				</tr>
				<?php }?>
				<?php }else{?>
				<tr>
					<td colspan="5" class="center">Aucun abonnement en cours</td>
				</tr>
				<?php }?>
			</tbody>
		</table>
	</div>
</div>