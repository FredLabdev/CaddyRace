<?php 
$title = 'CaddyRace/Login';
$template = 'frontend';
ob_start(); 
?>

<div class="loginView bg-dark">
    <div class="login">
        <h4 class="login-title">
            <i class="fas fa-user-check orange"></i> Connexion :
        </h4>
        <div class="row justify-content-center align-items-center">
            <?php if($login_error) { ?>
            <span class="alert alert-danger col-xs-4">
                <?= $login_error; ?>
            </span>
            <?php } ?>
        </div>
        <form class="login-form" method="post" action="index.php?action=login">
            <div class="form-row">
                <div class="form-group">
                    <label class="orange">Votre pseudo :</label>
                    <input id="pseudo_login" type="text" name="pseudo_connect" placeholder="pseudo" />
                </div>
                <div class="form-group">
                    <label class="orange">Votre mot de passe :</label>
                    <input id="password_login" type="password" name="password_connect" placeholder="password" />
                </div>

                <input class="form-check-input" type="hidden" name="login_auto" checked />

                <div class="form-group">
                    <button type="button submit" class="btn btn-success white btn-lg" name="login">
                        <span class="logo2 d-flex justify-content-center align-items-end">
                            <img src="public/picture/brand/caddy-icon-C-38x38-white.png" alt="caddy picture" />
                            <span>addy</span>
                            <img src="public/picture/brand/caddy-icon-R-32x32-white.png" alt="caddy picture" />
                            <span>ace</span>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="newMember bg-grey">
        <h4 class="member-title black">
            <i class="fas fa-user-plus orange"></i> Nouveau venu ?
        </h4>
        <div class="row justify-content-center align-items-center">
            <?php if($message_error) { ?>
            <span class="alert alert-danger col-xs-4">
                <?= $message_error; ?>
            </span>
            <?php } ?>
        </div>
        <form class="login-form" method="post" action="index.php?action=newMember">
            <div class="form-row">
                <div class="form-group">
                    <label class="black">Nom :</label>
                    <input id="name_create" type="text" name="name" placeholder="last name" value="<?php if (isset($_POST['name'])){echo $_POST['name'];} ?>" />
                    <label class="black">Prenom :</label>
                    <input id="first_name_create" type="text" name="first_name" placeholder="first name" value="<?php if (isset($_POST['first_name'])){echo $_POST['first_name'];} ?>" />
                    <label class="black">Pseudo :</label>
                    <input id="pseudo_create" type="text" name="pseudo" placeholder="pseudo" value="<?php if (isset($_POST['pseudo'])){echo $_POST['pseudo'];} ?>" />
                </div>
                <div class="form-group">
                    <label class="black">e-mail :</label>
                    <input id="email_create" type="text" name="email" placeholder="e-mail" value="<?php if (isset($_POST['email'])){echo $_POST['email'];} ?>" />
                    <label class="black">Confirmer l'e-mail:</label>
                    <input id="email_create_confirm" type="text" name="email_confirm" placeholder="confirm e-mail" value="<?php if (isset($_POST['email_confirm'])){echo $_POST['email_confirm'];} ?>" />
                </div>
                <div class="form-group">
                    <label class="black">Mot de passe :</label>
                    <input id="password_create" type="password" name="password" placeholder="Pass&word (inclu: Maj et caract.special)" />
                    <label class="black">Confirmer le mot de passe :</label>
                    <input id="password_create_confirm" type="password" name="password_confirm" placeholder="confirm Pass&word" />
                </div>
                <div class="form-group">
                    <button type="button submit" class="btn btn-success white btn-lg col-xs-12" name="login"><i class="fas fa-user-plus orange"></i> Envoyer</button>
                </div>
            </div>
        </form>
    </div>

</div>

<?php $all1 = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
