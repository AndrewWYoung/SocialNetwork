<?php
    if (isset($_POST['register-submit'])) {
        include "./db.inc.php";

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email    = $_POST['email'];

        // Fail Fast
    
        // Create account
        $query = 'INSERT iNTO users (username, password, email) VALUES (:username, :password, :email);';
        $values = array(':username'=>$username, ':password'=>$password, ':email'=>$email);
        if (db::query($query, $values)) {
            echo 'success';
        } else {
            echo 'FAILED';
        }
    
    } else {
        echo 'Thats a negative, ghostrider.';
    }
?>