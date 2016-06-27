<h3>Editer un utilisateur</h3>

<p style="font-style:italic">Date d'inscription: <?php echo date('Y-m-d H:i:s', strtotime($user['date_inscription']));?></p>
<form action="<?php echo BASE_URL_ADMIN.'utilisateur/edit'.'/'.sha1($user['id']);?>" method="post">
    <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input id="first_name" name="first_name" type="text" class="validate" required value="<?php echo (isset($_POST['first_name']))? htmlentities($_POST['first_name']) : htmlentities($user['first_name']) ;?>">
            <label for="first_name">Prénom *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input id="last_name" name="last_name" type="text" class="validate" required value="<?php echo (isset($_POST['last_name']))? htmlentities($_POST['last_name']) : htmlentities($user['last_name'])  ;?>">
            <label for="last_name">Nom *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">date_range</i>
            <input id="birthday" type="date" name="birthday" class="datepicker" required data-value="<?php echo (isset($_POST['birthday_submit']))? htmlentities($_POST['birthday_submit']) : htmlentities($user['birthday_date']) ;?>">
            <label for="birthday">Date de naissance *</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">contact_mail</i>
            <input id="email" name="email" type="email" class="validate" required value="<?php echo (isset($_POST['email']))? htmlentities($_POST['email']) : htmlentities($user['email']) ;?>">
            <label for="email" data-error="Veuillez saisir une adresse email valide">Email *</label>
        </div>
        <div class="input-field col s6">
            <i class="material-icons prefix">list</i>
            <select name="role" disabled>
                <option><?php echo $user['role'];?></option>
            </select>
            <label>Rôle</label>
        </div>
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light blue" type="submit" name="submit">Ajouter<i class="material-icons right">send</i></button>
        </div>
    </div>
    <input type="hidden" value="<?php echo $user['id'];?>">
</form>