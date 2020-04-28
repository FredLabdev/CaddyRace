<?php 
    $title = 'CaddyRace/Membres';
    if ($_SESSION['group_id'] == 1) {
        $template = 'backend';
    } else {
        $template = 'frontend';
    }
    ob_start(); 
?>

<div id="members">

    <!-- LISTE DES ADMINISTRATUERS ET MODERATEURS -->

    <h4 class="login-title black">
        <i class="fas fa-user-graduate orange"></i> Administration :
    </h4>

    <div class="member-text bg-dark white">
        <?php 
        foreach($membersByGroup as $member) {
            echo $member['grade_groupe'] . ' : ' . $member['name_member'] . ' ' . $member['first_name_member'] . '<br>';
        }
        ?>
    </div>

    <!-- LISTE DES MEMBRES -->

    <h4 class="login-title black">
        <i class="fas fa-users orange"></i> Autres membres :
    </h4>
    <div class="member-text bg-dark white text-center">
        <h1>
            <?= $membersCount['nbre_members'] ?>
        </h1>
    </div>


    <!-- MESSAGES -->

    <div class="row col-12 text-center">
        <?php if($message_success) { ?>
        <span class="alert alert-success col-4 offset-4">
            <?= $message_success; ?>
        </span>
        <?php } else if($message_error) { ?>
        <span class="alert alert-danger col-4 offset-4">
            <?= $message_error; ?>
        </span>
        <?php } ?>
    </div>

    <!-- EDITION D'UN MEMBRE -->

    <h4 class="login-title black">
        <i class="fas fa-user-edit orange"></i> Voir un profil :
    </h4>

    <!-- SELECTION -->

    <form id="MemberForm" class="member-text bg-dark white" method="post" action="index.php?action=membersDetail">
        <select name="member">
            <option name="choix" value=""></option>
            <?php
                foreach($membersByName as $member) {
                    echo '<option value="' . $member['id'] . '">' . $member['name_maj'] . ' ' . $member['first_name_min'] . '</option>';
                }
                ?>
        </select>
        <button class="offset-1 btn btn-light btn-sm blue" type="submit">Editer</button><br>

        <!-- DETAIL -->

        <?php
            foreach($memberDetails as $dataMember) { // Détail du member sélectionné
                echo 'Nom : ' . $dataMember['name'] . '<br>';
                            echo 'Prénom : ' . $dataMember['first_name'] . '<br>';  
                echo 'Pseudo : ' . $dataMember['pseudo'] . '<br>';  
                echo 'Mail : ' . $dataMember['email'] . '<br>';  
                echo 'Date de création : ' . $dataMember['creation_date'] . '<br>';
                if($dataMember['block_comment'] == 0) {
                    echo 'Commentaires autorisés : oui' . '<br>';  
                } else {
                    echo 'Commentaires autorisés : non' . '<br>';  
                }; 
                if($dataMember['group_id'] == 2) {
                    echo 'Ce membre est un modérateur';
                };  
            }
            ?>
    </form>

    <!-- ACTIONS POSSIBLES -->

    <?php
        if ($memberDetails) {
    ?>
    <h4 class="login-title black">
        <i class="fas fa-user-cog orange"></i> Actions possibles :
    </h4>

    <form id="modifMember" class="member-text bg-dark white" method="post" action="index.php?action=memberModif">
        <input type="hidden" name="member_modif" value="<?php echo $dataMember['id']; ?>" />
        <label>
            <?php 
            if($dataMember['block_comment'] == 0) {
                echo 'Bloquer ses commentaires';
            } else {
                echo 'Réautoriser ses commentaires';
            };
            ?>
        </label>
        <input type="checkbox" name="block_comment" value="<?php if($dataMember['block_comment'] == 0){echo '1';}else{echo '0';};?>" /><br>
        <label>
            <?php 
            if ($_SESSION['group_id'] == 1) {
                if ($dataMember['group_id'] != 2) {
                    echo 'Donner un pouvoir de modérateur de commentaires';
                } else {
                    echo 'Retirer son pouvoir de modérateur de commentaires';
                }
            ?>
        </label>
        <input type="checkbox" name="moderator" value="<?php if($dataMember['group_id'] == 3){echo '2';}else{echo '3';};?>" />
        <?php 
            }
        ?>
        <p></p>
        <button class="member-button btn btn-success btn-lg offset-lg-2" type="submit" name="remplacer">Appliquer</button>
    </form>

    <!-- SUPPRESSION DU COMPTE -->

    <div class="delete-member">

        <h4 class="login-title desinscrire black">
            <i class="fas fa-user-times orange"></i> Le désinscrire :
        </h4>

        <?php 
    if ($_SESSION['group_id'] == 1) {
    ?>

        <form class="member-text bg-dark white" name="delete">
            <label class="red">Désinscription définitive : </label>
            <input type="hidden" name="member_modif" value="<?= $dataMember['id']; ?>" />
            <a href="#" class="btn btn-danger white btn-lg" onClick="var memberId = document.forms.delete.member_modif.value;
        function valid_confirm(member) {
            if (confirm('Voulez-vous vraiment désinscrire ce membre ?')) {
                var url = 'index.php?action=memberDelete&memberErase=' + member;
                document.location.href = url;
                return true;
            } else {
                alert('Je me disais aussi...');
                return false;
            }
        }
        valid_confirm(memberId);"> <i class="fas fa-user-times"></i> Désinscription </a>
        </form>
        <?php 
    }
    }
    ?>

        <?php 
    if ($_SESSION['group_id'] == 1) {
        $backend = ob_get_clean();
    } else {
        $frontend = ob_get_clean();
    }
    ?>

    </div>

</div>

<?php require('view/frontend/template.php'); ?>
