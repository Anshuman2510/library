<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
include 'database.php';
$username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "Select * from user where username='$username' AND password='$password'";
    
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
      
      session_start();
      $login=true;
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        $name=$_SESSION['username'];
      // header("location:index.php");
      
     
    }
    else{
      $showError="first signup";
      
  }
  }
  ?>
  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  
      <title>Login page</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/LoginSystem">iSecure</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/LoginSystem/welcome.php">Home <span class="sr-only">(current)</span></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="/LoginSystem/login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/LoginSystem/signup.php">Signup</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/LoginSystem/logout.php">Logout</a>
      </li>
       
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

      <?php
      
      if($login)
      {
  //     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  //   <strong>success!</strong> You are logged in
  //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  //     <span aria-hidden="true">&times;</span>
  //     <input type="button" value="Go back!" onclick="history.back()">
  //   </button>
  // </div>';
  echo'<div class="container my-4">
  <div class="alert alert-success" role="alert" >
  <h4 class="alert-heading">Logged in !</h4>
  <p>Thank you for logging in</p>
  <hr>
  <input type="button" value="Go back!" onclick="history.back()">
</div>
</div>';
      }
      if($showError){
          // echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
          //     <strong>Error!</strong> '. $showError.'
          //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          //         <span aria-hidden="true">×</span>
          //     </button>
          // </div> ';
          // header( "Refresh:3; url=index.php", true, 303);
          // }
          echo'<div class="container my-4">
  <div class="alert alert-danger" role="alert" >
  <h4 class="alert-heading">Error!</h4>
  <p>First Signup</p>
  <hr>
  <input type="button" value="Go back!" onclick="history.back()">
</div>
</div>';
      }

  ?>
      
  
      <!-- Optional JavaScript; choose one of the two! -->
  
      <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
      <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      -->
    </body>
  </html>