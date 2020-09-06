<div style="border: 1px solid gray; border-radius: 5px; padding: 8px; margin-bottom: 16px;">
    <!-- HIDDEN -->
    <div id="edit-form_<?php echo $post['id']; ?>" style="display: none;">
    <form action="includes/edit_post.inc.php" method="POST" enctype="multipart/form-data" style="display: flex; justify-content: space-between; margin: 8px 0;">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        <textarea name="edit_content" style="resize: none; width: 80%; padding: 8px;"><?php echo $post['content']; ?></textarea>
        <input id="input" type="file" accept="image/*" name="edit_image">
        <button name="edit-post-submit" style="width: 15%;">Submit</button>
    </form>
    </div>
    <!-- HIDDEN -->

    <div id="user-post_<?php echo $post['id']; ?>">
    <p><?php echo $post['content']; ?></p>
    <p>By: <a href="profile.php?id=<?php echo $post['user_id']; ?>"><?php echo $post['user_id']; ?></a>
    <p>On: <?php echo $post['date']; ?></p>
    </div>
    <?php
    if ($post['image']) { ?>
        <img src='users/posts/<?php echo $post['image']; ?>' style="width: 100%; height: auto;">
    <?php } 
    ?>
    <!-- EDIT / DELETE -->
    <?php if ($username == $post['user_id']) { ?>
        <form action="includes/delete_post.inc.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <button name="delete-post" style="border: none; padding: 4px 8px; background-color: red; color: white;">Delete</button>
        </form>
        <p id="edit-button_<?php echo $post['id']; ?>" onclick="myFunction(<?php echo $post['id']; ?>)" style="padding: 8px; background-color: yellow;">Edit</p>
    <?php } ?>
</div>