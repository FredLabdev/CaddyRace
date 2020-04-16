<?php 
    $title = 'CaddyRace/Accueil';
    if ($_SESSION['group_id'] == 1) {
        $template = 'backend';
    } else {
        $template = 'frontend';
    }
    ob_start(); 
?>

<!-- MESSAGES -->

<?php
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
    if ($message_error) {
        phpAlert($message_error);
    } else if ($message_success) {
        phpAlert($message_success);
    }
?>

<!-- MENU PERSO -->

<div id="tabs" class="tabs">

    <div class="row">
        <nav class="list-nav navbar navbar-light bg-dark fixed-top justify-content-end">
            <ul class="nav nav-pills nav-stacked align-items-center">
                <li class="nav-item ">
                    <a class="nav-link liste-tab" href="#caddie"><i class="fas fa-scroll fa-2x"></i><span class="list-nav-text"> Liste</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link liste-tab" href="#list"><i class="fas fa-th fa-2x"></i><span class="list-nav-text"> Articles</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link rayons-tab" href="#aisles"><i class="fas fa-stream fa-2x"></i><span class="list-nav-text"> Rayons</span></a>
                </li>
            </ul>

            <!-------------- TODO: Search Bar d'association d'un nouvel article dans un rayon -------------->
            <div id="raySelect" class="bg-dark">
                <form class="search-bar form-inline" action="#">
                    <select name="rayon" id="rayon" required>
                        <option value="" hidden>
                            Rangez-le dans son rayon.
                        </option>
                        <option class="ray-order" data-class="autr">
                            Divers
                        </option>
                        <option class="ray-order" data-class="hygi">
                            Toilette, Maquillage
                        </option>
                        <option class="ray-order" data-class="fari">
                            Dessert, Farine, Compotes
                        </option>
                        <option class="ray-order" data-class="choc">
                            Goûters, Chocolat
                        </option>
                        <option class="ray-order" data-class="conf">
                            Confiture, Café, Thé
                        </option>
                        <option class="ray-order" data-class="cere">
                            Pain, Céréales
                        </option>
                        <option class="ray-order" data-class="mena">
                            Ménage, Animaux
                        </option>
                        <option class="ray-order" data-class="cond">
                            Huile, Condiments, Pdts monde
                        </option>
                        <option class="ray-order" data-class="pate">
                            Pâtes, Riz, Thon, Potages
                        </option>
                        <option class="ray-order" data-class="cons">
                            Conserve, Plats cuisinés
                        </option>
                        <option class="ray-order" data-class="bois">
                            Boissons
                        </option>
                        <option class="ray-order" data-class="aper">
                            Biscuits apéritifs
                        </option>
                        <option class="ray-order" data-class="lait">
                            Laitages, Oeufs
                        </option>
                        <option class="ray-order" data-class="surg">
                            Surgelés
                        </option>
                        <option class="ray-order" data-class="frai">
                            Charcuterie, Pâtes tarte
                        </option>
                        <option class="ray-order" data-class="vian">
                            Viandes, Poissons, traiteur
                        </option>
                        <option class="ray-order" data-class="coup">
                            A la coupe
                        </option>
                        <option class="ray-order" data-class="frui">
                            Fruits, Légumes
                        </option>
                        <option class="ray-order" data-class="boul">
                            Boulangerie
                        </option>
                    </select>
                </form>

                <div id="popup6" class="overlay">
                    <div class="text-center popup popup-sm">
                        <h3>Article créé</h3>
                        <a class="close" href="#">&times;</a>
                        <div class="content orange">
                            Vous pouvez maintenant l'ajouter à votre liste !
                        </div>
                    </div>
                </div>
            </div>

        </nav>
    </div>

    <!-- TAB DE LA LISTE DE COURSES ORDONNEE PAR ARTILCES A,B,C ou RAYONS  -->

    <div id="caddie">

        <!-------------- Magasin en accordéon -------------->
        <div id="accordion-caddie">

            <!-------------- Boucle 1ère des rayons -------------->
            <?php    
             for ($i=0; $i<$aislesCount['count']; $i++) {
                 if ($itemsCountInAisleToBuyTab[$i]['count'] >= 1) {
            ?>
            <!--------------- En-tête du rayon -------------------->
            <div class="d-flex flex-row">
                <?php
                foreach ($aislesIconsTab[$i] as $aislesIcons) {
                ?>
                <span class="col-1 d-flex justify-content-center align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesIcons['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php
                }
                ?>
                <h4 class="ray col-xs-8 col-sm-8" id="one">
                    <?= $aislesTab[$i]['aisle_priv_title'] ?>
                </h4>
                <!--------------- Comptage des articles du rayon en panier -------------------->
                <span class="<?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex col-1 flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas item-check"></i>
                    <span class="caddie2 orange d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleToBuyTab[$i]['count'] ?>
                    </span>
                </span>
                <!--------------- Comptage des articles du rayon en magasin -------------------->
                <span class="d-flex col-1 flex-row justify-content-between align-items-center">
                </span>
            </div>
            <!--------------- Contenu d'un rayon -------------------->
            <div>
                <ul>
                    
                    <!---------------- Boucle 2ndaire des articles en panier ---------------------->
                    <?php
                    foreach ($itemsToPickTab[$i] as $itemsToPick) {
                        if($itemsToPick['item_priv_purchase'] == 1) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">

                        <!---------------- Le nom de l'article, sa modification ---------------------->
                        <form class="modif-form form-row col-10 col-push-1 justify-content-end align-items-center" method="post" action="index.php?action=modifItem">
                            <input type="hidden" name="itemId" value="<?= $itemsToPick['id'] ?>" />
                            <input type="text" name="itemName" class="col-10 to-caddy" value="<?= $itemsToPick['item_priv_name'] ?>" />
                        </form>
                        
                          <!---------------- Ajout à la liste par chekbox cocher/décocher ---------------------->                      
                        <form class="modif-form form-row col-lg-8 justify-content-start align-items-center to-check" method="post" action="index.php?action=itemCheck">
                            <input type="hidden" name="itemId" value="<?= $itemsToPick['id'] ?>" />
                            <button type="submit" class="col-lg-12 action-button modif-btn"><i class="col-1"></i></button>
                        </form>
                        
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
                 }
            }
            ?>

        </div>
        
    </div>
        
    <!-- TAB DE LA LISTE DE COURSES ORDONNEE PAR RAYONS PUIS ARTICLES COCHES EN TETE -->

    <div id="list">

        <!-------------- Search Bar d'ajout d'un article à la liste ou si inconnu de création -------------->
<!--    <form class="search-bar form-inline">
            <a href="#" id="addItem"><i class="tohide2 item-action fas fa-plus-circle fa-2x orange"></i></a>
            <input type="text" class="typeahead tt-query" id="recherche" placeholder="Que vous manque-t-il ?" autocomplete="off" spellcheck="false" />
            <span class="nav-item">
                <a class="nav-link" href="#popup5" id="addList"><i class="tohide item-action fas fa-check-circle fa-2x green"></i></a>
            </span>
        </form>
-->                  
        <form class="search-bar form-inline" method="post" action="index.php?action=itemCheck">
            <p id="box"><input type="text" name="itemDescription" id="itemDescription" value="" /></p>
            <p>
                <input type="hidden" name="itemId" id="itemId" value="" />
                <button type="submit" class="tohide action-button">
                    <i class="item-action fas item-check orange"></i>
                </button>
            </p>
        </form>

        <!-------------- popup 5 -------------->
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
        <div id="accordion">

            <!-------------- Boucle 1ère des rayons -------------->
            <?php    
             for ($i=0; $i<$aislesCount['count']; $i++) {
            ?>
            <!--------------- En-tête du rayon -------------------->
            <div class="d-flex flex-row">
                <?php
                foreach ($aislesIconsTab2[$i] as $aislesIcons2) {
                ?>
                <span class="col-1 d-flex justify-content-center align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesIcons2['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php
                }
                ?>
                <h4 class="ray col-xs-8 col-sm-8" id="one">
                    <?= $aislesTab[$i]['aisle_priv_title'] ?>
                </h4>
                <!--------------- Comptage des articles en panier -------------------->
                <span class="<?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex col-1 flex-row justify-content-between align-items-center">
                    <i class="fam-select orange fas item-check"></i>
                    <span class="caddie2 orange d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleToBuyTab[$i]['count'] ?>
                    </span>
                </span>
                <!--------------- Comptage des articles du rayon -------------------->
                <span class="d-flex col-1 flex-row justify-content-between align-items-center">
                    <i class="fam-select white fas fa-th"></i>
                    <span class="items d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleTab[$i]['count'] ?>
                    </span>
                </span>
            </div>
            <!--------------- Contenu d'un rayon -------------------->
            <div>
                <ul>
                    
                    <!---------------- Boucle 2ndaire des articles en panier ---------------------->
                    <?php
                    foreach ($itemsToBuyTab[$i] as $itemtoBuy) {
                        if($itemtoBuy['item_priv_purchase'] == 1) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">

                        <!---------------- Le nom de l'article, sa modification ---------------------->
                        <form class="modif-form form-row col-10 col-push-1 justify-content-end align-items-center" method="post" action="index.php?action=modifItem">
                            <input type="hidden" name="itemId" value="<?= $itemtoBuy['id'] ?>" />
                            <input type="text" name="itemName" class="col-10 to-caddy" value="<?= $itemtoBuy['item_priv_name'] ?>" />
                        </form>
                        
                          <!---------------- Ajout à la liste par chekbox cocher/décocher ---------------------->                      
                        <form class="modif-form form-row col-lg-8 justify-content-start align-items-center to-check" method="post" action="index.php?action=itemCheck">
                            <input type="hidden" name="itemId" value="<?= $itemtoBuy['id'] ?>" />
                            <button type="submit" class="col-lg-12 action-button modif-btn"><i class="col-1"></i></button>
                        </form>
                        
                    </li>
                    <?php
                        }
                    }
                    ?>
                    <!---------------- Ajout d'un article en magasin ---------------------->
                    <li class="dropdown-item d-flex justify-content-center align-items-center" href="#">
                        <span class="col-1"></span>
                        <form class="modif-form new-item form-row col-10 offset-1 justify-content-start align-items-center" name="createItem" method="post" action="index.php?action=createItem">
                            <input type="hidden" name="aisleId" value="<?= $aislesTab[$i]['aisle_priv_order'] ?>" />
                            <input id="item-gene-name" type="text" name="itemName" class="item-gene bg-dark col-10" placeholder="Rajouter un article dans ce rayon ?" focus />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-plus"></i></button>
                        </form>
                    </li>
                    
                    <!---------------- Boucle 3ème des articles en magasin ---------------------->
                    <?php
                    foreach ($itemsInAisleTab[$i] as $itemInAisle) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">
                        <!---------------- Supprimer un article du magasin ---------------------->
                        <form class="delete-form col-1 d-flex justify-content-end" method="post" action="index.php?action=deleteItem">
                            <input type="hidden" name="itemId" value="<?= $itemInAisle['id'] ?>" />
                            <button type="submit" class="action-button delete-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>

                        <!---------------- Le nom de l'article, sa modification ---------------------->
                        <form class="modif-form form-row col-10 justify-content-start align-items-center" method="post" action="index.php?action=modifItem">
                            <input type="hidden" name="itemId" value="<?= $itemInAisle['id'] ?>" />
                            <input type="text" name="itemName" class="modif-form item-gene col-10 <?php if($itemInAisle['item_priv_purchase'] == 1) {echo 'to-buy';} ?>" value="<?= $itemInAisle['item_priv_name'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
                        </form>
                        <?php 
                        if($itemInAisle['item_priv_purchase'] == 0) {
                        ?>
                          <!---------------- Ajout à la liste par chekbox cocher/décocher ---------------------->                      
                        <form class="modif-form form-check form-row justify-content-start align-items-center" method="post" action="index.php?action=itemCheck">
                            <input type="hidden" name="itemId" value="<?= $itemInAisle['id'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas item-check"></i></button>
                        </form>
                        <?php      
                        } ?>
                        
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

    <div id="aisles">

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
                <ul id="sortable" class="sortable col-11">
                    <!-------------- Boucle des rayons -------------->
                    <?php    
                    for ($i=0; $i<$aislesCount['count']; $i++) {
                    ?>
                    <li class="ui-state-default row" id="aisleId_<?= $aislesTab[$i]['id'] ?>">

                        <!---------------- Groupe de boutons et icones ---------------------->
                        <div class="col-sm-2 aisles-icons d-flex justify-content-center align-items-center">

                            <!---------------- Icones des rayons ---------------------->
                            <?php
                            foreach ($aislesIconsTab3[$i] as $aislesIcons3) {
                            ?>
                            <span class="col-sm-6 d-flex align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesIcons3['icon_adress'] ?>" alt="item picture" title="item" /></span>
                            <?php
                            }
                            ?>
                        </div>
                        <!---------------- Bouton delete ---------------------->
                        <form class="delete-form d-flex justify-content-start align-items-center col-offset-1-sm-1" method="post" action="index.php?action=deleteAisle">
                            <input type="hidden" name="aisleId" value="<?= $aislesTab[$i]['id'] ?>" />
                            <button type="submit" class="action-button delete-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <!---------------- Le titre du rayon et sa modification -------------------->
                        <form class="modif-form form-row col-sm-9 justify-content-start align-items-center" method="post" action="index.php?action=modifAisle">
                            <input type="hidden" name="aisleId" value="<?= $aislesTab[$i]['id'] ?>" />
                            <input type="text" name="aisleTitle" class="item-gene col-sm-12" value="<?= $aislesTab[$i]['aisle_priv_title'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
                        </form>
                       <!---------------- logo rayon mobile -------------------->
                        <div class="col-sm-1 aisles-icons d-flex justify-content-center align-items-center">                             
                            <i class="fam-select orange fas fa-stream col-sm-3 d-flex justify-content-end align-items-center"></i>
                        </div>
                    </li>

                    <?php
                    }
                    ?>
                </ul>

                <!-------------- Boucle des repères num ---------->
                <ul class="list-group rayon-num col-1">
                    <?php    
                    for ($i=0; $i<$aislesCount['count']; $i++) {
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
                    <input type="hidden" name="sortable" />
                </form>

            </div>

            <!----------------  Ajouter un rayon ------------>
            <div class="row">
                <div class="col-11">
                    <div class="row" id="newAisle">
                        <span class="col-sm-3"></span>
                        <form class="modif-form form-row col-sm-8 justify-content-start align-items-center" method="post" action="index.php?action=createAisle">
                            <input type="hidden" name="aisleOrder" value="<?= $aislesCount['count']+1 ?>" />
                            <input type="text" name="aisleTitle" class="item-gene add-form col-sm-12" placeholder="Rajouter un rayon au circuit ?" focus />
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
