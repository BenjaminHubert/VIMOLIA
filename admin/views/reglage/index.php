<!-- SCROLLSPY -->
<div class="row">
	<div class="col hide-on-med-and-down">
		<div class="toc-wrapper">
			<div style="height: 1px;">
				<ul class="section table-of-contents">
					<li><a href="#colors-section">Couleur</a></li>
					<li><a href="#subscription-section">Abonnements</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- COLORS SECTION -->
<div id="colors-section" class="row scrollspy" style="border: solid 1px grey; margin-top:10px; padding: 10px;">
	<form action="<?php echo BASE_URL_ADMIN;?>reglage/updateColors" method="post">
		<div class="col s12">
			<h4>Couleurs</h4>
			<div class="divider"></div>
		</div>
		
		<div class="col s12 m6">
			<h5>Barre horizontale haut de page</h5>
			<label for="HEADER_BACKGROUND-COLOR">Couleur d'arrière plan</label>
			<input id="HEADER_BACKGROUND-COLOR" name="HEADER_BACKGROUND-COLOR" type="text" value="<?php echo $_SETTINGS['HEADER_BACKGROUND-COLOR'];?>" class="colorpicker right">
		</div>
		
		<div class="col s12 m6">
			<h5>Pied de page</h5>
			<label for="FIRST_FOOTER_BACKGROUND-COLOR">Couleur d'arrière plan</label>
			<input id="FIRST_FOOTER_BACKGROUND-COLOR" name="FIRST_FOOTER_BACKGROUND-COLOR" type="text" value="<?php echo $_SETTINGS['FIRST_FOOTER_BACKGROUND-COLOR'];?>" class="colorpicker right">
		</div>
		
		<div class="col s12 m6">
			<h5>Copyright</h5>
			<label for="SECOND_FOOTER_BACKGROUND-COLOR">Couleur d'arrière plan</label>
			<input id="SECOND_FOOTER_BACKGROUND-COLOR" name="SECOND_FOOTER_BACKGROUND-COLOR" type="text" value="<?php echo $_SETTINGS['SECOND_FOOTER_BACKGROUND-COLOR'];?>" class="colorpicker right">
		</div>
		
		<div class="col s12 m6">
			<h5>Boutons</h5>
			<label for="BUTTON_BACKGROUND-COLOR">Couleur d'arrière plan</label>
			<input id="BUTTON_BACKGROUND-COLOR" name="BUTTON_BACKGROUND-COLOR" type="text" value="<?php echo $_SETTINGS['BUTTON_BACKGROUND-COLOR'];?>" class="colorpicker right">
		</div>
		
		<div class="col s12 m6">
			<h5>Couleur primaire</h5>
			<label for="PRIMARY_BACKGROUND-COLOR">Couleur d'arrière plan</label>
			<input id="PRIMARY_BACKGROUND-COLOR" name="PRIMARY_BACKGROUND-COLOR" type="text" value="<?php echo $_SETTINGS['PRIMARY_BACKGROUND-COLOR'];?>" class="colorpicker right">
			<br>
			<br>
			<label for="PRIMARY_COLOR">Couleur de texte</label>
			<input id="PRIMARY_COLOR" name="PRIMARY_COLOR" type="text" value="<?php echo $_SETTINGS['PRIMARY_COLOR'];?>" class="colorpicker right">
		</div>
		
		<div class="col s12 m6">
			<h5>Couleur secondaire</h5>
			<label for="ACCENT_BACKGROUND-COLOR">Couleur d'arrière plan</label>
			<input id="ACCENT_BACKGROUND-COLOR" name="ACCENT_BACKGROUND-COLOR" type="text" value="<?php echo $_SETTINGS['ACCENT_BACKGROUND-COLOR'];?>" class="colorpicker right">
			<br>
			<br>
			<label for="ACCENT_COLOR">Couleur de texte</label>
			<input id="ACCENT_COLOR" name="ACCENT_COLOR" type="text" value="<?php echo $_SETTINGS['ACCENT_COLOR'];?>" class="colorpicker right">
		</div>
		
		<div class="col s4 offset-s8">
			<br>
			<button class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" style="width:100%" name="updateColors">Valider
				<i class="material-icons right">send</i>
			</button>
		</div>
	</form>
</div>
<!-- SUBSCRIPTION SECTION -->
<div id="subscription-section" class="row scrollspy" style="border: solid 1px grey; margin-top:10px; padding: 10px;">
	<div class="col s12">
		<h4>Abonnements</h4>
		<div class="divider"></div>
	</div>
	<div class="col s12">
		<a href="<?php echo BASE_URL_ADMIN;?>reglage/subscription/add" class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR right" type="button">
			<i class="material-icons">add</i>
		</a>
	</div>
	<form action="" method="post">
		<table class="table">
			<thead>
				<tr>
					<td>Nom de l'offre</td>
					<td>Description</td>
					<td>Montant</td>
					<td>Durée (jours)</td>
					<td>Dernière mise à jour</td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php if($subscriptionTypes){?>
				<?php foreach($subscriptionTypes as $subscriptionType){?>
				<tr>
					<td><?php echo $subscriptionType['name'];?></td>
					<td><?php echo $subscriptionType['description'];?></td>
					<td><?php echo $subscriptionType['amount'].' '.$subscriptionType['currencycode'];?></td>
					<td><?php echo $subscriptionType['duration_days'];?></td>
					<td><?php echo date('d/m/Y H:i:s', strtotime($subscriptionType['last_update']));?></td>
					<td>
						<a class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="button">
							<i class="material-icons">edit</i>
						</a>
					</td>
					<td>
						<a class="btn waves-effect waves-light red lighten-3" type="button">
							<i class="material-icons">delete</i>
						</a>
					</td>
				</tr>
				<?php }?>
				<?php }else{?>
				<tr><td colspan="7" class="center">Aucun abonnement existant sur le site</td></tr>
				<?php }?>
			</tbody>
		</table>
	</form>
</div>
<script src="<?php echo BASE_URL;?>js/jqColorPicker.min.js"></script>