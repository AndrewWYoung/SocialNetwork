<div style="width: 500px; margin: 0 auto">

<?php
    include "components/create_post.component.php";

    $query = "SELECT * FROM posts ORDER BY date DESC";
    $values = array(':user_id'=>$username);
    $result = db::query($query, $values);

    foreach ($result as $post) {
        
        include "components/post.component.php";

    }
?>

</div>