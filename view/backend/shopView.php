<!--********************************************************************************-->
<!--************************************ ADMIN *************************************-->
<!--************************************ SHOP **************************************-->
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

<div id="tabs-Admin" class="tabs bg-dark">

    <!--********************************************************************************-->
    <!--********************************** ADMIN SHOP **********************************-->
    <!--********************************************************************************-->
    <div id="items-admin">

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

        <!-------------- ADMIN SHOP -------------->
        <div id="accordion-Admin">

            <!-------------- Boucle 1ère des rayons du shop -------------->
            <?php for ($i=0; $i<$aislesGeneCount['count']; $i++) { ?>
            
            <!--------------- En-tête de chaque rayon du shop -------------------->
            <div class="row d-flex flex-row">
                <?php foreach ($aislesGeneIconsTab[$i] as $aislesGeneIcons) { ?>
                <span class="col-1 d-flex justify-content-center align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesGeneIcons['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php } ?>
                <h4 class="ray col-8" id="one"><?= $aislesGeneTab[$i]['aisle_gene_title'] ?></h4>
                    
                <!--------------- Comptage des articles de chaque rayon du shop -------------------->
                <span class="col-1 d-flex flex-column justify-content-between align-items-center">
                    <i class="fam-select fas fa-th"></i>
                    <span class="items dark d-flex justify-content-center align-items-center"><?= $itemsGeneCountInAisleTab[$i]['count'] ?></span>
                </span>
            </div>
            
            <!--------------- Contenu de chaque rayon du shop -------------------->
            <div>
                
                <ul>
                    
                    <!---------------- Barre d'Ajout d'un article dans le shop par chekbox cocher ---------------------->
                    <li class="dropdown-item d-flex justify-content-flex-start align-items-center" href="#">
                        <span class="delete-form d-flex justify-content-start align-items-center">
                            <button type="submit" class="action-button"><i></i></button>
                        </span>
                        <form class="modif-form new-item form-row col-10 justify-content-start align-items-center" name="createItemGene" method="post" action="index.php?action=createItemGene">
                            <input type="hidden" name="aisleGeneId" value="<?= $aislesGeneTab[$i]['id'] ?>" />
                            <input type="text" id="item-gene-name" name="itemGeneName" class="item-gene bg-dark col-10" placeholder="Rajouter un article dans ce rayon ?" focus />
                            <button type="submit" class="action-button modif-btn bg-green-md"><i class="fas fa-plus"></i></button>
                        </form>               
                        <span class="col-1 modif-form form-check"></span>
                    </li>
                    
                    <!---------------- Boucle 2ndaire des articles en liste pour chaque rayon du shop ---------------------->
                    <?php
                    foreach ($itemsGeneInAisleTab[$i] as $itemGeneInAisle) { ?>
                    <li class="dropdown-item d-flex flex-row justify-content-flex-start align-items-center" href="#">
                        
                        <!---------------- Supprimer un article du shop ---------------------->
                        <form class="delete-form d-flex justify-content-end" method="post" action="index.php?action=deleteItemGene">
                            <input type="hidden" name="itemGeneId" value="<?= $itemGeneInAisle['id'] ?>" />
                            <button type="submit" class="action-button delete-btn"><i class="fas fa-trash-alt"></i></button>
                        </form>

                        <!---------------- Le nom de l'article du shop, sa modification ---------------------->
                        <form class="modif-form form-row col-10 justify-content-start align-items-center" method="post" action="index.php?action=modifItemGene">
                            <input type="hidden" name="itemGeneId" value="<?= $itemGeneInAisle['id'] ?>" />
                            <input type="text" name="itemGeneName" class="modif-form item-gene col-10" value="<?= $itemGeneInAisle['item_gene_name'] ?>" />
                            <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
                        </form>
                      
                        <!---------------- Bloc boutons shop to list et caddy to shop ---------------------->
                        <div class="col-1 modif-form form-check form-row justify-content-center align-items-center" >
                            
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
