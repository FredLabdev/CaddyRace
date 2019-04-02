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
            <div class="bs-example">
                <input type="text" class="typeahead tt-query" id="recherche" placeholder="Que vous manque-t-il ?" autocomplete="off" spellcheck="false" />
            </div>
            <li class="nav-item">
                <a class="nav-link" href="#liste" id="list-tab" onclick="focusListe()"><i class="far fa-file-alt fa-2x"></i> Liste</a>
            </li>
            <li class="nav-item" id="liste-nav">
                <a class="nav-link" href="#liste" id="byABC-tab" onclick="focusListe1()"><i class="far fa-th fa-2x"></i> /ABC</a>
            </li>
            <li class="nav-item" id="liste-nav2">
                <a class="nav-link" href="#liste2" id="byFam-tab" onclick="focusListe2()"><i class="far fa-th-large fa-2x"></i> /Famille</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#pref" id="pref-tab" onclick="focusPref()"><i class="far fa-cogs fa-2x"></i> Pref</a>
            </li>

            <li class="nav-item" id="pref-nav">
                <a class="nav-link" href="#pref" id="fam-tab" onclick="focusPref1()"><i class="far fa-th-large fa-2x"></i> Familles</a>
            </li>
            <li class="nav-item" id="pref-nav2">
                <a class="nav-link" href="#pref2" id="ray-tab" onclick="focusPref2()"><i class="fas fa-stream fa-2x"></i> Rayons</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#caddie" id="caddie-tab" onclick="focusCaddie()"><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" /> Go !</a>
            </li>

            <li class="nav-item white" id="caddie-nav">
                <a class="nav-link" href="#tobuy" id="to-buy" onclick="focusCaddie1()"><img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" title="Caddie" /> To buy</a>
            </li>
            <li class="nav-item orange" id="caddie-nav2">
                <a class="nav-link" href="#topay" id="to-pay" onclick="focusCaddie2()"><i class="fas fa-shopping-cart fa-2x"></i> To pay</a>
            </li>
        </ul>

    </nav>

    <!-- LISTE -->

    <div id="liste">

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

    <div id="">
    </div>

    <div id="liste2">
        <p>
            TODO: Tous les articles (ceux cochés en tête de famille) triés par Familles. Avec possibilité d'en coché d'autres...
        </p>
    </div>

    <!-- PREFERENCES -->

    <div id="pref">

        <div id="accordion">

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 bois"></span>
                <span class="col-1 famIcon2 bois2"></span>
                <h4 id="one">Boissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 cond"></span>
                <span class="col-1 famIcon2 cond2"></span>
                <h4 id="two">Condiments</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 cons"></span>
                <span class="col-1 famIcon2 cons2"></span>
                <h4 id="three">Conserves</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 frui"></span>
                <span class="col-1 famIcon2 frui2"></span>
                <h4 id="four">Fruits &amp; Légumes</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 hygi"></span>
                <span class="col-1 famIcon2 hygi2"></span>
                <h4 id="five">Hygiène</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 lait"></span>
                <span class="col-1 famIcon2 lait2"></span>
                <h4 id="six">Laitages</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 mena"></span>
                <span class="col-1 famIcon2 mena2"></span>
                <h4 id="seven">Ménage &amp; Animaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 cere"></span>
                <span class="col-1 famIcon2 cere2"></span>
                <h4 id="height">Pain &amp; Céréales</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="far fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 pate"></span>
                <span class="col-1 famIcon2 pate2"></span>
                <h4 id="nine">Pâtes &amp; Riz</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 frai"></span>
                <span class="col-1 famIcon2 frai2"></span>
                <h4 id="ten">Rayon frais</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 gate"></span>
                <span class="col-1 famIcon2 gate2"></span>
                <h4 id="eleven">Confiserie, Gâteaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 surg"></span>
                <span class="col-1 famIcon2 surg2"></span>
                <h4 id="twelve">Surgelès</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 vian"></span>
                <span class="col-1 famIcon2 vian2"></span>
                <h4 id="thirteen">Viandes &amp; Poissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 autr">?</span>
                <span class="col-1 famIcon2 autr2"></span>
                <h4 id="else">Autre</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>

        </div>

    </div>

    <div id="">
    </div>

    <div id="pref2">
        <div class="circuit d-flex flex-row justify-content-center align-items-center bg-green">
            <div><i class="fas fa-flag fa-2x"></i> Entrée circuit</div>
        </div>

        <ul id="sortable">

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Divers</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files1"></label>
                            <select name="files1" id="files1" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Toilette, Maquillage</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files2"></label>
                            <select name="files2" id="files2" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Dessert, Farine, Compotes</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files3"></label>
                            <select name="files3" id="files3" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Goûters, Chocolat</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files4"></label>
                            <select name="files4" id="files4" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Confiture, Café, Thé</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files5"></label>
                            <select name="files5" id="files5" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Pain, Céréales</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files6"></label>
                            <select name="files6" id="files6" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Ménage, Animaux</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files7"></label>
                            <select name="files7" id="files7" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Huile, Condiments, Pdts monde</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files8"></label>
                            <select name="files8" id="files8" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Pâtes, Riz, Thon, Potages</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files9"></label>
                            <select name="files9" id="files9" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Conserves, Plats cuisinés</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files10"></label>
                            <select name="files10" id="files10" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Boissons</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files11"></label>
                            <select name="files11" id="files11" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Biscuits apéritif</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files12"></label>
                            <select name="files12" id="files12" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Laitages, Oeufs</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files13"></label>
                            <select name="files13" id="files13" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Surgelés</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files14"></label>
                            <select name="files14" id="files14" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Charcuterie, pâtes tarte</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files15"></label>
                            <select name="files15" id="files15" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Viandes, Poissons</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files16"></label>
                            <select name="files16" id="files16" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">A la coupe</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files17"></label>
                            <select name="files17" id="files17" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Fruits, Légumes</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files18"></label>
                            <select name="files18" id="files18" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Boulangerie</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files19"></label>
                            <select name="files19" id="files19" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

            <li class="ui-state-default row"><i class="fas fa-sort col-1"></i><span class="col-10">Ajouter ?</span><i class="fam-select blue far fa-th-large col-1"></i>
                <div class="demo">
                    <form action="#">
                        <fieldset>
                            <label for="files20"></label>
                            <select name="files20" id="files20" class="famSelect">
                                <option value="mypodcast" data-class="podcast">Famille</option>
                                <option value="myvideo" data-class="video">Fruits et Légumes</option>
                                <option value="myrss" data-class="rss">Laitages</option>
                            </select>
                        </fieldset>
                    </form>
                </div>
            </li>

        </ul>

        <div class="circuit d-flex flex-row justify-content-center align-items-center bg-red">
            <div><i class="fas fa-flag-checkered fa-2x"></i> Fin circuit</div>
        </div>

    </div>

    <!-- COURSES -->

    <div id="caddie">

        <div id="caddie-accordion">
            <div class="d-flex flex-row">
                <h4 id="c-one">Boissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-two">Condiments</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-three">Conserves</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-four">Fruits &amp; Légumes</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-five">Hygiène</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-six">Laitages</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-seven">Ménage &amp; Animaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-height">Pain &amp; Céréales</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="far fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-nine">Pâtes &amp; Riz</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-ten">Rayon frais</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-eleven">Confiserie, Gâteaux</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-twelve">Surgelès</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-thirteen">Viandes &amp; Poissons</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
            </div>
            <div class="d-flex flex-row">
                <h4 id="c-else">Autre</h4>
                <div class="alert3 d-flex justify-content-between">2<i class="fas fa-stream"></i></div>
            </div>
            <div>
                <a class="dropdown-item d-flex flex-row" href="#">Article 1
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 2
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>9</span>
                </a>
                <a class="dropdown-item d-flex flex-row" href="#">Article 3
                    <span class="alert3b d-flex justify-content-between"><i class="fas fa-stream"></i>8</span>
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
