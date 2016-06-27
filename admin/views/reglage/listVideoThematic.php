<h2>Liste des thématiques</h2>
<?php
if(!empty($listThematic)){ 
?>
<table class="responsive-table striped">
    <thead>
        <tr>
            <th data-field="thematic" id="thematic">Thématique</th>
            <th data-field="action">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
    foreach($listThematic as $thematic){
        ?>
        <tr>
            <td><?php echo htmlentities($thematic['thematic']); ?></td>
            <td>
                <?php
                    if($thematic['id'] == 1){
                ?>
                    <span class="default">Thématique par défaut</span>
                <?php
                    }else {
                ?>
                <a class="waves-effect waves-light btn edit-thematic" data-value="<?php echo $thematic['id']; ?>">
                    Modifier
                    <i class="material-icons right">create</i> 
                </a> 
                <a class="waves-effect waves-light btn delete-thematic" data-value="<?php echo $thematic['id']; ?>">
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
<h3>Aucune thématique pour le moment.</h3>
<?php 
}
?>
<br>
<h5>Ajouter une thématique : </h5>
<div class="input-field" id="add-input">
    <input id="new-thematic" type="text" class="validate">
    <label for="new-thematic">Nom</label>
    <button class="btn waves-effect waves-light" id="add-thematic">Ajouter
        <i class="material-icons right">library_add</i>
    </button>
</div>