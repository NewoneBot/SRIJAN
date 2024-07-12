<?php 
include 'comman_include.php';
?>


<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo " href="index.html">
            <img src="assets/images/logo.png" alt="logo" style="height: 58px;!important" />
        </a>
        <a class="navbar-brand brand-logo-mini " href="index.html" style="padding-left: 1.25rem;!important">
            <img src="assets/images/logo.jpg" alt="logo" style="height: 35px !important; width: auto!important; " />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="nav-profile-img">
                        <!-- <img src="assets/images/faces/face1.jpg" alt="image"> -->
                        <?php if (!empty($user['photo'])): ?>
                        <img src="<?php echo htmlspecialchars($user['photo']); ?>" width="100" height="100" />
                        <?php else: ?>
                        <img src="assets/images/profile.png" width="100" height="100" />
                        <?php endif; ?>

                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black"><?php echo $user['f_name']." ".$user['l_name'];   ?></p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="editProfile.php">
                        <i class="fa fa-user me-2 text-success"></i> Profile </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST">
                        <button class="dropdown-item" type="submit" class="dropdown-item" name="logout">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>