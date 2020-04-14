<?php 
  
namespace FredLab\tp5_caddy_race\Model;

require_once("model/Manager.php");

class ItemsManager extends Manager {

//**************************************************************************************
//         ItemsManager backend           
//**************************************************************************************

    public function getItemsGeneCountInAisle($aisleGeneId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(id) AS count FROM items WHERE aisle_gene_id = ?');
        $req->execute(array($aisleGeneId));
        $itemsGeneCountInAisle = $req->fetch();
        $req->closeCursor();
        return $itemsGeneCountInAisle;
    }
    
    public function getItemsGeneInAisle($aisleGeneId) {
        $db = $this->dbConnect();
        $itemsGeneInAisle = $db->prepare('SELECT * FROM items WHERE aisle_gene_id = ? ORDER BY item_gene_name');
        $itemsGeneInAisle->execute(array($aisleGeneId));
        return $itemsGeneInAisle;
    }
    
    public function pushItemGene($aisleGeneId, $itemGeneName) {            
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO items(aisle_gene_id, item_gene_name) VALUES(:aisle_gene_id, :item_gene_name)');
        $req->execute(array(
            'aisle_gene_id' => $aisleGeneId,
            'item_gene_name' => $itemGeneName
        ));
        $req->closeCursor();
    }
    
    public function pullItemGene($itemGeneId) {  
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM items WHERE id = ?');
        $req->execute(array($itemGeneId)); 
        $req->closeCursor();
    }
    
    public function changeItemGeneName($itemGeneId, $itemGeneName) {            
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE items SET item_gene_name = :item_gene_name WHERE id = :id');
        $req->execute(array(
            'item_gene_name' => $itemGeneName,
            'id' => $itemGeneId
        ));
        $req->closeCursor();
    }
    
    //**************************************************************************************
    //         ItemsManager frontend           
    //**************************************************************************************
    
    public function duplicateItemsGeneDatas($memberId) {            
        // copie la table Générale dans la table des articles Privés,
        $db = $this->dbConnect(); 
        $req = $db->query('INSERT INTO items_priv(aisle_priv_id, item_priv_name, item_priv_owner_id) SELECT aisle_gene_id, item_gene_name, item_gene_owner_id FROM items');
        $req->closeCursor(); 
        // puis remplace l'id admin "1" copiée, par celle du nouveau membre propriétaire.
        $req = $db->prepare('UPDATE items_priv SET item_priv_owner_id = ? WHERE item_priv_owner_id = 1');
        $req->execute(array($memberId));
        $req->closeCursor();
        // et on modifie les ids des rayons de référence dupliqués par les ids des rayons Privés précédemment créés
      /*  $changeItemAisleGene = $db->query('UPDATE i SET i.aisle_priv_id = a.id FROM items_priv AS i INNER JOIN aisles AS a ON i.aisle_priv_id = a.aisle_gene_refer_id'); */
        // si ça ne marche pas faire d'abord INNER JOIN puis le UPDATE de la fonction changeItemAisleGene ci-dessous avec le [] récupéré (voir MemberManager)
    }
    
    /* public function changeItemAisleGene($aisleId2, $aisleId1) {            
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE items_priv SET aisle_priv_id = :aisle_priv_id2 WHERE aisle_priv_id = :aisle_priv_id1');
        $req->execute(array(
            'aisle_priv_id2' => $aisleId2,
            'aisle_priv_id1' => $aisleId1
        ));
        $req->closeCursor();
    } */
    
    public function getItemsCountInAisle($memberId, $aisleId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(id) AS count FROM items_priv WHERE item_priv_owner_id = :member_id AND aisle_priv_id = :aisle_priv_id');
        $req->execute(array(
            'member_id' => $memberId,
            'aisle_priv_id' => $aisleId
        ));
        $itemsCountInAisle = $req->fetch();
        $req->closeCursor();
        return $itemsCountInAisle;
    }

    public function getItemsInAisle($memberId, $aisleId) {
        $db = $this->dbConnect();
        $itemsInAisle = $db->prepare('SELECT * FROM items_priv WHERE item_priv_owner_id = :member_id AND aisle_priv_id = :aisle_priv_id ORDER BY item_priv_name');
        $itemsInAisle->execute(array(
            'member_id' => $memberId,
            'aisle_priv_id' => $aisleId
        ));
        return $itemsInAisle;
    }
    
    public function pushItem($memberId, $aisleId, $itemName) {            
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO items_priv(aisle_priv_id, item_priv_name, item_priv_owner_id) VALUES(:aisle_priv_id, :item_priv_name, :member_id)');
        $req->execute(array(
            'aisle_priv_id' => $aisleId,
            'item_priv_name' => $itemName,
            'member_id' => $memberId
        ));
        $req->closeCursor();
    }
    
    public function pullItem($memberId, $itemId) {  
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM items_priv WHERE item_priv_owner_id = :member_id AND id = :item_id');
        $req->execute(array(
            'member_id' => $memberId,
            'item_id' => $itemId
        )); 
        $req->closeCursor();
    }
    
    public function changeItemName($memberId, $itemId, $itemName) {            
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE items_priv SET item_priv_name = :item_priv_name WHERE item_priv_owner_id = :member_id AND id = :item_id');
        $req->execute(array(
            'item_priv_name' => $itemName,
            'member_id' => $memberId,
            'item_id' => $itemId
        ));
        $req->closeCursor();
    }
    
}
