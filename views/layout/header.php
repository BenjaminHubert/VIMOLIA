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
        <nav class="light-blue lighten-1" role="navigation">
            <div class="nav-wrapper container"><a id="logo-container" href="<?php echo BASE_URL;?>" class="brand-logo">Logo</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="<?php echo BASE_URL;?>login">Connexion</a></li>
                    <li><a href="<?php echo BASE_URL;?>signup">Créer un compte</a></li>
                </ul>

                <ul id="nav-mobile" class="side-nav">
                    <li><a href="<?php echo BASE_URL;?>login">Connexion</a></li>
                    <li><a href="<?php echo BASE_URL;?>signup">Créer un compte</a></li>
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        <div class="container">