<div class="row">
    <div class="col s12 m6">
        <div class="slider">
            <ul class="slides">
                <?php 
                $i = 0;
                foreach($listVideo as $video){ 
                    if($i < 5){
                ?>
                <li>
                    <div class="video-container">
                        <iframe width="853" height="480" src="<?php echo str_replace('watch?v=', 'embed/', $video['url']); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="caption center-align">
                        <h5 class="light white-text text-lighten-3 truncate"><a href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>"><?php echo htmlentities($video['title']); ?></a></h5>
                    </div>
                </li>
                <?php 
                        $i++;
                    }else break;
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="col s12">
        <h4>
            Derniers articles 
            <a id="more_article" class="waves-effect waves-light btn" href="<?php echo BASE_URL.'article/'; ?>">
                Voir tout
                <i class="material-icons right">navigate_next</i>
            </a>
        </h4>
        <div class="collection">
            <?php 
            $j = 0;
            foreach($listArticle as $article){
                if($j < 3){
                    $user = $this->registry->db->getUser($article['id_user']);
            ?>
            <a class="collection-item" href="<?php echo BASE_URL.'article/display/'.$article['id']; ?>">
                <div class="article_thumbnail">
                    <img src="<?php echo $article['main_picture']; ?>">
                    <p class="author">Par <?php echo htmlentities($user['first_name']." ".$user['last_name']); ?><br>
                        <?php echo date('\L\e d/m/Y \à H\hi', strtotime($article['date_publish'])); ?></p>
                </div>
                <div class="article_details">
                    <h5><?php echo htmlentities($article['title']); ?></h5>
                    <p class="desc"><?php echo htmlentities($article['description']); ?></p>
                </div>
            </a>
            <?php 
                    $j++;
                }else break;
            }
            ?>
        </div>
    </div>
</div>