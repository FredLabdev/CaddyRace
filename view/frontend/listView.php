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

<!-- ADMIN: AVIS SIGNALES -->

<?php
    if (($_SESSION['group_id'] == 1 || $_SESSION['group_id'] == 2) && $signalComments) {
?>

<div id="comments-signaled" class="posts-view black">
    <div class="row justify-content-center">
        <a href="#popup4">
            <i class="fas fa-exclamation-circle orange fa-7x"></i>
        </a>
    </div>
    <div id="popup4" class="overlay">
        <div class="popup">
            <h3 class="text-center">Avis signalés</h3>
            <a class="close" href="#">&times;</a>
            <div class="comments-content-signaled col-xs-10">
                <?php
                    foreach($signalComments as $signalComment) {
                ?>
                <div class="row justify-content-around">
                    <span class="col-md-auto orange"><i class="fas fa-exclamation-circle"></i> signalé le
                        <?= $signalComment['signal_date_fr']; ?> par
                        <strong>
                            <?= $signalComment['signal_author']; ?></strong>
                    </span>
                    <span class="col-md-auto">
                        <strong>
                            <?= $signalComment['author']; ?>
                        </strong>
                        <span>
                            le
                            <?= $signalComment['comment_date_fr']; ?>
                        </span>
                    </span>
                </div>
                <p class="alert alert-info row col-xs-12">
                    <?= nl2br(htmlspecialchars($signalComment['comment'])); ?>
                </p>

                <!-- BOUTON SUPPRIMER UN COMMENTAIRE (uniquement si admin, modérateur, ou posté par sois-meme)-->

                <div class="boutons row">
                    <form class="offset-lg-7" action="index.php?action=deleteComment" method="post">
                        <input type="hidden" name="delete_comment" value="<?= $signalComment['id'] ?>" />
                        <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i> Supprimer</button>
                    </form>
                    <a href="index.php?action=post&amp;billet=<?= $signalComment['post_id']; ?>" class="btn btn-primary btn-sm">Accéder à l'avis complet <i class="fab fa-readme"></i></a>

                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

</div>
<?php
    }
?>

<?php $all1 = ob_get_clean(); ?>

<!-- LISTE DE COURSES -->

<?php ob_start();?>

<div class="posts-view">
    <h3 class="posts-title orange">
        <?php
            echo 'items du n° ' . $billet_max . ' au n° ' . $billet_min;
         ?>
    </h3>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link bg-darkgreen white" href="index.php?action=pagePosts&amp;page=<?php if($_GET['page'] < $pages_max){echo $_GET['page']+1;} else {echo $pages_max;} ?>">Retour</a>
                <?php 
                    for ($index=1, $pages_max; $index <= $pages_max; $index++) {
                ?>
            <li class="page-item">
                <a class="page-link bg-darkgreen white" href="index.php?action=pagePosts&amp;page=<?= $pages_max+1-$index ?>">
                    <?= $index ?></a>
                <?php
                    }
                ?>
            <li class="page-item">
                <a class="page-link bg-darkgreen white" href="index.php?action=pagePosts&amp;page=<?php if($_GET['page'] > 1){echo $_GET['page']-1;} else {echo 1;} ?>">Avance</a>
        </ul>
    </nav>
    <div class="posts-extracts col-xs-12 white">
        <?php    
            for ($i=0; $i<5; $i++) {
                if ($postsBy5[$i] != "") {
        ?>
        <div class="extract">
            <p class="row">
                <a href="index.php?action=post&amp;billet=<?= $postsBy5[$i]['id']; ?>" class="btn btn-primary">
                    <span class="white">le
                        <?= $postsBy5[$i]['date']; ?>
                    </span>
                    <span class="badge badge-light">
                        <?= $commentsCountBy5[$i]['nbre_comment']; ?>
                    </span>
                    <span class="news-title">
                        <?= $postsBy5[$i]['chapter_title'] ?>
                    </span>
                    <i class="fab fa-readme"></i>
                </a>
            </p>
        </div>
        <?php
                }
            }
        ?>
    </div>
</div>

<!-- NOUVEL ITEM -->

<div class="post-viewblack">
    <div class=title-container>
        <h3 class="posts-title orange">
            Votre nouvel item ici :
        </h3>
        <div class="row col-xs-12 text-center">
            <?php if($message_success) { ?>
            <span class="alert alert-success col-xs-4 offset-4">
                <?= $message_success; ?>
            </span>
            <?php } else if($message_error) { ?>
            <span class="alert alert-danger col-xs-4 offset-4">
                <?= $message_error; ?>
            </span>
            <?php } ?>
        </div>
    </div>
    <form method="post" action="index.php?action=addPost">
        <label>Nom du nouvel item : </label>
        <input type="text" name="titre" class="col-xs-7 news-title" /><br>
        <button type="button submit" class="btn btn-success btn-sm col-xs-1 offset-lg-10" onclick="getNewPostInForm();"><i class="fas fa-share-square"></i> Valider</button>
    </form>
</div>

<?php $all2 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
