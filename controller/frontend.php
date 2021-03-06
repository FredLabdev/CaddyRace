<?php

require_once('model/CommentManager.php');
require_once('model/AislesManager.php');
require_once('model/ItemsManager.php');
require_once('model/LoginManager.php');
require_once('model/MemberManager.php');

try {
    
    //**************************************************************************************
    //            Controller frontend ItemsManager         
    //**************************************************************************************

    //**************************************************************************************
    //            Redirection vers listView / Tab "Shop to Liste" 
    
    function shopList($memberId, $message_success, $message_error, $tab) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $aislesCount = $AislesManager->getAislesCount($memberId);
        $aislesTab = $AislesManager->getAislesTab($memberId);
        $itemsCountInAisleTab = array();
        $itemsCountInAisleToBuyTab = array();
        $itemsCountInAisleInCadTab = array();
        $itemsInAisleTab  = array();
        $itemsToBuyTab  = array();
        $itemsToPickTab  = array();
        $aislesIconsTab  = array();
        $aislesIconsTab2  = array();
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $itemsToBuyCount = $ItemsManager->getItemsToBuyCount($memberId);
        $itemsInCaddyCount = $ItemsManager->getItemsInCaddyCount($memberId);
        foreach($aislesTab as $aisle) {
            $itemsCountInAisle = $ItemsManager->getItemsCountInAisle($memberId, $aisle['id']);  
            $itemsCountInAisleTab[] = $itemsCountInAisle;
            $itemsCountInAisleToBuy = $ItemsManager->getItemsCountInAisleToBuy($memberId, $aisle['id']);  
            $itemsCountInAisleToBuyTab[] = $itemsCountInAisleToBuy;
            $itemsCountInAisleInCad = $ItemsManager->getItemsCountInAisleInCad($memberId, $aisle['id']);  
            $itemsCountInAisleInCadTab[] = $itemsCountInAisleInCad;
            $itemsInAisle = $ItemsManager->getItemsInAisle($memberId, $aisle['id']);    
            $itemsInAisleTab[] = $itemsInAisle;
            $itemsToBuy = $ItemsManager->getItemsToBuy($memberId, $aisle['id']);    
            $itemsToBuyTab[] = $itemsToBuy;
            $itemsToPick= $ItemsManager->getItemsToPick($memberId, $aisle['id']);    
            $itemsToPickTab[] = $itemsToPick;
            $aislesIcons = $AislesManager->getAislesIcons($aisle['aisle_gene_refer_id']);    
            $aislesIconsTab[] = $aislesIcons;
            $aislesIcons = $AislesManager->getAislesIcons($aisle['aisle_gene_refer_id']);    
            $aislesIconsTab2[] = $aislesIcons;
        }
        $message_success;
        $message_error;
        if ($tab == 'shop') {
            $_REQUEST['id'] = 'items-tab';
            require('view/frontend/listView.php');
        } else if ($tab == 'caddy') {
            $_REQUEST['id'] = 'list-tab';
            require('view/frontend/listView.php');
        } else if ($tab == 'aisles') {
            require('view/frontend/aislesView.php');
        }
    }
    
    function createItem($memberId, $aisleId, $itemName) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $message_error = "";
        if($itemName == "") {
            $message_error =  'Merci de renseigner un nom pour votre nouvel article.';
        } else {
            $ItemsManager->pushItem($memberId, $aisleId, $itemName);  
            $itemId = $ItemsManager->getItemId($memberId); 
            $itemNewCheckStatus = $ItemsManager->changeItemCheck($itemId[0]);   
            if ($itemNewCheckStatus == 0) {
                $message_success =  'Quelque chose de bizarre s\'est profuit ??';
            } else {
                $message_success =  'Votre nouvel article ' . $itemName . ' a bien été créé, et ajouté à votre liste.';
            }
        }
        shopList($memberId, $message_success, $message_error, 'shop');
    }
    
    function deleteItem($memberId, $itemId) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->pullItem($memberId, $itemId); 
        $message_success =  'Cet article a bien été supprimé.';
        $message_error = "";
        shopList($memberId, $message_success, $message_error, 'shop');
    }
    
    function modifItem($memberId, $itemId, $itemName) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->changeItemName($memberId, $itemId, $itemName);     
        $message_success =  'Votre article a bien été modifié.';
        $message_error = "";
        shopList($memberId, $message_success, $message_error, 'shop');
    }
    
    function checkItem($memberId, $itemId) {
        if ($itemId != '') {
            $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
            $itemNewCheckStatus = $ItemsManager->changeItemCheck($itemId);   
            if ($itemNewCheckStatus == 0) {
                $message_success =  'Cet article a bien été retiré de votre liste.';
            } else if ($itemNewCheckStatus == 1) {
                $message_success =  'Cet article a bien été ajouté dans votre liste.';
            } 
        } else {
            $message_error = 'Désolé cet article n\'existe pas. Crééz le dans le bon rayon.';
        }
        shopList($memberId, $message_success, $message_error, 'shop');
    }
    
    function caddyToList($memberId) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->changeItemsToList($memberId);   
        $message_success =  'Liste sauvegardée, bien joué ' . $_SESSION['first_name'] . '.';
        $message_error = "";
        shopList($memberId, $message_success, $message_error, 'shop');
    }
    
    function caddyToShop($memberId) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->deleteItemsList($memberId);   
        $message_success =  'La liste a bien été remise à zéro ' . $_SESSION['first_name'].'.';
        $message_error = "";
        shopList($memberId, $message_success, $message_error, 'shop');
    }
    
    //**************************************************************************************
    //            Redirection vers listView / Tab "Liste to Caddy"  
    
    function caddyItem($memberId, $itemId) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $itemNewCheckStatus = $ItemsManager->putItemCaddy($itemId);   
        if ($itemNewCheckStatus == 2) {
            $message_success =  '' /*'Cet article a bien été déposé dans votre caddy.'*/ ;
        } else {
            $message_success =  'Nothing was changed';
        }
        $message_error = "";
        shopList($memberId, $message_success, $message_error, 'caddy');
    }
    
    //**************************************************************************************
    //            Controller frontend AislesManager         
    //**************************************************************************************

    function aislesList($memberId, $message_success, $message_error) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $aislesCount2 = $AislesManager->getAislesCount($memberId);
        $aislesTab2 = $AislesManager->getAislesTab($memberId);
        /*
        $iconsListTab = array();
        $iconsListTab = $AislesManager->getIconsListTab($memberId);
        */
        foreach($aislesTab2 as $aisle) {
            $aislesIcons = $AislesManager->getAislesIcons($aisle['aisle_gene_refer_id']);    
            $aislesIconsTab3[] = $aislesIcons;
        }
        $message_success;
        $message_error;
        require('view/frontend/aislesView.php');
    }
    
    function createAisle($memberId, $aisleTitle, $aisleOrder) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->pushAisle($memberId, $aisleTitle, $aisleOrder);     
        $message_success =  'Votre rayon a bien été ajouté à la suite. Vous pouvez désormais le déplacer.';
        $message_error = "";
        aislesList($memberId, $message_success, $message_error);
    }
    
    function deleteAisle($memberId, $aisleId) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->pullAisle($memberId, $aisleId); 
        $message_success =  'Ce rayon a bien été supprimé ainsi que tous les articles rattachés éventuels.';
        $message_error = "";
        aislesList($memberId, $message_success, $message_error);
    }
        
    function modifAisle($memberId, $aisleId, $aisleTitle) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->changeAisleTitle($memberId, $aisleId, $aisleTitle);   
        $message_success =  'Votre rayon a bien été modifié.';
        $message_error = "";
        aislesList($memberId, $message_success, $message_error);
    }
    
    //**************************************************************************************
    //                        Controller frontend LoginManager           
    //**************************************************************************************

    function loginControl($pseudo, $password, $memberExist) {
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
                loginAvailable($pseudo, $dbPassword, $memberExist);
            } else {
                require('view/frontend/loginView.php');
            }
        } else {
            require('view/frontend/loginView.php');
        }
    }

    function loginAvailable($pseudo, $password, $memberExist) {
                    // 1 - Récupération de ses données   
        $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
        $memberData = $loginManager->getMemberData($pseudo, $password);
                    // 2 - Ouverture de session   
        sessionStart($memberData);
                    // 3 - re-direction vers accueil front ou backend
        homePageDirect($memberData['pseudo'], $memberData['group_id'], $memberExist);
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

    function homePageDirect($pseudo, $group, $memberExist) {
        if ($group == 1) {
            header('Location: index.php?action=shopAdmin'); 
        }  
        else {
            if ($memberExist == 0) {
                header('Location: index.php?action=home');
            } else {
                header('Location: index.php?action=shopList');
            }
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
            // Si tout ok on creer le nouveau membre,
            if ($message_error == '') {
                $loginManager = new \FredLab\tp5_caddy_race\Model\LoginManager();
                $loginManager->CreateMember($createName, $createFirstName, $createPseudo, $createMail, $createPassword);
                $getMemberId = $loginManager->getMemberId($createPseudo);
                // on récupère son numéro d'id créée pour affecter ses rayons et articles privés
                $memberId =  $getMemberId['id'];
                // on duplique les rayons Géné dans les rayons Privés avec son id
                $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
                $AislesManager->duplicateAislesGeneDatas($memberId);
                // on duplique les articles Géné dans les articles Privés avec son id
                // et on modifie les ids des rayons de référence dupliqués par les ids des rayons Privés précédemment créés
                $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
                $ItemsManager->duplicateItemsGeneDatas($memberId);
                
                // ensuite on récupère les données des rayons privés,      
                $aislesTab3  = array();                
                $aislesTab3 = $AislesManager->getAislesTab($memberId);
               // et on les passe en boucle pour récupèrer les sous-tableaux d'items rattachés qu'on met à leur tour dans un tableau, (qu'on pourra lister par rayon donc) 
                $itemsInAisleTab3  = array();
                foreach($aislesTab3 as $aisle) {
                    $itemsInAisle = $ItemsManager->getItemsInAisle($memberId, $aisle['aisle_priv_order']);    
                    $itemsInAisleTab3[] = $itemsInAisle;                        
                }
               // puis on vient modifier l'id de base (Gene) du rayon rattaché pour chaque item, par les vraies id des rayons créés
                $aislesCount3 = $AislesManager->getAislesCount($memberId);
                for ($i=0; $i<$aislesCount3['count']; $i++) {     
                    foreach ($itemsInAisleTab3[$i] as $itemInAisle) {
                        $ItemsManager->updateItemAisleId($itemInAisle['id'], $aislesTab3[$i]['id']);
                    }
                }
                // et on démarre sa session
                loginControl($createPseudo, $createPassword, 0);
            } else {
                require('view/frontend/loginView.php'); // retour au login avec affichage des erreurs
            }
        }
    }

    //**************************************************************************************
    //        Controller frontend MemberManager
    //**************************************************************************************
    
    function homeDirect($postId, $message_success, $message_error) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $membersCount2 = $memberManager->getMembersCount();
    // RAJOUT DES COMMENTAIRES 
        $commentsCountBy5 = array(); 
        $commentManager = new \FredLab\tp5_caddy_race\Model\CommentManager();
        $signalComments = $commentManager->getSignalComments();
        $commentManager = new \FredLab\tp5_caddy_race\Model\CommentManager();
        $comments = $commentManager->getComments(1);
        $commentsCount = $commentManager->getCommentsCount(1);
        
        require('view/frontend/homeView.php');      
    }
    
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

     function memberHome($message_success, $message_error, $memberId, $memberDetails) {
        $message_success;
        $message_error;
        $memberDetails;
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $itemsToBuyCount2 = $ItemsManager->getItemsToBuyCount($memberId);
        $itemsInCaddyCount2 = $ItemsManager->getItemsInCaddyCount($memberId);
        require('view/frontend/profilView.php');      
    }
    
    function memberDetail($message_success, $message_error, $memberId, $template) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $memberDetails = $memberManager->getMemberDetail($memberId);
        if ($template != "") {
        membersHome($message_success, $message_error, $memberDetails);            
        } else {
        memberHome($message_success, $message_error, $memberId, $memberDetails);
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
            $message_success =  'Votre compte a bien été supprimé.<br>Désolé de vous voir nous quitter ' . $_SESSION['first_name'] .'...';
            sessionEnd($message_success);
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
    //           Controller CommentManager                   
    //**************************************************************************************
/*
    function post($postId, $message_success, $message_error) {
        $postManager = new \FredLab\tp4_blog_ecrivain\Model\PostManager();
        $postDetails = $postManager->getPost($postId);
        $message_success;
        $message_error;
        $commentManager = new \FredLab\tp4_blog_ecrivain\Model\CommentManager();
        $comments = $commentManager->getComments($postId);
        $commentsCount = $commentManager->getCommentsCount($postId);
        require('view/frontend/postView.php');
    } */
    
    function addCommentRequest($postId, $member, $newComment) {
        $commentManager = new \FredLab\tp5_caddy_race\Model\CommentManager();
        $addCommentRight = $commentManager->getMemberNoComment($member);
        $message_error = "";
        if($addCommentRight['block_comment'] == 1) {
            $message_error =  'Désolé vous n\'êtes pas autorisé à poster des comments';
        } else if($newComment == "") {
            $message_error =  'Désolé votre message est vide';
        } else {
            $commentManager->addComment($postId, $member, $newComment);     
            $message_success =  'Votre commentaire a bien été publié ci-dessous';
        }
        homeDirect(1, $message_success, $message_error);
    }
    
    function modifCommentRequest($postId, $member, $commentId, $modifComment) {
        $commentManager = new \FredLab\tp5_caddy_race\Model\CommentManager();
        $addCommentRight = $commentManager->getMemberNoComment($member);
        $message_error = "";
        if($addCommentRight['block_comment'] == 1) {
            $message_error =  'Désolé vous n\'êtes pas autorisé à poster des comments';
        } else if ($modifComment == "") {
            $message_error =  'Désolé votre message est vide';
        } else {
            $commentManager->replaceComment($commentId, $modifComment);     
            $message_success =  'Votre commentaire a bien été modifié et publié ci-dessous';
        }
        homeDirect(1, $message_success, $message_error);
    }

    function commentSignal($postId, $commentId, $signalId, $member) {
        $commentManager = new \FredLab\tp5_caddy_race\Model\CommentManager();
        $commentManager->signalComment($commentId, $signalId, $member);     
        if ($signalId == 1) {
            $message_error =  'Ce commentaire a bien été signalé à l\'administrateur!';
        } else {
            $message_success =  'Ce commentaire ne sera plus signalé à l\'administrateur!';
        }
        homeDirect(1, $message_success, $message_error);
    }
    
    function commentErase($postId, $commentId) {
        $commentManager = new \FredLab\tp5_caddy_race\Model\CommentManager();
        $commentManager->deleteComment($commentId); 
        if ($postId != "") {
            $message_success =  'Ce commentaire a bien été Supprimé !';
            homeDirect(1, $message_success, "");
        } else {
            $message_success =  'Ce commentaire a bien été Supprimé !';
            listPosts(1, $message_success, "");
        }
    }

    //**************************************************************************************
    //                       Controller frontend Deconnexion       
    //**************************************************************************************

    function sessionEnd($message) {
        if ($message == "") {
        $message_success = 'A très bientôt sur CaddyRace' . '<br> ' . $_SESSION['first_name'];
        } else {
            $message_success = $message;
        }
        $_SESSION = array(); // Suppression des variables de session 
        session_destroy();
        setcookie('pseudo', '');
        setcookie('password', '');
        $_COOKIE = array(); // Suppression des cookies de connexion automatique
    
        require('view/frontend/exitView.php');
    }

//**************************************************************************************
//                   Redirection des erreurs vers page errorView             
//**************************************************************************************

} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
