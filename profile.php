<?php include "header.php"; ?>
<?php
    $uri = $_SERVER['REQUEST_URI'];
    $url_id = explode("id=", $uri)[1];
    $is_following = false;

    if (!$url_id) {
        header("Location: profile.php?id=$username");
        exit();
    }

    $query = "SELECT * FROM users WHERE username=:username";
    $values = array(':username'=>$url_id);
    $result = db::query($query, $values);

    if ($result) {
        $profile_username = $result[0]['username'];
        $profile_email = $result[0]['email'];
        $profile_registration_date = $result[0]['registration_date'];
        $profile_cover = $result[0]['profile_cover'];

        $query = "SELECT * FROM followers WHERE user_id=:username AND follower_id=:follower_id";
        $values = array(':username'=>$username, 'follower_id'=>$url_id);
        $is_following = db::query($query, $values);
    } else {
        // ... MAYBE MAKE THIS A 404 Page?
        header("Location: profile.php?id=$username");
        exit();
    }

    if (isset($_POST['follow-submit'])) {
        $query = 'INSERT iNTO followers (user_id, follower_id) VALUES (:user_id, :follower_id);';
        $values = array(':user_id'=>$username, ':follower_id'=>$url_id);
        if (db::query($query, $values)) {
            header("Location: profile.php?id=$url_id");
            exit();
        } else {
            echo "failed to add";
        }
    }

    if (isset($_POST['unfollow-submit'])) {
        $query = "DELETE FROM followers WHERE user_id=:user_id AND follower_id=:follower_id";
        $values = array(':user_id'=>$username, ':follower_id'=>$url_id);
        if (db::query($query, $values)) {
            header("Location: profile.php?id=$url_id");
            exit();
        } else {
            echo "failed to delete";
        }
    }

    // TEST AREA
?>

<div class="container">
    <!-- Cover Photo -->
    <div class="hero" style="background-image: url('users/covers/<?php echo $profile_cover; ?>')">
        <!-- If user is logged in -->
        <?php if ($username == $url_id) { ?>
        <form id="cover-form" action="includes/update_profile.inc.php" method="POST"
            enctype="multipart/form-data" style="align-self: flex-end; margin: 24px;">
            <label class="cover-upload">
                <h4 style="color: white;">Edit Cover Photo</h4>
                <input id="cover-input" type="file" accept="image/*" name="profile_cover" style="display: none;">
                <button id="form-submit" type="submit" name="cover-update" style="display: none;"></button>
            </label>
        </form>
        <?php } ?>
    </div>

    <div style="display: flex; align-items: flex-start; margin-top: 8px; justify-content: space-between;">
        <div style="width: 35%;">
            <!-- About -->
            <div class="card">
                <?php
                    if ($username != $url_id && !$is_following) { ?>
                        <form action=<?php echo "profile.php?id=$url_id"; ?> method="POST">
                            <input type="hidden" name="user_to_follow" value="<?php echo $url_id; ?>">
                            <button class="btn btn-success" type="submit" name="follow-submit">Follow</button>
                        </form>
                    <?php } else if ($username != $url_id && $is_following) { ?>
                        <form action=<?php echo "profile.php?id=$url_id"; ?> method="POST">
                            <input type="hidden" name="user_to_follow" value="<?php echo $url_id; ?>">
                            <button class="btn btn-danger" type="submit" name="unfollow-submit">Unfollow</button>
                        </form>
                    <?php }
                ?>
                <h2>About</h2>
                <p><?php echo ($username == $url_id) ? $username : $profile_username; ?></p>
                <p>Registered on: <?php echo ($username == $url_id) ? $registration_date : $profile_registration_date; ?></p>
                <p>Email: <?php echo ($username == $url_id) ? $email : $profile_email; ?></p>
            </div>
            
            <!-- following -->
            <?php
                $query = "SELECT * FROM followers WHERE user_id=:user_id";
                $values = array(':user_id'=>$url_id);
                $result = db::query($query, $values);
                if ($result) { ?>
                    <div class="card">
                        <h2>Following</h2>
                        <?php
                            foreach($result as $follower) { ?>
                                <p><a href="profile.php?id=<?php echo $follower['follower_id']; ?>"><?php echo $follower['follower_id']; ?></a></p>
                            <?php }
                        ?>
                    </div>
                <?php }
            ?>
        </div>
        <div style="width: 60%;">
            <?php
                if (isset($_SESSION['content_empty'])) { ?>
                    <p style="padding: 2px; background-color: red; color: white;"><?php echo $_SESSION['content_empty']; ?></p>
                <?php }
                unset($_SESSION['content_empty']);
            ?>

            <!-- CREATE POST -->
            <?php include "components/post_modal.component.php"; ?>
            <?php 
                if ($username == $url_id) { ?>
                    <!-- Create Post -->
                    <div class="card">
                        <div class="row space-between" style="max-width: 100%;" onclick="DisplayPostModal()">
                            <img class="profile-image" src="users/covers/<?php echo $profile_cover; ?>">
                            <textarea name="content" style="resize: none; width: 90%; outline: none; border-radius: 25px; height: 35px; padding: 8px 16px;" onclick="DisplayPostModal()"></textarea>
                        </div>
                    </div>
                    <!-- -->
            <?php } 
            ?>

            <!-- ALL POSTS -->
            <?php
                $profile_to_search = ($username == $url_id) ? $username : $profile_username;
                $query = "SELECT * FROM posts WHERE user_id=:user_id ORDER BY date DESC";
                $values = array(':user_id'=>$profile_to_search);
                $result = db::query($query, $values);

                foreach ($result as $post) {

                    include "components/post.component.php";

                }
            ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>