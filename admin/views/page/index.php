<h2>Liste des pages</h2>
<?php
if(!empty($listPage)){ 
?>
<table class="responsive-table striped">
    <thead>
        <tr>
            <th data-field="title">Titre</th>
            <th data-field="author">Auteur</th>
            <th data-field="date">Date de publication</th>
            <th data-field="action">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
    foreach($listPage as $page){
        $user = $this->registry->db->getUser($page['id_user']);
        ?>
        <tr>
            <td><a href="#"><?php echo $page['title']; ?></a></td>
            <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
            <td><?php echo date('\L\e d/m/Y \à H\hi', strtotime($page['date_publish'])); ?></td>
            <td>
                <a <?php echo(($page['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 'Administrateur ')?'href="'.BASE_URL_ADMIN.'page/edit/'.$page['id'].'"':'');?> 
                   class="waves-effect waves-light btn <?php echo(($page['id_user'] == $_SESSION['id'])?'':'disabled'); ?>">
                    Modifier
                    <i class="material-icons right">create</i> 
                </a> 
                <a <?php echo(($page['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 'Administrateur ')?'data-target="modal-'.$page['id'].'" class="btn modal-trigger"':'class="btn disabled"'); ?> >
                    <i class="material-icons">delete</i>
                </a> 
            </td>
        </tr>

        <div id="modal-<?php echo $page['id']; ?>" class="modal bottom-sheet">
            <div class="modal-content">
                <h4>Suppression</h4>
                <p>Êtes vous sûr de vouloir supprimer la page "<?php echo $page['title']; ?>" ?</p>
            </div>
            <div class="modal-footer">
                <a data-value="<?php echo $page['id']; ?>" 
                   class="delete-page modal-action modal-close waves-effect waves-green btn-flat">Oui</a>
                <a class="modal-action modal-close waves-effect waves-green btn-flat">Annuler</a>
            </div>
        </div> 
        <?php   
    }
        ?>
    </tbody>
</table>
<?php
} else{
?>
<h3>Aucune page pour le moment.</h3>
<?php 
}
?>
<br>
<a href="<?php echo BASE_URL_ADMIN.'page/add'; ?>" class="waves-effect waves-light btn">
    <i class="material-icons left">create</i>Créer une page
</a>