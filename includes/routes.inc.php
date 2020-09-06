<?php
    session_start();
    if (isset($_SESSION['email'])) {
        include "db.inc.php";
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

    $profile_url = "../profile.php?id=$username";
    header("Location: $profile_url");
?>