<?php

    // on se connecte à notre base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=caddyrace', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    // On analyse la variable POST action (qui permet éventuellement de gérer plusieurs scripts de mise à jour)

    //**************************************************************************************
    // => Backend: shopView/Rayons jQuery - Sortable orderAisleGene      
    //**************************************************************************************
    if ($_GET['action'] == 'orderAisleGene') {
        $i = 1;
        foreach($_POST['aisleId'] as $aisleId) {
            $req = $bdd->prepare('UPDATE aisles SET aisle_gene_order = :aisleNewOrder WHERE id = :aisleId'); 
            $req->execute(array(
                'aisleId' => $aisleId,
                'aisleNewOrder' =>$i
            ));
            $req->closeCursor();
            $i++;
        };
    }

    //**************************************************************************************
    // => Frontend: listView/Rayons jQuery - Sortable orderAisle       
    //**************************************************************************************
    if ($_GET['action'] == 'orderAisle') {
        $i = 1;
        foreach($_POST['aisleId'] as $aisleId) {
            $req = $bdd->prepare('UPDATE aisles_priv SET aisle_priv_order = :aisleNewOrder WHERE id = :aisleId'); 
            $req->execute(array(
                'aisleId' => $aisleId,
                'aisleNewOrder' =>$i
            ));
            $req->closeCursor();
            $i++;
        };
    }

    //**************************************************************************************
    // => Frontend: listView/Articles jQuery - Mise en panier itemToBuy        
    //**************************************************************************************
    function changeItemCheckAjax($itemId) { 
        $bdd = new PDO('mysql:host=localhost;dbname=caddyrace', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $req = $bdd->prepare('SELECT item_priv_purchase FROM items_priv WHERE id = ?');
        $req->execute(array($itemId)); 
        $itemCheckStatus = $req->fetch();
        $req->closeCursor();
        if (($itemCheckStatus['item_priv_purchase'] == 0) || ($itemCheckStatus['item_priv_purchase'] == 2)) {
            $itemNewCheckStatus = 1;
        } else {
            $itemNewCheckStatus = 0;
        }
        $req = $bdd->prepare('UPDATE items_priv SET item_priv_purchase = :change_check WHERE id = :item_id');
        $req->execute(array(
            'change_check' => $itemNewCheckStatus,
            'item_id' => $itemId
        )); 
        $req->closeCursor();

    }

    if (isset($_POST['myFunction']) && $_POST['myFunction'] != '') {
        $_POST['myFunction']($_POST['myParams']);
    }
?>
