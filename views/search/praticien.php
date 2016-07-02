<h4>Nos praticiens</h4>
<form method="get">
    <div class="row">
        <div class="input-field col s12 m6 l4">
            <select name="skill" required>
                <option value="all" selected>Tous</option>
                <?php foreach($skills as $skill){?>
                <option <?php echo (isset($_GET['skill']) && strtolower($_GET['skill']) == strtolower($skill))?'selected':'';?>><?php echo htmlentities($skill);?></option>
                <?php } ?>
            </select>
        </div>
        <div class="input-field col s12 m6 l4">
            <button class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" style="width:100%">Chercher</button>
        </div>
    </div>
</form>
<div class="row">
    <?php if($doctors === false || count($doctors) < 1){?>
    <p>Il n'y a aucun praticien correspondant à votre recherche</p>
    <?php }else{?>
    <?php foreach($doctors as $doctor){?>
    <div class="col s12 m4 l3">
        <div class="card large">
            <a href="<?php echo BASE_URL.'praticien/profile/'.$doctor['id'];?>">
                <div class="card-image" style="height:256px;">
                    <img src="<?php echo $doctor['url_avatar'];?>" alt="Picture not found">
                    <span class="card-title"><?php echo htmlentities($doctor['first_name'].' '.$doctor['last_name']);?></span>
                </div>
            </a>
            <div class="card-content">
                <div>
                    <b>Spécialité(s):</b>
                    <p><?php echo htmlentities(implode(', ', $doctor['skills']));?></p>
                </div>
            </div>
            <div class="card-action">
                <a href="<?php echo BASE_URL.'praticien/profile/'.$doctor['id'];?>">Voir profil</a>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
</div>