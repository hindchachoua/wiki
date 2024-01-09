<?php 

include "connection\conn.php";


class wiki {
    private $wiki_id;
    private $title;
    private $content;
    private $author_id;
    private $category_id;
    private $creation_date;
    private $is_archived;

    public function __construct($wiki_id, $title, $content, $author_id, $category_id, $creation_date, $is_archived) {

        $this->wiki_id = $wiki_id;
        $this->title = $title;
        $this->content = $content;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
        $this->creation_date = $creation_date;
        $this->is_archived = $is_archived;
        
    }

    /**
     * Get the value of wiki_id
     */ 
    public function getWiki_id()
    {
        return $this->wiki_id;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of author_id
     */ 
    public function getAuthor_id()
    {
        return $this->author_id;
    }

    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Get the value of creation_date
     */ 
    public function getCreation_date()
    {
        return $this->creation_date;
    }

    /**
     * Get the value of is_archived
     */ 
    public function getIs_archived()
    {
        return $this->is_archived;
    }
}



class wikiDAO{
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function grtwiki(){

        $sql = "SELECT * FROM wikis";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        $resultdata = $stmt->fetchAll();
        $results = array();

        foreach($resultdata as $row){
            $results[] = new wiki($row['wiki_id'], $row['title'], $row['content'], $row['author_id'], $row['category_id'], $row['creation_date'], $row['is_archived']);
        }
        return $results;
    }

    public function getwikibyid ($id){

        $sql = "SELECT * FROM wikis WHERE wiki_id = $id";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        $resultdata = $stmt->fetchAll();
        foreach($resultdata as $row){
            $result = new wiki($row['wiki_id'], $row['title'], $row['content'], $row['author_id'], $row['category_id'], $row['creation_date'], $row['is_archived']);
        }
        return $result;
    }

    public function insertwiki($title, $content, $author_id, $category_id, $creation_date, $is_archived){

        $sql = "INSERT INTO wikis (title, content, author_id, category_id, creation_date, is_archived) VALUES (:title, :content, :author_id, :category_id, :creation_date, :is_archived)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':creation_date', $creation_date);
        $stmt->bindParam(':is_archived', $is_archived);
        $stmt->execute();
    }

    public function updatewiki($wiki_id, $title, $content, $author_id, $category_id, $creation_date, $is_archived){
        $sql = "UPDATE wikis SET title = :title, content = :content, author_id = :author_id, category_id = :category_id, creation_date = :creation_date, is_archived = :is_archived WHERE wiki_id = :wiki_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':wiki_id', $wiki_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':creation_date', $creation_date);
        $stmt->bindParam(':is_archived', $is_archived);
        $stmt->execute();
    }

    public function deletewiki($wiki_id){
        $sql = "DELETE FROM wikis WHERE wiki_id = $wiki_id";
        $stmt = $this->db->query($sql);
        $stmt->execute();
    }

}

?>