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

    private $tags = [];

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
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    public function getTags()
    {
        return $this->tags;
    }
}



class wikiDAO{
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getwiki(){

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


    public function getwikibycategoryid($id) {
        // Check if $id is not NULL and is a valid integer
        if ($id !== null && filter_var($id, FILTER_VALIDATE_INT) !== false) {
            $sql = "SELECT * FROM wikis WHERE category_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultdata = $stmt->fetchAll();
            $results = array();
    
            foreach($resultdata as $row){
                $results[] = new wiki(
                    $row['wiki_id'], 
                    $row['title'], 
                    $row['content'], 
                    $row['author_id'], 
                    $row['category_id'], 
                    $row['creation_date'], 
                    $row['is_archived']);
            }
    
            return $results;
        } else {
            // Handle the case where $id is NULL or not a valid integer
            // You can throw an exception, log an error, or return an appropriate response
            return array();
        }
    }
    

public function getAllWikisForCrud(){

    $sql = "SELECT * FROM wikis";
    $stmt = $this->db->query($sql);
    $stmt->execute();
    $resultdata = $stmt->fetchAll();
    $results = array();

    // results / result
    foreach($resultdata as $row){
        $result = new wiki(
            $row['wiki_id'], 
            $row['title'],
            $row['content'],
            $row['author_id'], 
            $row['category_id'], 
            $row['creation_date'], 
            $row['is_archived']);

            $tags = $this->getTagsByWikiId($row['wiki_id']);
            $result->setTags($tags);

            $results[] = $result;

    }
}

public function getLatestWikis($limit = 5)
{
    $query = "SELECT * FROM wikis WHERE is_archived = 0 ORDER BY creation_date DESC LIMIT $limit" ;
    $wikisData = $this->db->query($query);

    $wikis = [];
    foreach ($wikisData as $wikiData) {
        $wikis[] = new Wiki(
            $wikiData['wiki_id'],
            $wikiData['title'],
            $wikiData['content'],
            $wikiData['author_id'],
            $wikiData['category_id'],
            $wikiData['creation_date'],
            $wikiData['is_archived']
        );
    }

    return $wikis;
}




public function getTagsByWikiId($wikiId)
    {
        $sql = "SELECT t.* FROM tags t JOIN wiki_tags wt ON t.tag_id = wt.tag_id WHERE wt.wiki_id = :wikiId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':wikiId', $wikiId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $tags = [];
        foreach ($result as $row) {
            $tags[] = new Tag($row['tag_id'], $row['tag_name'], $row['creation_date']);
        }
        return $tags;

        
    }

    public function getWikiByIdWithTags($wikiId)
{
    $sql = "SELECT * FROM wikis WHERE wiki_id = :wikiId AND is_archived = 0";
    $params = [':wikiId' => $wikiId];

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $wiki = new Wiki(
            $result['wiki_id'],
            $result['title'],
            $result['content'],
            $result['user_id'],
            $result['category_id'],
            $result['creation_date'],
            $result['is_archived']
        );

        // Get tags associated with the wiki
        $tags = $this->getTagsByWikiId($result['wiki_id']);
        $wiki->setTags($tags);

        return $wiki;
    }

    return null;
}
// public function getWikisByCategoryId($categoryId)
// {
//     $query = "SELECT * FROM wikis WHERE category_id = :categoryId";
//     $params = [':categoryId' => $categoryId];
//     $results = $this->fetchAll($query, $params);

//     $wikis = [];
//     foreach ($results as $result) {
//         $wikis[] = new Wiki(
//             $result['wiki_id'],
//             $result['title'],
//             $result['content'],
//             $result['user_id'],
//             $result['category_id'],
//             $result['created_at'],
//             $result['is_archived']
//         );
//     }

//     return $wikis;
// }

 public function getwikibyid ($id){
    $sql = "SELECT * FROM wikis WHERE wiki_id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $resultdata = $stmt->fetchAll();
    $result = null; // Initialize $result

    foreach($resultdata as $row){
        $result = new wiki(
            $row['wiki_id'], 
            $row['title'], 
            $row['content'], 
            $row['author_id'], 
            $row['category_id'], 
            $row['creation_date'], 
            $row['is_archived']);
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


    public function disableWiki($wikiId)
{
    $sql = "UPDATE wikis SET is_archived = 1 WHERE wiki_id = :wikiId";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':wikiId', $wikiId);
    
    return $stmt->execute();
}
public function enableWiki($wikiId)
{
    $sql = "UPDATE wikis SET is_archived = 0 WHERE wiki_id = :wikiId";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':wikiId', $wikiId);
    
    return $stmt->execute();
}

public function getWikiCount()
{
    $sql = "SELECT COUNT(*) as count FROM wikis";
    $stmt = $this->db->prepare($sql);

    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (object)['count' => $result['count'] ?? 0];
    } else {
        // Handle the case where execution fails (perhaps log an error or return an error object)
        return (object)['count' => 0];
    }
}

public function liveSearchWiki($query)
{
    $sql = "SELECT * FROM wikis WHERE title LIKE :query LIMIT 5";
    $params = [':query' => '%' . $query . '%'];

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

public function searchWikisByQuery($query)
{
    $query1 = "%$query%";

    $sql = "SELECT DISTINCT w.* FROM wikis w
            JOIN categories c ON w.category_id = c.category_id
            JOIN wiki_tags wt ON w.wiki_id = wt.wiki_id
            JOIN tags t ON wt.tag_id = t.tag_id
            WHERE (w.title LIKE :query OR
                   c.name LIKE :query OR
                   t.name LIKE :query)
            AND w.is_archived = 0";

    $params = [':query' => $query1];

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $wikis = [];
    foreach ($results as $result) {
        $wikis[] = new Wiki(
            $result['wiki_id'],
            $result['title'],
            $result['content'],
            $result['user_id'],
            $result['category_id'],
            $result['creation_date'],
            $result['is_archived']
        );
    }

    return $wikis;
}


}

?>