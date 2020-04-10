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

<!-- MENU ADMIN BOUTIQUE -->

<div id="tabs-Admin" class="tabs">

    <div class="row">
        <nav class="list-nav navbar navbar-light bg-orange fixed-top justify-content-end">
            <ul class="nav nav-pills nav-stacked align-items-center">
                <li class="nav-item ">
                    <a class="nav-link liste-tab" href="#items-admin"><i class="far fa-th fa-2x"></i><span class="list-nav-text"> Articles</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link rayons-tab" href="#aisles-admin"><i class="fas fa-stream fa-2x"></i><span class="list-nav-text"> Rayons</span></a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- TAB DES ARTICLES RANGES PAR RAYONS -->

    <div id="items-admin">

        <!-------------- Search Bar d'un article dans la barre de nav -------------->
        <form class="search-bar form-inline">
            <input type="text" class="typeahead tt-query" id="recherche2" placeholder="Vérifier existence d'un article" autocomplete="off" spellcheck="false" />
        </form>

        <div id="popup5" class="overlay">
            <div class="text-center popup popup-sm">
                <h3>Ajouté !</h3>
                <a class="close" href="#">&times;</a>
                <div class="content orange">
                    Cet article est désormais ajouté à votre liste dans le rayon !
                </div>
            </div>
        </div>

        <!-------------- Magasin en accordéon -------------->
        <div id="accordion-Admin">

            <!-------------- Boucle primaire des rayons -------------->
            <?php    
             for ($i=0; $i<$aislesGeneCount['count']; $i++) {
            ?>
            <!--------------- En-tête du rayon -------------------->
            <div class="d-flex flex-row">
                <?php
                foreach ($aislesGeneIconsTab[$i] as $aislesGeneIcons) {
                ?>
                <span class="col-1 d-flex justify-content-center align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesGeneIcons['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php
                }
                ?>
                <h4 class="ray col-xs-8 col-sm-8" id="one">
                    <?= $aislesGeneTab[$i]['aisle_gene_title'] ?>
                </h4>
                <!--------------- Comptage des articles du rayon -------------------->
                <span class="d-flex flex-row justify-content-between align-items-center">
                    <i class="fam-select orange far fa-th"></i>
                    <span class="caddie2 d-flex justify-content-center align-items-center">
                        <?= $itemsGeneCountInAisleTab[$i]['count'] ?>
                    </span>
                </span>
            </div>
            <!--------------- Contenu d'un rayon -------------------->
            <div>
                <ul>
                    <!---------------- Y ajouter un article ---------------------->
                    <li class="dropdown-item d-flex justify-content-center align-items-center" href="#">
                        <span class="col-1"></span>
                        <form class="modif-form new-item form-row col-11 offset-1 justify-content-start align-items-center" method="post" action="index.php?action=createItemGene">
                            <input type="hidden" name="aisleGeneId" value="<?= $aislesGeneTab[$i]['id'] ?>" />
                            <input type="text" name="itemGeneName" class="item-gene col-10" placeholder="Rajouter un article dans ce rayon ?" focus />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-plus"></i></button>
                        </form>
                    </li>
                    <!---------------- Boucle secondaire des articles ---------------------->
                    <?php
                    foreach ($itemsGeneInAisleTab[$i] as $itemGeneInAisle) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                        <!---------------- Supprimer un article ---------------------->
                        <form class="delete-form col-1 d-flex justify-content-end" method="post" action="index.php?action=deleteItemGene">
                            <input type="hidden" name="itemGeneId" value="<?= $itemGeneInAisle['id'] ?>" />
                            <button type="submit" class="action-button delete-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <!---------------- Le nom de l'article et sa modification ---------------------->
                        <form class="modif-form form-row col-11 justify-content-start align-items-center" method="post" action="index.php?action=modifItemGene">
                            <input type="hidden" name="itemGeneId" value="<?= $itemGeneInAisle['id'] ?>" />
                            <input type="text" name="itemGeneName" class="modif-form item-gene col-10" value="<?= $itemGeneInAisle['item_gene_name'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
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

    <!-- TAB DES RAYONS -->

    <div id="aisles-admin">

        <!-------------- Message dans la barre de nav -------------->
        <div class="screen-avert d-md-none">
            EASIER ON SCREEN ...
        </div>

        <!-------------- Début du circuit de rayons -------------->
        <div class="rayons-org col-10 offset-1">
            <div class="row">
                <div class="col-12 circuit text-center bg-green">
                    <i class="fas fa-flag fa-2x"></i> Entrée circuit
                </div>
            </div>

            <div class="row">

                <!-------------- Rayons "sortables" pour ordonner -------------->
                <ul id="sortable-admin" class="sortable col-11">
                    <!-------------- Boucle des rayons -------------->
                    <?php    
                    for ($i=0; $i<$aislesGeneCount['count']; $i++) {
                    ?>
                    <li class="ui-state-default row" id="aisleId_<?= $aislesGeneTab[$i]['id'] ?>">

                        <!---------------- Groupe de boutons et icones ---------------------->
                        <div class="col-sm-3 aisles-icons d-flex justify-content-center align-items-center">
                            <!---------------- Bouton delete ---------------------->
                            <form class="delete-form d-flex justify-content-start align-items-center col-sm-3" method="post" action="index.php?action=deleteAisleGene">
                                <input type="hidden" name="aisleGeneId" value="<?= $aislesGeneTab[$i]['id'] ?>" />
                                <button type="submit" class="action-button delete-btn"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <!---------------- Icones des rayons ---------------------->
                            <?php
                            foreach ($aislesGeneIconsTab2[$i] as $aislesGeneIcons2) {
                            ?>
                            <span class="col-sm-3 d-flex align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesGeneIcons2['icon_adress'] ?>" alt="item picture" title="item" /></span>
                            <?php
                            }
                            ?>
                            <!---------------- logo rayon mobile -------------------->
                            <i class="fam-select orange fas fa-stream col-sm-3 d-flex justify-content-end align-items-center"></i>
                        </div>
                        <!---------------- Le titre du rayon et sa modification -------------------->
                        <form class="modif-form form-row col-sm-8 justify-content-start align-items-center" method="post" action="index.php?action=modifAisleGene">
                            <input type="hidden" name="aisleGeneId" value="<?= $aislesGeneTab[$i]['id'] ?>" />
                            <input type="text" name="aisleGeneTitle" class="item-gene col-sm-12" value="<?= $aislesGeneTab[$i]['aisle_gene_title'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
                        </form>
                    </li>

                    <?php
                    }
                    ?>
                </ul>

                <!-------------- Boucle des repères num ---------->
                <ul class="list-group rayon-num col-1">
                    <?php    
                    for ($i=0; $i<$aislesGeneCount['count']; $i++) {
                    ?>
                    <li class="list-group-item d-flex flex-row justify-content-center align-items-center">
                        <span class="caddie2 d-flex justify-content-center align-items-center">
                            <?= $i+1 ?>
                        </span>
                        <?php
                    }
                    ?>
                </ul>
                <form action="" method="post">
                    <input type="hidden" name="sortable-admin" />
                </form>

            </div>

            <!----------------  Ajouter un rayon ------------>
            <div class="row">
                <div class="col-11">
                    <div class="row" id="newAisleGene">
                        <span class="col-sm-3"></span>
                        <form class="modif-form form-row col-sm-8 justify-content-start align-items-center" method="post" action="index.php?action=createAisleGene">
                            <input type="hidden" name="aisleGeneOrder" value="<?= $aislesGeneCount['count']+1 ?>" />
                            <input type="text" name="aisleGeneTitle" class="item-gene add-form col-sm-12" placeholder="Rajouter un rayon au circuit ?" focus />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-plus"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <!-------------- Fin du circuit de rayons -------------->
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
