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
        }
    }
?>
<div class="container">
    <div style="display: flex; flex-direction: column; width: 100%; height: 250px; background-position: center; background-size: cover; background-image: url('users/covers/<?php echo $profile_cover; ?>');">
        <div style="width: 100%; background-color: rgba(0,0,0,0.5);">
            <p style="text-align: center; color: white; font-size: 1.5rem;">Welcome, <?php echo $username; ?></p>
        </div>
    </div>
    <form action="<?php echo 'profile.php?user='.$username; ?>" method="POST"
            enctype="multipart/form-data">
            <input type="file" accept="image/*" name="profile_cover">
            <button name="cover-update">Update Cover</button>
    </form>
</div>
<?php include "footer.php"; ?>