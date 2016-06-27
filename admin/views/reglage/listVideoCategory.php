<h2>Liste des catégories</h2>
<?php
if(!empty($listCategory)){ 
?>
<table class="responsive-table striped">
    <thead>
        <tr>
            <th data-field="category" id="category">Catégorie</th>
            <th data-field="action">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
    foreach($listCategory as $category){
        ?>
        <tr>
            <td><?php echo htmlentities($category['category']); ?></td>
            <td>
                <?php
                    if($category['id'] == 1){
                ?>
                    <span class="default">Catégorie par défaut</span>
                <?php
                    }else {
                ?>
                <a class="waves-effect waves-light btn edit-category" data-value="<?php echo $category['id']; ?>">
                    Modifier
                    <i class="material-icons right">create</i> 
                </a> 
                <a class="waves-effect waves-light btn delete-category" data-value="<?php echo $category['id']; ?>">
                    Supprimer
                    <i class="material-icons right">delete</i> 
                </a>
                <?php
                    }
                ?>
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
<h3>Aucune catégorie pour le moment.</h3>
<?php 
}
?>
<br>
<h5>Ajouter une catégorie : </h5>
<div class="input-field" id="add-input">
    <input id="new-category" type="text" class="validate">
    <label for="new-category">Nom</label>
    <button class="btn waves-effect waves-light" id="add-category">Ajouter
        <i class="material-icons right">library_add</i>
    </button>
</div>