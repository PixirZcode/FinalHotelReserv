<?php 

    $servername = "localhost";
    $username = "root";
    $password = "123321xx";
    $dbname = "hotelreserv";

    // Create Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    }

?>