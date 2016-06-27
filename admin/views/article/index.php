<h2>Liste des articles</h2>
<?php
if(!empty($listArticle)){ 
?>
<table class="responsive-table striped">
    <thead>
        <tr>
            <th data-field="title" colspan="2">Titre</th>
            <th data-field="author">Auteur</th>
            <th data-field="date">Date de publication</th>
            <th data-field="action">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    foreach($listArticle as $article){
        $user = $this->registry->db->getUser($article['id_user']);
        ?>
        <tr>
            <td><img class="article_thumbnail" src="<?php echo $article['main_picture']; ?>"></td>
            <td><a href="<?php echo BASE_URL.'article/display/'.$article['id']; ?>" target="_blank"><?php echo htmlentities($article['title']); ?></a></td>
            <td><?php echo htmlentities($user['first_name']." ".$user['last_name']); ?></td>
            <td><?php echo date('\L\e d/m/Y \à H\hi', strtotime($article['date_publish'])); ?></td>
            <td>
                <a <?php echo(($article['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 'Administrateur ')?'href="'.BASE_URL_ADMIN.'article/edit/'.$article['id'].'"':'');?> 
                   class="waves-effect waves-light btn <?php echo(($article['id_user'] == $_SESSION['id'])?'':'disabled'); ?>">
                    Modifier
                    <i class="material-icons right">create</i> 
                </a>
                <a <?php echo(($article['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 'Administrateur ')?'data-target="modal-'.$article['id'].'" class="btn modal-trigger"':'class="btn disabled"'); ?> >
                    <i class="material-icons">delete</i>
                </a> 
            </td>
        </tr> 

        <div id="modal-<?php echo $article['id']; ?>" class="modal bottom-sheet">
            <div class="modal-content">
                <h4>Suppression</h4>
                <p>Êtes vous sûr de vouloir supprimer l'article "<?php echo htmlentities($article['title']); ?>" ?</p>
            </div>
            <div class="modal-footer">
                <a data-value="<?php echo $article['id']; ?>" 
                   class="delete-article modal-action modal-close waves-effect waves-green btn-flat">Oui</a>
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
<h3>Aucun article pour le moment.</h3>
<?php 
}
?>
<br>
<a href="<?php echo BASE_URL_ADMIN.'article/add'; ?>" class="waves-effect waves-light btn">
    <i class="material-icons left">create</i>Ecrire un article
</a>
