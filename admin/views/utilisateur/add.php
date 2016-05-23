<h3>Ajouter un utilisateur</h3>
<p>Créer un nouvel utilisateur et l’ajouter à ce site.</p>

<form action="" method="post">
    <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input id="first_name" name="first_name" type="text" class="validate" required>
            <label for="first_name">Prénom *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input id="last_name" name="last_name" type="text" class="validate" required>
            <label for="last_name">Nom *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">date_range</i>
            <input id="birthday" type="date" name="birthday" class="datepicker" required>
            <label for="birthday">Date de naissance *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">contact_mail</i>
            <input id="email" name="email" type="email" class="validate" required>
            <label for="email" data-error="Veuillez saisir une adresse email valide">Email *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">vpn_key</i>
            <input id="password" name="password" type="password" class="validate" required>
            <label for="password">Mot de passe *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">vpn_key</i>
            <input id="password_confirmation" name="password_confirmation" type="password" class="validate" required>
            <label for="password_confirmation" data-error="Le mot de passe n'est pas identique">Confirmation mot de passe *</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">list</i>
            <select name="role" required>
                <option value="" disabled selected>Aucun sélectionné</option>
                <?php foreach($roles as $role){?>
                <option><?php echo $role;?></option>
                <?php }?>
            </select>
            <label>Rôle</label>
        </div>
        <div class="input-field col s12">
            <input type="checkbox" id="send_mail" name="send_mail">
            <label for="send_mail">Envoyer un message au nouvel utilisateur à propos de son compte.</label>
        </div>
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light blue" type="submit" name="submit">Ajouter<i class="material-icons right">send</i></button>
        </div>
    </div>
</form>