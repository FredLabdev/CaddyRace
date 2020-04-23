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
/*
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }
    if ($message_error) {
        phpAlert($message_error);
    } else if ($message_success) {
        phpAlert($message_success);
    }
*/
?>

<!-- MENU PERSO -->

<div id="tabs" class="tabs bg-dark">

    <div class="row">
        <nav class="fixed-top col-12 list-nav navbar navbar-light bg-dark justify-content-start align-items-start">

            <!-------------- Sous-menu dropdown pour passage des articles du caddie en nvelle liste ou éffacement -------------->
            <div class="col-2 nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <!--------------- Comptage total des articles en caddy -------------------->
                    <span class="<?php if ((isset($itemsInCaddyCount['count']) && $itemsInCaddyCount['count'] == 0) || (isset($itemsInCaddyCount2['count']) && $itemsInCaddyCount2['count'] == 0)) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                        <i class="fam-select fas fa-shopping-cart <?php if ((isset ($itemsToBuyCount['count']) && $itemsToBuyCount['count'] == 0) || (isset ($itemsToBuyCount2['count']) && $itemsToBuyCount2['count'] == 0)) {echo 'green';} else  {echo 'white';} ?>" title="Boutique"></i>
                        <span class="items <?php if ((isset ($itemsToBuyCount['count']) && $itemsToBuyCount['count'] == 0) || (isset ($itemsToBuyCount2['count']) && $itemsToBuyCount2['count'] == 0)) {echo 'green';} else  {echo 'white';} ?> d-flex justify-content-center align-items-center">
                        <?php if (isset ($itemsInCaddyCount['count']) && $itemsInCaddyCount['count'] >= 1) { echo $itemsInCaddyCount['count']; } else if (isset ($itemsInCaddyCount2['count']) && $itemsInCaddyCount2['count'] >= 1) { echo $itemsInCaddyCount2['count']; } ?>
                        </span>
                    </span>

                    <!--------------- Comptage total des articles en liste -------------------->
                    <span class="<?php if ((isset ($itemsToBuyCount['count']) && $itemsToBuyCount['count'] == 0) || (isset($itemsToBuyCount2['count']) && $itemsToBuyCount2['count'] == 0)) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                        <i class="fam-select fas fa-scroll orange"></i>
                        <span class="caddie2 orange d-flex justify-content-center align-items-center">
                        <?php if (isset ($itemsToBuyCount['count']) && $itemsToBuyCount['count'] >= 1) { echo $itemsToBuyCount['count']; } else if (isset ($itemsToBuyCount2['count']) && $itemsToBuyCount2['count'] >= 1) { echo $itemsToBuyCount2['count']; } ?>
                        </span>
                    </span>  
                </a>
                <div class="col-12 dropdown-menu">
                    <a class="dropdown-item nav-link" >
                        <form class="form-inline" method="post" action="index.php?action=caddyToList">
                            <input type="hidden" name="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                            <button type="submit" class="action-button2 bg-dgrey">
                                <i class="item-action green fas fa-shopping-cart"></i>
                                <i class="fas fa-arrow-alt-circle-right grey"></i>
                                <i class="item-action fas fa-scroll orange"></i>
                            </button>
                        </form>
                    </a>
                    <a class="dropdown-item nav-link" >
                        <form class="form-inline" method="post" action="index.php?action=caddyToShop">
                            <input type="hidden" name="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                            <button type="submit" class="action-button2 bg-dgrey">
                                <i class="item-action green fas fa-shopping-cart"></i>
                                <i class="fas fa-arrow-alt-circle-right grey"></i>
                                <i class="item-action white fas fa-th"></i>
                            </button>
                        </form>
                    </a>
                </div>
            </div>

            <!-------------- Search Bar d'ajout d'un article connu à la liste -------------->
            <form class="search-bar col-6" method="post" action="index.php?action=itemCheck">
                <input class="col-12" type="text" name="itemDescription" id="itemDescription" placeholder="Que vous manque-t-il de connu, et qui ne soit pas déjà dans votre liste ?" value="" />
                <p>
                    <input type="hidden" name="itemId" id="itemId" value="" />
                    <input type="hidden" name="sessionId" id="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                    <button type="submit" class="tohide action-button">
                        <i class="item-action fas fa-scroll orange"></i>
                    </button>
                </p>
            </form>

            <!-------------- Menu Tabs pour basculer entre Accordéon List/Items/Aisles -------------->
            <ul class="col-4 nav nav-pills nav-stacked align-items-center">

                <!-------------- Tab Liste -------------->                
                <li class="col-4 nav-item ">
                    <a class="nav-link liste-tab" href="#caddie"><i class="fas fa-scroll fa-2x"></i><span class="list-nav-text"> Liste</span></a>
                </li>
                <!-------------- Tab Articles -------------->  
                <li class="col-4 nav-item ">
                    <a class="nav-link liste-tab" href="#list"><i class="fas fa-th fa-2x"></i><span class="list-nav-text"> Articles</span></a>
                </li>
                <!-------------- Tab Rayons --------------> 
                <li class="col-4 nav-item ">
                    <a class="nav-link rayons-tab" href="#aisles"><i class="fas fa-stream fa-2x"></i><span class="list-nav-text"> Rayons</span></a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- TAB DE LA LISTE DE COURSES ORDONNEE PAR ARTILCES A,B,C ou RAYONS  -->

    <div id="caddie">
        
        <!-------------- Magasin en accordéon -------------->
        <div id="accordion-caddie">

            <!-------------- Boucle 1ère des rayons -------------->
            <?php    
             for ($i=0; $i<$aislesCount['count']; $i++) {
                 if (($itemsCountInAisleToBuyTab[$i]['count'] >= 1) || ($itemsCountInAisleInCadTab[$i]['count'] >= 1)) {
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
                <!--------------- Comptage des articles mis dans le caddy -------------------->
                <span class="d-flex flex-column justify-content-between align-items-center">
                    <?php 
                    if ($itemsCountInAisleInCadTab[$i]['count'] >= 1) {
                    ?>
                        <i class="fam-select <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'green';} else  {echo 'white';} ?> fas fa-shopping-cart"></i>
                        <span class="items <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'green';} ?>  d-flex justify-content-center align-items-center">
                            <?= $itemsCountInAisleInCadTab[$i]['count'] ?>
                        </span>
                    <?php 
                    }
                    ?>
                </span>
                <!--------------- Comptage des articles du rayon en liste -------------------->
                <span class="<?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-scroll"></i>
                    <span class="caddie2 orange d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleToBuyTab[$i]['count'] ?>
                    </span>
                </span>
            </div>
            <!--------------- Contenu d'un rayon -------------------->
            <div>
                <ul>
                    
                    <!---------------- Boucle 2ndaire des articles en liste ---------------------->
                    <?php
                    foreach ($itemsToPickTab[$i] as $itemsToPick) {
                        if($itemsToPick['item_priv_purchase'] == 1) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-center align-items-center" href="#">

                        <!---------------- Le nom de l'article, sa modification ---------------------->
                        <form class="modif-form form-row col-10 col-push-1 justify-content-center align-items-center" method="post" action="index.php?action=modifItem">
                            <input type="hidden" name="itemId" value="<?= $itemsToPick['id'] ?>" />
                            <input type="text" name="itemName" class="col-10 to-caddy" value="<?= $itemsToPick['item_priv_name'] ?>" />
                        </form>
                        
                          <!---------------- Ajout au caddy par chekbox cocher ---------------------->                      
                        <form class="modif-form form-row col-8 justify-content-center align-items-center to-check" method="post" action="index.php?action=itemCaddy">
                            <input type="hidden" name="itemId" value="<?= $itemsToPick['id'] ?>" />
                            <button type="submit" class="col-12 action-button"><i class="col-1"></i></button>
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
            <div class="row d-flex flex-row">
                <?php
                foreach ($aislesIconsTab2[$i] as $aislesIcons2) {
                ?>
                <span class="col-1 d-flex justify-content-center align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesIcons2['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php
                }
                ?>
                <h4 class="ray col-8" id="one">
                    <?= $aislesTab[$i]['aisle_priv_title'] ?>
                </h4>
                <!--------------- Comptage des articles en liste -------------------->
                <span class="col-1 <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-scroll"></i>
                    <span class="caddie2 orange d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleToBuyTab[$i]['count'] ?>
                    </span>
                </span>
                <!--------------- Comptage des articles du rayon -------------------->
                <span class="col-1 d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select white fas fa-th"></i>
                    <span class="items d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleTab[$i]['count'] ?>
                    </span>
                </span>
            </div>
            <!--------------- Contenu d'un rayon -------------------->
            <div>
                <ul>
                    
                    <!---------------- Boucle 2ndaire des articles en liste ---------------------->
                    <?php
                    foreach ($itemsToBuyTab[$i] as $itemtoBuy) {
                        if($itemtoBuy['item_priv_purchase'] == 1) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-flex-start align-items-center" href="#">
                        <span class="col-1"></span>
                        <!---------------- Le nom de l'article ---------------------->
                        <div class="form-row col-10 offset-1 justify-content-center align-items-center" method="post" action="index.php?action=modifItem">
                            <input type="text" name="itemName" class="col-10 to-caddy" value="<?= $itemtoBuy['item_priv_name'] ?>" />
                            <!---------------- Suppression de la liste par chekbox décocher ---------------------->                     
                            <form class="form-row col-10 justify-content-start align-items-center to-check" method="post" action="index.php?action=itemCheck">
                                <input type="hidden" name="itemId" value="<?= $itemtoBuy['id'] ?>" />
                                <button type="submit" class="action-button"><i class="col-1"></i></button>
                            </form>
                        </div>
                        
                    </li>
                    <?php
                        }
                    }
                    ?>
                    <!---------------- Ajout d'un article en magasin ---------------------->
                    <li class="dropdown-item d-flex justify-content-flex-start align-items-center" href="#">
                        <span class="delete-form col-1"></span>
                        <form class="modif-form new-item form-row col-10 justify-content-start align-items-center" name="createItem" method="post" action="index.php?action=createItem">
                            <input type="hidden" name="aisleId" value="<?= $aislesTab[$i]['aisle_priv_order'] ?>" />
                            <input id="item-gene-name" type="text" name="itemName" class="item-gene bg-dark col-10" placeholder="Rajouter un article dans ce rayon ?" focus />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-plus"></i></button>
                        </form>
                          <!---------------- Ajout à la liste par chekbox cocher  ---------------------->                      
                        <span class="col-1 modif-form form-check"></span>
                    </li>
                    
                    <!---------------- Boucle 3ème des articles en magasin ---------------------->
                    <?php
                    foreach ($itemsInAisleTab[$i] as $itemInAisle) {
                    ?>
                    <li class="dropdown-item d-flex flex-row justify-content-flex-start align-items-center" href="#">
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
                      
                        <form class="col-1 modif-form form-check form-row justify-content-center align-items-center" method="post" action="index.php?action=itemCheck">
                            <input type="hidden" name="itemId" value="<?= $itemInAisle['id'] ?>" />
                                                    <?php 
                        if($itemInAisle['item_priv_purchase'] == 0) {
                        ?>
                          <!---------------- Ajout à la liste par chekbox cocher ---------------------->
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-scroll"></i></button>
                        <?php      
                        } else if($itemInAisle['item_priv_purchase'] == 2) {
                        ?>
                          <!---------------- Article déjà en caddie -> Remise en liste par chekbox cocher ---------------------->                      
                            <button type="submit" class="action-button green modif-btn"><i class="fas fa-shopping-cart"></i></button>
                        <?php      
                        } 
                        ?>
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
