<form method="post" action=""  enctype="multipart/form-data">
	<div class="row">
		<div class="col s12">
			<h4>Besoin de plus de détails sur votre question ?</h4>
			<p>Merci de remplir ce questionnaire qui nous permettra d'avoir tous les éléments nécéssaires pour vous rediriger vers le ou les praticiens qui correspondent le mieux à votre demande.</p>
			<br><br>
		</div>
		<div class="input-field col s12 m6 l4">
			<input type="text" id="last_name" name="last_name" value="<?php echo htmlentities($_SESSION['last_name']);?>" readonly> <label for="last_name">Nom*</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 l4">
			<input type="text" id="first_name" name="first_name" value="<?php echo htmlentities($_SESSION['first_name']);?>" readonly> <label for="first_name">Prénom*</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 l4">
			<input type="number" id="age" name="age" class="validate" min=0 max=125  value="<?php echo DateTime::createFromFormat('Y-m-d', $_SESSION['birthday_date'])->diff(new DateTime('now'))->y;?>" required> <label for="age" data-error="L'age doit être un nombre compris entre 0 et 125">Âge*</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 l4">
			<input type="text" id="city" name="city" value="<?php echo (isset($_POST['city']))?htmlentities($_POST['city']):htmlentities($_SESSION['city']);?>" required> <label for="city">Ville*</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 l4">
			<textarea id="symptoms" placeholder="Décrivez vos symptômes ici" name="symptoms" class="materialize-textarea" required><?php echo (isset($_POST['symptoms']))?htmlentities($_POST['symptoms']):'';?></textarea>
			<label for="symptoms">Symptômes*</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 l4">
			<textarea id="particularPains" placeholder="Décrivez vos douleurs ici" name="particularPains" class="materialize-textarea"><?php echo (isset($_POST['particularPains']))?htmlentities($_POST['particularPains']):'';?></textarea>
			<label for="particularPains">Douleurs particulières ?</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 l4">
			<textarea id="antecedents" placeholder="Décrivez vos éventuels antécédents ici" name="antecedents" class="materialize-textarea"><?php echo (isset($_POST['antecedents']))?htmlentities($_POST['antecedents']):'';?></textarea>
			<label for="antecedents">Antécédents</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 l4">
			<textarea id="usefulInfo" placeholder="Indiquer d'autres informations pouvant aider à la compréhension de votre cas ici" name="usefulInfo" class="materialize-textarea"><?php echo (isset($_POST['usefulInfo']))?htmlentities($_POST['usefulInfo']):'';?></textarea>
			<label for="usefulInfo">Autres informations utiles</label>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="file-field input-field col s12 m6">
			<p>Dossier médical (10 Mo autorisé)</p>
			<div class="btn">
				<span>Parcourir</span> <input type="file" accept=".zip" name="medicalFile" required>
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text" placeholder="Fichier ZIP seulement">
			</div>
		</div>
		<div class="col s12 m6 offset-m3 l8 offset-l3"></div>
		<div class="input-field col s12 m6 offset-m3 right">
			<button class="btn waves-effect waves-light" type="submit" name="valider">
				Valider <i class="material-icons right">send</i>
			</button>
		</div>
	</div>
</form>