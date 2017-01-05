<!DOCTYPE html>
<?php
require_once('php/Tools.php');
require_once('php/db/Database.php');
require_once('php/Translator.php');
Database::init_db();
$translator = new Translator('es');
?>
<html lang="es">
    <head>
        <title><?php echo $translator->getText('GENERIC_TITLE'); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href="css/style.css" type="text/css" rel="stylesheet"/>
        <!-- Temporal hasta implementar el php -->
        <!--<script src="http://www.w3schools.com/lib/w3data.js"></script>-->
    </head>
    <body>
        <div class="wrapper">
            <header id="header_wrapper"></header>

            <section id="main_wrapper" class="container width100"></section>

            <footer id="footer_wrapper"></footer>
        </div>




        <!-- Temporal hasta implementar el php -->
        <!--<script>
            w3IncludeHTML();
        </script>-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/functions.js" type="text/javascript"></script>
    </body>
<?php Database::close_db(); ?>
</html>
