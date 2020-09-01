<?php include "header.php"; ?>
<form action="./includes/register.inc.php" method="POST">
    <input type="text" name="username" placeholder="username...">
    <input type="password" name="password" placeholder="password...">
    <input type="email" name="email" placeholder="email...">
    <button type="submit" name="register-submit">Register</button>
</form>
<?php include "footer.php"; ?>