<?php
    class DB {

        public static function connect() {
            $dbname     = 'socialnetwork';
            $servername = 'localhost';
            $username   = 'root';
            $password   = 'password';

            try {
                $connection_string = "mysql:host=".$servername.";dbname=".$dbname.";charset=utf8";
                $pdo = new PDO($connection_string, $username, $password);
                // Set the PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                return $pdo;
                echo "Connected successfully";
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function query($query, $values = array()) {
            // Query Example:
            // 'INSERT iNTO users (username, password, email) VALUES (:username, :password, :email)';
            $statement = self::connect()->prepare($query);
            // Values Example:
            // array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_DEFAULT), ':email'=>$email)
            $success   = $statement->execute($values);
    
            if (explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll();
                return $data;
            }
    
            return $success;
        }
    }

?>