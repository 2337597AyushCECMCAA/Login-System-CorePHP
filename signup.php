<?php
session_start();

$showAlert = false;
$showError=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  include './partials/dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  // $exists=false;
  $existSql = "SELECT * from `users` where `username` = '$username'";
  $result= mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if($numExistRows>0){
    $showError = "Username Already Exists";
  }else{
    if ($password == $cpassword) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username', '$hash', CURRENT_TIMESTAMP)";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
        
      } else {
        $showError = "Error in signing up. Please try again.";
      }
    } else {
      if ($password != $cpassword) {
        $showError = "Passwords do not match";
      }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require '../Login-System/partials/nav.php'?>
    <?php 
      if($showAlert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success</strong> Signup is Successfull!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

      }
      if($showError){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Error</strong>'.$showError.'
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
      }
      
    
    
    
    ?>

    <h1 class="text-center mt-5">SignUp to Continue</h1>
    <div class="container">
      <form class="mt-4" action="../Login-System/signup.php" method="post">
        <div class="mb-3 md-6">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
          <div id="emailHelp" class="form-text">Never forget your username and password</div>
        </div>
        <div class="mb-3 md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 md-6">
          <label for="password" class="form-label"> Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword" required>
          <div id="emailHelp" class="form-text">Make sure to enter the same password.</div>
        </div>
        <button type="submit" class="btn btn-primary">SignUp</button>
      </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>