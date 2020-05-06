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

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
if ($message_error) {
    phpAlert($message_error);
} else if ($message_success) {
    phpAlert($message_success);
}

?>

<!-------------- Message indiquant l'affichage uniquement sur ordinateur -------------->

<div id="aisles">

    <!-------------- Début du circuit de rayons -------------->
    <div class="row rayons-org col-12 col-sm-11">

        <div class="col-12 circuit text-center bg-green-md">
            <i class="fas fa-flag fa-2x"></i> Entrée circuit
        </div>
  
        <!-------------- Rayons "sortables" pour ordonner -------------->
        <ul id="sortable" class="sortable col-10">
            
            <!-------------- Boucle des rayons -------------->
            <?php for ($i=0; $i<$aislesCount2['count']; $i++) {?>
            <li class="ui-state-default row d-flex align-items-center" id="aisleId_<?= $aislesTab2[$i]['id'] ?>">                      
         
                <!---------------- Icones des rayons ---------------------->
                <?php foreach ($aislesIconsTab3[$i] as $aislesIcons3) { ?>
                <span class="col-1 d-none d-sm-block justify-content-end align-items-center"><img class="famIcon" src="public/picture/items/<?= $aislesIcons3['icon_adress'] ?>" alt="item picture" title="item" /></span>
                <?php } ?>
                
                <!---------------- Bouton delete ---------------------->
                <form class="delete-form delete-aisle d-flex justify-content-start align-items-center" name="deleteaisle" method="post" action="index.php?action=deleteAisle">
                    <input type="hidden" name="aisleIdErase" value="<?= $aislesTab2[$i]['id'] ?>" />
                    <button type="submit" class="action-button delete-btn" value="<?= $aislesTab2[$i]['id'] ?>"><i class="fas fa-trash-alt"></i></button>
                </form>
                <script type="text/javascript">
                    var aislesIds = document.forms.deleteaisle.aisleIdErase;
                    if (aislesIds) {
                        var deleteBtns = document.querySelectorAll(".delete-btn");
                        for (var i = 0, c = deleteBtns.length; i < c; i++) {
                            deleteBtns[i].onclick = function (e) {
                                e.preventDefault();
                                var aisleId = this.value;
                                if (confirm('Attention si vous supprimez un rayon non vide, les articles rattachés seront également supprimés et n\'apparaîtront plus dans vos recherches ! Mieux vaut modifier son descriptif ou alors créer un nouveau rayon et y recopier vos articles avant. De plus le choix des icônes n\'est pas encore disponible sur un nouveau rayon créé... Bientôt !')) {
                                    var url = 'index.php?action=deleteAisle&aisleErase=' + aisleId;
                                    document.location.href = url;
                                    return true;
                                } else {
                                    alert('C\'est plus prudent ;)...');
                                    return false;
                                }
                            }
                        }
                    }
                </script>
                
                <!---------------- Le titre du rayon et sa modification -------------------->
                <form class="modif-form form-row col-10 col-sm-8 justify-content-start align-items-center" method="post" action="index.php?action=modifAisle">
                    <input type="hidden" name="aisleId" value="<?= $aislesTab2[$i]['id'] ?>" />
                    <input contenteditable=true type="text" name="aisleTitle" class="contenteditable item-gene modif-hide aisle-title col-11" value="<?= $aislesTab2[$i]['aisle_priv_title'] ?>" />
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
        <ul class="list-group rayon-num col-2">
            <?php for ($i=0; $i<$aislesCount2['count']; $i++) { ?>
            <li class="list-group-item d-flex flex-row justify-content-center align-items-center">
                <span class="caddie2 d-flex justify-content-center align-items-center"><?= $i+1 ?></span>
              <!--  <input type="number" name="newaisleposition" id="<?= $aislesTab2[$i]['id'] ?>" /> -->
            </li>
            <?php } ?>
        </ul>
  <!--  <button type="submit" id="new-order" class="action-button modif-btn"><i class="fas fa-check"></i></button> -->
        <form action="" method="post">
            <input type="hidden" name="sortable" />
        </form>
        
        <!----------------  Ajouter un rayon ------------>
        <div class="col-10">
            <div class="d-flex justify-content-center align-items-center" id="newAisle">
                <span class="col-1 d-none d-sm-block"></span>
                <span class="col-1 d-none d-sm-block"></span>
                <span class=""></span>
                <form class="modif-form form-row col-10 col-sm-8 flex-nowrap justify-content-start align-items-center" method="post" action="index.php?action=createAisle">
                    <input type="hidden" name="aisleOrder" value="<?= $aislesCount2['count']+1 ?>" />
                    <input type="text" name="aisleTitle" class="item-gene modif-hide bg-dark add-form col-11" placeholder="Rajouter un rayon ici et positionnez-le ensuite." focus />
                    <button type="submit" class="action-button modif-btn"><i class="fas fa-check "></i></button>
                </form>
                <div class="col-1 aisles-icons d-flex justify-content-center align-items-center">                             
                    <i class=""></i>
                </div>
            </div>
        </div>
        <ul class="list-group rayon-num col-2">
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
