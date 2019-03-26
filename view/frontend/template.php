<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CaddyRace, appli pour faire vos courses, une course" />
    <meta name="author" content="Frédéric Labourel">

    <!-- Favicone du site dans la barre du navigateur -->
    <link rel="icon" href="public/picture/ico/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="public/picture/ico/favicon.ico" type="image/x-icon" />

    <title>
        <?= $title ?>
    </title>

    <!-- Facebook Open Graph data -->
    <meta property="og:title" content="Caddy race" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.facebook.com/caddyrace" />
    <meta property="og:image" content="public/picture/ico/logo.png" />
    <meta property="og:description" content="Caddy Race, vos courses, une course" />

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="Caddy Race">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="Caddy Race">
    <meta name="twitter:description" content="Caddy Race, vos courses, une course">
    <meta name="twitter:creator" content="@author_handle">

    <!-- Twitter Summary card images must be at least 200x200px -->
    <meta name="twitter:image" content="public/picture/ico/logo.png">

    <!-- Icones du site en raccourci écran Apple -->
    <link rel="apple-touch-icon-precomposed" href="public/picture/ico/apple-touch-icon-57-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="public/picture/ico/apple-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="public/picture/ico/apple-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="public/picture/ico/apple-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="public/picture/ico/apple-icon-144x144.png" />

    <!-- Liens Polices Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli|Orbitron|Open+Sans+Condensed:300" rel="stylesheet">

    <!-- Feuille de style css et Bibliothèque d'icones FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
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

    <!-- LISTES DU MENU (COMMUN TOUS RESPONSIVES) -->

    <?php ob_start(); 
    
    if($_SESSION['group_id']) {
    ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=list">Votre caddie</a>
    </li>
    <?php
    if($_SESSION['group_id'] != 3) {
    ?>
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=membersDetail">Membres</a>
    </li>
    <?php
        }
    }
    ?>

    <?php $ul = ob_get_clean(); ?>
    <?php ob_start(); ?>

    <!-- MENU SMARTPHONES -->

    <div class="pos-f-t fixed-top">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <div class="container-fluid menu-xs">
                    <span class="logo d-inline-flex align-items-end white">
                        <img src="public/picture/brand/caddy-icon-C-70x70.png" alt="caddy picture" />
                        <span class="navbar-brand">addy</span>
                        <img src="public/picture/brand/caddy-icon-R-32x32.png" alt="caddy picture" />
                        <span class="navbar-brand">ace</span>
                    </span>
                    <ul class="nav flex-column">
                        <?php
                        if($_SESSION['pseudo']) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=list">Votre caddie</a>
                        </li>
                        <?php
                            if($_SESSION['group_id'] != 3) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=membersDetail">Membres</a>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=memberDetail">Profil</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#" id="deconnexion_xs">Deconnexion</a>
                        </li>
                        <?php
                        } 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-light bg-dark">
            <button class="navbar-toggler container-fluid justify-content-around align-items-center bg-dark" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="navbar-brand">
                    <span class="logo white">
                        <img src="public/picture/brand/caddy-icon-C-38x38.png" alt="caddy picture" />
                        <span>addy</span>
                        <img src="public/picture/brand/caddy-icon-R-22x17.png" alt="caddy picture" />
                        <span>ace</span>
                    </span>
                </div>
                <span class="menu white">Menu</span>
                <i class="fas fa-cogs white"></i>
            </button>
        </nav>
    </div>

    <!-- MENU ECRANS -->

    <nav class="navbar nav-ecran navbar-light bg-dark fixed-top white">
        <div class="container">
            <span class="logo d-flex align-items-end">
                <img src="public/picture/brand/caddy-icon-C-70x70.png" alt="caddy picture" />
                <span>addy</span>
                <img src="public/picture/brand/caddy-icon-R-32x32.png" alt="caddy picture" />
                <span>ace</span>
            </span>
            <ul class="nav nav-pills nav-stacked">
                <?php
                if($_SESSION['pseudo']) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=list">Caddie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=memberDetail">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="deconnexion">Deconnexion</a>
                </li>
                <?php
                if($_SESSION['group_id'] != 3) {
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item nav-link" href="index.php?action=items">Les items</a>
                        <a class="dropdown-item nav-link" href="index.php?action=membersDetail">Les Membres</a>
                    </div>
                </li>
                <?php
                    }
                } 
                ?>
            </ul>
        </div>
    </nav>

    <?php $menu = ob_get_clean(); ?>
    <?php ob_start(); ?>

    <!-- FOOTER -->

    <footer class="text-center white">
        <div class="sm-row xs-column justify-content-around align-items-center bg-orange">
            <a href="#popup1"><img src="public/picture/mini/App_Store_Badge.png" alt="apple_store_picture" width="175px" /></a>
            <div id="popup1" class="overlay">
                <div class="popup">
                    <h3>Pas encore :D</h3>
                    <a class="close" href="#">&times;</a>
                    <div class="content orange">
                        Mais vous pouvez vous servir de l'Appli en créant un raccourci sur l'écran de votre iphone/ipad !
                    </div>
                </div>
            </div>
            <a href="#popup2"><img src="public/picture/mini/Google_Play_Badge.png" alt="google_play_picture" width="200px" /></a>
            <div id="popup2" class="overlay">
                <div class="popup">
                    <h3>Là non plus :D</h3>
                    <a class="close" href="#">&times;</a>
                    <div class="content orange">
                        Mais vous pouvez vous servir de l'Appli en créant un raccourci sur l'écran de votre mobile Androïd !
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-around align-items-center bg-orange">
            <h2 class="col-12">Restez informé</h2>
            <div>
                <button class="btn btn-info social-link"><a href="https://www.facebook.com/frederic.labourel.3" target=_blank><span class="glyphicon glyphicon-facebook"><i class="fab fa-facebook-f fa-lg white"></i></span></a></button>
                <button class="btn btn-info social-link"><a href="mailto: fred.labourel@wanadoo.fr"><span class="glyphicon glyphicon-calendar"><i class="fas fa-at fa-lg white"></i></span></a></button>
                <button class="btn btn-info social-link"><a href="https://www.linkedin.com/in/frederic-labourel-84b059b0/" target=_blank><span class="glyphicon glyphicon-shopping-cart"><i class="fab fa-linkedin-in white"></i></span></a></button>
                <button class="btn btn-info social-link"><a href="https://github.com/freddieLab" target=_blank><span class="glyphicon glyphicon-bullhorn fa-lg"><i class="fab fa-github white"></i></span></a></button>
            </div>
        </div>
        <div class="sm-row xs-column justify-content-center align-items-center white">
            <span><i class="far fa-copyright"></i> 2019 FredLab</span><span>Brainmade with <strong class="rwd-line">HTML CSS PHP SQL GIT</strong></span><span><a href="index.php?action=contact">contact</a></span>
        </div>
        <div class="offset-10 fixed-bottom popup3">
            <a href="#popup3"><i class="far fa-comment-alt fa-7x"></i><i id="light" class="fas fa-lightbulb fa-3x"></i></a>
            <div id="popup3" class="overlay">
                <div class="popup">
                    <h3>Votre avis <i class="far fa-lightbulb fa-2x"></i><br>nous éclaire !</h3>
                    <a class="close" href="#">&times;</a>
                    <div class="content black">
                        Une question, une idéee, n'hésitez pas à tout poser ici sur le tapis !
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <?php if($message_error) { ?>
                        <span class="alert alert-danger col-4 offset-4">
                            <?= $message_error; ?>
                        </span>
                        <?php } ?>
                    </div>

                    <form class="login-form contact-form" method="post" action="index.php?action=contactForm">
                        <div class="form-row">
                            <div class="form-group text-left">
                                <label class="black">Votre nom :</label>
                                <input class="bg-dark" type="text" name="name" value="<?= $_SESSION['name'] ?>" />
                            </div>
                            <div class="form-group text-left">
                                <label class="black">Votre prénom :</label>
                                <input class="bg-dark" type="text" name="first_name" value="<?= $_SESSION['first_name'] ?>" />
                            </div>
                            <div class="form-group text-left">
                                <label class="black text-left">Votre message : </label>
                                <textarea class="col-lg-12" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button submit" class="btn btn-success white btn-lg" name="login"><i class="fas fa-paper-plane orange"></i> Soumettre</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    <?php $footer = ob_get_clean(); ?>

    <!-- CONTAINER BOOTSRTAP -->

    <main role="main" class="container-fluid">

        <?php 
            echo $menu;
            echo $all1;
            if ($template == 'adminModerator') {
                echo $adminModerator;
            }
            if ($template == 'frontend') {
                echo $frontend;
            }
            echo $all2;
            if ($template == 'backend') {
                echo $backend;
            }    
        ?>

    </main>

    <?= $footer ?>

    <!-- jQuery Bibliothèque Production -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- JavaScript Bootstrap-->
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
