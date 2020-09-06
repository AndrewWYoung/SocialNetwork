<?php include "header.php"; ?>

<div style="width: 500px; margin: 0 auto">

<?php
    $query = "SELECT * FROM posts";
    $values = array(':user_id'=>$username);
    $result = db::query($query, $values);

    foreach ($result as $post) {
        
        include "components/post.component.php";

    }
?>

</div>

<?php include "footer.php"; ?>