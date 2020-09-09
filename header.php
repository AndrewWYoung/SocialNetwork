<?php
    include "includes/user_data.inc.php";
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/profile.css">
    <link rel="stylesheet" type="text/css" href="assets/css/post.css">
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
    <?php include "nav.php"; ?>