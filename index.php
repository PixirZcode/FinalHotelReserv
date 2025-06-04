<?php
include('server.php');
session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/8b43bbff40.js"></script>

    <!--- Fonts --->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

    <!--- CSS --->
    <link rel="stylesheet" href="style.css">
    
    <title>Hotel Reserv</title>
</head>

<body>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--- Div and BG --->
    <div class="d-flex flex-column min-vh-100" style="background-image: url('picture/1.jpg');">

        <!--- Import ไฟล์หน้าต่างๆ --->
        <?php
        include('navbar.php');
        if ($_GET['page'] == "login") {
            include("login.php");
        } else if ($_GET['page']  == 'payment') {
            include("payment.php");
        } else if ($_GET['page'] == "logout") {
            include("logout.php");
        } else if ($_GET['page'] == 'register') {
            include("register.php");
        } else if ($_GET['page'] == 'home') {
            include("home.php");
        } else if ($_GET['page'] == 'profile') {
            include("profile.php");
        } else if ($_GET['page'] == 'history') {
            include("history.php");
        } 
        else {
            include("home.php");
        }
        ?>
        <p></p>

    </div>
    <!--- End div and BG --->
</body>
<!--- Import footer --->
<?php include('footer.php'); ?>

</html>