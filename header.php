<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
</head>
<body>
    <header>
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