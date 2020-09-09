<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/post.css">
</head>
<body>
    <?php include "nav.php"; ?>
    <div class="signup-form">
    <form id="register-form" action="./includes/register.inc.php" method="POST">
        <?php
            if(isset($_SESSION['error'])) { ?>
                <div class="error-container">
                    <ul>
                        <?php
                        foreach($_SESSION['error'] as $error_message) {
                            echo '<li class="register-error">'.$error_message.'</li>';
                        }
                        unset($_SESSION['error']);
                        ?>
                    </ul>
                </div>
            <?php 
            } 
            if (isset($_SESSION['success'])) { ?>
                <div class="success-container">
                    <p class="register-success">User Added</p>
                </div>
            <?php 
                unset($_SESSION['success']);
            }
        ?>
        <h2 class="register-title">Register</h2>
        <p>Create your account. It's free and only takes a minute.</p>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="text" name="email" placeholder="Email">
        <button type="submit" name="register-submit">Sign up!</button>
    </form>

    <?php
        if (isset($_SESSION['username'])) {
            echo '<p style="font-size: 2rem; color: white;">'.$_SESSION['username'].'</p>';
        }
    ?>
<?php include "footer.php"; ?>