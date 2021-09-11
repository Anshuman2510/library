<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <title>BookWeb</title>
</head>

<body>
  <style>
    img {
      object-fit: cover;
      /* // background-blend-mode: saturation; */
      opacity: 1.7;
      filter: brightness(-11.5);
      filter: drop-shadow(100);
      filter: saturate(0.5);
      filter: contrast(-31.5);
      /* //background-blend-mode: color; */


    }

    body {
      font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-size: 15px;
    }

    .a1 {
      -webkit-filter: blur(2px);
      filter: blur(2px);
    }

    h5 {
      font-weight: bolder;
    }

    p {
      font-weight: bold;
    }

    .img-fluid {
      height: auto;
      width: 2em;
    }
  </style>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="logo-image mx-2">
      <img src="web3.jpg" class="img-fluid">
    </div>
    <a class="navbar-brand" href="#">BookWeb</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact Us</a>
        </li>
        <!-- // if($loggedin)
                // { -->
        <li class="nav-item">

          <a class="nav-link" href="course.php">Course</a>
        </li>
        <!-- //  } -->

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
      <div class="mx-2">

        <button class="btn btn-danger" data-toggle="modal" data-target="#LoginModal">Login</button>

        <button class="btn btn-danger" data-toggle="modal" data-target="#SignupModal">Signup</button>

        <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
      </div>
    </div>
  </nav>




  <?php 
        
       $showAlert = false;
       $showError = false;
       if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'database.php';
       $username = $_POST["username"];
           $password = $_POST["password"];
           $cpassword = $_POST["cpassword"];
          //  $exists=false;
          //check whether this username exists or not
          $existSql = "SELECT * FROM `user` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Failed!</strong> Username already exists
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';

    }
    else
    {

           if(($password == $cpassword)){
               $sql = "INSERT INTO `user` ( `username`, `password`, `dt`) VALUES ('$username', '$password', current_timestamp())";
               $result = mysqli_query($conn, $sql);
               if ($result){
                   $showAlert = true;
                   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
               }
           }
           else{
               $showError = "Passwords do not match";
               echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Failed!</strong> password do not match
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">×</span>
               </button>
             </div>';
               
           }
       }
      }
       ?>



  <?php
// $login = false;
// $showError = false;
// if($_SERVER["REQUEST_METHOD"] == "POST"){
// include 'database.php';
// $username = $_POST["username"];
//     $password = $_POST["password"];
//     $sql = "Select * from user where username='$username' AND password='$password'";
    
//     $result = mysqli_query($conn, $sql);
//     $num = mysqli_num_rows($result);
//     if ($num == 1){
//       header("location:about.html");
//       $login=true;
//     }
//   }
    ?>



  <!--Login Modal -->
  <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="LoginModalLabel">Login to BookWeb</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <form action="/Bootstrap/index.php" method="post"> -->
          <form action="process.php" method="post">
            <div class="form-group">
              <label for="username">Email address</label>
              <input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>

            <!-- <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div> -->


            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>


  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" id="xy" data-toggle="modal" data-target="#SignupModal"></button> -->

  <!-- SignupModal -->
  <div class="modal fade" id="SignupModal" tabindex="-1" role="dialog" aria-labelledby="SignupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="SignupModalLabel">Signup to BookWeb</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/Bootstrap/index.php" method="post">
            <div class="form-group">
              <label for="username">username</label>
              <input type="email" class="form-control" id="username" aria-describedby="emailHelp" name="username">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
              <label for="cpassword">Confirm password</label>
              <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>

            <button type="submit" class="btn btn-primary">Signup</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>
  <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      
    </ol>

    <div class="carousel-inner">

      <div class="carousel-item active">
        <!-- <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=752&q=80"
                    width="1000" height="400" class="d-block w-100" alt="..."> -->
        <img src="book1.jpg" width="96" height="400" class="d-block w-100 a1" alt="...">

        <div class="carousel-caption d-none d-md-block">
          <h5 style="color: white">Welcome to the worlds largest computer science book collection</h5>
          <p style="color: white">were you can manage your all subject links</p>
          <a href="about.html" class="btn btn-danger">About Us</a>
                    <!-- <button class="btn btn-primary">Web development</button>
                    <button class="btn btn-success">Tech fun</button>  -->
        </div>

      </div>
      <div class="carousel-item">
        <!-- <img src="https://images.unsplash.com/photo-1584438784894-089d6a62b8fa?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80"
                    width="1000" height="400" class="d-block w-100" alt="..."> -->
        <img src="world3.jpg" width="1000" height="400" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Largest Database</h5>
          <p>Use our world largest database to create your own personalized book store</p>
          <h6><b>Contact us if you have any problem</b></h6>
          <a href="contact.html" class="btn btn-danger">Contact Us</a>
          <!-- <button class="btn btn-primary">Web development</button>
          <button class="btn btn-success">Tech fun</button> --> -->
        </div>
      </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="container my-4">
    <div class="row mb-2">
      <div class="col-md-6">

        <div
          class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">Know more</strong>
            <!-- <h3 class="mb-0">Know more</h3> -->
            <div class="mb-1 text-muted"></div>
            <p class="card-text mb-auto">Know more about computer science branch</p>
            <a href="https://www.shiksha.com/engineering/computer-science-engineering-chp#:~:text=One%20of%20the%20most%20sought,comprises%20a%20plethora%20of%20topics."
              target="_blank" class="stretched-link">Continue reading</a>
          </div>

          <div class="col-auto d-none d-lg-block">

            <!-- <img class="bd-placeholder-img" width="200" height="250" src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=393&q=80" alt=""> -->
            <img class="bd-placeholder-img" width="200" height="250" src="comp.jpg" alt="">

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div
          class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-success">Internship</strong>
            <!-- <h3 class="mb-0">Post title</h3>
                  <div class="mb-1 text-muted">Nov 11</div> -->
            <p class="mb-auto">Know about internships which are important part of CSE branch</p>
            <a href="https://www.wayup.com/guide/types-internships-computer-science-majors/" target="_blank"
              class="stretched-link">Continue reading</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <img class="bd-placeholder-img" width="200" height="250" src="intern3.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
  <hr>
  <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2020-2021 BookWeb, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>

  </footer>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>