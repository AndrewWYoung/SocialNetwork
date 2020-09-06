<?php include "header.php"; ?>

<div class="container">
    <div style="display: flex; flex-direction: column; width: 100%; height: 250px; background-position: center; background-size: cover; background-image: url('users/covers/<?php echo $profile_cover; ?>');">
        <div style="width: 100%; background-color: rgba(0,0,0,0.5);">
            <p style="text-align: center; color: white; font-size: 1.5rem;">Welcome, <?php echo $username; ?></p>
        </div>
    </div>

    <div style="margin: 8px 0;">
        <form action="includes/update_profile.inc.php" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
                <input id="input" type="file" accept="image/*" name="profile_cover">
                <button name="cover-update">Update Cover</button>
        </form>
    </div>

    <div style="display: flex; align-items: flex-start; margin-top: 8px; justify-content: space-between;">
        <div style="width: 35%; background-color: #E0E0E0; border-radius: 5px; padding: 16px;">
            <h2>About</h2>
            <p><?php echo $username; ?></p>
            <p>Registered on: <?php echo $registration_date; ?></p>
            <p>Email: <?php echo $email; ?></p>
        </div>
        <div style="width: 60%; background-color: #E0E0E0; border-radius: 5px; padding: 16px;">
            <?php
                if (isset($_SESSION['content_empty'])) { ?>
                    <p style="padding: 2px; background-color: red; color: white;"><?php echo $_SESSION['content_empty']; ?></p>
                <?php }
                unset($_SESSION['content_empty']);
            ?>
            <form action="includes/create_post.inc.php" method="POST" enctype="multipart/form-data" style="display: flex; justify-content: space-between; margin: 8px 0;">
                <textarea name="content" style="resize: none; width: 80%; padding: 8px;"></textarea>
                <input type="hidden" name="url" value="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
                <input id="input" type="file" accept="image/*" name="image">
                <button name="content-submit" style="width: 15%;">Submit</button>
            </form>
            <!-- POSTS -->
            <?php
                $query = "SELECT * FROM posts WHERE user_id=:user_id";
                $values = array(':user_id'=>$username);
                $result = db::query($query, $values);

                foreach ($result as $post) {

                    include "components/post.component.php";

                }
            ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>