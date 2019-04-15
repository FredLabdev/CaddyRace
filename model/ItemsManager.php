<?php 
  
namespace FredLab\tp5_caddy_race\Model;

require_once("model/Manager.php");

class ItemsManager extends Manager { // se situe dans le namespace

//**************************************************************************************
//                                Model ItemsManager           
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
    
    public function getMemberNoComment($member) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT block_comment FROM members WHERE pseudo = ?');
        $req->execute(array($member));
        $addCommentRight = $req->fetch();
        $req->closeCursor();
        return $addCommentRight;
    }
    
    public function signalComment($commentId, $signalId, $member) {  
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment_signal = :comment_signal, signal_author = :member, signal_date = NOW() WHERE id = :commentId');
        $req->execute(array(
            'comment_signal' => $signalId,
            'member' => $member,
            'commentId' => $commentId
        ));  
        $req->closeCursor();
    }
    
    public function getSignalComments() {
        $db = $this->dbConnect();
        $getSignalComments = $db->query('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\')comment_date_fr, signal_author, DATE_FORMAT(signal_date, \'%d/%m/%Y à %Hh%imin\')signal_date_fr FROM comments WHERE comment_signal = 1 ORDER BY comment_date');
        $signalComments = array(); 
        while ($signalComment = $getSignalComments->fetch()) {
            $signalComments[] = $signalComment; // on créer un tableau regroupant les members
        }
        return $signalComments;
    }
    
    public function deleteComments($postId) {  
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE post_id = :postidnum');
        $req->execute(array(
            'postidnum' => $postId
        ));  
        $req->closeCursor();
    }
    
}
