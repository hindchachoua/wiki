<?php
// require_once("model/userModel.php");
class AuthController
{
    private $authDAO;

    public function __construct()
    {
        $this->authDAO = new userDAO();
    }

    public function showLoginForm()
    {
        include_once 'view/pages/sign-in.php';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->authDAO->getUser($email, $password);


            if (!empty($result))  {
              

                $_SESSION['user_id'] = $result[0]->getauthor_id();  // Assuming getId() is the method to retrieve the user_id
                $_SESSION['user'] = $result[0]->getauthor_id();
                if (isset($_SESSION['user'])) {
                    $role = $result[0]->getRole();

                    switch ($role) {
                        case 'Admin':
                            header('Location: index.php?action=admin');
                            break;
                        case 'auteur':
                            header('Location: index.php?action=author');

                            break;
                        default:
                            header('Location: index.php?action=home');
                            break;

                    }
                }

            } else {
                // Login failed, display error message
                $errorMessage = $result['message'];
                include_once 'view/pages/sign-in.php';

            }
        }
    }
    public function showregisterForm()
    {
        include_once 'view/pages/sign-up.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->authDAO->insertuser($username, $email, $password);

       
        
     
        }
    }

    public function logout()
    {
        // Unset all session variables
        $_SESSION = array();
        // Destroy the session
        session_destroy();
        // Redirect to the login page
        header("Location: index.php?action=login");
        exit();
    }
}

?>