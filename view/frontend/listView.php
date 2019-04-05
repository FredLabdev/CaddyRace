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

    <div class="row">
        <nav id="list-nav" class="navbar navbar-light bg-dark fixed-top">
            <form class="search-bar form-inline">
                <span class="nav-item item-create">
                    <a class="nav-link" href="#item" id="item-tab"><i class="far fa-plus-circle fa-2x orange"></i></a>
                </span>
                <input type="text" class="typeahead tt-query" id="recherche" placeholder="Que vous manque-t-il ?" autocomplete="off" spellcheck="false" />
                <span class="nav-item item-create">
                    <a class="nav-link" href="#item" id="item-tab"><i class="fas fa-check-circle fa-2x green"></i></a>
                </span>
            </form>
            <ul class="nav nav-pills nav-stacked align-items-center">
                <li class="nav-item ">
                    <a class="nav-link" href="#liste" id="liste-tab"><i class="far fa-th fa-2x"></i><span class="list-nav-text"> Liste</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#rayons" id="rayons-tab"><i class="fas fa-stream fa-2x"></i><span class="list-nav-text"> Rayons</span></a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- LISTE -->

    <div id="liste">
        <div id="accordion">

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 autr"></span>
                <span class="col-1 famIcon2 autr2"></span>
                <h4 class="col-7" id="one">Divers</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=1; $i<5; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 hygi"></span>
                <span class="col-1 famIcon2 hygi2"></span>
                <h4 class="col-7" id="two">Toilette, Maquillage</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=6; $i<10; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 fari"></span>
                <span class="col-1 famIcon2 fari2"></span>
                <h4 class="col-7" id="three">Dessert, Farine, Compotes</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=11; $i<15; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 choc"></span>
                <span class="col-1 famIcon2 choc2"></span>
                <h4 class="col-7" id="three2">Goûters, Chocolat</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=16; $i<20; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 conf"></span>
                <span class="col-1 famIcon2 conf2"></span>
                <h4 class="col-7" id="four">Confiture, Café, Thé</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=21; $i<25; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 cere"></span>
                <span class="col-1 famIcon2 cere2"></span>
                <h4 class="col-7" id="five">Pain, Céréales</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=26; $i<30; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 mena"></span>
                <span class="col-1 famIcon2 mena2"></span>
                <h4 class="col-7" id="six">Ménage, Animaux</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=31; $i<35; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 cond"></span>
                <span class="col-1 famIcon2 cond2"></span>
                <h4 class="col-7" id="seven">Huile, Condiments, Pdts monde</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=36; $i<40; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 pate"></span>
                <span class="col-1 famIcon2 pate2"></span>
                <h4 class="col-7" id="height">Pâtes, Riz, Thon, Potages</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=41; $i<45; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 cons"></span>
                <span class="col-1 famIcon2 cons2"></span>
                <h4 class="col-7" id="nine">Conserve, Plats cuisinés</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=46; $i<50; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 bois"></span>
                <span class="col-1 famIcon2 bois2"></span>
                <h4 class="col-7" id="ten">Boissons</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=51; $i<55; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 aper"></span>
                <span class="col-1 famIcon2 aper2"></span>
                <h4 class="col-7" id="eleven">Biscuits apéritifs</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=56; $i<60; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 lait"></span>
                <span class="col-1 famIcon2 lait2"></span>
                <h4 class="col-7" id="twelve">Laitages, Oeufs</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=61; $i<65; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 surg"></span>
                <span class="col-1 famIcon2 surg2"></span>
                <h4 class="col-7" id="thirteen">Surgelés</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=66; $i<70; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 frai"></span>
                <span class="col-1 famIcon2 frai2"></span>
                <h4 class="col-7" id="else">Charcuterie, Pâtes tarte</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=71; $i<75; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 vian"></span>
                <span class="col-1 famIcon2 vian2"></span>
                <h4 class="col-7" id="else">Viandes, Poissons, traiteur</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=76; $i<80; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 coup"></span>
                <span class="col-1 famIcon2 coup2"></span>
                <h4 class="col-7" id="else">A la coupe</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=81; $i<85; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 frui"></span>
                <span class="col-1 famIcon2 frui2"></span>
                <h4 class="col-7" id="else">Fruits, Légumes</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=86; $i<90; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>

            <div class="d-flex flex-row">
                <span class="col-1 famIcon1 boul"></span>
                <span class="col-1 famIcon2 boul2"></span>
                <h4 class="col-7" id="else">Boulangerie</h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-shopping-cart caddie1"></i>
                    <span class="caddie2">22</span>
                </span>
            </div>
            <div>
                <?php    
            for ($i=91; $i<95; $i++) {
               ?>
                <a class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                    <span class="item-delete d-flex p-2"><i class="fas fa-trash"></i></span>
                    <input type="checkbox" name="checkbox-<?= $i ?>" id="checkbox-<?= $i ?>">
                    <label class="item-check col-9" for="checkbox-<?= $i ?>">Article
                        <?= $i ?></label>
                    <span class="item-modif d-flex align-items-center p-2"><i class="fas fa-pencil-alt"></i></span>
                </a>
                <?php
            }
            ?>
            </div>
        </div>
    </div>

    <!-- RAYONS -->

    <div id="rayons">

        <div class="rayons-org col-10 offset-1">
            <div class="row">
                <div class="col-12 circuit text-center bg-green">
                    <i class="fas fa-flag fa-2x"></i> Entrée circuit
                </div>
            </div>
            <div class="row">
                <ul class="list-group rayon-num col-2">
                    <?php    
                    for ($i=1; $i<=20; $i++) {
                    ?>
                    <li class="list-group-item">
                        <?= $i ?>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
                <ul id="sortable" class="col-10 offset-2">
                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 autr"></span>
                        <span class="col-1 famIcon2 autr2"></span>
                        <h4 class="ray col-7">Divers</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 hygi"></span>
                        <span class="col-1 famIcon2 hygi2"></span>
                        <h4 class="ray col-7">Toilette, Maquillage</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 fari"></span>
                        <span class="col-1 famIcon2 fari2"></span>
                        <h4 class="ray col-7">Dessert, Farine, Compotes</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 choc"></span>
                        <span class="col-1 famIcon2 choc2"></span>
                        <h4 class="ray col-7">Goûters, Chocolat</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 conf"></span>
                        <span class="col-1 famIcon2 conf2"></span>
                        <h4 class="ray col-7">Confiture, Café, Thé</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 cere"></span>
                        <span class="col-1 famIcon2 cere2"></span>
                        <h4 class="ray col-7">Pain, Céréales</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 mena"></span>
                        <span class="col-1 famIcon2 mena2"></span>
                        <h4 class="ray col-7">Ménage, Animaux</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 cond"></span>
                        <span class="col-1 famIcon2 cond2"></span>
                        <h4 class="ray col-7">Huile, Condiments, Pdts monde</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 pate"></span>
                        <span class="col-1 famIcon2 pate2"></span>
                        <h4 class="ray col-7">Pâtes, Riz, Thon, Potages</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 cons"></span>
                        <span class="col-1 famIcon2 cons2"></span>
                        <h4 class="ray col-7">Conserves, Plats cuisinés</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 bois"></span>
                        <span class="col-1 famIcon2 bois2"></span>
                        <h4 class="ray col-7">Boissons</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 aper"></span>
                        <span class="col-1 famIcon2 aper2"></span>
                        <h4 class="ray col-7">Biscuits apéritif</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 lait"></span>
                        <span class="col-1 famIcon2 lait2"></span>
                        <h4 class="ray col-7">Laitages, Oeufs</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 surg"></span>
                        <span class="col-1 famIcon2 surg2"></span>
                        <h4 class="ray col-7">Surgelés</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 frai"></span>
                        <span class="col-1 famIcon2 frai2"></span>
                        <h4 class="ray col-7">Charcuterie, pâtes tarte</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 vian"></span>
                        <span class="col-1 famIcon2 vian2"></span>
                        <h4 class="ray col-7">Viandes, Poissons</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 coup"></span>
                        <span class="col-1 famIcon2 coup2"></span>
                        <h4 class="ray col-7">A la coupe</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 frui"></span>
                        <span class="col-1 famIcon2 frui2"></span>
                        <h4 class="ray col-7">Fruits, Légumes</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 boul"></span>
                        <span class="col-1 famIcon2 boul2"></span>
                        <h4 class="ray col-7">Boulangerie</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>

                    <li class="ui-state-default row">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1"></span>
                        <span class="col-1 famIcon2"><i class="fas fa-plus-square fa-2x"></i></span>
                        <h4 class="ray col-7">Ajouter un rayon ?</h4>
                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12 circuit text-center bg-red">
                    <i class="fas fa-flag-checkered fa-2x"></i> Sortie Circuit
                </div>
            </div>
        </div>

    </div>

</div>

<?php $all1 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
