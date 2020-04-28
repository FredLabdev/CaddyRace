<!--********************************************************************************-->
<!--********************************* SHOP to LIST *********************************-->
<!--*********************************       &       ********************************-->
<!--********************************* LIST to CADDY ********************************-->
<!--********************************************************************************-->

<?php 
    $title = 'CaddyRace/liste';
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

<div id="tabs" class="tabs bg-dark">

    <div class="row">
        <nav class="fixed-top col-12 list-nav navbar navbar-light bg-dark justify-content-start align-items-center">

            <!-------------- Menu dropdown pour passage des articles du caddie en nvelle liste ou éffacement -------------->
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
                            <button type="submit" class="action-button2 refresh-btn bg-dgrey">
                                <i class="item-action green fas fa-shopping-cart"></i>
                                <i class="fas fa-arrow-alt-circle-right grey"></i>
                                <i class="item-action fas fa-scroll orange"></i>
                            </button>
                        </form>
                    </a>
                    <a class="dropdown-item nav-link" >
                        <form class="form-inline" method="post" action="index.php?action=caddyToShop">
                            <input type="hidden" name="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                            <button type="submit" class="action-button2 refresh-btn bg-dgrey">
                                <i class="item-action green fas fa-shopping-cart"></i>
                                <i class="fas fa-arrow-alt-circle-right grey"></i>
                                <i class="item-action white fas fa-th"></i>
                            </button>
                        </form>
                    </a>
                </div>
            </div>

            <!-------------- Search Bar d'ajout d'un article connu à la liste -------------->
            <span class="item-searchbar">
                <span class=""><i class="fas fa-search-plus fa-2x"></i></span>
            </span>            
            <form class="search-bar col-6" method="post" action="index.php?action=itemCheck">
                <input class="col-12" type="text" name="itemDescription" id="itemDescription" placeholder="Que vous manque-t-il de connu, et qui ne soit pas déjà dans votre liste ?" value="" />
                <input type="hidden" name="itemId" id="itemId" value="" />
                <input type="hidden" name="sessionId" id="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                <button type="submit" class="tohide action-button d-flex justify-content-center">
                    <i class="item-action fas fa-scroll orange"></i>
                </button>
            </form>

            <!-------------- Menu Tabs pour basculer entre LIST TO CADDY / SHOP TO LIST -------------->
            <ul class="col-4 nav nav-pills nav-stacked align-items-center">

                <!-------------- Tab LIST TO CADDY -------------->                
                <li class="col-6 nav-item">
                    <a class="nav-link liste-tab" id="list-tab" href="#list" style="display: none;">
                        <div class="col-12 title bg-dark d-flex justify-content-center align-items-center white">
                            <a class="nav-link" href="index.php?action=caddyList" id="list-refresh">
                                <div class="refresh-btn bg-dgrey">
                                    <i class="item-action fas fa-scroll fa-2x orange"></i>
                                    <i class="fas fa-arrow-alt-circle-right grey"></i>
                                    <i class="item-action green fas fa-shopping-cart fa-2x"></i>
                                </div>
                            </a>
                        </div>
                    </a>
                </li>
                
                <!-------------- Tab SHOP TO LIST -------------->  
                <li class="col-6 nav-item">
                    <a class="nav-link liste-tab" id="items-tab" href="#items" style="display: none;">
                        <div class="title bg-dark d-flex justify-content-center align-items-center white">
                            <a class="nav-link" href="index.php?action=shopList" id="items-refresh">
                                <div class="refresh-btn bg-dgrey">
                                    <i class="item-action white fas fa-th fa-2x"></i>
                                    <i class="fas fa-arrow-alt-circle-right grey"></i>
                                    <i class="item-action fas fa-scroll orange fa-2x"></i>
                                </div>
                            </a>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!--********************************************************************************-->
    <!--********************************* LIST to CADDY ********************************-->
    <!--********************************************************************************-->
    <div id="list">
        
        <!-------------- LIST TO CADDY en accordéon -------------->
        <div id="accordion-list">

            <!-------------- Boucle 1ère des rayons en liste -------------->
            <?php    
            for ($i=0; $i<$aislesCount['count']; $i++) {
                if (($itemsCountInAisleToBuyTab[$i]['count'] >= 1) || ($itemsCountInAisleInCadTab[$i]['count'] >= 1)) {
            ?>
            <!--------------- En-tête des rayons en liste -------------------->
            <div class="d-flex flex-row">
                
                <?php foreach ($aislesIconsTab[$i] as $aislesIcons) { ?>
                <span class="col-1 d-flex justify-content-center align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesIcons['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php } ?>
                <h4 class="ray col-xs-8 col-sm-8" id="one"><?= $aislesTab[$i]['aisle_priv_title'] ?></h4>
                
                <!--------------- Comptage des articles de chaque rayon mis dans le caddy -------------------->
                <span class="d-flex flex-column justify-content-between align-items-center">
                    <?php if ($itemsCountInAisleInCadTab[$i]['count'] >= 1) { ?>
                        <i class="fam-select <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'green';} else  {echo 'white';} ?> fas fa-shopping-cart"></i>
                        <span class="items <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'green';} ?>  d-flex justify-content-center align-items-center"><?= $itemsCountInAisleInCadTab[$i]['count'] ?></span>
                    <?php } ?>
                </span>
                
                <!--------------- Comptage des articles de chaque rayon en liste -------------------->
                <span class="<?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-scroll"></i>
                    <span class="caddie2 orange d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleToBuyTab[$i]['count'] ?>
                    </span>
                </span>
                
            </div>
            
            <!--------------- Contenu de chaque rayon en liste -------------------->
            <div>
                
                <ul class="row">
                    
                    <!---------------- Boucle 2ndaire des articles de chaque rayon en liste ---------------------->
                    <?php
                    foreach ($itemsToPickTab[$i] as $itemsToPick) {
                        if($itemsToPick['item_priv_purchase'] == 1) {
                    ?>
                    <li class="list-items dropdown-item item-to-caddy d-flex flex-row justify-content-center align-items-center offset-1" href="#">

                        <!---------------- Le nom de l'article, Ajout au caddy par chekbox cocher ---------------------->              
                        <form class="modif-form form-row col-6 justify-content-center align-items-center to-check" method="post" action="index.php?action=itemCaddy">
                            <input type="hidden" name="itemId" value="<?= $itemsToPick['id'] ?>" />
                            <button type="submit" class="action-button col-10 to-caddy d-flex justify-content-center align-items-center"><i></i><?= $itemsToPick['item_priv_name'] ?></button>
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
        
    <!--********************************************************************************-->
    <!--********************************* SHOP to LIST *********************************-->
    <!--********************************************************************************-->
    <div id="items">

        <!-------------- popup 5 ------------
        <div id="popup5" class="overlay">
            <div class="text-center popup popup-sm">
                <h3>Ajouté !</h3>
                <a class="close" href="#">&times;</a>
                <div class="content orange">
                    Cet article est désormais ajouté à votre liste dans le rayon !
                </div>
            </div>
        </div> -->

        <!-------------- SHOP TO LIST en accordéon -------------->
        <div id="accordion-items">

            <!-------------- Boucle 1ère des rayons du shop -------------->
            <?php for ($i=0; $i<$aislesCount['count']; $i++) { ?>
            
            <!--------------- En-tête de chaque rayon du shop -------------------->
            <div class="row d-flex flex-row">
                <?php foreach ($aislesIconsTab2[$i] as $aislesIcons2) { ?>
                <span class="col-1 d-flex justify-content-center align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesIcons2['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php } ?>
                <h4 class="ray col-8" id="one"><?= $aislesTab[$i]['aisle_priv_title'] ?></h4>
                
                <!--------------- Comptage des articles mis en liste pour chaque rayon du shop -------------------->
                <span class="col-1 <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-scroll"></i>
                    <span class="caddie2 orange d-flex justify-content-center align-items-center"><?= $itemsCountInAisleToBuyTab[$i]['count'] ?></span>
                </span>
                
                <!--------------- Comptage des articles de chaque rayon du shop -------------------->
                <span class="col-1 d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select fas fa-th"></i>
                    <span class="items dark d-flex justify-content-center align-items-center"><?= $itemsCountInAisleTab[$i]['count'] ?></span>
                </span>
            </div>
            
            <!--------------- Contenu de chaque rayon du shop -------------------->
            <div>
                
                <ul>
                    
                    <!---------------- Boucle 2ndaire des articles en liste pour chaque rayon du shop ---------------------->
                    <?php
                    foreach ($itemsToBuyTab[$i] as $itemtoBuy) {
                        if($itemtoBuy['item_priv_purchase'] == 1) {
                    ?>
                    <li class="list-items item-to-caddy dropdown-item d-flex flex-row justify-content-flex-start align-items-center" href="#">
                        <span class="col-1"></span>
                        
                        <!---------------- Le nom de l'article en liste ---------------------->
                        <div class="form-row col-10 offset-1 justify-content-center align-items-center" method="post" action="index.php?action=modifItem">
                        <form class="modif-form form-row col-10 justify-content-center align-items-center to-check" method="post" action="index.php?action=itemCheck">
                            <input type="hidden" name="itemId" value="<?= $itemtoBuy['id'] ?>" />
                            <button type="submit" class="action-button col-10 to-list d-flex justify-content-center align-items-center"><i></i><?= $itemtoBuy['item_priv_name'] ?></button>
                        </form>
                        </div>   
                        
                    </li>
                    <?php
                        }
                    }
                    ?>
                    
                    <!---------------- Barre d'Ajout d'un article dans le shop par chekbox cocher ---------------------->
                    <li class="dropdown-item d-flex justify-content-flex-start align-items-center" href="#">
                        <span class="delete-form d-flex justify-content-start align-items-center">
                            <button type="submit" class="action-button"><i></i></button>
                        </span>
                        <form class="modif-form new-item form-row col-10 justify-content-start align-items-center" name="createItem" method="post" action="index.php?action=createItem">
                            <input type="hidden" name="aisleId" value="<?= $aislesTab[$i]['aisle_priv_order'] ?>" />
                            <input type="text" name="itemName" class="item-gene bg-dark col-10" placeholder="Rajouter un article dans ce rayon ?" focus />
                            <button type="submit" class="action-button modif-btn bg-green-md"><i class="fas fa-plus"></i></button>
                        </form>               
                        <span class="col-1 modif-form form-check"></span>
                    </li>
  
                    <!---------------- Boucle 3ème des articles en shop pour chaque rayon du shop ---------------------->
                    <?php foreach ($itemsInAisleTab[$i] as $itemInAisle) { ?>
                    <li class="dropdown-item d-flex flex-row justify-content-flex-start align-items-center" href="#">
                        
                        <!---------------- Supprimer un article du shop ---------------------->
                        <form class="delete-form d-flex justify-content-end" method="post" action="index.php?action=deleteItem">
                            <input type="hidden" name="itemId" value="<?= $itemInAisle['id'] ?>" />
                            <button type="submit" class="action-button delete-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>

                        <!---------------- Le nom de l'article du shop, sa modification ---------------------->
                        <form class="modif-form form-row col-10 justify-content-start align-items-center" method="post" action="index.php?action=modifItem">
                            <input type="hidden" name="itemId" value="<?= $itemInAisle['id'] ?>" />
                            <input type="text" name="itemName" class="modif-form item-gene col-10 <?php if($itemInAisle['item_priv_purchase'] == 1) {echo 'to-buy';} else if($itemInAisle['item_priv_purchase'] == 2) {echo 'in-caddy';} ?>" id="<?= $itemInAisle['item_priv_name'] ?>" value="<?= $itemInAisle['item_priv_name'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
                        </form>
                      
                        <!---------------- Bloc boutons shop to list et caddy to shop ---------------------->
                        <div class="col-1 modif-form form-check form-row justify-content-center align-items-center" >
                            
                            <!---------------- Ajout d'un article de shop à liste par chekbox cocher ---------------------->
                            <?php if($itemInAisle['item_priv_purchase'] == 0) { ?>
                            <button type="submit" class="action-button modif-btn add-list" data-value="<?= $itemInAisle['item_priv_name'] ?>" value="<?= $itemInAisle['id'] ?>"><i class="fas fa-scroll"></i></button>
                            <?php } ?>
                            
                        </div>
                        
                    </li>
                    <?php } ?>
                    
                </ul>
                
            </div>
            <?php } ?>

        </div>

    </div>
    <!--********************************************************************************-->
    <!--********************************************************************************-->
    <!--********************************************************************************-->

</div>

<?php $all1 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>

<!-- Vérification de la Tab demandée par php et passage en "active" -->
<?php 
$tab_id = $_REQUEST['id'];
if(isset($tab_id)): ?>
    <script type="text/javascript">
    jQuery(function($) {
            $(document).ready(function(){
            $("#<?php echo $tab_id?>").click();
            });
        });
    </script>
<?php endif; ?>
