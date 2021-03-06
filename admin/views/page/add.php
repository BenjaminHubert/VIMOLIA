<h2>Créer une page</h2>
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
                <h6>Contenu</h6>
                <textarea id="content" name="content"></textarea>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l4 s12">
                <input id="datepub" type="date" class="datepicker" name="date_publish">
                <label for="datepub">Date de publication</label>
            </div>
            <div class="input-field col l2 s6">
                <select name="hour_publish">
                    <?php for($i=0; $i<24; $i++) { ?>
                    <option value="<?php echo htmlentities($i); ?>" <?php echo (($i==12)?'selected':''); ?>><?php echo (($i<10)?'0'.htmlentities($i):htmlentities($i)); ?></option>
                    <?php } ?>
                </select>
                <label>Heure</label>
            </div>
            <div class="input-field col l2 s6">
                <select name="minute_publish">
                    <?php for($i=0; $i<60; $i+=15) { ?>
                    <option value="<?php echo htmlentities($i); ?>" <?php echo (($i==0)?'selected':''); ?>><?php echo (($i<10)?'0'.htmlentities($i):htmlentities($i)); ?></option>
                    <?php } ?>
                </select>
                <label>Minute</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" name="submit" id="submit">Enregistrer
                    <i class="material-icons right">done</i>
                </button>
            </div>
        </div>
    </form>
</div>