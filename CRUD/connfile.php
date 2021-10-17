<?php
    $servername="localhost";
    $username = "root";
    $password = "";
    $database = "dbRupesh";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if(!$conn){
        die("Sorry the connection can't be created : ". mysqli_connect_error());
    }
    else {
        // echo "Connection Created";
    }
?>