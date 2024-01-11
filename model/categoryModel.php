<?php

// include_once "connection\conn.php";


class category{

    private $category_id;
    private $category_name;
    private $description;

    public function __construct($category_id, $category_name, $description){
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->description = $description;
    }

    

    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Get the value of category_name
     */ 
    public function getCategory_name()
    {
        return $this->category_name;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }
}

class categoryDAO{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function getcategory(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        $resultdata = $stmt->fetchAll();
        $results =array();

        foreach($resultdata as $row){
            $results[] = new category($row['category_id'], $row['category_name'], $row['description'], $row['created_at']);
        }
        return $results;
    }

    public function getcategorybyid($id){
        $sql = "SELECT * FROM categories WHERE category_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $resultdata = $stmt->fetch();
        foreach($resultdata as $data){
            $result = new category($data['category_id'], $data['category_name'], $data['description']);
        }
        return $result;
    }

    public function insertcategory($category_name, $description){
        $sql = "INSERT INTO categories (category_name, description) VALUES (:category_name, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }


    public function updatecategory($category_id, $category_name, $description){
        $sql = "UPDATE categories SET category_name = :category_name, description = :description WHERE category_id = :category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }
    

    public function deletecategory($category_id){
        $sql = "DELETE FROM categories WHERE category_id = :category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
    }

// last categorie
    public function getLatestCategories($limit = 5){
        $sql = "SELECT * FROM categories ORDER BY created_at DESC LIMIT $limit";
        $result = $this->db->query($sql);

        $categories = [];
        foreach($result as $row){
            $categories[] = new category(
                $row['category_id'], 
                $row['category_name'], 
                $row['description'], 
                $row['created_at']);
        }
        return $result;
    }




    public function getCategoryCount(){
        $sql = "SELECT COUNT(*) as count FROM categories";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return (object)['count' => $result['count'] ?? 0];
    }
    
}

// $obj = new categoryDAO();
// $users =$obj ->getcategory();
// echo'<table>
// <thead>
//     <tr>ID</tr>
//     <tr>NAME</tr>
//     <tr>E-MAIL</tr>
//     <tr>PASSWORD</tr>
//     <tr>REGESTRATION DATE</tr>
// </thead>
// <tbody>';
// foreach($users as $user){
//     echo '<tr>
//     <td>'.$user->getCategory_id().'</td>
//     <td>'.$user->getCategory_name().'</td>
//     <td>'.$user->getDescription().'</td>
//     </tr>';
// }

// echo '</tbody>
// </table>';
?>