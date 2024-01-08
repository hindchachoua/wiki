<?php


class categorie {

    private $category_id;
    private $category_name;
    private $description;


    public function __construct($category_id, $category_name, $description) {
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


?>