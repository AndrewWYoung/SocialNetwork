<?php
session_start();
session_unset(); // takes all of the session variables and deletes the values
session_destroy();
header("Location: ../index.php");
?>