<div class="card">
    <form action="includes/create_post.inc.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        <div class="row space-between" style="max-width: 100%;">
            <img class="profile-image" src="users/covers/<?php echo $profile_cover; ?>">
            <textarea name="content" style="resize: none; width: 90%;"></textarea>
        </div>
        <div class="row space-between" style="margin: 16px 0;">
            <input id="input" type="file" accept="image/*" name="image">
            <button name="content-submit" style="width: 15%;">Submit</button>
        </div>
    </form>
</div>