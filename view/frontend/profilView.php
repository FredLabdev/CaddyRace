<?php 
    session_start();
    $title = 'CaddyRace/Compte';
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
            <i class="fas fa-user orange"></i> Votre profil membre :
        </h4>

        <div class="member-text bg-dark">
            <?php
        foreach($memberDetails as $dataMember) { // Détail du member sélectionné
            echo '<span class="orange">Date de création : </span>' . $dataMember['creation_date_fr'] . '<br>';
            echo '<span class="orange">Nom : </span>' . $dataMember['name'] . '<br>';
            echo '<span class="orange">Prénom : </span>' . $dataMember['first_name'] . '<br>';  
            echo '<span class="orange">Pseudo : </span>' . $dataMember['pseudo'] . '<br>';  
            echo '<span class="orange">Mail : </span>' . $dataMember['email'] . '<br>';  
        }
        ?>
        </div>


        <h4 class="login-title black">
            <i class="fas fa-user-edit orange"></i> Modifier votre profil :
        </h4>

        <form class="profil-form" novalidate method="post" action="index.php?action=memberModif" id="form_modif" name="modif">
            <input type="hidden" name="personal_modif" value="<?php echo $dataMember['id']; ?>" />
            <div class="form-group row">
                <label class="black">Champ à modifier:</label>
                <select id="champ" name="champ">
                    <option value=""></option>
                    <option value="1">e-mail</option>
                    <option value="2">Mot de passe</option>
                </select>
            </div>
            <div class="form-group row">
                <label class="black" for="modif_champ">Nouveau contenu :</label>
                <input id="modif_champ" class="" type="text" name="modif_champ" value="<?php if (isset($_POST['modif_champ'])){echo $_POST['modif_champ'];} ?>" /> <br>
                <span class="error" id="error1" aria-live="polite">
                    <?= $message_error; ?>
                </span>
            </div>
            <div class="form-group row">
                <label class="black" for="modif_champ_confirm">Confirmez ce contenu : </label>
                <input id="modif_champ_confirm" type="text" name="modif_champ_confirm" value="<?php if (isset($_POST['modif_champ_confirm'])){echo $_POST['modif_champ_confirm'];} ?>" /> <br>
                <span class="error" id="error2" aria-live="polite">
                    <?= $message_error; ?>
                </span>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <button id="bouton_envoi" type="button submit" class="btn btn-success white btn-lg" name="remplacer"><i class="fas fa-user-edit"></i> Modifier</button>
                </div>
                <?php if($message_success) { ?>
                <div class="col-sm-8 alert-danger">
                    <?= $message_success; ?>
                </div>
                <?php } ?>
            </div>
        </form>

    </div>

    <div class="login bg-grey">

        <h4 class="login-title desinscrire black">
            <i class="fas fa-user-times orange"></i> Vous désinscrire :
        </h4>

        <form class="login-form" name="delete">
            <div class="form-row">
                <div class="form-group">
                    <input type="hidden" name="personal_modif" value="<?php echo $dataMember['id']; ?>" />
                    <label class="red">Désinscription définitive : </label>
                    <a href="#" class="btn btn-danger white btn-lg" onClick="var memberId = document.forms.delete.personal_modif.value;
        function valid_confirm(member) {
            if (confirm('Voulez-vous vraiment vous désinscrire définitivement ?')) {
                var url = 'index.php?action=memberDelete&memberErase=' + member;
                document.location.href = url;
                return true;
            } else {
                alert('Je me disais aussi...');
                return false;
            }
        }
        valid_confirm(memberId);"><i class="fas fa-user-times"></i> Désinscription </a>
                </div>
            </div>
        </form>

    </div>

</div>


<?php 
    if ($_SESSION['group_id'] == 1) {
        $backend = ob_get_clean();
    } else {
        $frontend = ob_get_clean();
    }
?>

<?php require('view/frontend/template.php'); ?>
