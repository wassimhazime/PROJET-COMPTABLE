
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
        <link href="<?php echo ROOTWEB ?>front_end/dist/dist.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= ROOTWEB ?>index">Project name </a>
                    <a class="navbar-brand" href="<?= ROOTWEB ?>mode_paiement/index">mode_paiement</a>
                    <a class="navbar-brand" href="<?= ROOTWEB ?>commande/index">commande</a>
                    <a class="navbar-brand" href="<?= ROOTWEB ?>bl/index">bl</a>
                    <a class="navbar-brand" href="<?= ROOTWEB ?>raison_sociale/index">raison_sociale</a>
                    <a class="navbar-brand" href="<?= ROOTWEB ?>avoir/index">avoir</a>
                    <a class="navbar-brand" href="<?= ROOTWEB ?>facture/index">facture</a>
                    <a class="navbar-brand" href="<?= ROOTWEB ?>paiement/index">paiement</a>
                </div>
            </nav>
            <div class="container" >
                <div class="starter-template">
                    <h1></h1><br>  <h1></h1><br>  <h1></h1><br>
                    <p class="lead"> </p>
                </div>
            </div>
            <?= $container; ?>
            <script src="<?= ROOTWEB ?>front_end/dist/dist.js"></script>  
        </div>
    </body>
</html>
