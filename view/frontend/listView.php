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

<!-- MENU COURSES -->

<nav id="navbar-example2" class="navbar navbar-light bg-dark fixed-top justify-content-end">

    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="#liste"><i class="far fa-file-alt fa-2x"></i> Liste</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tri"><i class="fas fa-cogs fa-2x"></i> Tris</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#caddie"><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" /> Go !</a>
        </li>
    </ul>
</nav>

<div id="list_scroll" data-spy="scroll" data-target="#navbar-example2" data-offset="0">

    <!-- LISTE -->

    <nav id="liste" class="navbar navbar-dark bg-dark">
        <span class="white">
            Votre liste
        </span>
        <ul class="nav nav-pills">
        </ul>
    </nav>

    <div class="bs-example">
        <h2>Ajouter un article à la liste</h2>
        <input type="text" class="typeahead tt-query" id="recherche" placeholder="Rechercher un article ici..." autocomplete="off" spellcheck="false" />
    </div>

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

    <!-- TRIS -->

    <nav id="tri" class="navbar navbar-dark bg-dark">
        <span class="white">
            Tri par Familles &amp; Rayons
        </span>
        <ul class="nav nav-pills">
            <li class="nav-item dropdown orange">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-th-large fa-2x"></i> Familles</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#one">Boissons</a>
                    <a class="dropdown-item" href="#two">Condiments</a>
                    <a class="dropdown-item" href="#three">Conserves</a>
                    <a class="dropdown-item" href="#four">Fruits &amp; Légumes</a>
                    <a class="dropdown-item" href="#five">Hygiène</a>
                    <a class="dropdown-item" href="#six">Laitages</a>
                    <a class="dropdown-item" href="#seven">Ménage &amp; Animaux</a>
                    <a class="dropdown-item" href="#height">Pain &amp; Céréales</a>
                    <a class="dropdown-item" href="#nine">Pâtes &amp; Riz</a>
                    <a class="dropdown-item" href="#ten">Rayon frais</a>
                    <a class="dropdown-item" href="#eleven">Sucres, Farines &amp; Gâteaux</a>
                    <a class="dropdown-item" href="#twelve">Surgelès</a>
                    <a class="dropdown-item" href="#thirteen">Viandes &amp; Poissons</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#else">Autre</a>
                </div>
            </li>
            <li class="nav-item orange">
                <a><i class="far fa-th fa-2x"></i> Articles</a>
            </li>
        </ul>
    </nav>

    <div id="accordion">
        <div class="d-flex flex-row">
            <h4 id="one">Boissons</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="two">Condiments</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="three">Conserves</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="four">Fruits &amp; Légumes</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="five">Hygiène</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="six">Laitages</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="seven">Ménage &amp; Animaux</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="height">Pain &amp; Céréales</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="far fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="nine">Pâtes &amp; Riz</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="ten">Rayon frais</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="eleven">Confiserie, Gâteaux</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="twelve">Surgelès</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="thirteen">Viandes &amp; Poissons</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
        <div class="d-flex flex-row">
            <h4 id="else">Autre</h4>
            <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints black"></i></div>
        </div>
        <div>
            <a class="dropdown-item d-flex flex-row" href="#">Article 1
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 2
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>9</span>
            </a>
            <a class="dropdown-item d-flex flex-row" href="#">Article 3
                <span class="alert3b d-flex justify-content-between"><i class="fas fa-shopping-cart"></i>8</span>
            </a>
        </div>
    </div>

    <!-- COURSES -->

    <nav id="caddie" class="navbar navbar-dark bg-dark">
        <span class="white">
            Démarrez vos courses !
        </span>
        <ul class="nav nav-pills">
            <li class="nav-item white">
                <a><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" /> To pick up</a>
            </li>
            <li class="nav-item orange">
                <a><img src="public/picture/brand/caddy-icon-C-38x38.png" alt="caddy picture" title="Caddie" /> To pay</a>
            </li>
        </ul>
    </nav>

</div>

<?php $all1 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
