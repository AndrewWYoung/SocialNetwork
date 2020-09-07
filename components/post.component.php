<div class="card">
    <?php
        $query = "SELECT * FROM users WHERE username=:username";
        $values = array(':username'=>$post['user_id']);
        $result = db::query($query, $values);
        if ($result) {
            $profile_cover = $result[0]['profile_cover'];
        }
    ?>

    <!-- HIDDEN -->
    <div class="create-post" id="edit-form_<?php echo $post['id']; ?>" style="display: none;">
    <form action="includes/edit_post.inc.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        <div class="row space-between" style="max-width: 100%;">
            <img class="profile-image" src="users/covers/<?php echo $profile_cover; ?>">
            <textarea name="edit_content" style="resize: none; width: 90%;"><?php echo $post['content']; ?></textarea>
        </div>
        <div class="row space-between" style="margin: 16px 0;">
            <input id="input" type="file" accept="image/*" name="edit_image">
            <button name="edit-post-submit" style="width: 15%;">Submit</button>
        </div>
    </form>
    <hr>
    </div>
    <!-- HIDDEN -->

    <!-- Author and Date -->
    <div class="author-container">
        <img class="profile-image" src="users/covers/<?php echo $profile_cover; ?>">
        <div class="posted-author">
            <a href="profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['user_id']; ?></a>
            <p><?php echo date("Y-m-d", strtotime($post['date'])); ?></p>
        </div>
    </div>

    <!-- Post -->
    <div id="user-post_<?php echo $post['id']; ?>">
    <p><?php echo $post['content']; ?></p>
    </div>
    <?php
    if ($post['image']) { ?>
        <img src='users/posts/<?php echo $post['image']; ?>' style="width: 100%; height: auto;">
    <?php } 
    ?>

    <!-- EDIT / DELETE -->
    <div class="btn-container">
    <?php if ($username == $post['user_id']) { ?>
        <form action="includes/delete_post.inc.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <button class="btn btn-danger" name="delete-post">Delete</button>
        </form>
        <p class="btn btn-warning" id="edit-button_<?php echo $post['id']; ?>" onclick="myFunction(<?php echo $post['id']; ?>)">Edit</p>
    <?php } ?>
    </div>
</div>