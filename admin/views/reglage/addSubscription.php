<form action="" method="post">
	<div class="row">
		<div class="col s12">
			<h4>Créer un nouvel abonnement</h4>
			<div class="divider"></div>
		</div>
		<div class="input-field col s12 m6">
			<input id="name" name="name" type="text" value="<?php echo ($_POST['name'])??'';?>" required>
        	<label for="name">Nom de l'offre</label>
		</div>
		<div class="input-field col s12 m6">
			<textarea id="description" name="description" class="materialize-textarea" length="250" required><?php echo ($_POST['description'])??'';?></textarea>
        	<label for="description">Description</label>
		</div>
		<div class="input-field col s6 m3">
			<input id="amount" name="amount" type="number" step="0.01" min="0.01" class="validate" style="text-align:right" value="<?php echo ($_POST['amount'])??'';?>" required>
        	<label for="amount" data-error="Veuillez saisir un montant valide">Montant</label>
		</div>
		<div class="input-field col s6 m3">
			<select name="currencycode" id="currencycode" required>
		    	<option value="EUR" <?php echo (isset($_POST['currencycode']) && $_POST['currencycode'] == 'EUR')?'selected':'';?>>EUR (€)</option>
		    	<option value="USD" <?php echo (isset($_POST['currencycode']) && $_POST['currencycode'] == 'USD')?'selected':'';?>>USD ($)</option>
		    </select>
		</div>
		<div class="input-field col s12 m6">
			<input id="duration_days" name="duration_days" type="number" step="1" min="1" class="validate" value="<?php echo ($_POST['duration_days'])??'';?>" required>
        	<label for="duration_days" data-error="Veuillez saisir un nombre de jours valide">Nombre de jours</label>
		</div>
	</div>
	
	<div class="row">
		<div class="col s12">
			<button class="btn BUTTON_BACKGROUND-COLOR waves-effect waves-light right" type="submit">
				Ajouter
		    	<i class="material-icons right">send</i>
		  	</button>
		</div>
	</div>
</form>