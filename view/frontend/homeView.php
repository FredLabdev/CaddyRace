<?php 
    session_start();
    $title = 'CaddyRace/Accueil';
    if ($_SESSION['group_id'] == 1) {
        $template = 'backend';
    } else {
        $template = 'frontend';
    }
    ob_start(); 
?>

<!-- SLIDER SUR ECRAN SEULEMENT -->

<div id="carouselExampleIndicators" class="carousel slide row" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    </ol>

    <div class="carousel-inner">
        <!-- SLIDE 1 -->
        <div class="carousel-item active row justify-content-center align-items-between">
            <div class="title-slider1">
                <span>
                    Améliorez votre chrono<br>
                    et remportez enfin<br>
                    <em>la course contre</em><br>
                    <em>vos courses !</em>
                </span>
            </div>
            <img class="rounded mx-auto d-block slider1" src="public/picture/slider/caddy_picture.png" alt="First slide">
        </div>
        <!-- SLIDE 2 -->
        <div class="carousel-item row justify-content-center align-items-between">
            <div class="title-slider2">
                <span>
                    Perdu entre une liste<br>
                    et des rayons<br>
                    <em>qui sont ordonnés<br>
                        différemment ?!</em>
                </span>
            </div>
            <div class="rounded mx-auto d-block slider2">
                <span>?</span>
                <img class="rounded mx-auto d-block" src="public/picture/slider/logo_liste_wrong2.png" alt="Second slide">
            </div>
        </div>
        <!-- SLIDE 3 -->
        <div class="carousel-item row justify-content-center align-items-between">
            <div class="title-slider3">
                <span>
                    Fini les aller-retours<br>
                    et les pertes de temps<br>
                    <em>CaddyRace c'est la liste <br>
                        qui vous suit pas à pas !</em>
                </span>
            </div>
            <div class="rounded mx-auto d-block slider3">
                <img class="rounded mx-auto d-block" src="public/picture/slider/logo_liste_good2.png" alt="Third slide">
                <img class="smiley" src="public/picture/slider/smiley2.png" alt="Third slide">
                <img class="caddyrace" src="public/picture/slider/caddyrace2.png" alt="Third slide">
                <img class="caddyicone" src="public/picture/slider/caddy-icon.png" alt="Third slide">
            </div>
        </div>
        <!-- SLIDE 4 -->
        <div class="carousel-item row justify-content-center align-items-between">
            <div class="title-slider4">
                <span>
                    Ajoutez, classez<br>
                    tous vos articles<br>
                    <em>tels qu'ils sont rangés<br>
                        dans votre magasin préféré !</em>
                </span>
            </div>
            <img class="rounded mx-auto d-block slider4" src="public/picture/slider/logo_rayons2.png" alt="Fourth slide">
        </div>
    </div>
    <!-- SLIDER CONTROLS -->
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>

<!-- ENTER BUTTON -->
<div class="row enter justify-content-center">
    <a href="index.php?action=connexion" class="enter-btn btn btn-dark btn-lg">
        <i class="fas fa-sign-in-alt"></i>
        <span>Entrer dans la course !</span>
        <span class="logo2 d-flex justify-content-center align-items-end">
            <img src="public/picture/brand/caddy-icon-C-70x70.png" alt="caddy picture" />
            <span>addy</span>
            <img src="public/picture/brand/caddy-icon-R-32x32.png" alt="caddy picture" />
            <span>ace</span>
        </span>
    </a>
</div>

<?php $all1=ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
