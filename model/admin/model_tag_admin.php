<?php 

include "model\conn.php";


class admintag {

    public function getAlltag() {
        
        $db = new database();
        $sql = "SELECT * FROM tags";
        $stmt = $this->$db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $tag = array();
        foreach($result as $row) {
            $tag[] = new tag($row['tag_id'], $row['tag_name']);
        }
        return $tag;
    }


    public function inserttag($tag_name) {
        try {
            $db = new database();
            $sql = "INSERT INTO tags(tag_name) VALUES (:tag_name)";
            $stmt = $this->$db->getConnection()->prepare($sql);
            $stmt->bindParam(':tag_name', $tag_name);

            $result = $stmt->execute();

            if ($result) {
                return "Inserted successfully";
            } else {
                return "Failed to insert: " . implode(", ", $stmt->errorInfo()); // Fetch and return the error message
            }
        }catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Fetch and return the error message from the exception
        }
    }


    public function updatetag($tag_id, $tag_name) {
        try{
            $db = new database();
            $sql = "UPDATE tags SET tag_name = :tag_name WHERE tag_id = :tag_id";

            $stmt = $this->$db->getConnection()->prepare($sql);

            $result = $stmt->execute(array( "tag_id" => $tag_id, "tag_name" => $tag_name));

            return $result;
        }catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Fetch and return the error message from the exception
        }

    }


    public function deletetagbyid($tag_id) {
        try{
            $db = new database();
            $sql = "DELETE FROM tags WHERE tag_id = :tag_id";

            $stmt = $this->$db->getConnection()->prepare($sql);
            $result = $stmt->execute(array( "tag_id" => $tag_id));

            return $result;
    }catch(PDOException $e) {
        return "Error: " . $e->getMessage(); // Fetch and return the error message from the exception
    }
    }
}




?>