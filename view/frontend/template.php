<!--********************************************************************************-->
<!--********************************** TEMPLATE ************************************-->
<!--********************************************************************************-->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no, maximum-scale=1">
    <meta name="description" content="CaddyRace, appli pour faire vos courses, une course" />
    <meta name="author" content="LABDEV - Frédéric Labourel">

    <!-- Favicone du site dans la barre du navigateur -->
    <link rel="icon" href="public/picture/ico/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="public/picture/ico/favicon.ico" type="image/x-icon" />

    <title>
        <?= $title ?>
    </title>

    <!-- Facebook Open Graph data -->
    <meta property="og:title" content="Caddy race" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://fredlabourel.fr/caddyrace" />
    <meta name="image" property="og:image" content="public/picture/brand/caddyrace3.jpg" />
    <meta property="og:description" content="Caddy Race, vos courses, une course" />

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="Caddy Race">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="Caddy Race">
    <meta name="twitter:description" content="Caddy Race, vos courses, une course">
    <meta name="twitter:creator" content="@author_handle">

    <!-- Twitter Summary card images must be at least 200x200px -->
    <meta name="twitter:image" content="public/picture/brand/caddyrace.jpg">

    <!-- Icones du site en raccourci écran Apple -->
    <link rel="apple-touch-icon-precomposed" href="public/picture/ico/apple-touch-icon-57-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="public/picture/ico/apple-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="public/picture/ico/apple-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="public/picture/ico/apple-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="public/picture/ico/apple-icon-144x144.png" />

    <!-- Polices Google Fonts utilisées -->
    <link href="https://fonts.googleapis.com/css?family=Muli|Orbitron|Open+Sans+Condensed:300" rel="stylesheet">

    <!-- Bibliothèque CSS FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bibliothèque CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bibliothèque CSS jQuery UI -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- Bibliothèque CSS perso -->
    <link href="public/style.css" rel="stylesheet" />
</head>

<body class="<?= $template ?> black">

    <noscript>
        <div class="noscript">
            <input type="checkbox" class="modal-closing-trick" id="modal-closing-trick">
            <div class="overlay noscript-overlay" style="display: block;"></div>
            <div class="noscript-title white">
                <h3>"CaddyRace" nécessite l'activation de JavaScript pour fonctionner complétement.</h3>
                <h3>"CaddyRace" requires JavaScript to render all the views and actions.</h3>
            </div>
            <p grey>Need to know how to enable JavaScript? <a href="http://enable-javascript.com/" target="_blank" rel="noopener">Go here.</a>
            </p>
            <label class="noscript-button" for="modal-closing-trick">Close this, use anyway.</label>
        </div>
    </noscript>

    <!-- UL DU NAV (COMMUN ORDIS & SMARTPHONES) -->
    <?php ob_start(); ?>

    <!-------------- Menu Membre uniquement -------------->
    <?php if (isset ($_SESSION['group_id']) && $_SESSION['group_id'] != 1) { ?>  
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=shopList"><!--<img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" />--><i class="fas fa-shopping-cart fa-2x" title="Boutique"></i> Shoplist
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=aislesList"><!--<img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" />--><i class="fas fa-stream fa-2x" title="Rayons"></i> Rayons
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=memberDetail"><i class="fas fa-user fa-2x" title="Profil"></i> Profil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=home" title="Demo"><i class="far fa-eye fa-2x"></i> Démo</a>
    </li>

    <!-------------- Menu Admin uniquement -------------->
    <?php } else if (isset ($_SESSION['group_id']) && $_SESSION['group_id'] == 1) { ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=memberDetail"><i class="fas fa-user fa-2x" title="Profil"></i> Profil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=shopAdmin"><i class="fas fa-barcode fa-2x"></i> Boutique</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=aislesAdmin"><i class="fas fa-stream fa-2x" title="Rayons"></i> Rayons</a>
    </li>
        <li class="nav-item">
        <a class="nav-link" href="index.php?action=membersDetail"><i class="fas fa-users-cog fa-2x"></i> Membres</a>
    </li>
    <?php } if (isset ($_SESSION['group_id'])) {
                $ul = ob_get_clean(); 
          } ?>

    <!-- MENUS ORDIS & SMARTPHONES -->
    <?php ob_start(); ?>
    
    <!-- MENUS ORDIS -->
    <nav class="navbar nav-ecran navbar-light bg-dark white">
        <span class="logo d-flex align-items-end">
            <img src="public/picture/brand/caddy-icon-C-70x70.png" alt="caddy picture" />
            <span>addy</span>
            <img src="public/picture/brand/caddy-icon-R-32x32.png" alt="caddy picture" />
            <span>ace</span>
        </span>
        <ul class="nav nav-pills nav-stacked align-items-center">
     
            <!-------------- Insertion de l'UL commun pour ordis -------------->           
            <?php if (isset($ul)) { echo $ul; } 
            
            /* -------------- Bouton de déconnexion uniquement si connecté -------------*/ 
                  if (isset ($_SESSION['pseudo'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="#" id="deconnexion" title="Deconnexion"><i class="fas fa-power-off fa-2x"></i> Deconnexion</a>
            </li>
            <?php } ?>
            
        </ul>
    </nav>

    <!-- MENU SMARTPHONES -->
    <div class="pos-f-t fixed-top">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <div class="container-fluid menu-xs">
                    <ul class="nav flex-column nav-pills nav-stacked justify-content-end">
                        
                    <!-------------- Insertion de l'UL commun pour smartphones -------------->    
                    <?php if (isset($ul)) { echo $ul; } ?>
                              
                        <!--------------  Bouton de déconnexion uniquement si connecté --------------> 
                        <?php if(isset($_SESSION['pseudo'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="deconnexion-xs" title="Deconnexion"><i class="fas fa-power-off fa-2x"></i> Deconnexion</a>
                        </li>
                        <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link bg-orange" href="index.php?action=login"><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" /> Start !
                            </a>
                        </li>
                        <?php }?>

                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar nav-smartphone">
                <button class="row navbar-toggler container-fluid justify-content-center align-items-center bg-dark" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="col-4 navbar-brand">
                        <span class="logo white">
                            <img src="public/picture/brand/caddy-icon-C-70x70.png" alt="caddy picture" />
                            <span>addy</span>
                            <img src="public/picture/brand/caddy-icon-R-32x32.png" alt="caddy picture" />
                            <span>ace</span>
                        </span>
                    </div>
                    <div class="col-3 navbar-menu orange"><span id="mobile-menu" class="mobile-menu"><span class="hamburger-box"><span class="hamburger-inner"></span></span></span></div>
                    <div class="col-5 navbar-descript">
                    </div>
                </button>
        </nav>
    </div>

    <?php $menu = ob_get_clean(); ?>
    <!-- RECUPERATION MENUS ORDIS & SMARTPHONES -->

    <!-- FOOTER -->
    <?php ob_start(); ?>
    <footer class="text-center white">
        <div class="sm-row xs-column justify-content-around align-items-center bg-orange">
            <a href="#popup1"><img src="public/picture/mini/App_Store_Badge.png" alt="apple_store_picture" width="175px" /></a>
            <div id="popup1" class="overlay">
                <div class="popup popup-sm">
                    <h3>Pas encore :D</h3>
                    <a class="close" href="#">&times;</a>
                    <div class="content orange">
                        Mais vous pouvez vous servir de l'Appli en créant un raccourci sur l'écran de votre iphone/ipad !
                    </div>
                </div>
            </div>
            <a href="#popup2"><img src="public/picture/mini/Google_Play_Badge.png" alt="google_play_picture" width="200px" /></a>
            <div id="popup2" class="overlay">
                <div class="popup popup-sm">
                    <h3>Là non plus :D</h3>
                    <a class="close" href="#">&times;</a>
                    <div class="content orange">
                        Mais vous pouvez vous servir de l'Appli en créant un raccourci sur l'écran de votre mobile Androïd !
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-around align-items-center bg-orange">
            <h2>Restez informé</h2>
            <div class="d-flex justify-content-center align-items-center">
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://www.facebook.com/labdev.web/" target=_blank><span><i class="fab fa-facebook-f fa-lg white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://twitter.com/labdev_web" target=_blank><span><i class="fab fa-twitter fa-lg white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://www.instagram.com/labdev_web/" target=_blank><span><i class="fab fa-instagram fa-lg white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://www.linkedin.com/in/frederic-labourel/" target=_blank><span><i class="fab fa-linkedin-in white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://github.com/FredLabdev/" target=_blank><span><i class="fab fa-github white"></i></span></a></button>
            </div>
        </div>
        <div class="sm-row xs-column justify-content-center align-items-center white">
            <span>CaddyRace</span><span>Copyrights © 2019 labdev. Tous droits réservés.</span><span><a href="mailto:fred@labdev.fr">contact</a></span><span class="site-info">Brainmade by Labdev</span>
        </div>
        
        <!--
        <div class="offset-10 fixed-bottom popup3">
            <a href="#popup3"><i class="fas fa-comment-dots fa-7x"></i></a>
            <div id="popup3" class="overlay">
                <div class="popup popup-lg">
                    <h3>Votre avis <i class="fas fa-lightbulb fa-2x"></i><br>nous éclaire !</h3>
                    <a class="close" href="#">&times;</a>
                    <div class="content black">
                        Une question, une idée, n'hésitez pas à tout poser ici sur le tapis !
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <?php if(isset($message_error)) { ?>
                        <span class="alert alert-danger col-4 offset-4">
                            <?= $message_error; ?>
                        </span>
                        <?php } ?>
                    </div>

                    
                    <form class="contact-form" method="post" action="index.php?action=contactForm">
                        <div class="form-row">
                            <div class="col-12">
                                <?php
                                if(!isset(($_SESSION['pseudo']))) {
                                ?>
                                <div class="form-group text-left">
                                    <label>Votre nom :</label>
                                    <input class="col-lg-12" type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; }?>" />
                                </div>
                                <div class="form-group text-left">
                                    <label>Votre prénom :</label>
                                    <input class="col-lg-12" type="text" name="first_name" value="<?php if(isset($_SESSION['first-name'])) { echo $_SESSION['first_name']; } ?>" />
                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-group text-left">
                                    <label class="text-left">Votre message : </label>
                                    <textarea class="col-lg-12" rows="8"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="button submit" class="btn btn-success white btn-lg" name="login"><i class="fas fa-paper-plane orange"></i> Soumettre</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        -->
    </footer>

    <?php $footer = ob_get_clean(); ?>

    <!-- CONTAINER BOOTSTRAP -->

    <main role="main" class="container-fluid">

        <?php 
            echo $menu;
            echo $all1;
            echo $all3;
            if ($template == 'adminModerator') {
                echo $adminModerator;
            }
            if ($template == 'frontend') {
                echo $frontend;
            }
            if (isset ($all2)) { echo $all2; };
            if ($template == 'backend') {
                echo $backend;
            }  
        
        ?>

    </main>

    <?= $footer ?>

    <!-- (1) Bibliothèque jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- (2) Bibliothèque jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- (2b) Bibliothèque jQuery Touch screen  -->
    <script src="http://localhost:8888/caddyrace/CaddyRace/public/jquery.ui.touch-punch.js"></script>

    <!-- (3) Bibliothèque JavaScript Bootstrap-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="public/ajax.js"></script>
    <script src="public/caddyrace.js"></script>

</body>

</html>
