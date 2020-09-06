<?php include "header.php"; ?>
<?php
    if (isset($_POST['cover-update'])) {
        $cover_name = $_FILES['profile_cover']['name'];
        $image_tmp = $_FILES['profile_cover']['tmp_name'];
        $random_num = rand(1, 100);
        
        if ($cover_name) {
            $directory = "users/covers/$cover_name";
            move_uploaded_file($image_tmp, $directory);

            $query = "UPDATE users SET profile_cover=:profile_cover";
            $values = array(':profile_cover'=>$cover_name);
            $result = db::query($query, $values);

            header("Location: profile.php");
            exit();
        }
    }

    if (isset($_POST['content-submit'])) {
        $content = $_POST['content'];
        $image   = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $directory = "users/posts/$image";

        if (empty($content) && empty($image)) {
            $_SESSION['content_empty'] = "This post appears to be empty. Please write something or attach a link or photo to post.";
            header("Location: profile.php");
            exit();
        }

        if (empty($image)) {
            $query = 'INSERT iNTO posts (user_id, content) VALUES (:user_id, :content);';
            $values = array(':user_id'=>$username, ':content'=>$content);
            if (db::query($query, $values)) {
                header("Location: profile.php?");
                exit();
            }
        }

        if (empty($content)) {
            move_uploaded_file($image_tmp, $directory);

            $query = 'INSERT iNTO posts (user_id, image) VALUES (:user_id, :image);';
            $values = array(':user_id'=>$username, ':image'=>$image);
            if (db::query($query, $values)) {
                header("Location: profile.php?");
                exit();
            }
        }

        if ($content && $image) {
            move_uploaded_file($image_tmp, $directory);

            $query = 'INSERT iNTO posts (user_id, content, image) VALUES (:user_id, :content, :image);';
            $values = array(':user_id'=>$username, ':content'=>$content, ':image'=>$image);
            if (db::query($query, $values)) {
                header("Location: profile.php?");
                exit();
            }
        }
    }

    if (isset($_POST['delete-post'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM posts WHERE id=:id";
        $values = array('id'=>$id);
        if (db::query($query, $values)) {
            header("Location: profile.php?deleeete");
            exit;
        }
    }

    if (isset($_POST['edit-content-submit'])) {
        $post_id = $_POST['id'];
        $content = $_POST['edit_content'];
        $image   = $_FILES['edit_image']['name'];
        $image_tmp = $_FILES['edit_image']['tmp_name'];
        $directory = "users/posts/$image";

        if (empty($content) && empty($image)) {
            $_SESSION['content_empty'] = "This post appears to be empty. Please write something or attach a link or photo to post.";
            header("Location: profile.php");
            exit();
        }

        if (empty($image)) {
            // "UPDATE data SET name='$name', location='$location' where id=$id";
            $query = 'UPDATE posts SET content=:edit_content WHERE id=:id';
            $values = array(':id'=>$post_id, ':edit_content'=>$content);
            if (db::query($query, $values)) {
                header("Location: profile.php?");
                exit();
            }
        }

        if (empty($content)) {
            move_uploaded_file($image_tmp, $directory);

            // $query = 'INSERT iNTO posts (user_id, image) VALUES (:user_id, :image);';
            $query = 'UPDATE posts SET image=:edit_image WHERE id=:id';
            $values = array(':id'=>$post_id, ':edit_image'=>$image);
            if (db::query($query, $values)) {
                header("Location: profile.php?");
                exit();
            }
        }

        if ($content && $image) {
            move_uploaded_file($image_tmp, $directory);

            // $query = 'INSERT iNTO posts (user_id, content, image) VALUES (:user_id, :content, :image);';
            $query = 'UPDATE posts SET content=:edit_content, image=:edit_image WHERE id=:id';
            $values = array(':id'=>$post_id, ':edit_content'=>$content, ':edit_image'=>$image);
            if (db::query($query, $values)) {
                header("Location: profile.php?");
                exit();
            }
        }
    }
?>


<div class="container">
    <div style="display: flex; flex-direction: column; width: 100%; height: 250px; background-position: center; background-size: cover; background-image: url('users/covers/<?php echo $profile_cover; ?>');">
        <div style="width: 100%; background-color: rgba(0,0,0,0.5);">
            <p style="text-align: center; color: white; font-size: 1.5rem;">Welcome, <?php echo $username; ?></p>
        </div>
    </div>

    <div style="margin: 8px 0;">
        <form action="<?php echo 'profile.php?user='.$username; ?>" method="POST"
                enctype="multipart/form-data">
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
            <form action="<?php echo 'profile.php?user='.$username; ?>" method="POST" enctype="multipart/form-data" style="display: flex; justify-content: space-between; margin: 8px 0;">
                <textarea name="content" style="resize: none; width: 80%; padding: 8px;"></textarea>
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