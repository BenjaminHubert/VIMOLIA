<!DOCTYPE html>
<html>
    <head>
        <title><?php echo htmlentities($this->getTitle());?></title>        
        <link rel="icon" href="<?php echo BASE_URL;?>img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- JQUERY -->
        <script src="<?php echo BASE_URL;?>js/jquery-2.1.1.min.js"></script>

        <!-- MATERIALIZE -->
        <link href="<?php echo BASE_URL;?>css/material-icon.css" rel="stylesheet">
        <link href="<?php echo BASE_URL;?>css/materialize.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo BASE_URL;?>js/materialize.min.js"></script>

        <link href="<?php echo BASE_URL_ADMIN;?>css/mystyle.css" rel="stylesheet" type="text/css">
        <script src="<?php echo BASE_URL_ADMIN;?>js/functions.js"></script>

        <script src='<?php echo BASE_URL; ?>php_libraries/tinymce/js/tinymce/tinymce.min.js'></script>
        <script>
            tinymce.init({
                selector: 'textarea#content'
            });
        </script>
        
        <!-- DYNAMIC THEME -->
		<style>
		<?php
			setClassFromSettings($_SETTINGS);
		?>
		</style>
    </head>
    <body>
        <?php include('../views/layout/navbar.php');?>
        <div class="container">