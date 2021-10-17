<?php
$exists =false;
$showalert=false;
$errors=false;
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile'])){
    
    // $err='';
    include 'connfile.php';
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $cpassword = $_POST['cpass'];

    
    // Images storing
    $pname = $_FILES['profile']['name'];
    $file_size =$_FILES['profile']['size'];
    $file_tmp =$_FILES['profile']['tmp_name'];
    $file_type=$_FILES['profile']['type'];
    $ext= substr($file_type,6);
    // move_uploaded_file($file_tmp,"upload-images/".$pname);
    $extensions= array("jpeg","jpg","png");

    if(!in_array($ext, $extensions)){
      $errors="extension not allowed, please choose a JPEG or PNG file only.";
    }
    if($file_size > 2097152){
      $errors='File size must be less than 2 MB';
    }
    $sqlexists = "SELECT * FROM `users101` where `username`= '$username' ";
    $result = mysqli_query($conn, $sqlexists);
    $numExistRow = mysqli_num_rows($result);
    if ($numExistRow ==1) {
      $exists = true;
      $errors = "Username already Taken try another.";
    }
    else{
      
      if (($password == $cpassword)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if(empty($errors) == true){
          $sql = "INSERT INTO `users101` (`sno`, `username`, `password`, `profile`) VALUES (NULL, '$username', '$hash', '$pname') ";
          $result = mysqli_query($conn, $sql);
          if($result){
            $showalert = true;
            move_uploaded_file($file_tmp,"upload-images/".$pname);        
          }
          else{
            die("Sorry can't insert: ". mysqli_connect_error());
          // mysqli_connect_error();
          }
        }
      }      
      else{
        $errors= " Confirm Password doesn't match. Try Again ";
      }
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

  <title>Sign-up</title>
</head>


<body>
  <?php require 'resources/_nav.php'?>
  <?php 
    if ($showalert) {
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong>   Sucessfully Account created and you can Login. 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> '; 
    } 
    if ($errors) {
      echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '.$errors.' 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> '; 
    } 
  ?>
    <!-- ============================================== NAVBAR STARRTING ============================================== -->
  <div class="container my-4">
    <h2 class="text-center">Sign up here for New Account</h2>
    <form action="signup.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3 col-md-6">
        <label for="username" class="form-label">Email address</label>
        <input type="text" maxlength="13" class="form-control" name="username" id="username" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3 col-md-6">
        <label for="pass" class="form-label">Password</label>
        <input type="password" maxlength="16" class="form-control" id="pass" name="pass">
      </div>
      <div class="mb-3 col-md-6">
        <label class="form-check-label" for="cpass">Confirm Password</label>
        <input type="password" maxlength="16" class="form-control" id="cpass" name="cpass">
      </div>
      <div class="mb-3 col-md-6">
        <label for="profile" class="form-label">Attach profile photo</label>
        <input class="form-control" type="file" id="profile" name="profile">
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