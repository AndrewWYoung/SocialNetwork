<?php include "header.php"; ?>
<div class="container">
    <div style="display: flex; flex-direction: column; width: 100%; height: 250px; background-position: center; background-size: cover; background-image: url('users/covers/<?php echo $profile_cover; ?>');">
        <form action="<?php echo 'profile.php?user='.$username; ?>" method="POST"
            enctype="multipart/form-data">

        </form>
        <div style="width: 100%; background-color: rgba(0,0,0,0.5);">
            <p style="text-align: center; color: white; font-size: 1.5rem;">Welcome, <?php echo $username; ?></p>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>