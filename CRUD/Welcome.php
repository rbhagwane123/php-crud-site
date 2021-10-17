<?php
    $profile=false;
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!= true){
        header("location: login.php");
        exit;
    }
    else{
        require 'connfile.php';
        $username = $_SESSION['username'];
        $sql = "SELECT `profile` FROM `users101` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $row= mysqli_fetch_assoc($result);
            $profile = $row['profile']; 
            $_SESSION['image'] =$profile; 
        }
    }
 
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <!-- <title>Welcome -</title> -->
    <title>Welcome
        <?php echo $_SESSION['username']?>
    </title>
    <style>
        .trial {
            position: relative;
            width: 51px;
            height: 51px;
            right: 4.2rem;
        }
    </style>
</head>

<body>

    <!-- ============================================== NAVBAR STARRTING ============================================== -->
    <?php require 'resources/_login_nav.php'?>
    <!-- ============================================== NAVBAR ENDING ============================================== -->
    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><?php echo "Welcome - " .$_SESSION['username']." !";?></h4>
            <p>Hey how are doing? Welcome to iNotes. You are logged in as <?php echo $_SESSION['username'];?>.I hope your day will be good and properous.</p>
            <hr>
            <p class="mb-0">Whenever you need to, be sure to logout. <a href="logout.php">use this link</a></p>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>


</body>

</html>