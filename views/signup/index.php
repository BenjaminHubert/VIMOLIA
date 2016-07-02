<div class="row">
    <h4>Rejoignez la plateforme <?php echo APP_TITLE;?></h4>
    <div class="col s12 l6 offset-l3">
        <ul class="tabs">
            <li class="tab col s6"><a class="<?php echo (!isset($_POST['type']) || (isset($_POST['type']) && $_POST['type'] == 'member'))?'active':'';?>" href="#particulier">Je suis particulier</a></li>
            <li class="tab col s6"><a class="<?php echo (isset($_POST['type']) && $_POST['type'] == 'doctor')?'active':'';?>"  href="#praticien">Je suis praticien</a></li>
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
        <form method="POST" action="<?php echo BASE_URL;?>signup" class="row" enctype="multipart/form-data">
            <div class="input-field col s4">
                <i class="material-icons prefix">person</i>
                <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo (isset($_POST['first_name']) && $_POST['type'] == 'member')?htmlentities($_POST['first_name']):'';?>" required>
                <label for="first_name">Prénom *</label>
            </div>
            <div class="input-field col s4">
                <i class="material-icons prefix">person</i>
                <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo (isset($_POST['last_name']) && $_POST['type'] == 'member')?htmlentities($_POST['last_name']):'';?>" required>
                <label for="last_name">Nom *</label>
            </div>
            <div class="input-field col s4">
                <i class="material-icons prefix">date_range</i>
                <input id="birthday" type="date" name="birthday" class="datepicker" value="<?php echo (isset($_POST['birthday']) && $_POST['type'] == 'member')?htmlentities($_POST['birthday']):'';?>" required>
                <label for="birthday">Date de naissance *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">person</i>
                <input id="pseudo" name="pseudo" type="text" class="validate" value="<?php echo (isset($_POST['pseudo']) && $_POST['type'] == 'member')?htmlentities($_POST['pseudo']):'';?>">
                <label for="pseudo">Pseudo</label>
            </div>
            <div class="file-field input-field col s6">
                <div class="btn">
                    <span>Avatar</span>
                    <input type="file" accept="image/*" name="avatar_file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" name="url_avatar">
                </div>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">place</i>
                <input id="address" name="address" type="text" class="validate" value="<?php echo (isset($_POST['address']) && $_POST['type'] == 'member')?htmlentities($_POST['address']):'';?>" required>
                <label for="address">Adresse *</label>
            </div>
            <div class="input-field col s3">
                <i class="material-icons prefix">place</i>
                <input id="postal_code" name="postal_code" type="text" class="validate" pattern="[0-9]{5}" value="<?php echo (isset($_POST['postal_code']) && $_POST['type'] == 'member')?htmlentities($_POST['postal_code']):'';?>" required>
                <label for="postal_code" data-error="Veuillez saisir un code à 5 chiffres">Code postal *</label>
            </div>
            <div class="input-field col s9">
                <i class="material-icons prefix">place</i>
                <input id="city" name="city" type="text" class="validate" value="<?php echo (isset($_POST['city']) && $_POST['type'] == 'member')?htmlentities($_POST['city']):'';?>" required>
                <label for="city">Ville *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="phone" name="phone" type="text" class="validate" value="<?php echo (isset($_POST['phone']) && $_POST['type'] == 'member')?htmlentities($_POST['phone']):'';?>" pattern="[0-9]{10}">
                <label for="phone" data-error="Veuillez saisir un numéro à 10 chiffres">Téléphone</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="mobile" name="mobile" type="text" class="validate" value="<?php echo (isset($_POST['mobile']) && $_POST['type'] == 'member')?htmlentities($_POST['mobile']):'';?>" pattern="[0-9]{10}" required>
                <label for="mobile" data-error="Veuillez saisir un numéro à 10 chiffres">Portable *</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">contact_mail</i>
                <input id="email" name="email" type="email" class="validate" value="<?php echo (isset($_POST['email']) && $_POST['type'] == 'member')?htmlentities($_POST['email']):'';?>" required>
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
                <button style="width:100%" class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" name="submit">Inscription<i class="material-icons right">send</i></button>
            </div>

            <input type="hidden" name="type" value="member">
        </form>
    </div>
    <div id="praticien" class="col s12">
        <p>Vous avez la possibilité d'être membre du club et bénéficier des avantages suivants:</p>
        <ul>
            <li>- Recevoir des patients en consultation</li>
            <li>- Avoir une page partenaire publique</li>
            <li>- Obtenir une notation de la part des patients</li>
        </ul>
        <h5>Etape 1: Vos informations</h5>
        <form method="POST" action="<?php echo BASE_URL;?>signup" class="row" enctype="multipart/form-data">
            <div class="input-field col s4">
                <i class="material-icons prefix">person</i>
                <input id="first_name" name="first_name" type="text" class="validate" value="<?php echo (isset($_POST['first_name']) && $_POST['type'] == 'doctor')?htmlentities($_POST['first_name']):'';?>" required>
                <label for="first_name">Prénom *</label>
            </div>
            <div class="input-field col s4">
                <i class="material-icons prefix">person</i>
                <input id="last_name" name="last_name" type="text" class="validate" value="<?php echo (isset($_POST['last_name']) && $_POST['type'] == 'doctor')?htmlentities($_POST['last_name']):'';?>" required>
                <label for="last_name">Nom *</label>
            </div>
            <div class="input-field col s4">
                <i class="material-icons prefix">date_range</i>
                <input id="birthday" type="date" name="birthday" class="datepicker" value="<?php echo (isset($_POST['birthday']) && $_POST['type'] == 'doctor')?htmlentities($_POST['birthday']):'';?>" required>
                <label for="birthday">Date de naissance *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">person</i>
                <input id="pseudo" name="pseudo" type="text" class="validate" value="<?php echo (isset($_POST['pseudo']) && $_POST['type'] == 'doctor')?htmlentities($_POST['pseudo']):'';?>">
                <label for="pseudo">Pseudo</label>
            </div>
            <div class="file-field input-field col s6">
                <div class="btn">
                    <span>Avatar</span>
                    <input type="file" accept="image/*" name="avatar_file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" name="url_avatar">
                </div>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">place</i>
                <input id="address" name="address" type="text" class="validate" value="<?php echo (isset($_POST['address']) && $_POST['type'] == 'doctor')?htmlentities($_POST['address']):'';?>" required>
                <label for="address">Adresse *</label>
            </div>
            <div class="input-field col s3">
                <i class="material-icons prefix">place</i>
                <input id="postal_code" name="postal_code" type="text" class="validate" pattern="[0-9]{5}" value="<?php echo (isset($_POST['postal_code']) && $_POST['type'] == 'doctor')?htmlentities($_POST['postal_code']):'';?>" required>
                <label for="postal_code" data-error="Veuillez saisir un code à 5 chiffres">Code postal *</label>
            </div>
            <div class="input-field col s9">
                <i class="material-icons prefix">place</i>
                <input id="city" name="city" type="text" class="validate" value="<?php echo (isset($_POST['city']) && $_POST['type'] == 'doctor')?htmlentities($_POST['city']):'';?>" required>
                <label for="city">Ville *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="phone" name="phone" type="text" class="validate" value="<?php echo (isset($_POST['phone']) && $_POST['type'] == 'doctor')?htmlentities($_POST['phone']):'';?>" pattern="[0-9]{10}">
                <label for="phone" data-error="Veuillez saisir un numéro à 10 chiffres">Téléphone</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">contact_phone</i>
                <input id="mobile" name="mobile" type="text" class="validate" value="<?php echo (isset($_POST['mobile']) && $_POST['type'] == 'doctor')?htmlentities($_POST['mobile']):'';?>" pattern="[0-9]{10}" required>
                <label for="mobile" data-error="Veuillez saisir un numéro à 10 chiffres">Portable *</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">contact_mail</i>
                <input id="email" name="email" type="email" class="validate" value="<?php echo (isset($_POST['email']) && $_POST['type'] == 'doctor')?htmlentities($_POST['email']):'';?>" required>
                <label for="email" data-error="Veuillez saisir une adresse email valide">Email *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password" name="password" type="password" class="validate" value="<?php echo (isset($_POST['password']) && $_POST['type'] == 'doctor')?htmlentities($_POST['password']):'';?>" required>
                <label for="password">Mot de passe *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password_confirmation" name="password_confirmation" type="password" class="validate" value="<?php echo (isset($_POST['password_confirmation']) && $_POST['type'] == 'doctor')?htmlentities($_POST['password_confirmation']):'';?>" required>
                <label for="password_confirmation" data-error="Le mot de passe n'est pas identique">Confirmation mot de passe *</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">list</i>
                <select name="specialities[]" required multiple>
                    <option value="" disabled selected>Aucune sélectionnée</option>
                    <?php foreach($skills as $skill){?>
                    <option <?php echo (isset($_POST['specialities']) && in_array($skill, $_POST['specialities']) )?'selected':'';?>><?php echo htmlentities($skill);?></option>
                    <?php }?>
                </select>
                <label>Sélectionner vos spécialités</label>
            </div>
            <div class="input-field col s6">
                <i class="material-icons prefix">note</i>
                <input id="siret" name="siret" type="text" class="validate" pattern="[0-9]{14}" value="<?php echo (isset($_POST['siret']) && $_POST['type'] == 'doctor')?htmlentities($_POST['siret']):'';?>" required>
                <label for="siret" data-error="Veuillez saisir un numéro de SIRET valide">SIRET *</label>
            </div>
            <div class="input-field col s12">
                <textarea id="presentation" name="presentation" class="materialize-textarea" required><?php echo (isset($_POST['presentation']) && $_POST['type'] == 'doctor')?htmlentities($_POST['presentation']):'';?></textarea>
                <label for="presentation">Présentation</label>
            </div>
            <div class="input-field col s12">
                <h5>Etape 2: Choix de l'abonnement</h5>
                <img style="width: 30%;" class="responsive-img" src="<?php echo BASE_URL;?>img/paypal.png">
            </div>
            <?php foreach($subscriptionTypes as $subscriptionType){?>
            <div class="input-field col s12 m4 l4">
                <h6 class="center-align" style="font-weight:bold"><?php echo htmlentities($subscriptionType['name']);?></h6>
                <div class="card-panel light-blue lighten-5">
                    <p class="center-align"><?php echo htmlentities($subscriptionType['description']);?></p>
                    <p class="center-align"><?php echo htmlentities($subscriptionType['amount'].$subscriptionType['currencycode']);?> pour <?php echo htmlentities($subscriptionType['duration_days']);?> jours</p>
                    <p>
                        <input class="with-gap" name="subscription_type" value="<?php echo $subscriptionType['id'];?>" type="radio" id="<?php echo htmlentities($subscriptionType['name']);?>" checked>
                        <label for="<?php echo htmlentities($subscriptionType['name']);?>">Je choisis cette option</label>
                    </p>
                </div>
            </div>
            <?php }?>
            <div class="input-field col s12">
                <input type="checkbox" id="agreement" name="agreement" <?php echo (isset($_POST['agreement']) && $_POST['type'] == 'doctor')?'checked':'';?>>
                <label for="agreement">J'accepte les conditions générales d'utilisation de <?php echo APP_TITLE;?></label>
            </div>
            <div class="input-field col s12 l4 offset-l8">
                <button style="width:100%" class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" name="submit">Inscription<i class="material-icons right">send</i></button>
            </div>
            <input type="hidden" name="type" value="doctor">
        </form>
    </div>
</div>