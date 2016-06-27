<h2>Modifier une page</h2>
<div class="row">
    <form method="POST" class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <input id="title" type="text" class="validate" name="title" value="<?php echo htmlentities($page['title']); ?>">
                <label for="title">Titre</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <h6>Contenu</h6>
                <textarea id="content" name="content"><?php echo htmlentities($page['content']); ?></textarea>
                <br>
            </div>
        </div>
        <?php
        $datetime = explode(' ', $page['date_publish']);
        $time = explode(':', $datetime[1]);
        ?>
        <div class="row">
            <div class="input-field col l4 s12">
                <input id="datepub" type="date" class="datepicker" name="date_publish" data-value="<?php echo $datetime[0]; ?>">
                <label for="datepub">Date de publication</label>
            </div>
            <div class="input-field col l2 s6">
                <select name="hour_publish">
                    <?php for($i=0; $i<24; $i++) { ?>
                    <option value="<?php echo $i; ?>" <?php echo (($i==$time[0])?'selected':''); ?>><?php echo (($i<10)?'0'.$i:$i); ?></option>
                    <?php } ?>
                </select>
                <label>Heure</label>
            </div>
            <div class="input-field col l2 s6">
                <select name="minute_publish">
                    <?php for($i=0; $i<60; $i+=15) { ?>
                    <option value="<?php echo $i; ?>" <?php echo (($i==$time[1])?'selected':''); ?>><?php echo (($i<10)?'0'.$i:$i); ?></option>
                    <?php } ?>
                </select>
                <label>Minute</label>
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