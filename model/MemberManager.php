<?php 
  
namespace FredLab\tp5_caddy_race\Model;

require_once("model/Manager.php");

class MemberManager extends Manager {

//**************************************************************************************
//         MemberManager           
//**************************************************************************************
 
    public function getMembersCount() {
        $db = $this->dbConnect();
        $getMembersCount = $db->query('SELECT COUNT(*) AS nbre_members FROM members WHERE group_id = 2 OR group_id = 3');
        $membersCount = $getMembersCount->fetch();
        return $membersCount;
    }

    public function getMembersByGroup() {
        $db = $this->dbConnect();
        $getMembersByGroup = $db->query('SELECT c.name AS name_member, c.first_name AS first_name_member, g.grade AS grade_groupe FROM groups AS g INNER JOIN members AS c ON c.group_id = g.id WHERE group_id = 1 OR group_id = 2 ORDER BY group_id, name');        
        $membersByGroup = array(); 
        while ($memberByGroup = $getMembersByGroup->fetch()) {
            $membersByGroup[] = $memberByGroup; // on créer un tableau regroupant les members
        }
        return $membersByGroup;
    }

    public function getMembersByName() {
        $db = $this->dbConnect();
        $getMembersByName = $db->query('SELECT id, UPPER(name) AS name_maj, LOWER(first_name) AS first_name_min FROM members WHERE group_id = 2 OR group_id = 3 ORDER BY name'); 
        $membersByName = array(); 
        while ($memberByName = $getMembersByName->fetch()) {
            $membersByName[] = $memberByName; // on créer un tableau regroupant les members
        }
        return $membersByName;
    }

    public function getMemberDetail($memberId) {
        $db = $this->dbConnect();
        $getMemberDetail = $db->prepare('SELECT *, DATE_FORMAT(creation_date, \'%d/%m/%Y\')creation_date_fr FROM members WHERE id = ?');
        $getMemberDetail->execute(array($memberId));          
        $memberDetails = array(); 
        while ($memberDetail = $getMemberDetail->fetch()) {
            $memberDetails[] = $memberDetail; // on créer un tableau regroupant les donnees des members
        }
        return $memberDetails;
    }

    public function changeMemberMail($memberId, $dataMember) {
        $db = $this->dbConnect();
        $changeMemberMail = $db->prepare('UPDATE members SET email = :nvemail WHERE id = :idnum');
        $changeMemberMail->execute(array(
            'nvemail' => $dataMember,
            'idnum' => $memberId
        )); 
    }

    public function changeMemberPassword($memberId, $dataMember) {
        $db = $this->dbConnect();
        $changeMemberPassword = $db->prepare('UPDATE members SET password = :newpassword WHERE id = :idnum');
        $changeMemberPassword->execute(array(
            'newpassword' => password_hash($dataMember, PASSWORD_DEFAULT),
            'idnum' => $memberId
        )); 
    }

    public function changeMemberNoComment($memberId, $blockId) {
        $db = $this->dbConnect();
        $changeMemberNoComment = $db->prepare('UPDATE members SET block_comment = :blockId WHERE id = :idnum');
        $changeMemberNoComment->execute(array(
            'blockId' => $blockId,
            'idnum' => $memberId
        )); 
    }

    public function changeMemberGroup($memberId, $moderatorId) {
        $db = $this->dbConnect();
        $changeMemberGroup = $db->prepare('UPDATE members SET group_id = :groupId WHERE id = :idnum');
        $changeMemberGroup->execute(array(
            'groupId' => $moderatorId,
            'idnum' => $memberId
        )); 
    }
    
    public function deleteMember($memberId) {
        $db = $this->dbConnect();
        $deleteMember = $db->prepare('DELETE FROM members WHERE id = :idnum');
        $deleteMember->execute(array(
            'idnum' => $memberId
        )); 
        $deleteMemberAisles = $db->prepare('DELETE FROM aisles_priv WHERE aisle_priv_owner_id = :idnum');
        $deleteMemberAisles->execute(array(
            'idnum' => $memberId
        )); 
        $deleteMemberItems = $db->prepare('DELETE FROM items_priv WHERE item_priv_owner_id = :idnum');
        $deleteMemberItems->execute(array(
            'idnum' => $memberId
        )); 
    }
    
    //**************************************************************************************
    //      CommentManager           
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
