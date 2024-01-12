<?php
class HomePageController
{
    private $wikiDAO;
    private $categoryDAO;
    private $tagDAO;

    public function __construct()
    {
        $this->wikiDAO = new WikiDAO();
        $this->categoryDAO = new CategoryDAO();
        $this->tagDAO = new TagDAO();
    }

    public function index()
    {
        $wikis = $this->wikiDAO->getwiki();
        // Get latest wikis
        $latestWikis = $this->wikiDAO->getLatestWikis();
        // Get latest categories
        $latestCategories = $this->categoryDAO->getLatestCategories();

        // print_r($latestCategories);

        // Get latest tags
        $latestTags = $this->tagDAO->getLatestTags();
        include "view\pages\homepage.php";
    }

    public function liveSearch()
    {
        // die('Reached liveSearch'); // Add this line
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        if (!empty($query)) {
            $wikiDAO = new WikiDAO();
            $results = $wikiDAO->searchWikisByQuery($query);

            ob_start();
            include 'app/views/liveSearchResults.php'; // This is the page to display live search results
            $content = ob_get_clean();

            echo $content;
        }
    }

}