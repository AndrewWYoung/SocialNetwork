<?php

    if (isset($_POST['cover-update'])) {
        include 'db.inc.php';
        include "user_data.inc.php";

        $cover_name = $_FILES['profile_cover']['name'];
        $image_tmp = $_FILES['profile_cover']['tmp_name'];
        $random_num = rand(1, 100);
        
        if ($cover_name) {
            $directory = "../users/covers/$cover_name";
            move_uploaded_file($image_tmp, $directory);

            $query = "UPDATE users SET profile_cover=:profile_cover WHERE username=:username";
            $values = array(':profile_cover'=>$cover_name, ':username'=>$username);
            $result = db::query($query, $values);

            header('Location: '.'../profile.php?id='.$username);
            exit();
        }
    } else {
        echo "error";
        var_dump($_FILES['profile-cover']);
    }
?>