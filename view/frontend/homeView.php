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
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
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
                        Lassé des aplis du marché<br>qui sont incomplètes ?<br><em>CadyRace le fait et<br>pour gratuit !</em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center white"><i class="red fas fa-angry"></i></span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/avis_concurrents.png"><img class="rounded mx-auto d-block slider3" src="public/picture/slider/avis_concurrents.png" alt="Third slide"></a>
                </div>
            </div>

            <!-- SLIDE 4 -->
            <div class="carousel-item">
                <div class="title-slider4">
                    <span>
                        Rangez par glisser-déposer<br>vos rayons à l'identique<br><em>du circuit suivi<br>en magasin !</em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center white">1</span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/demo_1.png"><img class="rounded mx-auto d-block slider3" src="public/picture/slider/demo_1.png" alt="Fourth slide"></a>
                </div>
            </div>

            <!-- SLIDE 5 -->
            <div class="carousel-item">
                <div class="title-slider5">
                    <span>
                        Ajoutez, modifiez, recherchez tout !<br>dans votre magasin virtuel<br><em>et préparez votre liste<br>sur mesure</em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center white">2</span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/demo_2.png"><img class="rounded mx-auto d-block slider4" src="public/picture/slider/demo_2.png" alt="Fifth slide"></a>
                </div>
            </div>

            <!-- SLIDE 6 -->
            <div class="carousel-item">
                <div class="title-slider6">
                    <span>
                       En magasin, vous n'avez plus qu'à <br>suivre l'enchaînement logique <br><em>de votre liste<br><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" id="caddie-left" />CaddyRace<img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" id="caddie-right" /></em>
                    </span>
                    <span class="demo-nb d-flex flex-column justify-content-between align-items-center">
                        <span class="d-flex justify-content-center align-items-center white">3</span>
                    </span>
                </div>
                <div class="slider-img d-flex justify-content-center align-items-start">
                    <a href="public/picture/slider/demo_3.png"><img class="rounded mx-auto d-block slider5" src="public/picture/slider/demo_3.png" alt="Sixth slide"></a>
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

<section id="comments">
    
<!-- LISTE DES COMMENTAIRES -->
    <?php if (!(empty($_SESSION['pseudo'])) && !(empty($_SESSION['password']))) { ?>
    <h3 class="posts-title orange">AVIS : Publiez le votre !</h3>
    <?php } else { ?>
    <h3 class="posts-title orange">LES AVIS :</h3>
    <?php } ?>
    <div class="comments-content">

        <?php
       while ($comment = $comments->fetch()) {  
        ?>
        <span class="row justify-content-around">
            <strong class="white">
                <?= $comment['author']; ?>
            </strong>
            <span class="green">
                le
                <?= $comment['comment_date_fr']; ?>
            </span>
        </span>
        <p class="alert alert-info">
            <?= nl2br(htmlspecialchars($comment['comment'])); ?>
        </p>

        <div class="boutons row justify-content-end">

            <!-- BOUTON MODIFIER UN COMMENTAIRE (uniquement si sois-meme)-->

            <?php
            if ($comment['author'] == $_SESSION['pseudo']) {
            ?>

            <a class="btn btn-outline-light btn-sm" data-toggle="collapse" href="#modifComment<?= $comment['id'] ?>" role="button" aria-expanded="false" aria-controls="modifComment"><i class="fas fa-eraser"></i> Modifier
            </a>
            <?php
            } 
            ?>

            <!-- BOUTON SUPPRIMER UN COMMENTAIRE (uniquement si admin, modérateur, ou posté par sois-meme)-->

            <?php
            if ($_SESSION['group_id'] == 1 || $_SESSION['group_id'] == 2 || $comment['author'] == $_SESSION['pseudo']) {
            ?>
            <form action="index.php?action=deleteComment" method="post">
                <input type="hidden" name="postId" value="1" />
                <input type="hidden" name="delete_comment" value="<?= $comment['id'] ?>" />
                <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i> Retirer</button>
            </form>
            <?php
            } 
            ?>

            <?php if($comment['comment_signal'] == 0) { ?>

            <!-- BOUTON SIGNALER UN COMMENTAIRE -->

            <form action="index.php?action=signalComment" method="post">
                <input type="hidden" name="postId" value="1" />
                <input type="hidden" name="signal_commentId" value="<?= 1 ?>" />
                <input type="hidden" name="signal_comment" value="<?= $comment['id'] ?>" />
                <button class="btn btn-warning btn-sm" type="submit" name="messageSignal"><i class="fas fa-exclamation-circle"></i> Signaler</button>
            </form>
            <?php } ?>

        </div>

        <!-- TEXTAREA POUR MODIFIER COMMENTAIRE -->

        <div class="collapse col-12" id="modifComment<?= $comment['id'] ?>">
            <form name="getCommentModif<?= $comment['id'] ?>" action="index.php?action=modifComment" method="post">
                <input type="hidden" name="postId" value="1" />
                <input type="hidden" name="modifCommentId" value="<?= $comment['id'] ?>" />
                <p>
                    <textarea id="modifComment<?= $comment['id'] ?>" class="alert alert-info col-12" name="modifComment" rows="8">
                </textarea>
                </p>
                <button class="btn btn-success btn-sm col-3 offset-9" type="submit" name="messageSignal"><i class="fas fa-share-square"></i> Publier</button>
                <p></p>
            </form>
        </div>

        <?php     
        } 
        ?>

    </div>
    
    <?php if (!(empty($_SESSION['pseudo'])) && !(empty($_SESSION['password']))) { ?>
    <!-- BOUTON ET TEXTAREA POUR AJOUTER UN COMMENTAIRE -->

    <p>
        <a class="btn btn-primary col-5 offset-6" data-toggle="collapse" href="#newComment" role="button" aria-expanded="false" aria-controls="newComment"><i class="far fa-comment-alt"></i>Commenter
        </a>
    </p>
    <div class="collapse col-12" id="newComment">
        <form id="newComment" action="index.php?action=addComment" method="post">
            <input type="hidden" name="postId" value="1" />
            <p>
                <textarea id="newComment" class="alert alert-info col-12" name="nv_comment" rows="8">
            </textarea>
            </p>
            <button class="btn btn-success btn-sm col-2 offset-10" type="submit"><i class="fas fa-share-square"></i> Publier</button>
        </form>
    </div>
    <?php } ?>

</section>

<!-- BOUTON D'ACCES AU LOGIN SI PAS DE CONNEXION -->

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
