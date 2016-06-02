<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->getTitle();?></title>        
        <link rel="icon" href="<?php echo BASE_URL;?>img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- JQUERY -->
        <script src="<?php echo BASE_URL;?>js/jquery-2.1.1.min.js"></script>

        <!-- MATERIALIZE -->
        <link href="<?php echo BASE_URL;?>css/material-icon.css" rel="stylesheet">
        <link href="<?php echo BASE_URL;?>css/materialize.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo BASE_URL;?>js/materialize.min.js"></script>

        <!-- CUSTOME CSS & JS -->
        <link href="<?php echo BASE_URL;?>css/mystyle.css" rel="stylesheet" type="text/css">
        <script src="<?php echo BASE_URL;?>js/functions.js"></script>
    </head>
    <body>
        <?php if(isset($_SESSION['id'])){?>
        <ul id="dropdown1" class="dropdown-content">
            <li><a href="<?php echo BASE_URL_ADMIN;?>"><i class="material-icons left">account_circle</i> Mon compte</a></li>
            <li><a href="<?php echo BASE_URL;?>search/praticien"><i class="material-icons left">search</i> Praticien</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo BASE_URL;?>login/logout"><i class="material-icons left">lock_open</i> Déconnexion</a></li>
        </ul>
        <?php }?>
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container">
                <a id="logo-container" href="<?php echo BASE_URL;?>" class="brand-logo hide-on-med-and-down">
                    <img src="<?php echo BASE_URL;?>img/logo.png" alt="<?php echo APP_TITLE;?>" >
                </a>
                <ul class="right">
                    <?php if(!isset($_SESSION['id'])){?>
                    <li><a href="<?php echo BASE_URL;?>login">Connexion</a></li>
                    <li><a href="<?php echo BASE_URL;?>signup">Créer un compte</a></li>
                    <?php }else{?>
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">account_circle</i><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?><i class="material-icons right">arrow_drop_down</i></a></li>
                    <?php }?>
                </ul>
                <ul id="nav-mobile" class="side-nav">
                    <li><img src="<?php echo BASE_URL;?>img/logo.png" style="width: 100%;" alt="<?php echo APP_TITLE;?>"></li>
                    <?php if(!isset($_SESSION['id'])){?>
                    <li><a href="<?php echo BASE_URL;?>login">Connexion</a></li>
                    <li><a href="<?php echo BASE_URL;?>signup">Créer un compte</a></li>
                    <?php }else{?>
                    <li><a href="<?php echo BASE_URL_ADMIN;?>"><i class="material-icons left">account_circle</i> Mon compte</a></li>
                    <li><a href="<?php echo BASE_URL;?>search/praticien"><i class="material-icons left">search</i> Praticien</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo BASE_URL;?>login/logout"><i class="material-icons left">lock_open</i> Déconnexion</a></li>
                    <?php }?>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        <div class="container">