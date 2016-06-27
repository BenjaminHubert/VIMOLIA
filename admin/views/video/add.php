<h2>Ajouter une vidéo</h2>
<div class="row">
    <form method="POST" class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <input id="title" type="text" class="validate" name="title">
                <label for="title">Titre</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="url" type="url" class="validate" name="url">
                <label for="url">URL de la vidéo</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea id="description" class="materialize-textarea" name="description"></textarea>
                <label for="description">Description</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l6">
                <select name="id_category">
                    <?php foreach($listCategory as $category){ ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo (($category['id'] == 1)?'selected':''); ?>>
                        <?php echo htmlentities($category['category']); ?>
                    </option>
                    <?php } ?>
                </select>
                <label>Catégorie</label>
            </div>
            <div class="input-field col l6">
                <select name="id_thematic">
                    <?php foreach($listThematic as $thematic){ ?>
                    <option value="<?php echo $thematic['id']; ?>" <?php echo (($thematic['id'] == 1)?'selected':''); ?>>
                        <?php echo htmlentities($thematic['thematic']); ?>
                    </option>
                    <?php } ?>
                </select>
                <label>Thématique</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="submit" name="submit" id="submit">Enregistrer
                    <i class="material-icons right">done</i>
                </button>
            </div>
        </div>
    </form>
</div>