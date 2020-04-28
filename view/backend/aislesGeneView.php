<!--********************************************************************************-->
<!--************************************ AISLES ************************************-->
<!--********************************************************************************-->

<?php 
    $title = 'CaddyRace/Rayons';
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

<!-------------- Message indiquant l'affichage uniquement sur ordinateur -------------->

<div class="aisles-xs-message">
    <p class="">Pour des raisons ergonomiques, la gestion de vos rayons n'est possible que sur ordinateur.</p>
</div>

<div id="aisles-admin">

    <!-------------- Début du circuit de rayons -------------->
    <div class="row rayons-org col-10 offset-1">

        <div class="col-12 circuit text-center bg-green">
            <i class="fas fa-flag fa-2x"></i> Entrée circuit
        </div>
  
        <!-------------- Rayons "sortables" pour ordonner -------------->
        <ul id="sortable-admin" class="sortable col-11">
            
            <!-------------- Boucle des rayons -------------->
            <?php for ($i=0; $i<$aislesGeneCount2['count']; $i++) {?>
            <li class="ui-state-default row d-flex align-items-center" id="aisleId_<?= $aislesGeneTab2[$i]['id'] ?>">                      
         
                <!---------------- Icones des rayons ---------------------->
                <?php foreach ($aislesGeneIconsTab2[$i] as $aislesGeneIcons2) { ?>
                <span class="col-1 d-flex justify-content-end align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesGeneIcons2['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php } ?>
                
                <!---------------- Bouton delete ---------------------->
                <form class="delete-form d-flex justify-content-start align-items-center" method="post" action="index.php?action=deleteAisleGene">
                    <input type="hidden" name="aisleGeneId" value="<?= $aislesGeneTab2[$i]['id'] ?>" />
                    <button type="submit" class="action-button delete-btn"><i class="fas fa-trash-alt"></i></button>
                </form>
                        
                <!---------------- Le titre du rayon et sa modification -------------------->
                <form class="modif-form form-row col-8 justify-content-start align-items-center" method="post" action="index.php?action=modifAisleGene">
                    <input type="hidden" name="aisleGeneId" value="<?= $aislesGeneTab2[$i]['id'] ?>" />
                    <input type="text" name="aisleGeneTitle" class="item-gene col-10" value="<?= $aislesGeneTab2[$i]['aisle_gene_title'] ?>" />
                    <button type="submit" class="action-button modif-btn"><i class="fas fa-pencil-alt"></i></button>
                </form>
                
                <!---------------- logo rayon mobile -------------------->
                <div class="col-1 aisles-icons d-flex justify-content-center align-items-center">                             
                    <i class="fam-select orange fas fa-stream col-sm-3 d-flex justify-content-end align-items-center"></i>
                </div>
            </li>
            <?php } ?> 
            
        </ul>

        <!-------------- Boucle des repères num ---------->
        <ul class="list-group rayon-num col-1">
            <?php for ($i=0; $i<$aislesGeneCount2['count']; $i++) { ?>
            <li class="list-group-item d-flex flex-row justify-content-center align-items-center">
                <span class="caddie2 d-flex justify-content-center align-items-center"><?= $i+1 ?></span>
            </li>
            <?php } ?>
        </ul>
        <form action="" method="post">
            <input type="hidden" name="sortable-admin" />
        </form>
        
        <!----------------  Ajouter un rayon ------------>
        <div class="col-11">
            <div class="row" id="newAisleGene">
                <span class="col-1"></span>
                <span class="col-1"></span>
                <span class="delete-form d-flex justify-content-start align-items-center">
                    <button type="submit" class="action-button"><i></i></button>
                </span>
                <form class="modif-form form-row col-9 flex-nowrap justify-content-start align-items-center" method="post" action="index.php?action=createAisleGene">
                    <input type="hidden" name="aisleGeneOrder" value="<?= $aislesGeneCount2['count']+1 ?>" />
                    <input type="text" name="aisleGeneTitle" class="item-gene bg-dark add-form col-10" placeholder="Rajouter un rayon au circuit ? ensiute, positionnez-le." focus />
                    <button type="submit" class="action-button modif-btn bg-green-md"><i class="fas fa-plus "></i></button>
                </form>
                <div class="col-1 aisles-icons d-flex justify-content-center align-items-center">                             
                    <i class="fam-select orange fas fa-stream col-sm-3 d-flex justify-content-end align-items-center"></i>
                </div>
            </div>
        </div>
        <ul class="list-group rayon-num col-1">
            <li class="list-group-item d-flex flex-row justify-content-center align-items-center">
                <span class="caddie2 d-flex justify-content-center align-items-center">?</span>
            </li>
        </ul>
          
        <div class="col-12 circuit text-center bg-red">
            <i class="fas fa-flag-checkered fa-2x"></i> Sortie Circuit
        </div>
    
    </div>
    <!-------------- Fin du circuit de rayons -------------->

</div>

<?php $all3 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
