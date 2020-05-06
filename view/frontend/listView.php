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

<!-- MESSAGES PHP -->
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


<div id="tabs" class="tabs bg-dark">

    <div class="row">
        <nav class="fixed-top col-12 list-nav navbar navbar-light bg-dark justify-content-start align-items-center">

            <!-------------- Search Bar d'ajout d'un article connu à la liste -------------->           
            <form class="search-bar col-7" id="search-item" method="post" action="index.php?action=itemCheck">
                <span class="item-searchbar">
                    <span class=""><i class="fas fa-search-plus fa-2x"></i></span>
                </span> 
                <input class="col-12 col-lg-10 item-gene add-list" type="text" name="itemDescription" id="itemDescription" placeholder="Rechercher un article manquant" value="" />
                <input type="hidden" name="itemId" id="itemId" value="" />
                <input type="hidden" name="sessionId" id="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                <button type="submit" class="tohide add-list-btn check-btn add-list bg-green d-flex justify-content-center align-items-center">
                    <i class="item-action fas fa-check white"></i>
                </button>
            </form>

            <!-------------- Menu Tabs pour basculer entre LIST TO CADDY / SHOP TO LIST -------------->
            <ul class="col-3 nav nav-pills nav-stacked align-items-center">

                <!-------------- Tab LIST TO CADDY -------------->                
                <li class="col-6 nav-item">
                    <a class="nav-link liste-tab" id="list-tab" href="#list">
                        <div class="col-12 title bg-dark d-flex justify-content-center align-items-center white">
                            <a class="nav-link" href="index.php?action=caddyList" id="list-refresh">
                                <!---- bouton tab pour aller au caddy : ---->
                                <div class="refresh-btn bg-dgrey">
                                    <i class="item-action 
                                        <?php 
                                        if ((isset ($itemsToBuyCount['count']) && ($itemsToBuyCount['count'] == 0) && isset ($itemsInCaddyCount['count']) && ($itemsInCaddyCount['count'] == 0)) || (isset ($itemsToBuyCount2['count']) && ($itemsToBuyCount2['count'] == 0) && isset ($itemsInCaddyCount2['count']) && ($itemsInCaddyCount2['count'] == 0))) {
                                            echo 'white';
                                        }
                                        else if ((isset ($itemsToBuyCount['count']) && ($itemsToBuyCount['count'] >= 1) && isset ($itemsInCaddyCount['count']) && ($itemsInCaddyCount['count'] == 0)) 
                                        || (isset ($itemsToBuyCount2['count']) && ($itemsToBuyCount2['count'] >= 1) && isset ($itemsInCaddyCount2['count']) && ($itemsInCaddyCount2['count'] == 0))) {
                                            echo 'orange';
                                        } else {
                                            echo 'green';
                                        } 
                                        ?> fas fa-shopping-cart fa-2x">
                                    </i>
                                </div>
                            </a>
                        </div>
                    </a>
                </li>
                
                <!-------------- Tab SHOP TO LIST -------------->  
                <li class="col-6 nav-item">
                    <a class="nav-link liste-tab" id="items-tab" href="#items">
                        <div class="title bg-dark d-flex justify-content-center align-items-center white">
                            <a class="nav-link" href="index.php?action=shopList" id="items-refresh">
                                <div class="refresh-btn bg-dgrey">
                                    <i class="item-action fas fa-scroll orange fa-2x"></i>
                                    <i class="fas fa-arrow-alt-circle-left grey fa-2x"></i>
                                </div>
                            </a>
                        </div>
                    </a>
                </li>
            </ul>
            
            <!-------------- Bouton de rafraichissement de la liste des items -------------->
            <div class="refresh-btn bg-dgrey" id="items-refresh-btn">
                <a class="nav-link" href="index.php?action=shopList">
                    <i class="fas fa-sync grey fa-2x"></i>
                </a>
            </div>
            
            <!-------------- Menu dropdown pour passage des articles du caddie en nvelle liste ou éffacement -------------->
            <div class="col-2 nav-item dropdown d-flex justify-content-center">
                <a class="col-12 nav-link dropdown-toggle return-btn" id="caddy-refresh" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

                    <!---- Bouton des articles restant en liste, puis quand à 0 inscrire le total du caddy ---->
                    <!---- bouton caché si liste et caddy vides : ---->
                    <span class="col-12 <?php 
                                 if (((isset ($itemsToBuyCount['count']) && $itemsToBuyCount['count'] == 0) || (isset($itemsToBuyCount2['count']) && $itemsToBuyCount2['count'] == 0)) && ((isset($itemsInCaddyCount['count']) && $itemsInCaddyCount['count'] == 0) || (isset($itemsInCaddyCount2['count']) && $itemsInCaddyCount2['count'] == 0))) {
                                     echo 'hidden';
                                 } ?> d-flex flex-column justify-content-between align-items-center">
                        <!---- Caddy orange quand liste mais caddy vide et vert dès que caddy se rempli ---->    
                        <i class="fam-select fas fa-shopping-cart
                                  <?php if ((isset ($itemsToBuyCount['count']) && ($itemsToBuyCount['count'] >= 1) 
                                                && isset ($itemsInCaddyCount['count']) 
                                                && ($itemsInCaddyCount['count'] == 0)) 
                                            || (isset ($itemsToBuyCount2['count']) && ($itemsToBuyCount2['count'] >= 1) 
                                                && isset ($itemsInCaddyCount2['count']) 
                                                && ($itemsInCaddyCount2['count'] == 0))) {echo 'orange';} 
                                     else {echo 'green';} 
                                  ?>" title="Boutique"></i>
                        <!---- Compteur orange plein quand liste mais caddy vide vert creux quand caddy se rempli ---->
                        <span id="caddy-final" class="items 
                                     <?php if ((isset ($itemsToBuyCount['count']) && ($itemsToBuyCount['count'] >= 1) 
                                                && isset ($itemsInCaddyCount['count']) 
                                                && ($itemsInCaddyCount['count'] == 0)) 
                                            || (isset ($itemsToBuyCount2['count']) && ($itemsToBuyCount2['count'] >= 1) 
                                                && isset ($itemsInCaddyCount2['count']) 
                                                && ($itemsInCaddyCount2['count'] == 0))) {echo 'btn-full-orange';}
                                     
                                     else if ((isset ($itemsToBuyCount['count']) && ($itemsToBuyCount['count'] >= 1)) 
                                            || (isset ($itemsToBuyCount2['count']) && ($itemsToBuyCount2['count'] >= 1))) {echo 'btn-circle-green';} 
                                     ?> d-flex justify-content-center align-items-center">
                        <!---- décompte de la liste puis quand à 0, inscription du caddy ---->
                        <?php 
                            if (isset ($itemsToBuyCount['count']) && $itemsToBuyCount['count'] >= 1) { 
                                echo $itemsToBuyCount['count']; } 
                            else if (isset ($itemsToBuyCount2['count']) && $itemsToBuyCount2['count'] >= 1) { 
                                echo $itemsToBuyCount2['count']; } 
                            else if (isset ($itemsInCaddyCount['count']) && isset ($itemsToBuyCount['count']) && $itemsToBuyCount['count'] == 0) { 
                                ?><i class="item-action fas fa-check"></i><?php } 
                            else if (isset ($itemsInCaddyCount2['count']) && isset ($itemsToBuyCount2['count']) && $itemsToBuyCount2['count'] == 0) { 
                                echo $itemsInCaddyCount2['count']; }
                            ?>
                        </span>
                    </span>                    
                </a>
                
                <!-------------- Contenus du dropdown pour passage des articles du caddie en nvelle liste ou éffacement -------------->
                <div class="dropdown-menu flex-column justify-content-center align-items-center" id="dropdown-content">
                    <a class="dropdown-item nav-link return-btn" >
                        <form class="form-inline" method="post" action="index.php?action=caddyToList" name="saveCaddy">
                            <input type="hidden" name="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                            <button type="submit" class="d-flex justify-content-center align-items-center" id="caddy-save">
                                <span class="d-flex flex-column justify-content-center align-items-center">
                                    <i class="item-action fas fa-scroll fa-2x green"></i>
                                    <!---- Bouton orange creux --
                                    <span class="items btn-circle-orange d-flex justify-content-center align-items-center">
                                    <!---- Total des articles en caddy plus ceux restant en liste éventuellement ---->
                                    <?php /*
                                    if (isset ($itemsToBuyCount['count']) && isset ($itemsInCaddyCount['count'])) {
                                        $TOT_ITEMS = ($itemsToBuyCount['count'] += $itemsInCaddyCount['count']); 
                                        echo $TOT_ITEMS; }
                                    else if (isset ($itemsToBuyCount2['count']) && isset ($itemsInCaddyCount2['count'])) {
                                        $TOT_ITEMS2 = ($itemsToBuyCount2['count'] += $itemsInCaddyCount2['count']);
                                        echo $TOT_ITEMS2; }
                                  */  ?>
                                 <!-- </span> -->
                                </span>
                            </button>
                        </form>
                    </a>
                    <a class="dropdown-item nav-link return-btn" >
                        <form class="form-inline" method="post" action="index.php?action=caddyToShop" name="trashCaddy">
                            <input type="hidden" name="sessionId" value="<?php echo $_SESSION['id'] ?>" />
                            <button type="submit" class="d-flex justify-content-center align-items-center" id="caddy-trash">
                                <span class="d-flex flex-column justify-content-center align-items-center">
                                    <i class="item-action fas fa-trash fa-2x red"></i>
                                    <!---- Bouton blanc creux ---
                                    <span class="items btn-circle-white d-flex justify-content-center align-items-center">
                                    <!---- Total des articles en cadd plus ceux restant en liste éventuellement ---->
                                    <?php /*
                                    if (isset ($TOT_ITEMS)) {
                                        echo $TOT_ITEMS; }
                                    else if  (isset ($TOT_ITEMS2)) {
                                        echo $TOT_ITEMS2; }
                                */    ?> 
                               <!--   </span> -->
                                </span>
                            </button>
                            <script type="text/javascript">
                                var caddyTrash = document.getElementById('caddy-trash');
                                if (caddyTrash) {
                                        caddyTrash.onclick = function (e) {
                                            e.preventDefault();
                                            if (confirm('Voulez-vous vraiment vider ce caddy et repartir sur une liste vierge ?')) {
                                                var url = 'index.php?action=caddyToShop';
                                                document.location.href = url;
                                                return true;
                                            } else {
                                                alert('Je me disais aussi... Sauvergardez-la peut-être ?');
                                                return false;
                                            }
                                        }
                                    }
                            </script>
                        </form>
                    </a>
                </div>                
            </div>
            
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
                <h4 class="ray col-8" id="one"><?= $aislesTab[$i]['aisle_priv_title'] ?></h4>
 
                <!--------------- Comptage des articles de chaque rayon en liste -------------------->
                <span class="col-1 <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-scroll"></i>
                    <span class="caddie orange d-flex justify-content-center align-items-center">
                        <?= $itemsCountInAisleToBuyTab[$i]['count'] ?>
                    </span>
                </span>
                
                <!--------------- Comptage des articles de chaque rayon mis dans le caddy -------------------->
                <span class="col-1 d-flex flex-column justify-content-between align-items-center">
                    <?php if ($itemsCountInAisleInCadTab[$i]['count'] >= 1) { ?>
                        <i class="fam-select green fas fa-shopping-cart"></i>
                        <span class="items <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'bg-green-md';} else {echo 'green';} ?>  d-flex justify-content-center align-items-center"><?= $itemsCountInAisleInCadTab[$i]['count'] ?></span>
                    <?php } ?>
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
                        <form class="modif-form form-row col-10 justify-content-center align-items-center to-check" method="post" action="index.php?action=itemCaddy">
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

                <!--------------- Comptage des articles de chaque rayon du shop -------------------->
                <span class="col-1 d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select fas fa-th blue"></i>
                    <span class="items shop blue d-flex justify-content-center align-items-center"><?= $itemsCountInAisleTab[$i]['count'] ?></span>
                </span>
                
                <!--------------- Comptage des articles mis en liste pour chaque rayon du shop -------------------->
                <span class="col-1 <?php if ($itemsCountInAisleToBuyTab[$i]['count'] == 0) {echo 'hidden';} ?> d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select orange fas fa-scroll"></i>
                    <span class="caddie2 orange d-flex justify-content-center align-items-center"><?= $itemsCountInAisleToBuyTab[$i]['count'] ?></span>
                </span>
                
            </div>
            
            <!--------------- Contenu de chaque rayon du shop -------------------->
            <div>
                
                <ul>
                    
                    <!---------------- Boucle 2ndaire des articles en liste pour chaque rayon du shop ---------------------->
                    <?php
                    foreach ($itemsToBuyTab[$i] as $itemtoBuy) {
                        if($itemtoBuy['item_priv_purchase'] == 1) {
                    ?><!--
                    <li class="list-items item-to-caddy dropdown-item d-flex flex-row justify-content-flex-start align-items-center" href="#">
                        <span class="col-1"></span>
                        
                        <!---------------- Le nom de l'article en liste ----------------------
                        <div class="form-row col-10 offset-1 justify-content-center align-items-center" method="post" action="index.php?action=modifItem">
                        <form class="modif-form form-row col-10 justify-content-center align-items-center to-check" method="post" action="index.php?action=itemCheck">
                            <input type="hidden" name="itemId" value="<?= $itemtoBuy['id'] ?>" />
                            <button type="submit" class="action-button col-10 to-list d-flex justify-content-center align-items-center"><i></i><?= $itemtoBuy['item_priv_name'] ?><!--</button>
                        </form>
                        </div>   
                        
                    </li>
                    <?php
                        }
                    }
                    ?>
                    
                    <!---------------- Barre d'Ajout d'un article dans le shop par chekbox cocher ---------------------->
                    <li class="dropdown-item d-flex justify-content-flex-start align-items-center" href="#">
                       <div class="col-2" ></div>
                        <form class="modif-form new-item form-row col-8 justify-content-start align-items-center" name="createItem" method="post" action="index.php?action=createItem">
                            <input type="hidden" name="aisleId" value="<?= $aislesTab[$i]['id'] ?>" />
                            <input type="text" name="itemName" class="item-gene add-shop bg-dark col-12" placeholder="Ajouter un article dans ce rayon" focus />
                            <button type="submit" class="action-button modif-btn bg-dark"><i class="fas fa-th black"></i></button>
                        </form>               
                        <span class="col-1 modif-form form-check"></span>
                    </li>
  
                    <!---------------- Boucle 3ème des articles en shop pour chaque rayon du shop ---------------------->
                    <?php foreach ($itemsInAisleTab[$i] as $itemInAisle) { ?>
                    <li class="dropdown-item d-flex flex-row justify-content-start align-items-center" href="#">
                        
                        <!---------------- Supprimer un article du shop ---------------------->
                        <form class="col-2 d-flex justify-content-start" name="deleteitem" method="post" action="index.php?action=deleteItem">
                            <input type="hidden" name="itemIdErase" value="<?= $itemInAisle['id'] ?>" />
                            <button type="submit" class="action-button delete-btn" value="<?= $itemInAisle['id'] ?>"><i class="fas fa-trash-alt"></i></button>
                            <script type="text/javascript">
                                var itemIds = document.forms.deleteitem.itemIdErase;
                                if (itemIds) {
                                    var deleteBtns = document.querySelectorAll(".delete-btn");
                                    for (var i = 0, c = deleteBtns.length; i < c; i++) {
                                        deleteBtns[i].onclick = function (e) {
                                            e.preventDefault();
                                            var itemId = this.value;
                                            if (confirm('Voulez-vous vraiment supprimer cet article ?')) {
                                                var url = 'index.php?action=deleteItem&itemErase=' + itemId;
                                                document.location.href = url;
                                                return true;
                                            } else {
                                                alert('Je me disais aussi...');
                                                return false;
                                            }
                                        }
                                    }
                                }
                            </script>
                        </form>

                        <!---------------- Le nom de l'article du shop, sa modification ---------------------->
                        <form class="modif-form form-row col-8 justify-content-start align-items-center" method="post" action="index.php?action=modifItem">
                            <input type="hidden" name="itemId" value="<?= $itemInAisle['id'] ?>" />
                            <input type="text" name="itemName" class="modif-form item-gene modif-hide col-12 <?php if(($itemInAisle['item_priv_purchase'] == 1) || ($itemInAisle['item_priv_purchase'] == 2)) {echo 'to-buy';} ?>" id="<?= $itemInAisle['item_priv_name'] ?>" value="<?= $itemInAisle['item_priv_name'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
                        </form>
                      
                        <!---------------- Bloc boutons shop to list et caddy to shop ---------------------->
                        <div class="col-1" ></div>
                        <div class="col-1 modif-form d-flex justify-content-center align-items-center" >
                            
                            <!---------------- Ajout d'un article de shop à liste par chekbox cocher ---------------------->
                            <button type="submit" class="action-button check-btn add-list <?php if($itemInAisle['item_priv_purchase'] == 0) { echo 'bg-white'; } else {echo 'bg-orange';} ?>" data-value="<?= $itemInAisle['item_priv_name'] ?>" value="<?= $itemInAisle['id'] ?>"><i class="<?php if($itemInAisle['item_priv_purchase'] == 0) { echo 'fas fa-th grey'; } else {echo 'fas fa-scroll white';} ?>"></i></button>
                            
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
            if ('<?php echo $tab_id; ?>' == 'list-tab') {
                $("#list-refresh").css("display", "none");
                $("#search-item").css("visibility", "hidden");
                $("#items-refresh-btn").css("visibility", "hidden");
            } else {
                $("#items-refresh").css("display", "none");
                $("#caddy-refresh").css("display", "none");
            }
            });
        });
    </script>
<?php endif; ?>

<!---- Quand courses termiées, message et passage du caddy en vert plein ---->   
<?php if ((isset ($itemsToBuyCount['count']) && ($itemsToBuyCount['count'] == 0) 
        && isset ($itemsInCaddyCount['count']) 
        && ($itemsInCaddyCount['count'] >= 1)) 
    || (isset ($itemsToBuyCount2['count']) 
        && ($itemsToBuyCount2['count'] == 0) 
        && isset ($itemsInCaddyCount2['count']) 
        && ($itemsInCaddyCount2['count'] >= 1))) { ?>
        <script type="text/javascript">
        var caddyCheck = document.getElementById('caddy-final');
        if (!(caddyCheck.classList.contains('btn-circle-green')) && !(caddyCheck.classList.contains('btn-full-orange'))) {
            caddyCheck.classList.add('btn-full-green');
            var shopMenu = document.getElementById('shop-menu');
            shopMenu.style.display = 'none';
            var dropDownMenu = document.getElementById('dropdown-content');
            dropDownMenu.classList.add('show');
            endRace();  
            function endRace() {
                if (confirm("Bonne nouvelle <?= $_SESSION['first_name'] ?>, vous êtes arrivé au bout de vos courses ! Souhaitez-vous mémoriser cette liste pour la prochaine course ?")) {
                    var caddySaveForm = document.forms.saveCaddy;
                    caddySaveForm.submit();
                } else {
                    var caddyTrashForm = document.forms.trashCaddy;
                    caddyTrashForm.submit();
                }
            }               
        }
        </script>
<?php } ?>
