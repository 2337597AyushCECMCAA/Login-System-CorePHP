<?php
  $server= "localhost";
  $username ="root";
  $password = "pass123";
  $database ="users";

  $conn = mysqli_connect($server, $username, $password, $database);
  if(!$conn){
    echo "Connection failed due to -->".mysqli_connect_error();
  }




?>