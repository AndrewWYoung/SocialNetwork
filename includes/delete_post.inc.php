<?php
    if (isset($_POST['delete-post'])) {
        include 'db.inc.php';

        $id = $_POST['id'];

        $query = "DELETE FROM posts WHERE id=:id";
        $values = array('id'=>$id);
        if (db::query($query, $values)) {
            // header("Location: profile.php?");
            header('Location: '.$_POST['url']);
            exit;
        }
    } else {
        echo 'broken';
    }
?>