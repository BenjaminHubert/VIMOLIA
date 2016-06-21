<h2>Liste des vidéos</h2>
<?php
if(!empty($listVideo)){ 
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
            foreach($listVideo as $video){
                $user = $this->registry->db->getUser($video['id_user']);
        ?>
                <tr>
                    <td><a href="#"><?php echo $video['title']; ?></a></td>
                    <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
                    <td><?php echo date('\L\e d/m/Y \à H\hi', strtotime($video['date_create'])); ?></td>
                    <td>
                        <a <?php echo(($video['id_user'] == $_SESSION['id'])?'href="'.BASE_URL_ADMIN.'page/edit/'.$video['id'].'"':'');?> 
                           class="waves-effect waves-light btn <?php echo(($video['id_user'] == $_SESSION['id'])?'':'disabled'); ?>">
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
<h3>Aucune vidéo pour le moment.</h3>
<?php 
}
?>
<br>
<a href="<?php echo BASE_URL_ADMIN.'video/add'; ?>" class="waves-effect waves-light btn">
    <i class="material-icons left">create</i>Ajouter une vidéo
</a>