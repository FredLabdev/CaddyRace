<?php 
  
namespace FredLab\tp5_caddy_race\Model;

require_once("model/Manager.php");

class AislesManager extends Manager { // se situe dans le namespace

    // private $postTitle;
    // private $postContentHTML;
    // private $postExtract;
    // private $postBefore;
    // private $postId;
    // private $newPostTitle;
    // private $newPostContentHTML;
    // private $postExtract;

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
            $aislesGeneTab[] = $aisleGene; // on créer un tableau regroupant les 5 posts
        }
        $req->closeCursor();
        return $aislesGeneTab;
    }
    
    public function getAislesGeneIcons($aisleGeneId) {
        $db = $this->dbConnect();
        $aislesGeneIcons = $db->prepare('SELECT icon_adress FROM icons WHERE aile_id = ? ORDER BY icon_class');    
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
    
    public function duplicateAislesGene() {            
        $db = $this->dbConnect();
        $req = $db->query('CREATE TABLE aisles_1 LIKE aisles');
        $req->closeCursor();
        $req = $db->query('INSERT INTO aisles_1 SELECT * FROM aisles');
        $req->closeCursor();
    }
    
    public function duplicateAislesGeneDatas($memberId) {            
        $db = $this->dbConnect();
        $req = $db->query('INSERT INTO aisles_priv SELECT * FROM aisles');
        $req->closeCursor();
        $req = $db->prepare('UPDATE aisles_priv SET aisle_owner_id = ? WHERE aisle_owner_id = 1');
        $req->execute(array($memberId));
        $req->closeCursor();
    }
    
    //**************************************************************************************

    public function getPostsBy5($offset) {
        $db = $this->dbConnect();
        $getPostsBy5 = $db->prepare('SELECT id, chapter_title, chapter_content, chapter_extract, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS date FROM posts ORDER BY creation_date DESC LIMIT 5 OFFSET :idmax'); // OFFSET selon indice page
        $getPostsBy5->bindValue(':idmax', $offset, \PDO::PARAM_INT);
        $getPostsBy5->execute();
        $postsBy5 = array(); 
        while ($post = $getPostsBy5->fetch()) {
            $postsBy5[] = $post; // on créer un tableau regroupant les 5 posts
        }
        return $postsBy5;
    }

    public function getPost($postId) {
        $db = $this->dbConnect();
        $getPostDetail = $db->prepare('SELECT id, chapter_title, chapter_content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $getPostDetail->execute(array($postId));
        $postDetails = array(); 
        while ($postDetail = $getPostDetail->fetch()) {
            $postDetails[] = $postDetail; // on créer un tableau regroupant les donnees des members
        }
        return $postDetails;
    }
    
    public function getAllPosts() {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT chapter_title, chapter_content FROM posts ORDER BY creation_date');
        $postsAll = array(); 
        while ($post = $posts->fetch()) {
            $postsAll[] = $post; // on créer un tableau regroupant les posts
        }
        return $postsAll;
    }
    
//**************************************************************************************
//                        Model backend AislesManager           
//**************************************************************************************
    
    public function addPost($postTitle, $postContentHTML, $postExtract, $postBefore) {            
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(creation_date, chapter_title, chapter_content, chapter_extract) VALUES(NOW(), :titre, :contenu, :extract)');
        $req->execute(array(
            'titre' => $postTitle,
            'contenu' => $postContentHTML,
            'extract' => $postExtract
        ));
        $req->closeCursor();
    }
 
    public function changePostTitle($postId, $newPostTitle) {
        $db = $this->dbConnect();
        $modifTitle = $db->prepare('UPDATE posts SET chapter_title = :nvtitre WHERE id = :idnum');
        $modifTitle->execute(array(
            'nvtitre' => $newPostTitle,
            'idnum' => $postId
        )); 
    }

    public function changePostContent($postId, $newPostContentHTML, $postExtract) {
        $db = $this->dbConnect();
        $modifContent = $db->prepare('UPDATE posts SET chapter_content = :nvcontenu, chapter_extract = :nvextract WHERE id = :idnum');
        $modifContent->execute(array(
            'nvcontenu' => $newPostContentHTML,
            'nvextract' => $postExtract,
            'idnum' => $postId
        )); 
    }

    public function deletePost($postId) {  
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = :idnum');
        $req->execute(array(
            'idnum' => $postId
        ));  
        $req->closeCursor();
    }
    
}
