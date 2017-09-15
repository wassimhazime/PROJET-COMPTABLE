
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Starter Template for Bootstrap</title>

        <link href="<?php echo ROOTWEB ?>src/app/views/templete/front_end/dist/dist.css" rel="stylesheet">


    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <?php ?>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>index">Project name </a>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>mode_paiement/index">mode_paiement</a>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>commande/index">commande</a>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>bl/index">bl</a>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>raison_sociale/index">raison_sociale</a>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>avoir/index">avoir</a>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>facture/index">facture</a>
                    <a class="navbar-brand" href="<?php echo ROOTWEB ?>paiement/index">paiement</a>
                </div>
        </nav>

        <div class="container" >

            <div class="starter-template">
                <h1></h1><br>  <h1></h1><br>  <h1></h1><br>
                <p class="lead"> </p>


            </div>

        </div>


        <?php
        echo $container;
        ?>





        <script src="<?php echo ROOTWEB ?>src/app/views/templete/front_end/dist/dist.js"></script>  





    </body>
</html>
