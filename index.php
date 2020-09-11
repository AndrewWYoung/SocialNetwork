<?php include "header.php"; ?>
<?php include "components/post_modal.component.php"; ?>

<div style="width: 400px; margin: 0 auto">

<!-- Create Post -->
<div class="card">
    <div class="row space-between" style="max-width: 100%;" onclick="DisplayPostModal()">
        <img class="profile-image" src="users/covers/<?php echo $profile_cover; ?>">
        <textarea name="content" style="resize: none; width: 90%; outline: none; border-radius: 25px; height: 35px; padding: 8px 16px;" onclick="DisplayPostModal()"></textarea>
    </div>
</div>
<!-- -->
<?php
    $query = "SELECT * FROM posts ORDER BY date DESC";
    $values = array(':user_id'=>$username);
    $result = db::query($query, $values);

    foreach ($result as $post) {
        
        include "components/post.component.php";

    }
?>

</div>

<?php include "footer.php"; ?>