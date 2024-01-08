<?php 

    class database {
        private $host = "localhost";
        private $db_name = "briefsc";
        private $username = "root";
        private $password = "";
        private $conn;


        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            }catch(PDOException $e) {
                echo "Connection error: " . $e->getMessage();
            }
            return $this->conn;
        }
    }

?>