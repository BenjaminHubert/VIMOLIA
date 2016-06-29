<div class="row">
	<div class="col s12">
		<table class="table">
			<thead>
				<tr>
					<th>Type d'abonnement</th>
					<th>Description</th>
					<th>Montant</th>
					<th>Durée d'abonnement</th>
					<th>Status de l'abonnement</th>
				</tr>
			</thead>
			<tbody>
				<?php if($user_subscriptions){?>
				<?php foreach($user_subscriptions as $subscription){?>
				<tr>
					<td><?php echo htmlentities($subscription['name']);?></td>
					<td><?php echo htmlentities($subscription['description']);?></td>
					<td><?php echo htmlentities($subscription['amount'].' '.$subscription['currencycode']);?></td>
					<td><?php echo htmlentities($subscription['duration_days']);?> jours</td>
					<td><?php echo htmlentities($subscription['status']);?></td>
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