<?php

// include_once "connection\conn.php";


class tag{

    private $tag_id;
    private $tag_name;
    private $created_at;

    public function __construct($tag_id, $tag_name, $created_at){
        $this->tag_id = $tag_id;
        $this->tag_name = $tag_name;
        $this->created_at = $created_at;
    }

    

    /**
     * Get the value of tag_id
     */ 
    public function getTag_id()
    {
        return $this->tag_id;
    }

    /**
     * Get the value of tag_name
     */ 
    public function getTag_name()
    {
        return $this->tag_name;
    }
    public function getCreated_at()
    {
        return $this->created_at;
    }
}


class tagDAO{

    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllTags(){

        $sql = "SELECT * FROM tags"; 
        $stmt = $this->db->query($sql);
        $stmt->execute();
        $resultdata = $stmt->fetchAll();
        $result = array();

        foreach($resultdata as $row){
            $result[] = new tag($row['tag_id'], $row['tag_name'], $row['created_at']);
        }
        return $result;
    }

    // many to many
    public function gettag($idwiki){
        $query = "SELECT * FROM tags inner join wiki_tags on tag_id = wiki_tags.tag_id and wiki_tags.wiki_id = $idwiki ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $tagsdata = $stmt->fetchAll();

        $tags = array();
        foreach ($tagsdata as $tag) {
            $tags[] = new tag($tag['tag_id'], $tag['tag_name'], $tag['created_at']);
        }
        return $tags;
    }


    public function getTagById($id){

        $sql = "SELECT * FROM tags WHERE tag_id = :tag_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tag_id', $id);
        $stmt->execute();
        $resultdata = $stmt->fetch();
        foreach($resultdata as $data){
            $result = new tag($data['tag_id'], $data['tag_name'] , $data['created_at']);
        }
        return $result;
    }

    public function inserttag($tag_name){

        $sql = "INSERT INTO tags (tag_name) VALUES (:tag_name)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();   
    }


    public function updatetag($tag_id, $tag_name){
        
        $sql = "UPDATE tags SET tag_name = :tag_name WHERE tag_id = :tag_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tag_id', $tag_id);
        $stmt->bindParam(':tag_name', $tag_name);
        $stmt->execute();
        
    }

    public function deletetag($tag_id){

        $sql = "DELETE FROM tags WHERE tag_id = :tag_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tag_id', $tag_id);
        $stmt->execute();
    }

    public function getLatestTags($limit = 5)
    {
        $query = "SELECT * FROM tags ORDER BY created_at DESC LIMIT " . (int) $limit;
    
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    
        $tags = [];
        while ($tagData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tags[] = new tag(
                $tagData['tag_id'],
                $tagData['tag_name'],
                $tagData['created_at']
            );
        }
    
        return $tags;
    }
    
    public function getTagCount()
{
    $sql = "SELECT COUNT(*) as count FROM tags";
    $stmt = $this->db->prepare($sql);

    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (object)['count' => $result['count'] ?? 0];
    } else {
        // Handle the case where execution fails (perhaps log an error or return an error object)
        return (object)['count' => 0];
    }
}


    /**
     * Get the value of created_at
     */ 

}



?>