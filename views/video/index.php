<h2>Liste des vidéos</h2>
<?php
if(!empty($listVideo)){ 
?>
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
} else{
?>
<h3>Aucune vidéo pour le moment.</h3>
<?php 
}
?>
