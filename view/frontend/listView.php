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

<div id="tabs">

    <nav id="list-nav" class="navbar navbar-light bg-dark fixed-top justify-content-end">

        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="#liste" onclick="focusListe()"><i class="far fa-file-alt fa-2x"></i> Liste</a>
            </li>

            <li class="nav-item" id="liste-nav">
                <a class="nav-link" href="#liste1"><i class="far fa-th-large fa-2x"></i> Liste</a>
            </li>
            <li class="nav-item" id="liste-nav2">
                <a class="nav-link" href="#articles"><i class="far fa-th fa-2x"></i> Article</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#pref" onclick="focusPref()"><i class="fas fa-cogs fa-2x"></i> Pref</a>
            </li>

            <li class="nav-item" id="pref-nav">
                <a class="nav-link" href="#fam"><i class="far fa-th-large fa-2x"></i> Familles</a>
            </li>
            <li class="nav-item" id="pref-nav2">
                <a class="nav-link" href="#pref2"><i class="fas fa-stream fa-2x"></i> Rayons</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#caddie" onclick="focusCaddie()"><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" /> Go !</a>
            </li>

            <li class="nav-item white" id="caddie-nav">
                <a class="nav-link" href="#tobuy"><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" /> To pick up</a>
            </li>
            <li class="nav-item orange" id="caddie-nav2">
                <a class="nav-link" href="#topay"><img src="public/picture/brand/caddy-icon-C-38x38.png" alt="caddy picture" title="Caddie" /> To pay</a>
            </li>

        </ul>

    </nav>

    <!-- LISTE -->

    <div id="liste">

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

    </div>

    <div id="liste1">
        <p>
            TODO: la liste 1 !
        </p>
    </div>

    <div id="articles">
        <p>
            TODO: les articles !
        </p>
    </div>

    <!-- PREFERENCES -->

    <div id="pref">

        <div id="accordion">

            <div class="d-flex flex-row">
                <h4 id="one">Boissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="two">Condiments</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="three">Conserves</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="four">Fruits &amp; Légumes</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="five">Hygiène</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="six">Laitages</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="seven">Ménage &amp; Animaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="height">Pain &amp; Céréales</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="far fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="nine">Pâtes &amp; Riz</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="ten">Rayon frais</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="eleven">Confiserie, Gâteaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="twelve">Surgelès</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="thirteen">Viandes &amp; Poissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="else">Autre</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>

        </div>

    </div>

    <div id="fam">
        <p>
            TODO: les familles !
        </p>
    </div>

    <div id="pref2">
        <p>
            TODO: les rayons !
        </p>
    </div>

    <!-- COURSES -->

    <div id="caddie">

        <div id="caddie-accordion">
            <div class="d-flex flex-row">
                <h4 id="c-one">Boissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-two">Condiments</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-three">Conserves</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-four">Fruits &amp; Légumes</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-five">Hygiène</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-six">Laitages</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-seven">Ménage &amp; Animaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-height">Pain &amp; Céréales</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="far fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-nine">Pâtes &amp; Riz</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-ten">Rayon frais</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-eleven">Confiserie, Gâteaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-twelve">Surgelès</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-thirteen">Viandes &amp; Poissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-else">Autre</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-shoe-prints"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-shoe-prints"></i>8</span>
                </a>
            </div>
        </div>

    </div>

    <div id="tobuy">
        <p>
            TODO: les To Buy !
        </p>
    </div>

    <div id="topay">
        <p>
            TODO: les To Pay !
        </p>
    </div>

</div>

<?php $all1 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
