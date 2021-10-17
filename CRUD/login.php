<?php
$exists =false;
$err=false;
$login=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // $errors=false;
    // $err='';
    include 'connfile.php';
    $username = $_POST['username'];
    $password = $_POST['pass'];
    
    // $sql = "Select * from `users101` where `username` ='$username' and `password` = '$password' ";
    $sql = "Select * from `users101` where `username` ='$username' ";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login =true;    
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;   
                header("location: Welcome.php");
            }
            else{
                $err = "Enter Wrong Password";
            }
        }
    }
    else{
        $err = "Invalid Credentials";
        $login=false;
    // mysqli_connect_error();
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

    <title>Login</title>
    <style>
    .login{
        position: relative;
        left : 3.0rem;
    }
    </style>
</head>


<body>

    <?php require 'resources/_nav.php'?>
    <?php
        if ($login) {
            echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>   You Are logged in. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> '; 
        }
        if($err){
            echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>  '.$err.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> '; 
        }
    ?>
    <!-- ============================================== NAVBAR STARRTING ============================================== -->
    <div class="container">
        <h2 class="text-center">Login up here </h2>
        <form action="login.php" method="POST" class="login">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Email address</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- ============================================== NAVBAR ENDING ============================================== -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>


</body>

</html>