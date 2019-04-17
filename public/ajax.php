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

?>
