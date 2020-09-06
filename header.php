<?php
    session_start();
    if (isset($_SESSION['email'])) {
        include "includes/db.inc.php";
        $query = "SELECT * FROM users WHERE email=:email";
        $values = array(':email'=>$_SESSION['email']);
        $result = db::query($query, $values);
        if ($result) {
            $username = $result[0]['username'];
            $email = $result[0]['email'];
            $registration_date = $result[0]['registration_date'];
            $profile_cover = $result[0]['profile_cover'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>
    <script>
        function myFunction(id) {
            var form = document.getElementById(`edit-form_${id}`);
            var edit_button = document.getElementById(`edit-button_${id}`);
            var user_post = document.getElementById(`user-post_${id}`);
            if (form.style.display === "none") {
                form.style.display = "block";
                user_post.style.display = "none";
                edit_button.innerHTML = "Cancel";
            } else {
                form.style.display = "none";
                user_post.style = "block";
                edit_button.innerHTML = "Edit";
            }
        }
    </script>
    <header>
        <?php if (isset($_SESSION['invalid-credentials'])) { ?>
            <div class="container-full bg-danger align-right">
                <div class="container">
                    <p>Email or Password is incorrect!</p>
                </div>
            </div>
        <?php 
            unset($_SESSION['invalid-credentials']);
        } ?>
        <nav class="navbar navbar-dark">
            <a class="brand" href="#">SocialNetwork</a>
            <?php
                if (isset($_SESSION['username'])) { ?>
                    <form action="./includes/logout.inc.php" method="POST">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>
                <?php } else { ?>
                    <form action="./includes/login.inc.php" method="POST">
                        <input type="email" name="email" placeholder="Email">
                        <input type="password" name="password" placeholder="Password">
                        <button type="submit" name="login-submit">Login</button>
                    </form>
                <?php } ?>
            </div>
        </nav>
    </header>