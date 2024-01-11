<?php
include_once 'model/categoryModel.php';
include_once 'model/tagModel.php';
include_once 'model/wikiModel.php';
class AdminController
{
    private $categoryDAO;
    private $tagDAO;
    private $wikiDAO;

    public function __construct()
    {
        $this->categoryDAO = new categoryDAO();
        $this->tagDAO = new tagDAO();
        $this->wikiDAO = new wikiDAO();
    }

    public function index()
    {
        $categoryCount = $this->categoryDAO->getCategoryCount();
        $tagCount = $this->tagDAO->getTagCount();
        $wikiCount = $this->wikiDAO->getWikiCount();


        include_once 'view\admin\AdminPage.php';
    }
}

?>

