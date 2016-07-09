<div class="row">
	<div class="input-field col s12 center">
		<h4>Modification du mot de passe</h4>
	</div>
	<form action="" method="post">
		<div class="col card s12 m6 offset-m3 l4 offset-l4">
			<div class="row">
				<div class="input-field col s12">
					<input id="currentPassword" name="currentPassword" type="password" required autofocus>
			        <label for="currentPassword">Mot de passe actuel</label>
				</div>
				<div class="input-field col s12">
					<input id="newPassword" name="newPassword" type="password" required>
			        <label for="newPassword">Nouveau mot de passe</label>
				</div>
				<div class="input-field col s12">
					<input id="newPasswordConfirmation" name="newPasswordConfirmation" type="password" required>
			        <label for="newPasswordConfirmation">Confirmation du nouveau mot de passe</label>
				</div>
				<div class="col s12">
					<button class="btn waves-effect waves-light right BUTTON_BACKGROUND-COLOR" type="submit" name="update">
					VALIDER
				    	<i class="material-icons right">send</i>
				  	</button>
				</div>
			</div>
		</div>
	</form>
</div>