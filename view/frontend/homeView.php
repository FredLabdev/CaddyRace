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

<section>
    
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
            <div class="carousel-item active">
                <div class="title-slider1">
                    
                    <!-------------- Message personalisé à la 1ère connexion -------------->
                    <?php if (!empty($_SESSION['pseudo']) && !empty($_SESSION['password'])) { ?>
                    <span>
                        Bienvenue <?= $_SESSION['first_name'] ?>, et félicitations<br>pour avoir choisi CaddyRace !<br>
                        <em>Voyez comment remporter</em><br><em>votre course</em>
                    </span>
                    <span class="demo-nb d-flex flex-row justify-content-center align-items-center">
                        Comme déjà <span class="d-flex justify-content-center align-items-center orange"> <?= $membersCount2['nbre_members'] ?> </span> participants !
                    </span>

                    <!-------------- Message de démo commun -------------->
                    <?php } else { ?>
                    <span>
                        Améliorez votre chrono<br>et remportez enfin<br><em>la course contre</em><br><em>vos courses !</em>
                    </span>
                    <span class="demo-nb d-flex flex-row justify-content-center align-items-center">
                        CaddyRace, la meilleure <span class="d-flex justify-content-center align-items-center orange"><i class="fas fa-shopping-cart"></i></span> liste de courses gratuite !
                    </span>
                    <?php } ?>

                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/demo_0.png"><img class="rounded mx-auto d-block slider1" src="public/picture/slider/demo_0.png" alt="First slide"></a>
                </div>
            </div>

            <!-- SLIDE 2 -->
            <div class="carousel-item">
                <div class="title-slider2">
                    <span>
                        Perdu entre une liste<br>de des rayons<br><em>différemment<br>ordonnés</em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center red"><i class="red fas fa-angry"></i></span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a><img class="rounded mx-auto d-block slider2" src="public/picture/slider/allee_magasin2b.jpg" alt="Second slide"></a>
                </div>
                <div class="slider2c">?</div>
                <div>
                    <img class="rounded mx-auto d-block slider2b" src="public/picture/slider/logo_liste_wrong2.png" alt="Second slide">
                </div>
            </div>

            <!-- SLIDE 3 -->
            <div class="carousel-item">
                <div class="title-slider3">
                    <span>
                        Rangez par glisser-déposer<br>vos rayons à l'identique<br><em>du circuit suivi<br>en magasin !</em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center white">1</span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/demo_1.png"><img class="rounded mx-auto d-block slider3" src="public/picture/slider/demo_1.png" alt="Third slide"></a>
                </div>
            </div>

            <!-- SLIDE 4 -->
            <div class="carousel-item">
                <div class="title-slider4">
                    <span>
                        Ajoutez, modifiez, recherchez tout !<br>dans votre magasin virtuel<br><em>et préparez votre liste<br>sur mesure</em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center white">2</span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/demo_2.png"><img class="rounded mx-auto d-block slider4" src="public/picture/slider/demo_2.png" alt="Fourth slide"></a>
                </div>
            </div>

            <!-- SLIDE 5 -->
            <div class="carousel-item">
                <div class="title-slider5">
                    <span>
                       En magasin, vous n'avez plus qu'à <br>suivre l'enchaînement logique <br><em>de votre liste<br><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" id="caddie-left" />CaddyRace<img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" id="caddie-right" /></em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center white">3</span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/demo_3.png"><img class="rounded mx-auto d-block slider5" src="public/picture/slider/demo_3.png" alt="Fifth slide"></a>
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
</section>
    
<!-- ORDI SEULEMENT BOUTON D'ACCES AU LOGIN SI PAS DE CONNEXION -->
<?php if (empty($_SESSION['pseudo']) && empty($_SESSION['password'])) { ?>
<section id="footer-all">
    <div class="home-footer bg-dark row d-flex flex-column justify-content-center align-items-center d-enter justify-content-center">
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
</section>
<?php } ?>

<!-- FOOTER HOMEVIEW MOBILE SEULEMENT 
<section id="footer-homeview">
    <footer class="text-center white">
        <!-- BOUTON D'ACCES AU LOGIN SI PAS DE CONNEXION -->
        <?php /* if (empty($_SESSION['pseudo']) && empty($_SESSION['password'])) { ?>
   <!--     <div class="home-footer row d-flex flex-column justify-content-center align-items-center d-enter justify-content-center">
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
        <?php } */ ?>
      <!-- <div class=" <?php /* if (empty($_SESSION['pseudo']) && empty($_SESSION['password'])) { echo 'home-footer'; } else { echo 'home-footer-connect'; } */ ?> <!-- sm-row xs-column d-flex flex-column justify-content-center align-items-center white">
            <span>CaddyRace</span><span>Copyrights © 2019 labdev, tous droits réservés.</span><span class="email"><a  href="mailto:fred@labdev.fr">contact</a></span><span class="site-info"><a href="http://labdev.fr" target=_blank>Brainmade by Labdev</a></span>
        </div> 
        <div class=" --> <?php /* if (empty($_SESSION['pseudo']) && empty($_SESSION['password'])) { echo 'home-footer'; } else { echo 'home-footer-connect'; } */ ?> <!-- d-flex flex-column justify-content-start align-items-center bg-orange">
            <div class="d-flex justify-content-center align-items-center">
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://www.facebook.com/labdev.web/" target=_blank><span><i class="fab fa-facebook-f fa-lg white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://twitter.com/labdev_web" target=_blank><span><i class="fab fa-twitter fa-lg white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://www.instagram.com/labdev_web/" target=_blank><span><i class="fab fa-instagram fa-lg white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://www.linkedin.com/in/frederic-labourel/" target=_blank><span><i class="fab fa-linkedin-in white"></i></span></a></button>
                <button class="d-flex justify-content-center align-items-center btn btn-info social-link"><a href="https://github.com/FredLabdev/" target=_blank><span><i class="fab fa-github white"></i></span></a></button>
            </div>
        <h2>Suivez Labdev</h2>
        </div>
        
    </footer>
</section> -->

<?php $all1=ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
