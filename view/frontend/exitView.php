<!--********************************************************************************-->
<!--******************************** DISCONNEXION **********************************-->
<!--********************************************************************************-->

<?php 
$title = 'CaddyRace/Exit';
$template = 'frontend';
$noMenu = 'no_menu';
ob_start(); 
?>

<div class="exit d-flex flex-column justify-content-center align-items-center">
    <a href="index.php?action=home" class="return-button btn btn-lg exit-text" name="login">Back to race ?</a>
    <h2 class="exit-text orange">
        <?= $message_success ?>
    </h2>
</div>

<?php $all1 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
