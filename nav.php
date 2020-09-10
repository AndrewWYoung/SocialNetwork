<header>
    <?php if (isset($_SESSION['invalid-credentials'])) { ?>
        <div class="container-full bg-danger align-right">
            <div class="container">
                <p>Email or Password is incorrect!</p>
            </div>
        </div>
    <?php 
        unset($_SESSION['invalid-credentials']);
    } ?>
    <nav class="navbar navbar-dark">
        <?php
            if (isset($_SESSION['username'])) { ?>
                <!-- If user is logged in -- show this nav -->
                <a class="brand" href="index.php">SocialNetwork</a>
                <!-- TEST -->
                <div class="dropdown">
                <img onclick="myFunction()" class="dropbtn profile-image" src="users/covers/<?php echo $profile_cover; ?>" style="cursor: pointer;">
                    <div id="myDropdown" class="dropdown-content">
                        <form class="menu-item" action="./includes/routes.inc.php" method="POST" style="margin-right: 8px;">
                            <button type="submit" name="profile-submit">Profile</button>
                        </form>
                        <a class="menu-item" href="index.php">Newsfeed</a>
                        <hr>
                        <form class="menu-item" action="./includes/logout.inc.php" method="POST">
                            <button type="submit" name="logout-submit">Logout</button>
                        </form>
                    </div>
                </div>
                <!-- END OF TEST -->
            <?php } else { ?>
                <!-- Display login if not already logged in -->
                <form action="./includes/login.inc.php" method="POST" style="margin-left: auto;">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>
            <?php } ?>
        </div>
    </nav>
</header>