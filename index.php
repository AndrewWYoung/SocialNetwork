<?php include "header.php"; ?>
<!-- -->

<div id="register-container">
    <?php
        session_start();
        if(isset($_SESSION['error'])) { ?>
            <div class="error-container">
                <?php
                foreach($_SESSION['error'] as $error_message) {
                    echo '<p class="register-error">'.$error_message.'</p>';
                }
                unset($_SESSION['error']);
                ?>
            </div>
        <?php 
        } 
        if (isset($_SESSION['success'])) { ?>
            <div class="success-container">
                <p class="register-success">User Added</p>
            </div>
        <?php }
    ?>
    <h2>Register</h2>
    <form id="register-form" action="./includes/register.inc.php" method="POST">
        <input type="text" name="username" placeholder="username...">
        <input type="password" name="password" placeholder="password...">
        <input type="text" name="email" placeholder="email...">
        <button type="submit" name="register-submit">Register</button>
    </form>
<div class="container">
<?php include "footer.php"; ?>