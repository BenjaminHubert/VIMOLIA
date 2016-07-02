<div class="fixed-action-btn hide-on-med-and-down" style="bottom: 45px; right: 24px;">
    <a class="btn-floating btn-large waves-effect waves-light BUTTON_BACKGROUND-COLOR" href="<?php echo BASE_URL_ADMIN;?>utilisateur/add">
        <i class="large material-icons">add</i>
    </a>
</div>
<a class="btn-floating btn-large waves-effect waves-light BUTTON_BACKGROUND-COLOR hide-on-large-only" href="<?php echo BASE_URL_ADMIN;?>utilisateur/add">
    <i class="large material-icons">add</i>
</a>
<h3>Utilisateurs</h3>

<table class="highlight bordered">
    <thead>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($users)){?>
        <?php foreach($users as $user){?>
        <?php if(in_array($user['id_status'], [1, 2, 3])){?>
        <tr>
            <td><?php echo htmlentities($user['first_name']);?></td>
            <td><?php echo htmlentities($user['last_name']);?></td>
            <td><?php echo htmlentities($user['email']);?></td>
            <td><?php echo htmlentities($user['role']);?></td>
            <td><?php echo htmlentities($user['status']);?></td>
            <?php if($user['id'] == $_SESSION['id']){?>
            <td> </td>
            <td> </td>
            <?php }else{?>
            <td><a class="edit-button" data-firstName="<?php echo htmlentities($user['first_name']);?>" data-lastName="<?php echo htmlentities($user['last_name']);?>" href="<?php echo BASE_URL_ADMIN.'utilisateur/edit/'.sha1($user['id']);?>">Editer</a></td>
            <td><a class="remove-button" data-firstName="<?php echo htmlentities($user['first_name']);?>" data-lastName="<?php echo htmlentities($user['last_name']);?>" href="<?php echo BASE_URL_ADMIN.'utilisateur/delete/'.sha1($user['id']);?>">Supprimer</a></td>

            <?php }?>
        </tr>
        <?php }?>
        <?php }?>
        <?php }else{?>
        <tr><td>Erreur</td></tr>
        <?php }?>
    </tbody>
</table>