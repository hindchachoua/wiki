<?php 

include './model/conn.php';



class admincategori{

    public function getAll(){
        $db = new database();
        $sql = "SELECT * FROM category";
        $stmt = $this->$db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}







?>