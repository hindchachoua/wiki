<?php 



class Wiki {

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

?>