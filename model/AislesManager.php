<?php 
  
namespace FredLab\tp5_caddy_race\Model;

require_once("model/Manager.php");

class AislesManager extends Manager {
    
    //**************************************************************************************
    //     AislesManager backend  
    //**************************************************************************************

    public function getAislesGeneCount() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) AS count FROM aisles');
        $aislesGeneCount = $req->fetch();
        $req->closeCursor();
        return $aislesGeneCount;
    }

    public function getAislesGeneTab() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM aisles ORDER BY aisle_gene_order');
        $aislesGeneTab = array(); 
        while ($aisleGene = $req->fetch()) {
            $aislesGeneTab[] = $aisleGene;
        }
        $req->closeCursor();
        return $aislesGeneTab;
    }
    
    public function getAislesGeneIcons($aisleGeneId) {
        $db = $this->dbConnect();
        $aislesGeneIcons = $db->prepare('SELECT icon_adress FROM icons WHERE aile_gene_id = ? ORDER BY icon_class');    
        $aislesGeneIcons->execute(array($aisleGeneId));
        return $aislesGeneIcons;
    }
    
        /* (Traité en AJAX) 
    public function changeAislesGeneOrder($aisleGeneId, $aisleGeneOrder) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE aisles SET aisle_gene_order = :aisleNewOrder WHERE id = :aisleId');    
        $req->execute(array($aisleGeneId));
        $req->execute(array(
            'aisleNewOrder' => $aisleGeneOrder,
            'aisleId' => $aisleGeneId
        ));
        $req->closeCursor();
    } */
    
    public function pushAisleGene($aisleGeneTitle, $aisleGeneOrder) {            
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO aisles(aisle_gene_title, aisle_gene_order) VALUES(:aisle_gene_title, :aisle_gene_order)');
        $req->execute(array(
            'aisle_gene_title' => $aisleGeneTitle,
            'aisle_gene_order' => $aisleGeneOrder
        ));
        $req->closeCursor();
    }
        
    public function pullAisleGene($aisleGeneId) {  
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM aisles WHERE id = ?');
        $req->execute(array($aisleGeneId)); 
        $req->closeCursor();
    }
    
    public function changeAisleGeneTitle($aisleGeneId, $aisleGeneTitle) {            
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE aisles SET aisle_gene_title = :aisle_gene_title WHERE id = :id');
        $req->execute(array(
            'aisle_gene_title' => $aisleGeneTitle,
            'id' => $aisleGeneId
        ));
        $req->closeCursor();
    }
    
    //**************************************************************************************
    //     AislesManager frontend  
    //**************************************************************************************

    /* public function duplicateAislesGene() { // option création d'une table privée par membre           
        $db = $this->dbConnect();
        $req = $db->query('CREATE TABLE aisles_1 LIKE aisles');
        $req->closeCursor();
        $req = $db->query('INSERT INTO aisles_1 SELECT * FROM aisles');
        $req->closeCursor();
    } */
    
    public function duplicateAislesGeneDatas($memberId) {            
        $db = $this->dbConnect(); // copie la table Générale dans la table des rayons Privés,
        $req = $db->query('INSERT INTO aisles_priv(aisle_priv_title, aisle_priv_owner_id, aisle_priv_order, aisle_gene_refer_id) SELECT aisle_gene_title, aisle_gene_owner_id, aisle_gene_order, id FROM aisles');
        $req->closeCursor(); // puis remplace l'id admin "1" copiée, par celle du nouveau membre propriétaire.
        $req = $db->prepare('UPDATE aisles_priv SET aisle_priv_owner_id = ? WHERE aisle_priv_owner_id = 1');
        $req->execute(array($memberId));
        $req->closeCursor();
    }
    
    public function getAislesCount($memberId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(id) AS count FROM aisles_priv WHERE aisle_priv_owner_id = ?');
        $req->execute(array($memberId));
        $aislesCount = $req->fetch();
        $req->closeCursor();
        return $aislesCount;
    }
    
    public function getAislesTab($memberId) {
        $db = $this->dbConnect();
        $getAislesTab = $db->prepare('SELECT * FROM aisles_priv WHERE aisle_priv_owner_id = ? ORDER BY aisle_priv_order');
        $getAislesTab->execute(array($memberId)); 
        $aislesTab = array(); 
        while ($aisle = $getAislesTab->fetch()) {
            $aislesTab[] = $aisle;
        }
        return $aislesTab;
    }
    
    public function getAislesIcons($aisleId) {
        $db = $this->dbConnect();
        $aislesIcons = $db->prepare('SELECT icon_adress FROM icons WHERE aile_gene_id = ? ORDER BY icon_class');    
        $aislesIcons->execute(array($aisleId));
        return $aislesIcons;
    }
    
    public function pushAisle($memberId, $aisleTitle, $aisleOrder) {            
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO aisles_priv(aisle_priv_owner_id, aisle_priv_title, aisle_priv_order) VALUES(:member_id, :aisle_priv_title, :aisle_priv_order)');
        $req->execute(array(
            'member_id' => $memberId,
            'aisle_priv_title' => $aisleTitle,
            'aisle_priv_order' => $aisleOrder
        ));
        $req->closeCursor();
    }
        
    public function pullAisle($memberId, $aisleId) {  
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM aisles_priv WHERE aisle_priv_owner_id = :member_id AND id = :item_id');
        $req->execute(array(
            'member_id' => $memberId,
            'item_id' => $aisleId
        )); 
        $req->closeCursor();
    }
    
    public function changeAisleTitle($memberId, $aisleId, $aisleTitle) {            
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE aisles_priv SET aisle_priv_title = :aisle_priv_title WHERE aisle_priv_owner_id = :member_id AND id = :aisle_id');
        $req->execute(array(
            'aisle_priv_title' => $aisleTitle,
            'member_id' => $memberId,            
            'aisle_id' => $aisleId
        ));
        $req->closeCursor();
    }
    
}
