<?php
session_start();
require('controller/frontend.php');
require('controller/backend.php');

try {

    //**************************************************************************************
    //**************************************************************************************
    // Si présence d'une action GET dans l'URL ?             
    //**************************************************************************************
    //**************************************************************************************

    if (isset($_GET['action'])) {
        
        //**************************************************************************************
        // Redirections autorisées sans ouverture de session:
        //**************************************************************************************
        
        //**************************************************************************************
        // => homeView (Démo/Avis/Connect)           

        if ($_GET['action'] == 'home') {
            require('view/frontend/homeView.php');
        }

        //**************************************************************************************
        // => loginView (Log In/ New member)                        
       
        // Log In membre
        else if ($_GET['action'] == 'login') {
            $pseudo_connect = getCleanParameter($_POST['pseudo_connect']);
            $password_connect = getCleanParameter($_POST['password_connect']);
            if (!empty($pseudo_connect) && !empty($password_connect)) {
                loginControl($pseudo_connect, $password_connect);
            } else { 
                loginControl("","");
            }
        } 

        // Nouveau membre
        else if ($_GET['action'] == 'newMember') {
            $name = getCleanParameter($_POST['name']);
            $first_name = getCleanParameter($_POST['first_name']);
            $pseudo = getCleanParameter($_POST['pseudo']);
            $email = getCleanParameter($_POST['email']);
            $email_confirm = getCleanParameter($_POST['email_confirm']);
            $password = getCleanParameter($_POST['password']);
            $password_confirm = getCleanParameter($_POST['password_confirm']);
            if(!empty($name) && !empty($first_name) && !empty($pseudo) && !empty($email) && !empty($email_confirm) && !empty($password) && !empty($password_confirm)) {
                newMember($name, $first_name, $pseudo, $email, $email_confirm, $password, $password_confirm);
            } else {
                newMember("","","","","","","","");
            }
        } 
        
        //**************************************************************************************
        // Redirections autorisées uniquement après ouverture de session (ci-dessus)             
        //**************************************************************************************

        else if (!empty($_SESSION['pseudo']) && !empty($_SESSION['password'])) {
            
            //**************************************************************************************
            // => listView(frontend) Interface de Gestion des tables Persos d'Articles & Rayons
           
                // Trier sa liste
                if ($_POST['sortList']) {
                    // par Alphabet:
                    if ($_POST['alphab']) {
                        sortListABC(); // TODO selon controller/model
                    }   // par Rayons du shop :
                    else if ($_POST['shop']) {
                        sortListShop(1,"",""); // TODO selon controller/model
                    } 
                    else {
                        throw new Exception('Identifiant de classement vide ou erronné');
                    }
                } 
                // Ajouter un article existant à sa liste     
                else if ($_GET['action'] == 'addItem') {
                    if (isset($_GET['itemId']) && $_GET['itemId'] > 0) {
                        $itemId = getCleanParameter($_GET['itemId']);
                        addItem($itemId); // TODO selon controller/model
                    }
                    else {
                        throw new Exception('Identifiant d\'item vide ou erronné');
                    }
                }
                
                // Moifier un de ses articles (Nom, et Rayon d'affectation)    
                else if ($_GET['action'] == 'item') {
                    if (isset($_GET['itemId']) && $_GET['itemId'] > 0) {
                        $itemId = getCleanParameter($_GET['itemId']);
                        
                        // Créer un nouvel article Perso   
                        if ($_GET['action'] == 'createItem') {
                            $itemName = getCleanParameter($_POST['itemName']);
                            $aisleId = getCleanParameter($_POST['aisleId']);
                            createItem($aisleId, $itemName); // TODO selon controller/model
                        }
                        // Modifier un de ses articles 
                        else if ($_GET['action'] == 'itemModif') {  
                            $itemName = getCleanParameter($_POST['itemName']);
                            modifItem($itemId, $itemName); // TODO selon controller/model
                        } 
                        // Supprimer un de ses articles,   
                        else if ($_GET['action'] == 'itemDelete') {
                            itemErase($itemId); // TODO selon controller/model
                        }
                        // Afficher sa liste en cours (par défaut)
                        else {
                            item($itemId, "", ""); // TODO selon controller/model
                        }
                    } 
                    else {
                        throw new Exception('Identifiant d\'item vide ou erronné');
                    }
                }
                 
            
            //**************************************************************************************
            // => shopView(backend) Interface de Gestion des tables Générales Communes d'Articles & Rayons
                
                // Afficher la shopView
               else if ($_GET['action'] == 'shopAdmin') {
                    shopDetail(1, "", ""); // TODO selon controller/model
                }
            
                // Créer un nouvel article Gene   
               else if ($_GET['action'] == 'createItemGene') {
                    $itemGeneName = getCleanParameter($_POST['itemGeneName']);
                    $aisleGeneId = getCleanParameter($_POST['aisleGeneId']);
                    createItemGene($aisleGeneId, $itemGeneName); // TODO selon controller/model
                }

                // Modifier un article   
                else if ($_GET['action'] == 'itemGeneModif') {  
                    $itemGeneName = getCleanParameter($_POST['itemGeneName']);
                    modifItemGene($itemGeneId, $itemGeneName); // TODO selon controller/model
                } 
                // Créer un nouveau article   
                else if ($_GET['action'] == 'createItemGene') {
                    $itemGeneName = getCleanParameter($_POST['itemGeneName']);
                    $aisleGeneId = getCleanParameter($_POST['aisleGeneId']);
                    newItemGene($itemGeneName, $aisleGeneId); // TODO selon controller/model
                }
                // Supprimer un article,   
                else if ($_GET['action'] == 'itemGeneDelete') {
                    itemGeneErase($itemGeneId); // TODO selon controller/model
                }
                // Modifier un rayon   
                else if ($_GET['action'] == 'aisleGeneModif') {  
                    $aisleGeneTitle = getCleanParameter($_POST['aisleGeneTitle']);
                    modifAisleGene($aisleGeneId, $aisleGeneTitle); // TODO selon controller/model
                } 
                // Créer un nouveau rayon   
                else if ($_GET['action'] == 'createAisleGene') {
                    $aisleGeneTitle = getCleanParameter($_POST['aisleGeneTitle']);
                    $aisleGeneOrder = getCleanParameter($_POST['aisleGeneOrder']);
                    newAisleGene($aisleGeneTitle, $aisleGeneOrder); // TODO selon controller/model
                }
                // Supprimer un rayon,   
                else if ($_GET['action'] == 'aisleGeneDelete') {
                    aisleGeneErase($aisleGeneId); // TODO selon controller/model
                }
 
            
            //**************************************************************************************
            // => profilView(frontend) / => membersView(backend)         
           
            // => membersView(backend) Editer le profil d'un membre
            else if ($_GET['action'] == 'membersDetail') {
                $member = getCleanParameter($_POST['member']);
                if (isset($member)) {
                    if (!empty($member)) {
                        memberDetail("", "", $member, 'backend');
                    } else {
                        memberDetail("",  'Veuillez sélectionner un membre', "", 'backend');
                    }
                } else {
                    memberDetail("", "", "", 'backend');
                }
             }

            // => profilView(frontend) Editer son propre profil (frontend)   
            else if ($_GET['action'] == 'memberDetail') {
                memberDetail("", "", $_SESSION['id'], "");
            }

            // Modifier un profil
            else if ($_GET['action'] == 'memberModif') {  

                // => membersView(backend) dun membre
                if ($_POST['member_modif']) {
                    $member_modif = getCleanParameter($_POST['member_modif']);
                    if(isset($_POST['block_comment'])) { // Interdir/autoriser de commenter 
                        $block_comment = getCleanParameter($_POST['block_comment']);
                        memberBloqComment($member_modif, $block_comment, 'backend');   
                    } else if(isset($_POST['moderator'])) { // Interdir/autoriser à être modérateur 
                        $moderator = getCleanParameter($_POST['moderator']);                       
                        memberModerator($member_modif, $moderator, 'backend');   
                    } else {
                        memberDetail("",  'Veuillez sélectionner une action', "", 'backend');
                    }

                // => profilView(frontend) le siens  
                } else if ($_POST['personal_modif']) { 
                    $personal_modif = $_POST['personal_modif'];
                    $champ = getCleanParameter($_POST['champ']);
                    $modif_champ = getCleanParameter($_POST['modif_champ']);
                    $modif_champ_confirm = getCleanParameter($_POST['modif_champ_confirm']);
                    if(!empty($champ) && !empty($modif_champ) && !empty($modif_champ_confirm)) {
                        if ($champ == 1) { // Modification du mail
                            newMail($personal_modif, $modif_champ, $modif_champ_confirm);
                        } else if ($champ == 2) { // Modification du mot de passe     
                            newPassword($personal_modif, $modif_champ, $modif_champ_confirm);
                        }
                    } else if(empty($champ) && empty($modif_champ) && empty($modif_champ_confirm)) {
                            memberDetail("",  'Veuillez sélectionner un champ et une action', $_SESSION['id'], "");
                    } else if (empty($champ)) {
                            memberDetail("",  'Veuillez selectionner un champ', $_SESSION['id'], "");
                    } else if (empty($modif_champ)) {
                            memberDetail("",  'Veuillez rentrer une nouvelle valeure au champ', $_SESSION['id'], "");
                    } else if (empty($modif_champ_confirm)) {
                            memberDetail("",  'Veuillez confirmer cette nouvelle valeure', $_SESSION['id'], "");
                    } 
                }
            }

            // => profilView(frontend) Supprimer son profil
            else if ($_GET['action'] == 'memberDelete') {
                if ($_GET['memberErase']) {
                    $memberErase = getCleanParameter($_GET['memberErase']);
                    memberDelete($memberErase, 'backend');
                } else {
                    throw new Exception('Aucun membre selectionné');
                }
            }

            //**************************************************************************************
            // => contactView (Envoyer une demande à l'admin)           

            else if ($_GET['action'] == 'contact') { // TODO A remplacer par pop-up ci-dessous !
                require('view/frontend/contactView.php');
            }  
            
            //**************************************************************************************
            // => depuis toutes les vues (Donner avis site)

            // Publier un avis à propos du site/Appli     
            else if ($_GET['action'] == 'addOpinion') {
                $newOpinion = getCleanParameter($_POST['newOpinion']);
                addOpinionRequest($_SESSION['pseudo'], $newOpinion); // TODO selon controller/model
            }

            // Modifier un avis (self)          
            else if ($_GET['action'] == 'modifOpinion') {
                $modifOpinionId = getCleanParameter($_POST['modifOpinionId']);
                $modifOpinion = getCleanParameter($_POST['modifOpinion']);
                if (modifOpinionId) {
                    modifOpinionRequest($_SESSION['pseudo'], $modifOpinionId, $modifOpinion); // TODO selon controller/model
                } else {
                    throw new Exception('Identifiant d\'avis vide ou erronné');
                }
            }

            // Signaler un avis (all)   
            else if ($_GET['action'] == 'signalOpinion') {
                $signalOpinion = getCleanParameter($_POST['signalOpinion']);
                $signalOpinionId = getCleanParameter($_POST['signalOpinionId']);
               if ($signalOpinionId) {
                    commentSignal($signalOpinion, $signalOpinionId, $_SESSION['pseudo']);// TODO selon controller/model
                } else {
                    throw new Exception('Identifiant d\'avis à signaler vide ou erronné');
                }
            }

            // Effacer un avis (self or admin/moderator)     
            else if ($_GET['action'] == 'deleteOpinion') {
                $deleteOpinionId = getCleanParameter($_POST['deleteOpinionId']);
                if ($deleteOpinionId) {
                    opinionErase($deleteOpinionId); // TODO selon controller/model 
                } else {
                    throw new Exception('Identifiant d\'avis à supprimer vide ou erronné');
                }
            }
            
            //**************************************************************************************
            // => exitView (Deconnexion (javascript))          
           
            else if ($_GET['action'] == 'deconnexion') {
                sessionEnd();
            } 
            
            //**************************************************************************************
            // => Afficher Accueil du site (par défaut):
            else {
                listDetail("",""); // TODO selon controller/model
            } 
            
        //**************************************************************************************
        // Si action url sans connexion préalable            
        //**************************************************************************************

        } else {
            require('view/frontend/loginView.php');
        }
        
    }

    //**************************************************************************************
    //**************************************************************************************
    // Sinon si le routeur ne recoit aucune action dans l'URL (entrée sur site)             
    //**************************************************************************************
    //**************************************************************************************

            // Soit on récupère un cookie autorisé d'un précédent login_ok,    
    else if ($_COOKIE['password']) {
        $pseudo = getCleanParameter($_COOKIE['pseudo']);
        $password = getCleanParameter($_COOKIE['password']);
        loginAvailable($pseudo, $password);
    }
            // Soit on dirige vers la page d'accueil en libre accés, 
    else {
        header('Location: index.php?action=home'); 
    }

//**************************************************************************************
//**************************************************************************************
//**************************************************************************************
// Redirection des erreurs vers page errorView             
//**************************************************************************************
//**************************************************************************************
//**************************************************************************************

} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}

//**************************************************************************************
//**************************************************************************************
//**************************************************************************************
// Fonction d'évitement de la faille XSS             
//**************************************************************************************
//**************************************************************************************
//**************************************************************************************

function getCleanParameter($parameter){
    $trimmedParameter = trim($parameter);
    $cleanedParameter = nl2br(htmlspecialchars($trimmedParameter));
    return $cleanedParameter;
}
