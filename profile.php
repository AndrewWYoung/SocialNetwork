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

    <div style="display: flex; margin-top: 8px; justify-content: space-between;">
        <div style="width: 35%; background-color: #E0E0E0; border-radius: 5px; padding: 16px;">
            <h2>About</h2>
            <p><?php echo $username; ?></p>
            <p>Registered on: <?php echo $registration_date; ?></p>
            <p>Email: <?php echo $email; ?></p>
        </div>
        <div style="width: 60%; background-color: #E0E0E0; border-radius: 5px; padding: 16px;">
            Main Area
        </div>
    </div>
</div>

<?php include "footer.php"; ?>