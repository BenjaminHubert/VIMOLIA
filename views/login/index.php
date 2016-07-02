<div class="row">
   <?php if(!isset($_SESSION['id'])){?>
    <form class="col s12 m6 offset-m3 l4 offset-l4" method="post" action="">
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">mail_outline</i>
                <input id="email" name="email" type="email" class="validate" value="<?php echo (isset($_POST['email']))?htmlentities($_POST['email']):'';?>" autofocus>
                <label for="email" data-error="Veuillez saisir une adresse email valide" data-success="">Adresse email</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password" name="password" type="password">
                <label for="password">Mot de passe</label>
            </div>
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light BUTTON_BACKGROUND-COLOR" type="submit" name="submit" style="width:100%">Se connecter<i class="material-icons right">send</i></button>
            </div>
        </div>
    </form>
    <?php }else{?>
    <p>Vous êtes déjà connecté</p>
    <?php }?>
</div>