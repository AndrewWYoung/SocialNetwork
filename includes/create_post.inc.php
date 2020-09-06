<?php
    session_start();
    if (isset($_POST['content-submit']) && isset($_SESSION['email'])) {
        include 'db.inc.php';

        $query = "SELECT * FROM users WHERE email=:email";
        $values = array(':email'=>$_SESSION['email']);
        $result = db::query($query, $values);
        if ($result) {
            $username = $result[0]['username'];
            $email = $result[0]['email'];
            $registration_date = $result[0]['registration_date'];
            $profile_cover = $result[0]['profile_cover'];
        }

        $content = $_POST['content'];
        $image   = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $directory = "users/posts/$image";

        if (empty($content) && empty($image)) {
            $_SESSION['content_empty'] = "This post appears to be empty. Please write something or attach a link or photo to post.";
            // header("Location: profile.php");
            header('Location: '.$_POST['url']);
            exit();
        }

        if (empty($image)) {
            $query = 'INSERT iNTO posts (user_id, content) VALUES (:user_id, :content);';
            $values = array(':user_id'=>$username, ':content'=>$content);
            if (db::query($query, $values)) {
                // header("Location: profile.php?");
                header('Location: '.$_POST['url']);
                exit();
            }
        }

        if (empty($content)) {
            move_uploaded_file($image_tmp, $directory);

            $query = 'INSERT iNTO posts (user_id, image) VALUES (:user_id, :image);';
            $values = array(':user_id'=>$username, ':image'=>$image);
            if (db::query($query, $values)) {
                // header("Location: profile.php?");
                header('Location: '.$_POST['url']);
                exit();
            }
        }

        if ($content && $image) {
            move_uploaded_file($image_tmp, $directory);

            $query = 'INSERT iNTO posts (user_id, content, image) VALUES (:user_id, :content, :image);';
            $values = array(':user_id'=>$username, ':content'=>$content, ':image'=>$image);
            if (db::query($query, $values)) {
                // header("Location: profile.php?");
                header('Location: '.$_POST['url']);
                exit();
            }
        }
    } else {
        echo "why wont i work";
    }
?>