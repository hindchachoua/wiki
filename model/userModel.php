<?php 

// require_once "connection\conn.php";


class user{
    private $author_id;
    private $author_name;
    private $email;
    private $password;
    private $registration_date;
    private $role;

    public function __construct($author_id, $author_name, $email, $password, $registration_date, $role){
        $this->author_id = $author_id;
        $this->author_name = $author_name;
        $this->email = $email;
        $this->password = $password;
        $this->registration_date = $registration_date;
        $this->role = $role;
    }



    /**
     * Get the value of author_id
     */ 
    public function getAuthor_id()
    {
        return $this->author_id;
    }

    /**
     * Get the value of author_name
     */ 
    public function getAuthor_name()
    {
        return $this->author_name;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of registration_date
     */ 
    public function getRegistration_date()
    {
        return $this->registration_date;
    }
    public function getRole()
    {
        return $this->role;
    }
}

class userDAO{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();

    }
    public function getUser($email, $password){
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    
        $resultdata = $stmt->fetchAll();
        $results = array();
    
        foreach($resultdata as $data){
            $results[] = new user($data['author_id'], $data['author_name'], $data['email'], $data['password'], $data['registration_date'], $data['role']);
        }
        return $results;
    }
    

    public function getUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        $resultdata = $stmt->fetchAll();
        foreach($resultdata as $data){
            $result = new user($data['author_id'], $data['author_name'], $data['email'], $data['password'], $data['registration_date'], $data['role']);
        }
        return $result;
    }

    public function getuserbyid($id){
        $sql = "SELECT * FROM users WHERE author_id = $id";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        $resultdata = $stmt->fetchAll();
        foreach($resultdata as $data){
            $result = new user($data['author_id'], $data['author_name'], $data['email'], $data['password'], $data['registration_date'], $data['role']);
        }
        return $result;
    }
    
    public function insertuser($author_name, $email, $password){
        $sql = "INSERT INTO users (author_name, email, password) VALUES ('$author_name', '$email', '$password')";
        $stmt = $this->db->query($sql);
        $stmt->execute();
        header('Location: index.php?action=login');
        exit();

    }

    /**
     * Get the value of role
     */ 
 
}
// $var = 'haha';
// $em = 'haha@gmail.com';
// $ps = '12345678';
// $obj = new userDAO();
// $obj->insertuser($var, $em, $ps);

// $obj = new userDAO();
// $users =$obj ->getUser();
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
//     <td>'.$user->getAuthor_id().'</td>
//     <td>'.$user->getAuthor_name().'</td>
//     <td>'.$user->getEmail().'</td>
//     <td>'.$user->getPassword().'</td>
//     <td>'.$user->getRegistration_date().'</td>
//     </tr>';
// }

// echo '</tbody>
// </table>';

?>