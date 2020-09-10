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
    <link rel="stylesheet" type="text/css" href="assets/css/profile-page.css">
    <link rel="stylesheet" type="text/css" href="assets/css/post.css">
    <link rel="stylesheet" type="text/css" href="assets/css/menu.css">
</head>
<body>
    <?php include "nav.php"; ?>