<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
    <div class="modal-title-container">
        <div style="flex: 1;"></div>
        <h3 class="modal-title" style="text-align: center;">Create Post</h3>
        <span class="modal-exit close" style="text-align: right;" onclick="ClosePostModal()">&times;</span>
    </div>

    <hr style="width: 30%; margin: 8px auto;">
    
    <form id="cover-form" action="includes/create_post.inc.php" method="POST"
        enctype="multipart/form-data" style="align-self: flex-end; margin: 24px;">
        <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        <textarea rows="4" id="content" name="content" style="width: 100%; border: 0; resize: none; outline: none;" placeholder="What's on your mind, Andrew?"></textarea>
        <div id="image-preview"></div>
        <div style="display: flex; justify-content: center; align-items: center; border: 1px solid lightgray; padding: 8px 16px; margin: 16px 0;">
            <p style="flex: 1; font-weight: 600;">Add to Your Post</p>
            <label style="flex: 1; text-align: right;">
                <img class="add-icon" src="assets/img/gallery.png" style="width: 40px; height: auto;">
                <input type="file" accept="image/*" name="image" style="display: none;" onchange="previewImage()">
            </label>
        </div>
        <button class="post-submit" name="content-submit">Post</button>
    </form>
    </div>

</div>