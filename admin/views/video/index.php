<h2>Liste des vidéos</h2>
<?php
if(!empty($listVideo)){ 
?>
<table class="responsive-table striped">
    <thead>
        <tr>
            <th data-field="title">Titre</th>
            <th data-field="category">Catégorie</th>
            <th data-field="thematic">Thématique</th>
            <th data-field="date">Date de publication</th>
            <th data-field="action">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
    foreach($listVideo as $video){
        $category = $this->registry->db->getCategoryById($video['id_category']);
        $thematic = $this->registry->db->getThematicById($video['id_thematic']);
        ?>
        <tr>
            <td><a href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>"><?php echo $video['title']; ?></a></td>
            <td><?php echo $category['category']; ?></td>
            <td><?php echo $thematic['thematic']; ?></td>
            <td><?php echo date('\L\e d/m/Y \à H\hi', strtotime($video['date_create'])); ?></td>
            <td>
                <a <?php echo(($video['id_user'] == $_SESSION['id'])?'href="'.BASE_URL_ADMIN.'video/edit/'.$video['id'].'"':'');?> 
                   class="waves-effect waves-light btn <?php echo(($video['id_user'] == $_SESSION['id'])?'':'disabled'); ?>">
                    Modifier
                    <i class="material-icons right">create</i> 
                </a>
                <button data-target="modal-<?php echo $video['id']; ?>" class="btn modal-trigger">
                    <i class="material-icons">delete</i>
                </button> 
            </td>
        </tr>

        <div id="modal-<?php echo $video['id']; ?>" class="modal bottom-sheet">
            <div class="modal-content">
                <h4>Suppression</h4>
                <p>Êtes vous sûr de vouloir supprimer la vidéo "<?php echo $video['title']; ?>" ?</p>
            </div>
            <div class="modal-footer">
                <a data-value="<?php echo $video['id']; ?>" 
                class="delete-video modal-action modal-close waves-effect waves-green btn-flat">Oui</a>
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
<h3>Aucune vidéo pour le moment.</h3>
<?php 
}
?>
<br>
<a href="<?php echo BASE_URL_ADMIN.'video/add'; ?>" class="waves-effect waves-light btn">
    <i class="material-icons left">create</i>Ajouter une vidéo
</a>