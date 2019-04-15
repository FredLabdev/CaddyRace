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

<!-- MENU ADMIN -->

<div id="tabs-Admin" class="tabs">

    <div class="row">
        <nav class="list-nav navbar navbar-light bg-orange fixed-top">
            <form class="search-bar form-inline">
                <input type="text" class="typeahead tt-query" id="recherche2" placeholder="Vérifier existence d'un article" autocomplete="off" spellcheck="false" />
            </form>
            <ul class="nav nav-pills nav-stacked align-items-center">
                <li class="nav-item ">
                    <a class="nav-link" href="#liste" id="liste-tab"><i class="far fa-th fa-2x"></i><span class="list-nav-text"> Articles</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#rayons" id="rayons-tab"><i class="fas fa-stream fa-2x"></i><span class="list-nav-text"> Rayons</span></a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- ITEMS -->

    <div id="liste">

        <div id="popup5" class="overlay">
            <div class="text-center popup popup-sm">
                <h3>Ajouté !</h3>
                <a class="close" href="#">&times;</a>
                <div class="content orange">
                    Cet article est désormais ajouté à votre liste dans le rayon !
                </div>
            </div>
        </div>

        <div id="accordion-Admin">

            <!---------------------- Rayon ---------------------->
            <?php    
             for ($i=0; $i<$aislesGeneCount['count']; $i++) {
            ?>
            <div class="d-flex flex-row">
                <?php
                foreach ($aislesGeneIconsTab[$i] as $aislesGeneIcons) {
                ?>
                <span class="col-1 aisles-icons"><img src="public/picture/items/<?= $aislesGeneIcons['icon_adress'] ?>" alt="caddy picture" title="Caddie" /></span>
                <?php
                }
                ?>
                <h4 class="ray col-xs-7 col-sm-8" id="one">
                    <?= $aislesGeneTab[$i]['aisle_gene_title'] ?>
                </h4>
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange far fa-th"></i>
                    <span class="caddie2 d-flex justify-content-center align-items-center">
                        <?= $itemsGeneCountInAisleTab[$i]['count'] ?>
                    </span>
                </span>
            </div>
            <div>
                <ul>
                    <li class="dropdown-item offset-1" href="#">
                        <form class="form-row col-11 justify-content-start align-items-center" method="post" action="index.php?action=createItemGene">
                            <input type="hidden" name="aisleGeneId" value="<?= $aislesGeneTab[$i]['id'] ?>" />
                            <input type="text" name="itemGeneName" class="item-gene col-10" placeholder="Rajouter un article dans ce rayon ?" focus />
                            <button type="submit" class="action-button"><i class="fas fa-plus"></i></button>
                        </form>
                    </li>
                    <?php
                    foreach ($itemsGeneInAisleTab[$i] as $itemGeneInAisle) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                        <form class="delete-form col-1 d-flex justify-content-end" method="post" action="index.php?action=deleteItemGene">
                            <input type="hidden" name="itemGeneId" value="<?= $itemGeneInAisle['id'] ?>" />
                            <button type="submit" class="action-button"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <form class="form-row col-11 justify-content-start align-items-center" method="post" action="index.php?action=modifItemGene">
                            <input type="hidden" name="itemGeneId" value="<?= $itemGeneInAisle['id'] ?>" />
                            <input type="text" name="itemGeneName" class="modif-form item-gene col-10" value="<?= $itemGeneInAisle['item_gene_name'] ?>" />
                            <button type="submit" class="action-button"><i class="fas fa-pencil-alt"></i></button>
                        </form>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
            }
            ?>

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
                <!--<form class="form" method="post" action="index.php?action=modifAislesGeneOrder">-->
                <div id="maj"></div>
                <ul id="sortable-admin" class="sortable col-10">
                    <?php    
                    for ($i=0; $i<$aislesGeneCount['count']; $i++) {
                    ?>
                    <li class="ui-state-default row" id="aisleId_<?= $aislesGeneTab[$i]['id'] ?>">
                        <i class="fas fa-sort"></i>
                        <span class="col-1 famIcon1 autr"></span>
                        <span class="col-1 famIcon2 autr2"></span>
                        <h4 class="ray-order col-7">
                            <?= $aislesGeneTab[$i]['aisle_gene_title'] ?>
                        </h4>

                        <i class="fam-select orange fas fa-stream col-1"></i>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="list-group rayon-num col-2">
                    <?php    
                    for ($i=0; $i<$aislesGeneCount['count']; $i++) {
                    ?>
                    <li class="list-group-item">
                        <?= $i+1 ?>
                    </li>
                    <?php
                    }
                    ?>
                </ul>

                <!--<input type="submit" value="enregistrer"/>
               </form>-->
                <form action="" method="post">
                    <input type="hidden" name="sortable-admin" />
                </form>
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
