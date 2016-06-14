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
                    <td><?php echo $page['title']; ?></td>
                    <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
                    <td><?php echo date('\L\e d/m/Y \à H\hi', strtotime($page['date_publish'])); ?></td>
                    <td>
                        <a <?php echo(($page['id_user'] == $_SESSION['id'])?'href="'.BASE_URL_ADMIN.'page/edit/'.$page['id'].'"':'');?> 
                           class="waves-effect waves-light btn <?php echo(($page['id_user'] == $_SESSION['id'])?'':'disabled'); ?>">
                            Modifier
                            <i class="material-icons right">create</i> 
                        </a> 
                    </td>
                </tr> 
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