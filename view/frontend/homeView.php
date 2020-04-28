<!--********************************************************************************-->
<!--********************************* PAGE D'ACCUEIL********************************-->
<!--*********************************       &       ********************************-->
<!--************************************ DE DEMO ***********************************-->
<!--********************************************************************************-->

<?php 
    $title = 'CaddyRace/Accueil';
    if (isset($_SESSION['group_id'])) {
        if($_SESSION['group_id'] == 1) {
        $template = 'backend';
        } else {
            $template = 'frontend';
        }
    }
    ob_start(); 
?>

<!-- SLIDER D'ACCUEIL & DE DEMO -->
<div id="carouselExampleIndicators" class="carousel slide row" data-ride="carousel">

    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
    </ol>
    
    <div class="carousel-inner">
        
        <!-- SLIDE 1 -->
        <div class="carousel-item active row justify-content-center align-items-start">
            <div class="title-slider1">
                <span>
                    
                    <!-------------- Message personalisé à la 1ère connexion -------------->
                    <?php if (!empty($_SESSION['pseudo']) && !empty($_SESSION['password'])) { ?>
                    Bienvenue <?= $_SESSION['first_name'] ?>, et félictations<br>pour avoir choisi CaddyRace !<br>
                    <em>Voyez comment remporter</em><br><em>la course</em>
 
                    <!-------------- Message de démo commun -------------->
                    <?php } else { ?>
                    Améliorez votre chrono<br>et remportez enfin<br><em>la course contre</em><br><em>vos courses !</em>
                    <?php } ?>
                    
                </span>
                <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                    <span class="d-flex justify-content-center align-items-center"><i class="orange fas fa-shopping-cart"></i></span>
                </span>
            </div>
            <div class="slider-img">
                <img class="rounded mx-auto d-block slider1" src="public/picture/slider/demo_0.png" alt="First slide">
            </div>
        </div>
        
        <!-- SLIDE 2 -->
        <div class="carousel-item row justify-content-center align-items-start">
            <div class="title-slider2">
                <span>
                    Perdu entre une liste<br>de des rayons<br><em>différemment<br>ordonnés</em>
                </span>
                <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                    <span class="d-flex justify-content-center align-items-center red"><i class="red fas fa-angry"></i></span>
                </span>
            </div>
            <div class="slider-img">
                <img class="rounded mx-auto d-block slider2" src="public/picture/slider/allee_magasin2b.jpg" alt="Second slide">>
            </div>
            <div class="slider2c">?</div>
            <div>
                <img class="rounded mx-auto d-block slider2b" src="public/picture/slider/logo_liste_wrong2.png" alt="Second slide">
            </div>
        </div>
        
        <!-- SLIDE 3 -->
        <div class="carousel-item row justify-content-center align-items-start">
            <div class="title-slider3">
                <span>
                    Rangez par glisser-déposer<br>vos rayons à l'identique<br><em>du circuit suivi<br>en magasin !</em>
                </span>
                <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                    <span class="d-flex justify-content-center align-items-center white">1</span>
                </span>
            </div>
            <div class="slider-img">
                <img class="rounded mx-auto d-block slider3" src="public/picture/slider/demo_1.png" alt="Third slide">
            </div>
        </div>
        
        <!-- SLIDE 4 -->
        <div class="carousel-item row justify-content-center align-items-start">
            <div class="title-slider4">
                <span>
                    Modifiez, recherchez des articles <br>dans votre magasin virtuel<br><em>et préparez votre<br>liste</em>
                </span>
                <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                    <span class="d-flex justify-content-center align-items-center white">2</span>
                </span>
            </div>
            <div class="slider-img">
                <img class="rounded mx-auto d-block slider4" src="public/picture/slider/demo_2.png" alt="Fourth slide">
            </div>
        </div>
        
        <!-- SLIDE 5 -->
        <div class="carousel-item row justify-content-center align-items-start">
            <div class="title-slider5">
                <span>
                    En magasin, vous déroulez<br>rayon après rayon...<br><em>une liste optimisée<br>CaddyRace</em>
                </span>
                <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                    <span class="d-flex justify-content-center align-items-center white">3</span>
                </span>
            </div>
            <div class="slider-img">
                <img class="rounded mx-auto d-block slider5" src="public/picture/slider/demo_3.png" alt="Fifth slide">
            </div>
        </div>
        
    </div>
    
    <!-- SLIDER CONTROLS -->
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-arrow-left"></i></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>

<!-- BOUTON D'ACCES AU LOGIN SI PAS DE CONNEXION -->
<?php if (empty($_SESSION['pseudo']) && empty($_SESSION['password'])) { ?>
<div class="row enter justify-content-center">
    <a href="index.php?action=connexion" class="enter-btn btn btn-dark btn-lg">
        <i class="fas fa-sign-in-alt"></i>
        <span>Entrer dans la course !</span>
        <span class="logo2 d-flex justify-content-center align-items-end">
            <img src="public/picture/brand/caddy-icon-C-70x70.png" alt="caddy picture" />
            <span>addy</span>
            <img src="public/picture/brand/caddy-icon-R-23x23.png" alt="caddy picture" />
            <span>ace</span>
        </span>
    </a>
</div>
<?php } ?>

<?php $all1=ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
