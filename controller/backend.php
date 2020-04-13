<?php

require_once('model/AislesManager.php');
require_once('model/ItemsManager.php');
require_once('model/LoginManager.php');
require_once('model/MemberManager.php');

try {
    
    //**************************************************************************************
    //            Controller backend ItemsManager         
    //**************************************************************************************

    function shopAdmin($message_success, $message_error) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $aislesGeneCount = $AislesManager->getAislesGeneCount();
        $aislesGeneTab = $AislesManager->getAislesGeneTab();
        $itemsGeneCountInAisleTab = array();
        $itemsGeneInAisleTab  = array();
        $aislesGeneIconsTab  = array();
        $aislesGeneIconsTab2  = array();
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        foreach($aislesGeneTab as $aisleGene) {
            $itemsGeneCountInAisle = $ItemsManager->getItemsGeneCountInAisle($aisleGene['id']);  
            $itemsGeneCountInAisleTab[] = $itemsGeneCountInAisle;
            $itemsGeneInAisle = $ItemsManager->getItemsGeneInAisle($aisleGene['id']);    
            $itemsGeneInAisleTab[] = $itemsGeneInAisle;
            $aislesGeneIcons = $AislesManager->getAislesGeneIcons($aisleGene['id']);    
            $aislesGeneIconsTab[] = $aislesGeneIcons;
            $aislesGeneIcons = $AislesManager->getAislesGeneIcons($aisleGene['id']);    
            $aislesGeneIconsTab2[] = $aislesGeneIcons;
        }
        $message_success;
        $message_error;
        require('view/backend/shopView.php');
    }
    
    function createItemGene($aisleGeneId, $itemGeneName) {
        $ItemsManager = new \FredLab\tp5_caddy_race\Model\ItemsManager();
        $message_error = "";
        if($itemGeneName == "") {
            $message_error =  'Désolé votre nouvel article est vide';
        } else {
            $ItemsManager->pushItemGene($aisleGeneId, $itemGeneName);     
            $message_success =  'Votre article a bien été ajouté dans ce rayon.';
        }
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
    
    //**************************************************************************************
    //            Controller backend AislesManager         
    //**************************************************************************************
    
    /* (Traité en AJAX) 
    function orderAisleGene($aisleGeneId, $aisleGeneOrder) { 
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->changeAislesGeneOrder($aisleGeneId, $aisleGeneOrder);     
        $message_success =  'Votre rayon a bien été déplacé.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    } */

    function createAisleGene($aisleGeneTitle, $aisleGeneOrder) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->pushAisleGene($aisleGeneTitle, $aisleGeneOrder);     
        $message_success =  'Votre rayon a bien été ajouté à la suite. Vous pouvez désormais le déplacer.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    }
    
    function deleteAisleGene($aisleGeneId) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->pullAisleGene($aisleGeneId); 
        $message_success =  'Ce rayon a bien été supprimé.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    }
        
    function modifAisleGene($aisleGeneId, $aisleGeneTitle) {
        $AislesManager = new \FredLab\tp5_caddy_race\Model\AislesManager();
        $AislesManager->changeAisleGeneTitle($aisleGeneId, $aisleGeneTitle);   
        $message_success =  'Votre article a bien été modifié.';
        $message_error = "";
        shopAdmin($message_success, $message_error);
    }
    
    //**************************************************************************************
    //         Controller backend MemberManager          
    //**************************************************************************************

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
