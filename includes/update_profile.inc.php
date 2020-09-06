<?php
    if (isset($_POST['cover-update'])) {
        include 'db.inc.php';

        $cover_name = $_FILES['profile_cover']['name'];
        $image_tmp = $_FILES['profile_cover']['tmp_name'];
        $random_num = rand(1, 100);
        
        if ($cover_name) {
            $directory = "../users/covers/$cover_name";
            move_uploaded_file($image_tmp, $directory);

            $query = "UPDATE users SET profile_cover=:profile_cover";
            $values = array(':profile_cover'=>$cover_name);
            $result = db::query($query, $values);

            header('Location: '.$_POST['url']);
            exit();
        }
    } else {
        echo "error";
    }
?>