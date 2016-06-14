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
            <td><a href="#" target="_blank"><?php echo $article['title']; ?></a></td>
            <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
            <td><?php echo date('\L\e d/m/Y \à H\hi', strtotime($article['date_publish'])); ?></td>
            <td>
                <a <?php echo(($article['id_user'] == $_SESSION['id'])?'href="'.BASE_URL_ADMIN.'article/edit/'.$article['id'].'"':'');?> 
                   class="waves-effect waves-light btn <?php echo(($article['id_user'] == $_SESSION['id'])?'':'disabled'); ?>">
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
<h3>Aucun article pour le moment.</h3>
<?php 
}
?>
<br>
<a href="<?php echo BASE_URL_ADMIN.'article/add'; ?>" class="waves-effect waves-light btn">
    <i class="material-icons left">create</i>Ecrire un article
</a>
