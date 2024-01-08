<?php 

include './model/conn.php';



class admincategori{

    public function getAllcat(){
        $db = new database();
        $sql = "SELECT * FROM category";
        $stmt = $this->$db->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $category = array();
        foreach($result as $row){
            $category[] = new categorie($row['category_id'], $row['category_name'], $row['description']);
        }
        return $category;
    }


    public function insertcat($category_name, $description){
        try {
            $db = new database();
    
            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO categories (category_name, description) VALUES (:category_name, :description)";
            $stmt = $this->$db->getConnection()->prepare($sql);
    
            // Bind parameters to the prepared statement
            $stmt->bindParam(':category_name', $category_name);
            $stmt->bindParam(':description', $description);
            
            // Execute the query
            $result = $stmt->execute();
    
            // Check if the query was executed successfully
            if ($result) {
                return "Inserted successfully";
            } else {
                return "Failed to insert: " . implode(", ", $stmt->errorInfo()); // Fetch and return the error message
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Fetch and return the error message from the exception
        }
    }
    


    public function updatecat($category_id, $category_name, $description){
        try{
            $db = new database();
            
            $sql = "UPDATE categories SET category_name = :category_name, description = :description WHERE category_id = :category_id";

            $stmt = $this->$db->getConnection()->prepare($sql);
            $result = $stmt->execute(array( "category_id" => $category_id ,"category_name" => $category_name, "description" => $description));

            return $result;

        }catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Fetch and return the error message from the exception
        }
    }


    public function deletecatbyid($category_id){
        try{
            $db = new database();
            $sql = "DELETE FROM categories WHERE category_id = :category_id";

            $stmt = $this->$db->getConnection()->prepare($sql);
            $result = $stmt->execute(array( "category_id" => $category_id));

            return $result;

        }catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Fetch and return the error message from the exception
        }
    }

}







?>