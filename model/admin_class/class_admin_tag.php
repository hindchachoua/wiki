<?php 


class tag {
    
    private $tag_id;
    private $tag_name;


    public function __construct($tag_id, $tag_name) {

        $this->tag_id = $tag_id;
        $this->tag_name = $tag_name;
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
}

?>