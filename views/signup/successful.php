<div class="row">
    <h5 class="center-align">Merci!</h5>
    <div class="col s12 m10 offset-m1 l8 offset-l2">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text">
                <span class="card-title">Vous êtes maintenant membre de <?php echo APP_TITLE;?></span>
                <p>
                    Avant de pouvoir vous connecter, vous allez recevoir un mail afin de confirmer votre adresse email. Voici votre adresse email: <b><?php echo htmlentities($_POST['email']);?></b>
                </p>
            </div>
            <div class="card-action">
                <a href="<?php echo BASE_URL_ADMIN;?>">Accès à mon compte</a>
                <a href="<?php echo BASE_URL;?>">Accueil</a>
            </div>
        </div>
    </div>
</div>
