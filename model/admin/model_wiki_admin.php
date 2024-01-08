<?php

include "model\conn.php";

class adminwiki{

    public function getAllwiki(){

        $db = new database();
        $sql = "SELECT * FROM wikis";
        $stmt = $this->$db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $wiki = array();
        foreach($result as $row){
            $wiki[] =new Wiki($row['wiki_id'], $row['title'], $row['content'], $row['author_id'], $row['category_id'], $row['creation_date'], $row['is_archived']);


        }
        return $wiki;
    }


    public function insertwiki($title, $content, $author_id, $category_id, $creation_date, $is_archived){
        try{
            
        }

    }

}



?>