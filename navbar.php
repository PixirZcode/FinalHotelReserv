<?php
include('server.php');
?>

<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="./">
        <i class="fa fa-hotel"></i> Hotel Reserv</a>
        
        <ul class="navbar-nav mr-auto">
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="?page=profile"><i class="fa fa-address-book" name="edit_pro"></i> ข้อมูลส่วนตัว</a></li>
                        <li><a class="dropdown-item" href="?page=history"><i class="fa fa-history"></i> ประวัติการจอง</a></li>
                        <li><a class="dropdown-item" href="?page=logout"><i class="fa fa-sign-out"></i> ออกจากระบบ</a></li>
                    </ul>
                </li>
            <?php } else { ?>
                <a class="btn btn-sm btn-success" type="button" href="?page=login">เข้าสู่ระบบ</a>
            <?php } ?>
        </ul>
    </div>
</nav>
<!-- End NavBAr -->