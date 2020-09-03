<?php
    if (isset($_POST['login-submit'])) {
        include 'db.inc.php';

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email=:email";
        $values = array(':email'=>$email);
        $result = db::query($query, $values);
        if ($result) {
            if (password_verify($password, $result[0]['password'])) {
                session_start();
                $_SESSION['username'] = $result[0]['username'];
                $_SESSION['email'] = $result[0]['email'];
                $_SESSION['password'] = $result[0]['password'];

                header("Location: ../index.php");
            } else {
                echo $password . '<br />';
                echo 'invalid password';
            }
        } else {
            dump_var($result);
        }
    } else {
        echo 'Negative, Ghostrider.';
    }
?>