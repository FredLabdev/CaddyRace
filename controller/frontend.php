<?php

require_once('model/ItemsManager.php');
require_once('model/LoginManager.php');
require_once('model/MemberManager.php');
require_once('model/AislesManager.php');


try {
    
    //**************************************************************************************
    //                        Controller frontend LoginManager           
    //**************************************************************************************

    function loginControl($pseudo, $password) {
        if ($pseudo == "" || $password =="") {
            $login_error =  'Veuillez renseigner tous les champs svp.';
        } else {
            $login_error = 'Erreur : pseudo et/ou mot de passe erroné(s).';
        }
        $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
        $passwordFromPseudo = ($loginManager->getPasswordFromPseudo($pseudo)); 
        $dbPassword = $passwordFromPseudo['password']; 
        $isPasswordCorrect = password_verify($password, $dbPassword); 
        if ($dbPassword) {
            if ($isPasswordCorrect) {
                if (isset($_POST['login_auto'])) {
                    setcookie('pseudo', $pseudo, time() + 365*24*3600, null, null, false, true);
                    setcookie('password', $dbPassword, time() + 365*24*3600, null, null, false, true);
                }
                loginAvailable($pseudo, $dbPassword);
            } else {
                require('view/frontend/loginView.php');
            }
        } else {
            require('view/frontend/loginView.php');
        }
    }

    function loginAvailable($pseudo, $password) {
                    // 1 - Récupération de ses données   
        $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
        $memberData = $loginManager->getMemberData($pseudo, $password);
                    // 2 - Ouverture de session   
        sessionStart($memberData);
                    // 3 - re-direction vers accueil front ou backend
        homePageDirect($memberData['pseudo'], $memberData['group_id']);
    }

    function sessionStart($memberData) {
        session_start();
        $_SESSION['id'] = $memberData['id'];
        $_SESSION['name'] = $memberData['name'];
        $_SESSION['first_name'] = $memberData['first_name'];
        $_SESSION['pseudo'] = $memberData['pseudo'];
        $_SESSION['password'] = $memberData['password'];    
        $_SESSION['group_id'] = $memberData['group_id'];    
    } 

    function homePageDirect($pseudo, $group) {
        if ($_SESSION['group_id']) {
            header('Location: index.php?action=list'); 
        }  
        else if ($group !== 1) {
            header('Location: index.php?action=list');
        }  
    }

    function pseudoControl($pseudo, $message_error) {
        $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
        $pseudoIdem = $loginManager->getPseudoIdem($pseudo);
        if ($pseudoIdem['pseudo_idem'] == 0) {
        } else {
            $message_error .=  'Ce pseudo existe déjà !' . '<br>';
        }
        return $message_error;
    }

    function mailControl($mail, $mailConfirm, $message_error) {
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
            $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
            $mailIdem = $loginManager->getMailIdem($mail);
            if ($mailIdem['email_idem'] == 0) {
                if ($mailConfirm == $mail) {
                } else {
                    $message_error .=  'Vos 2 adresses mail sont différentes !' . '<br>';
                } 
            } else {
                $message_error .=  'Cette adresse mail existe déjà !' . '<br>';
            }     
        } else {
            $message_error .=  'Format d\'adresse mail n\'est pas valide.' . '<br>';
        }    
        return $message_error;
    }

    function passwordControl($password, $passwordConfirm, $message_error) {
        if (preg_match("#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#", $password)) {
            if ($passwordConfirm == $password) {
                $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
                $getAllPassword = $loginManager->getAllPassword();
                while ($allPassword = $getAllPassword->fetch()) {
                    $isPasswordExist = password_verify($password, $allPassword['password']);
                    if (!$isPasswordExist) {   
                    } else {
                        $message_error .=  'Ce mot de passe existe déjà !' . '<br>';
                    }
                }
            } else {
                $message_error .=  'Vos mots de passes ne sont pas identiques !' . '<br>';
            }   
        } else {
            $message_error .=  'Votre mot de passe doit être composé de minimum 8 caractères'  . '<br>' . 'dont 1 Majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial !' . '<br>';
        }    
        return $message_error;
    }

    function newMember($createName, $createFirstName, $createPseudo, $createMail, $mailConfirm, $createPassword, $passwordConfirm) {
        if ($createName == "" || $createFirstName =="" || $createPseudo =="" || $createMail =="" || $mailConfirm =="" || $createPassword =="" || $passwordConfirm =="") {
            $message_error =  'Veuillez renseigner tous les champs svp.';
            require('view/frontend/loginView.php');
        } else {
            $message_error = '';
            $message_error = pseudoControl($createPseudo, $message_error);
            $message_error = mailControl($createMail, $mailConfirm, $message_error);
            $message_error = passwordControl($createPassword, $passwordConfirm, $message_error);    
            if ($message_error == '') { // Si tout ok on creer le nouveau membre,
                $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
                $loginManager->CreateMember($createName, $createFirstName, $createPseudo, $createMail, $createPassword);
                loginControl($createPseudo, $createPassword); // et on démmarre sa session
            } else {
                require('view/frontend/loginView.php'); // retour au login avec affichage des erreurs
            }
        }
    }

    //**************************************************************************************
    //             Controller frontend AislesManager (+frontend ItemsManager)            
    //**************************************************************************************

    function listDetail($message_success, $message_error) {
            require('view/frontend/listView.php');
    }

    function getPagesMax($postsCount) {
        if (($postsCount['nbre_posts']%5) == 0) {
            $pages_max = (int)($postsCount['nbre_posts']/5);    
        } else {
            $pages_max = ((int)($postsCount['nbre_posts']/5))+1;    
        }
        return $pages_max;
    }

    //**************************************************************************************
    //        Controller frontend MemberManager (+Controller frontend Login Manager)          
    //**************************************************************************************

    function membersHome($message_success, $message_error, $memberDetails) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $membersCount = $memberManager->getMembersCount();
        $membersByGroup = $memberManager->getMembersByGroup();
        $membersByName = $memberManager->getMembersByName();
        $message_success;
        $message_error;
        $memberDetails;
        require('view/backend/membersView.php');      
    }

     function memberHome($message_success, $message_error, $memberDetails) {
        $message_success;
        $message_error;
        $memberDetails;
        require('view/frontend/profilView.php');      
    }
    
    function memberDetail($message_success, $message_error, $memberId, $template) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $memberDetails = $memberManager->getMemberDetail($memberId);
        if ($template != "") {
        membersHome($message_success, $message_error, $memberDetails);            
        } else {
        memberHome($message_success, $message_error, $memberDetails);
        }
    }

    function newMail($memberId, $newMail, $mailConfirm) {
        $message_error = '';
        $message_error = mailControl($newMail, $mailConfirm, $message_error);
        if ($message_error == '') { // Si tout ok on creer le nouveau membre,
            memberModifMail($memberId, $newMail); // et on démmarre sa session
        } else {
            memberDetail("", $message_error, $memberId, $template);
        }
    }

    function memberModifMail($memberId, $newMail) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $memberManager->changeMemberMail($memberId, $newMail);
        $message_success =  'La modification de l\'email a bien été enrégistrée !';
        memberDetail($message_success, "", $memberId, "");
    }

    function newPassword($memberId, $newPassword, $passwordConfirm) {
        $message_error = '';
        $message_error = passwordControl($newPassword, $passwordConfirm, $message_error);
        if ($message_error == '') { // Si tout ok on creer le nouveau membre,
            memberModifPassword($memberId, $newPassword); // et on démmarre sa session
        } else {
            memberDetail("", $message_error, $memberId, "");
        }
    }

    function memberModifPassword($memberId, $newPassword) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $memberManager->changeMemberPassword($memberId, $newPassword);
        $message_success =  'La modification du mot de passe a bien été enrégistrée !';
        memberDetail($message_success, "", $memberId, "");
    }

    function memberDelete($memberId, $template) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $memberManager->deleteMember($memberId);
        if ($_SESSION['id'] == $memberId) {
            $message_success =  'Votre compte a bien été supprimé. Désolé de vous voir nous quitter...';
        } else {
            $message_success =  'Ce compte a bien été supprimé...';
        }  
        if ($_SESSION['group_id'] == 1) {
            memberDetail($message_success, "", $memberId, $template);
        } else {
            require('view/frontend/loginView.php');
        }   
    }

    //**************************************************************************************
    //                       Controller frontend Deconnexion       
    //**************************************************************************************

    function sessionEnd() {
        $message_success = 'A très bientôt sur CaddyRace' . ' ' . $_SESSION['first_name'];
        $_SESSION = array(); // Suppression des variables de session et de la session
        session_destroy();
        setcookie('pseudo', ''); // Suppression des cookies de connexion automatique
        setcookie('password', '');
        require('view/frontend/exitView.php');
    }

//**************************************************************************************
//                   Redirection des erreurs vers page errorView             
//**************************************************************************************

} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
