<?php

require_once('model/ItemsManager.php');
require_once('model/MemberManager.php');
require_once('model/AislesManager.php');

try {
    
    //**************************************************************************************
    //            Items Admin Manager          
    //**************************************************************************************

    function shopAdmin($message_success, $message_error) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $aislesGeneCount = $AislesManager->getAislesGeneCount();
        $aislesGeneTab = $AislesManager->getAislesGeneTab();
        $itemsGeneCountInAisleTab = array();
        $itemsGeneInAisleTab  = array();
        $aislesGeneIconsTab  = array();
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        foreach($aislesGeneTab as $aisleGene) {
            $itemsGeneCountInAisle = $ItemsManager->getItemsGeneCountInAisle($aisleGene['id']);  
            $itemsGeneCountInAisleTab[] = $itemsGeneCountInAisle;
            $itemsGeneInAisle = $ItemsManager->getItemsGeneInAisle($aisleGene['id']);    
            $itemsGeneInAisleTab[] = $itemsGeneInAisle;
            $aislesGeneIcons = $AislesManager->getAislesGeneIcons($aisleGene['id']);    
            $aislesGeneIconsTab[] = $aislesGeneIcons;
        }
        $message_success;
        $message_error;
        require('view/backend/shopView.php');
    }
    
    function createItemGene($aisleGeneId, $itemGeneName) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->pushItemGene($aisleGeneId, $itemGeneName);     
        $message_success =  'Votre article a bien été ajouté dans ce rayon.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    }
    
    function deleteItemGene($itemGeneId) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->pullItemGene($itemGeneId); 
        $message_success =  'Cet article a bien été supprimé.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    }
    
    function modifItemGene($itemGeneId, $itemGeneName) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->changeItemGeneName($itemGeneId, $itemGeneName);     
        $message_success =  'Votre article a bien été modifié.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    }
    
    function orderAisleGene($aisleGeneId, $aisleGeneOrder) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->changeAislesGeneOrder($aisleGeneId, $aisleGeneOrder);     
        $message_success =  'Votre rayon a bien été déplacé.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    }

//**************************************************************************************
    
    //**************************************************************************************
    // Controller backend AislesManager (+backend ItemsManager) (+Controller frontend AislesManager)          
    //**************************************************************************************

    function postExtract($text) {
        $max=200;
        if (strlen($text) > $max) { // vérifie que texte plus long que max extrait
            // récupère 1er espace après $max pour éviter de couper un mot en plein milieu
            $space = strpos($text,' ',$max);
            //récupère l'extrait jusqu'à l'espace préalablement cherché auquel on ajoute "..."
            $postExtract = substr($text,0,$space).'...';
        } else {
            $postExtract = $text;
        }
        return $postExtract;
    }

    function newPost($postTitle, $postContentHTML, $postContentText, $postBefore) {
        if ($postTitle == "" || $postContentHTML == "") {
            $message_error =  'Erreur : Veuillez renseigner tous les champs';
            listPosts(1, $message_success, $message_error);
        } else {
            $postExtract = postExtract($postContentText);
            $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
            if(!empty($postBefore)) {
                $AislesManager->addPost($postTitle, $postContentHTML, $postExtract, $postBefore); 
            } else {
                $AislesManager->addPost($postTitle, $postContentHTML, $postExtract, "");     
            }
            $message_success =  'Votre billet "' . $postTitle . '" a bien été publié !';
            listPosts(1, $message_success, "");
        }
    }
    
    function modifPost($postId, $newPostTitle, $newPostContentHTML, $newPostContentText) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->changePostTitle($postId, $newPostTitle);
        $postExtract = postExtract($newPostContentText);
        $AislesManager->changePostContent($postId, $newPostContentHTML, $postExtract);
        $message_success =  'L\'épisode a bien été modifié ci-dessous !';
        post($postId, $message_success, "");        
    }

    function postErase($postId) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->deletePost($postId);     
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->deleteComments($postId);     
        $message_success =  'Ce billet et ses commentaires ont bien été supprimés !';
        listPosts(1, $message_success, "");
    }

    function commentSignal($postId, $commentId, $signalId, $member) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $ItemsManager->signalComment($commentId, $signalId, $member);     
        if ($signalId == 1) {
            $message_error =  'Ce commentaire a bien été signalé à l\'administrateur!';
        } else {
            $message_success =  'Ce commentaire ne sera plus signalé à l\'administrateur!';
        }
        post($postId, $message_success, $message_error);
    }

    //**************************************************************************************
    //         Controller backend MemberManager (+Controller frontend AislesManager)              
    //**************************************************************************************

    function memberBloqComment($memberId, $blockId, $template) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $memberManager->changeMemberNoComment($memberId, $blockId);
        if ($blockId == 1) {
            $message_success =  'Le membre a bien été bloqué et ne pourra plus commenter !';
        } else {
            $message_success =  'Le membre a bien été débloqué et pourra de nouveau commenter !';
        }
        memberDetail($message_success, "", $memberId, $template);
    }

    //**************************************************************************************
    //         Controller backend MemberManager (+Controller frontend AislesManager)              
    //**************************************************************************************

    function memberModerator($memberId, $moderatorId, $template) {
        $memberManager = new \FredLab\tp5_caddy_race\Model\MemberManager();
        $memberManager->changeMemberGroup($memberId, $moderatorId);
        if ($moderatorId == 2) {
            $message_success =  'Ce membre a bien été passé en modérateur !';
        } else {
            $message_success =  'Ce membre n\'aura plus le statut de modérateur !';
        }
        memberDetail($message_success, "", $memberId, $template);
    }

//**************************************************************************************
//                   Redirection des erreurs vers page errorView             
//**************************************************************************************

} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
