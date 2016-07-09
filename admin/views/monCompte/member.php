<form action="" enctype="multipart/form-data" method="post">
		<div class="row">
			<div class="col s12">
				<img class="right hide-on-med-and-down materialboxed" width="100" src="<?php echo htmlentities($_SESSION['url_avatar']);?>">
				<h4>Mon compte</h4>
			</div>
			<div class="input-field col s4">
                <i class="material-icons prefix">person</i>
                <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo htmlentities($_SESSION['first_name']);?>" required>
                <label for="first_name">Prénom *</label>
            </div>
            <div class="input-field col s4">
                <i class="material-icons prefix">person</i>
                <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo htmlentities($_SESSION['last_name']);?>" required>
                <label for="last_name">Nom *</label>
            </div>
            <div class="input-field col s4">
                <i class="material-icons prefix">date_range</i>
                <input id="birthday" type="date" name="birthday" class="datepicker" data-value="<?php echo htmlentities($_SESSION['birthday_date']);?>" required>
                <label for="birthday">Date de naissance *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">person</i>
                <input id="pseudo" name="pseudo" type="text" class="validate" value="<?php echo htmlentities($_SESSION['pseudo']);?>">
                <label for="pseudo">Pseudo</label>
            </div>
            <div class="file-field input-field col s6">
                <div class="btn BUTTON_BACKGROUND-COLOR">
                    <span>Avatar</span>
                    <input type="file" accept="image/*" name="avatar_file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">place</i>
                <input id="address" name="address" type="text" class="validate" value="<?php echo htmlentities($_SESSION['address']);?>" required>
                <label for="address">Adresse *</label>
            </div>
            <div class="input-field col s3">
                <i class="material-icons prefix">place</i>
                <input id="postal_code" name="postal_code" type="text" class="validate" pattern="[0-9]{5}" value="<?php echo htmlentities($_SESSION['postal_code']);?>" required>
                <label for="postal_code" data-error="Veuillez saisir un code à 5 chiffres">Code postal *</label>
            </div>
            <div class="input-field col s9">
                <i class="material-icons prefix">place</i>
                <input id="city" name="city" type="text" class="validate" value="<?php echo htmlentities($_SESSION['city']);?>" required>
                <label for="city">Ville *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="phone" name="phone" type="text" class="validate" value="<?php echo htmlentities($_SESSION['phone']);?>" pattern="[0-9]{10}">
                <label for="phone" data-error="Veuillez saisir un numéro à 10 chiffres">Téléphone</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="mobile" name="mobile" type="text" class="validate" value="<?php echo htmlentities($_SESSION['mobile']);?>" pattern="[0-9]{10}" required>
                <label for="mobile" data-error="Veuillez saisir un numéro à 10 chiffres">Portable *</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">contact_mail</i>
                <input id="email" name="email" type="email" class="validate" value="<?php echo htmlentities($_SESSION['email']);?>" required>
                <label for="email" data-error="Veuillez saisir une adresse email valide">Email *</label>
            </div>
            <div class="col s12 l4 offset-l8">
                <button style="width:100%" class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" name="submit">Inscription<i class="material-icons right">send</i></button>
            </div>
		</div>
</form>