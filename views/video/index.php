<h2>Liste des vidéos</h2>
<?php
if(!empty($listVideo)){ 
?>

<div class="row">
    <form method="post">
        <div class="input-field col l4">
            <select name="id_category">
                <option value="-1" selected>Tout</option>
                <?php foreach($listCategory as $category){ ?>
                <option value="<?php echo $category['id']; ?>">
                    <?php echo $category['category']; ?>
                </option>
                <?php } ?>
            </select>  
            <label>Catégorie</label>
        </div>
        <div class="input-field col l4">
            <select name="id_thematic">
                <option value="-1" selected>Tout</option>
                <?php foreach($listThematic as $thematic){ ?>
                <option value="<?php echo $thematic['id']; ?>">
                    <?php echo $thematic['thematic']; ?>
                </option>
                <?php } ?>
            </select>
            <label>Thématique</label>
        </div>
        <div class="input-field col l4">
            <button class="btn waves-effect waves-light" id="submit-filter">Rechercher
                <i class="material-icons right">search</i>
            </button>  
        </div>
    </form>
</div>

<div class="row">
    <?php
    foreach($listVideo as $video){
        // Image
        parse_str(parse_url($video['url'], PHP_URL_QUERY), $image);
        if(isset($image['v'])){
            $video['main_picture'] = 'http://img.youtube.com/vi/'.$image['v'].'/0.jpg';
        }else {
            $image['v'] = basename(parse_url($video['url'], PHP_URL_PATH));
            $video['main_picture'] = 'http://img.youtube.com/vi/'.$image['v'].'/0.jpg';
        }
        $category = $this->registry->db->getCategoryById($video['id_category']);
        $thematic = $this->registry->db->getThematicById($video['id_thematic']);
    ?>
    <div class="col s12 m6 l4">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <a href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>">
                    <img src="<?php echo $video['main_picture']; ?>">
                </a>
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">
                    <?php echo $video['title']; ?>
                    <i class="material-icons right">more_vert</i>
                </span>
                <p class="cat-them"><?php echo $category['category']; ?><br><?php echo $thematic['thematic']; ?></p>
                <p><?php echo date('\L\e d/m/Y \à H\hi', strtotime($video['date_create'])); ?></p>
            </div>
            <div class="card-action">
                <a href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>">Voir la vidéo</a>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">
                    <?php echo $video['title']; ?>
                    <i class="material-icons right">close</i>
                </span>
                <p><?php echo $video['description']; ?></p>
            </div>
        </div>
    </div>
    <?php   
    }
    ?>
</div>
<?php
} elseif(isset($_POST)){
?>
<div class="row">
    <form method="post">
        <div class="input-field col l4">
            <select name="id_category">
                <option value="-1" selected>Tout</option>
                <?php foreach($listCategory as $category){ ?>
                <option value="<?php echo $category['id']; ?>">
                    <?php echo $category['category']; ?>
                </option>
                <?php } ?>
            </select>  
            <label>Catégorie</label>
        </div>
        <div class="input-field col l4">
            <select name="id_thematic">
                <option value="-1" selected>Tout</option>
                <?php foreach($listThematic as $thematic){ ?>
                <option value="<?php echo $thematic['id']; ?>">
                    <?php echo $thematic['thematic']; ?>
                </option>
                <?php } ?>
            </select>
            <label>Thématique</label>
        </div>
        <div class="input-field col l4">
            <button class="btn waves-effect waves-light" id="submit-filter">Rechercher
                <i class="material-icons right">search</i>
            </button>  
        </div>
    </form>
</div>
<h5>Aucune vidéo ne correspond aux critères de recherche</h5>
<?php
                       }else { 
?>
<h3>Aucune vidéo pour le moment.</h3>
<?php 
}
?>
