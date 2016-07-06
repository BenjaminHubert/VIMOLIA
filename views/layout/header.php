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

        <!-- CUSTOM CSS & JS -->
        <link href="<?php echo BASE_URL;?>css/mystyle.css" rel="stylesheet" type="text/css">
        <script src="<?php echo BASE_URL;?>js/functions.js"></script>

        <!-- CUSTOM SOCIAL NETWORK LINKS -->
        <?php if(isset($article)){ ?>
        <meta property="og:url"           content="<?php echo BASE_URL.'article/display/'.$article['id']; ?>" />
        <meta property="og:type"          content="article" />
        <meta property="og:title"         content="<?php echo htmlentities(APP_TITLE.' - '.$article['title']); ?>" />
        <meta property="og:description"   content="<?php echo htmlentities($article['description']); ?>" />
        <meta property="og:image"         content="<?php echo htmlentities(BASE_URL.$article['main_picture']); ?>" />

        <meta itemprop="og:headline"      content="<?php echo htmlentities(APP_TITLE.' - '.$article['title']); ?>" />
        <meta itemprop="og:description"   content="<?php echo htmlentities($article['description']); ?>" />
        <meta property="og:image"         content="<?php echo htmlentities(BASE_URL.$article['main_picture']); ?>" />
        <?php } ?>

        <!-- DYNAMIC COLORS -->
        <style>
            <?php
            setClassFromSettings($_SETTINGS);
            ?>
        </style>
    </head>
    <body>

        <?php include('navbar.php');?>
        <main>
            <div class="container">