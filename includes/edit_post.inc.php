<?php
if (isset($_POST['edit-post-submit'])) {
    include 'db.inc.php';

    $post_id = $_POST['id'];
    $content = $_POST['edit_content'];
    $image   = $_FILES['edit_image']['name'];
    $image_tmp = $_FILES['edit_image']['tmp_name'];
    $directory = "users/posts/$image";

    if (empty($content) && empty($image)) {
        $_SESSION['content_empty'] = "This post appears to be empty. Please write something or attach a link or photo to post.";
        // header("Location: profile.php");
        // header('Location: '.$_SERVER['REQUEST_URI']);
        header('Location: '.$_POST['url']);
        exit();
    }

    if (empty($image)) {
        // "UPDATE data SET name='$name', location='$location' where id=$id";
        $query = 'UPDATE posts SET content=:edit_content WHERE id=:id';
        $values = array(':id'=>$post_id, ':edit_content'=>$content);
        if (db::query($query, $values)) {
            // header("Location: profile.php?");
            header('Location: '.$_POST['url']);
            exit();
        }
    }

    if (empty($content)) {
        move_uploaded_file($image_tmp, $directory);

        // $query = 'INSERT iNTO posts (user_id, image) VALUES (:user_id, :image);';
        $query = 'UPDATE posts SET image=:edit_image WHERE id=:id';
        $values = array(':id'=>$post_id, ':edit_image'=>$image);
        if (db::query($query, $values)) {
            // header("Location: profile.php?");
            // header('Location: '.$_SERVER['REQUEST_URI']);
            header('Location: '.$_POST['url']);
            exit();
        }
    }

    if ($content && $image) {
        move_uploaded_file($image_tmp, $directory);

        // $query = 'INSERT iNTO posts (user_id, content, image) VALUES (:user_id, :content, :image);';
        $query = 'UPDATE posts SET content=:edit_content, image=:edit_image WHERE id=:id';
        $values = array(':id'=>$post_id, ':edit_content'=>$content, ':edit_image'=>$image);
        if (db::query($query, $values)) {
            // header("Location: profile.php?");
            // header('Location: '.$_SERVER['REQUEST_URI']);
            header('Location: '.$_POST['url']);
            exit();
        }
    }
} else {
    header('Location: '.$_POST['url']);
}
?>