<?php
    if (isset($_POST['register-submit'])) {
        include "./db.inc.php";
        session_start();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email    = $_POST['email'];

        $error_message = array();
        # Fail Fast
        // empty fields
        if (empty($username) || empty($password) || empty($email)) {
            // header("Location: ../index.php?error=empty_fields");
            $error_message[] = "fields cannot be empty";
        }
        // check to see if username is valid
        if (!empty($username) && !preg_match("/^[a-zA-Z0-9]{4,}$/", $username)) {
            $error_message[] = "invalid username - letters and numbers only and longer than 4 characters";
        }
        // check to see if username is already taken
        $query = "SELECT username FROM users WHERE username=:username";
        $values = array(':username'=>$username);
        if (db::query($query, $values)) {
            // header("Location: ../index.php?error=user_already_exists");
            $error_message[] = "username is already taken";
        }
        // check password
        if (!empty($password) && strlen($password) < 6) {
            $error_message[] = "password must be at least 6 characters";
        }
        // check to see if email is valid
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message[] = "invalid email";
        }
        // check to see if email is already taken
        $query = "SELECT email FROM users WHERE email=:email";
        $values = array(':email'=>$email);
        if (db::query($query, $values)) {
            // header("Location: ../index.php?error=email_already_exists");
            $error_message[] = "email is already taken";
        }


        if(!empty($error_message)) {
            $_SESSION['error'] = $error_message;
            header("Location: ../index.php");
            exit();
        }

        // Random profile cover
        $directory = "../users/covers";
        $covers    = scandir($directory);
        $profile_cover = $covers[array_rand($covers)];
    
        // Create account
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT iNTO users (username, password, email, profile_cover) VALUES (:username, :password, :email, :profile_cover);';
        $values = array(':username'=>$username, ':password'=>$hashed_password, ':email'=>$email, ':profile_cover'=>$profile_cover);
        if (db::query($query, $values)) {
            $_SESSION['success'] = "User successfully added!";
            header("Location: ../index.php");
        } else {
            $error_message[] = 'ERROR: User has NOT been added...';
            $_SESSION['error'] = $error_message;
        }
    } else {
        echo 'Thats a negative, ghostrider.';
    }
?>