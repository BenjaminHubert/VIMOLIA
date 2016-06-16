<h2>Liste des articles</h2>
<?php
if(!empty($listArticle)){ 
?>
<div class="row">
    <?php
    foreach($listArticle as $article){
        $user = $this->registry->db->getUser($article['id_user']);
    ?>
    <div class="col s12 m6 l4">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="<?php echo $article['main_picture']; ?>">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">
                    <?php echo $article['title']; ?>
                    <i class="material-icons right">more_vert</i>
                </span>
                <p>Par <?php echo $user['first_name']." ".$user['last_name']; ?></p>
                <p><?php echo date('\L\e d/m/Y \à H\hi', strtotime($article['date_publish'])); ?></p>
            </div>
            <div class="card-action">
                <a href="<?php echo BASE_URL.'article/display/'.$article['id']; ?>">Voir l'article</a>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">
                    <?php echo $article['title']; ?>
                    <i class="material-icons right">close</i>
                </span>
                <p><?php echo $article['description']; ?></p>
            </div>
        </div>
    </div>
    <?php   
    }
    ?>
</div>
<?php
} else{
?>
<h3>Aucun article pour le moment.</h3>
<?php 
}
?>
