<div class="row">
    <h4>Rejoignez la plateforme <?php echo APP_TITLE;?></h4>
    <div class="col s12 l6 offset-l3">
        <ul class="tabs">
            <li class="tab col s6"><a class="active" href="#particulier">Je suis particulier</a></li>
            <li class="tab col s6"><a href="#praticien">Je suis praticien</a></li>
        </ul>
    </div>
    <div id="particulier" class="col s12">
        <p>Vous pouvez être inscrit à la plateforme et bénéficier des avantages suivants:</p>
        <ul>
            <li>- Poser des questions aux expert <?php echo APP_TITLE;?></li>
            <li>- Prendre rendez-vous pour une consultation physique ou e-consultation</li>
            <li>- Accès libre à la liste des praticiens</li>
            <li>- Noter un praticien</li>
        </ul>
        <form method="POST" action="<?php echo BASE_URL;?>signup" class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">person</i>
                <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo (isset($_POST['first_name']))?$_POST['first_name']:'';?>" required>
                <label for="first_name">Prénom *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">person</i>
                <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo (isset($_POST['last_name']))?$_POST['last_name']:'';?>" required>
                <label for="last_name">Nom *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">person</i>
                <input id="pseudo" name="pseudo" type="text" class="validate" value="<?php echo (isset($_POST['pseudo']))?$_POST['pseudo']:'';?>">
                <label for="pseudo">Pseudo</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">date_range</i>
                <input id="birthday" type="date" name="birthday" class="datepicker" value="<?php echo (isset($_POST['birthday']))?$_POST['birthday']:'';?>" required>
                <label for="birthday">Date de naissance *</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">place</i>
                <input id="address" name="address" type="text" class="validate" value="<?php echo (isset($_POST['address']))?$_POST['address']:'';?>" required>
                <label for="address">Adresse *</label>
            </div>
            <div class="input-field col s3">
                <i class="material-icons prefix">place</i>
                <input id="postal_code" name="postal_code" type="text" class="validate" pattern="[0-9]{5}" value="<?php echo (isset($_POST['postal_code']))?$_POST['postal_code']:'';?>" required>
                <label for="postal_code" data-error="Veuillez saisir un code à 5 chiffres">Code postal *</label>
            </div>
            <div class="input-field col s9">
                <i class="material-icons prefix">place</i>
                <input id="city" name="city" type="text" class="validate" value="<?php echo (isset($_POST['city']))?$_POST['city']:'';?>" required>
                <label for="city">Ville *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="phone" name="phone" type="text" class="validate" value="<?php echo (isset($_POST['phone']))?$_POST['phone']:'';?>" pattern="[0-9]{10}">
                <label for="phone" data-error="Veuillez saisir un numéro à 10 chiffres">Téléphone</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="mobile" name="mobile" type="text" class="validate" value="<?php echo (isset($_POST['mobile']))?$_POST['mobile']:'';?>" pattern="[0-9]{10}" required>
                <label for="mobile" data-error="Veuillez saisir un numéro à 10 chiffres">Portable *</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">contact_mail</i>
                <input id="email" name="email" type="email" class="validate" value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>" required>
                <label for="email" data-error="Veuillez saisir une adresse email valide">Email *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password" name="password" type="password" class="validate" required>
                <label for="password">Mot de passe *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password_confirmation" name="password_confirmation" type="password" class="validate" required>
                <label for="password_confirmation" data-error="Le mot de passe n'est pas identique">Confirmation mot de passe *</label>
            </div>
            <div class="col s12 l4 offset-l8">
                <button style="width:100%" class="btn waves-effect waves-light blue" type="submit" name="submit">Inscription<i class="material-icons right">send</i></button>
            </div>
            
            <input type="hidden" name="type" value="member">
        </form>
    </div>
    <div id="praticien" class="col s12">
        COMING SOON
    </div>
</div>