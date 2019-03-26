<?php 
$title = 'CaddyRace/Contact';
    if ($_SESSION['group_id'] == 1) {
        $template = 'backend';
    } else {
        $template = 'frontend';
    }
ob_start(); 
?>

<div class="loginView bg-grey">

    <div class="login">

        <h4 class="login-title black">
            <i class="fas fa-question-circle orange"></i> Nous contacter :
        </h4>

        <div class="row justify-content-center align-items-center">
            <?php if($message_error) { ?>
            <span class="alert alert-danger col-4 offset-4">
                <?= $message_error; ?>
            </span>
            <?php } ?>
        </div>

        <form class="login-form" method="post" action="index.php?action=contactForm">
            <div class="form-row">
                <div class="form-group text-left">
                    <label class="orange">Votre nom :</label>
                    <input class="bg-dark" type="text" name="name" value="<?= $_SESSION['name'] ?>" />
                </div>
                <div class="form-group text-left">
                    <label class="orange">Votre prénom :</label>
                    <input class="bg-dark" type="text" name="first_name" value="<?= $_SESSION['first_name'] ?>" />
                </div>
                <div class="form-group text-left">
                    <label class="orange">Votre message : </label>
                    <textarea class="col-lg-12" rows="8"></textarea>
                </div>
                <div class="form-group">
                    <button type="button submit" class="btn btn-success white btn-lg" name="login"><i class="fas fa-paper-plane orange"></i> Soumettre</button>
                </div>
            </div>
        </form>

    </div>

</div>

<?php $all1 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
