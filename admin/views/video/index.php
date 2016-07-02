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
                <option value="<?php echo htmlentities($category['id']); ?>">
                    <?php echo htmlentities($category['category']); ?>
                </option>
                <?php } ?>
            </select>  
            <label>Catégorie</label>
        </div>
        <div class="input-field col l4">
            <select name="id_thematic">
                <option value="-1" selected>Tout</option>
                <?php foreach($listThematic as $thematic){ ?>
                <option value="<?php echo htmlentities($thematic['id']); ?>">
                    <?php echo htmlentities($thematic['thematic']); ?>
                </option>
                <?php } ?>
            </select>
            <label>Thématique</label>
        </div>
        <div class="input-field col l4">
            <button class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" id="submit-filter">Rechercher
                <i class="material-icons right">search</i>
            </button>  
        </div>
    </form>
</div>

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
            <td><a href="<?php echo BASE_URL.'video/display/'.$video['id']; ?>"><?php echo htmlentities($video['title']); ?></a></td>
            <td><?php echo htmlentities($category['category']); ?></td>
            <td><?php echo htmlentities($thematic['thematic']); ?></td>
            <td><?php echo date('\L\e d/m/Y \à H\hi', strtotime($video['date_create'])); ?></td>
            <td>
                <a <?php echo(($video['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 'Administrateur')?'href="'.BASE_URL_ADMIN.'video/edit/'.$video['id'].'"':'');?> 
                   class="waves-effect waves-light btn BUTTON_BACKGROUND-COLOR <?php echo(($video['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 'Administrateur')?'':'disabled'); ?>">
                    Modifier
                    <i class="material-icons right">create</i> 
                </a>
                <a <?php echo(($video['id_user'] == $_SESSION['id'] || $_SESSION['role'] == 'Administrateur')?'data-target="modal-'.$video['id'].'" class="btn modal-trigger BUTTON_BACKGROUND-COLOR"':'class="btn disabled BUTTON_BACKGROUND-COLOR"'); ?> >
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>

        <div id="modal-<?php echo $video['id']; ?>" class="modal bottom-sheet">
            <div class="modal-content">
                <h4>Suppression</h4>
                <p>Êtes vous sûr de vouloir supprimer la vidéo "<?php echo htmlentities($video['title']); ?>" ?</p>
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
                      } elseif(isset($_POST)){
?>
<div class="row">
    <form method="post">
        <div class="input-field col l4">
            <select name="id_category">
                <option value="-1" selected>Tout</option>
                <?php foreach($listCategory as $category){ ?>
                <option value="<?php echo $category['id']; ?>">
                    <?php echo htmlentities($category['category']); ?>
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
                    <?php echo htmlentities($thematic['thematic']); ?>
                </option>
                <?php } ?>
            </select>
            <label>Thématique</label>
        </div>
        <div class="input-field col l4">
            <button class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" id="submit-filter">Rechercher
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
<br>
<a href="<?php echo BASE_URL_ADMIN.'video/add'; ?>" class="waves-effect waves-light btn BUTTON_BACKGROUND-COLOR">
    <i class="material-icons left">create</i>Ajouter une vidéo
</a>