<?php 
include_once  'model/userModel.php';
include_once  'controller\controllerAdmin.php';
include_once  'controller\auth.php';
include_once   'controller\controllerAuteur.php';
include_once    'controller\controllerCategory.php';
include_once    'controller\controllerHomepage.php';
include_once    'controller\controllertag.php';
include_once    'controller\controllerwiki.php';
include_once    'model\categoryModel.php';
include_once    'model\tagModel.php';
include_once    'model\wikiModel.php';

session_start();
// $objet = new AdminController();
// $objet->index();



// session_start();
// // Routing.
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home':
            $controller = new HomePageController;
            $controller->index();
            break;
        case 'liveSearch':
            $controller = new HomePageController;
            $controller->liveSearch();
            break;
        case 'wiki':
            $controller = new WikiController();
            $controller->showWikiPage($_GET['id']);
            break;
        case 'admin_wiki_table':
            $controller = new WikiController();
            $controller->adminIndex();
            break;
        case 'author_wiki_table':
            $controller = new WikiController();
            $controller->authorIndex();
            break;
        case 'wiki_create':
            $controller = new WikiController();
            $controller->create();
            break;
        case 'wiki_store':
            $controller = new WikiController();
            $controller->store();
            break;
        case 'wiki_edit':
            $controller = new WikiController();
            $controller->edit($_GET['id']);
            break;
        case 'wiki_update':
            $controller = new WikiController();
            $controller->update($_GET['id']);
            break;
        case 'wiki_disable':
            $controller = new WikiController();
            $controller->disable($_GET['id']);
            break;
        case 'wiki_enable':
            $controller = new WikiController();
            $controller->enable($_GET['id']);
            break;
        case 'wiki_delete':
            $controller = new WikiController();
            $controller->delete($_GET['id']);
            break;
        case 'wiki_destroy':
            $controller = new WikiController();
            $controller->destroy();
            break;
        case 'category':
            $controller = new CategoryController();
            $controller->showCategoryPage($_GET['id']);
            break;
        case 'category_table':
            $controller = new CategoryController();
            $controller->index();
            break;
        case 'category_create':
            $controller = new CategoryController();
            $controller->create();
            break;
        case 'category_store':
            $controller = new CategoryController();
            $controller->store();
            break;
        case 'category_edit':
            $controller = new CategoryController();
            $controller->edit();
            break;
        case 'category_update':
            $controller = new CategoryController();
            $controller->update();
            break;
        case 'category_delete':
            $controller = new CategoryController();
            $controller->delete($_GET['id']);
            break;
        case 'category_destroy':
            $controller = new CategoryController();
            $controller->destroy();
            break;
        case 'tag':
            $controller = new TagController();
            $controller->showTagPage($_GET['id']);
            break;
        case 'tag_table':
            $controller = new TagController();
            $controller->index();
            break;
        case 'tag_create':
            $controller = new TagController();
            $controller->create();
            break;
        case 'tag_store':
            $controller = new TagController();
            $controller->store();
            break;
        case 'tag_edit':
            $controller = new TagController();
            $controller->edit();
            break;
        case 'tag_update':
            $controller = new TagController();
            $controller->update();
            break;
        case 'tag_delete':
            $controller = new TagController();
            $controller->delete($_GET['id']);
            break;
        case 'tag_destroy':
            $controller = new TagController();
            $controller->destroy();
            break;
        case 'admin':
            $controller = new AdminController();
            $controller->index();
            break;
        case 'author':
            $controller = new AuthorController();
            $controller->index();
            break;
        case 'login':
            $controller = new AuthController;
            $controller->showLoginForm();
            break;
        case 'register':
            $controller = new AuthController;
            $controller->showregisterForm();
            break;
        case 'login_execute':
            $controller = new AuthController;
            $controller->login();
            break;
        case 'register_store':
            $controller = new AuthController;
            $controller->register();
            break;
        case 'logout':
            $controller = new AuthController;
            $controller->logout();
            break;
        default:
            $controller = new HomePageController;
            $controller->index();
            break;
    }
}
?>