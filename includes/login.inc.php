<?php
    if (isset($_POST['login-submit'])) {
        include 'db.inc.php';
        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email=:email";
        $values = array(':email'=>$email);
        $result = db::query($query, $values);
        if ($result) {
            if (password_verify($password, $result[0]['password'])) {
                $_SESSION['username'] = $result[0]['username'];
                $_SESSION['email'] = $result[0]['email'];
                $_SESSION['password'] = $result[0]['password'];

                header("Location: ../profile.php");
            } else {

            }
        } else {
            $_SESSION['invalid-credentials'] = true;
            header("Location: ../index.php");
        }
    } else {
        echo 'Negative, Ghostrider.';
    }
?>