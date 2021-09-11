<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
     exit;
    
}

?>
<?php  
// INSERT INTO `notes` (`sno`, `subject`, `topic`, `link`) VALUES ('1', 'coa', 'playlist', 'www.google.com');
$insert = false;
$update = false;
$delete = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";


$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
    
    $result = mysqli_query($conn, $sql);
  }
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['snoEdit'])){
        // Update the record
          $sno = $_POST["snoEdit"];
          $subject = $_POST["subjectEdit"];
          $topic = $_POST["topicEdit"];
          $link = $_POST["linkEdit"];
      
        // Sql query to be executed
        $sql = "UPDATE `notes` SET `subject` = '$subject', `topic` = '$topic', `link` = '$link' WHERE `notes`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if($result){
          $update = true;
      }
      else{
          echo "We could not update the record successfully";
      }
      }
      else{
    $subject = $_POST["subject"];
    $topic = $_POST["topic"];
    $link = $_POST["link"];

  // Sql query to be executed
  $sql = "INSERT INTO `notes` ( `subject`, `topic`, `link`) VALUES ( '$subject', '$topic', '$link')";
  $result = mysqli_query($conn, $sql);
  if($result)
  {
    //   echo "It is working";
    $insert=true;
  }
  else{
      echo "It is not working";
  }
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <title>BookWeb</title>
</head>

<body>
  <style>
    .img-fluid {
      height: auto;
      width: 2em;
    }
  </style>
  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="course.php" method="post">
          <div class="modal-body">

            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" id="subjectEdit" aria-describedby="emailHelp" name="subjectEdit">

            </div>
            <div class="form-group">
              <label for="topic">Topic</label>
              <input type="text" class="form-control" id="topicEdit" name="topicEdit">
            </div>
            <div class="form-group">
              <label for="link">Link</label>
              <input type="text" class="form-control" id="linkEdit" name="linkEdit">
            </div>



          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
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

        <li class="nav-item">

          <a class="nav-link" href="course.php">Course</a>
        </li>


      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
      <div class="mx-2">

        <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#LoginModal">Login</button>
               
               <button class="btn btn-danger" data-toggle="modal" data-target="#SignupModal">Signup</button> -->

        <a class="btn btn-danger" href="logout.php" role="button">Logout</a>
      </div>
    </div>
  </nav>
  <?php
  if(($insert==false)&&($update==false)&&($delete==false))
  echo '<div class="container my-4">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <h4 class="alert-heading">Suggestion</h4>
      <p>Do not put your promotional links.</p>
      
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>';
  ?>
  <?php
if($insert)
{
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong> success!</strong> You inserted your favourite subject list
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <style>
    .scroll {
      max-height: 250px;
      overflow-y: auto;
      display: inline-block;
      white-space: nowrap;
    }

    .card .scroll {
      /* width:29rem;
height:29rem; */
    }

    .a {
      display: inline-block;
    }
  </style>
  <div class="container">
    <pre>
                    <h2 style="font-family: 'Odibee Sans', cursive;word-spacing: 4px;">My favourite computer science books</h2>
  </pre>
    <div class="card scroll mx-2" style="width: 20rem;  height:40rem;">
      <h3 style="font-family: 'Dancing Script', cursive;">Compiler design</h3>
      <!-- <a href="http://dspace.sfit.co.in:8004/jspui/bitstream/123456789/1184/1/Programming%20Language%20Pragmatics%20M%20L%20Scott.pdf" target="_blank"class="stretched-link"> -->
      <div class="card a">
        <a href="http://dspace.sfit.co.in:8004/jspui/bitstream/123456789/1184/1/Programming%20Language%20Pragmatics%20M%20L%20Scott.pdf"
          target="_blank" class="stretched-link">
          <img class="bd-placeholder-img" width="200" height="250" src="compiler.jpg" alt="" />
        </a>
      </div>
      <div class="card a">
        <a href="http://index-of.co.uk/Game-Development/Programming/Game%20Scripting%20Mastery.pdf" target="_blank"
          class="stretched-link">
          <img class="bd-placeholder-img" width="200" height="250" src="compiler1.jpg" alt="" />
        </a>
      </div>
    </div>

    <div class="card scroll mx-2" style="width: 20rem;  height:40rem;">
      <h3 style="font-family: 'Dancing Script', cursive;">Operating system</h3>
      <div class="card a">
        <a href="http://www.csl.ece.upatras.gr/os/Silberschatz.pdf" target="_blank" class="stretched-link">
          <img class="bd-placeholder-img" width="200" height="250" src="dos.jpg" alt="">
        </a>
      </div>
      <div class="card a">
        <a href="https://krunalbhardwaj.files.wordpress.com/2014/01/operating_operating_deitel1.pdf" target="_blank"
          class="stretched-link">
          <img class="bd-placeholder-img" width="200" height="250" src="dos1.jpg" alt="">
        </a>
      </div>
    </div>

    <div class="card scroll" style="width: 12rem;  height:40rem;">
      <h3 style="font-family: 'Dancing Script', cursive;">Internship</h3>
      <div class="card a">
        <a href="https://prutor.ai/" target="_blank" class="stretched-link">
          <img class="bd-placeholder-img" width="200" height="250" src="intern3.png" alt="">
        </a>
      </div>
    </div>
  </div>

  <div class="container my-4">
    <form action="course.php" method="post">
      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" aria-describedby="emailHelp" name="subject">

      </div>
      <div class="form-group">
        <label for="topic">Topic</label>
        <input type="text" class="form-control" id="topic" name="topic">
      </div>
      <div class="form-group">
        <label for="link">Link</label>
        <input type="text" class="form-control" id="link" name="link">
      </div>

      <button type="submit" class="btn btn-primary">Add subject</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.no</th>
          <th scope="col">Subject</th>
          <th scope="col">Topic</th>
          <th scope="col">Link</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
  $sql="SELECT * FROM `notes`";
  $result=mysqli_query($conn,$sql);
  $sno = 0;
  while($row = mysqli_fetch_assoc($result)){
    $sno = $sno + 1;
      echo "<tr>
      <th scope='row'>". $sno . "</th>
      <td>" .$row['subject']. "</td>
      <td>" .$row['topic']. "</td>
      <td>" .$row['link']. "</td>
      <td><button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td>
    </tr>";
  }
  ?>

      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        subject = tr.getElementsByTagName("td")[0].innerText;
        topic = tr.getElementsByTagName("td")[1].innerText;
        link = tr.getElementsByTagName("td")[2].innerText;
        console.log(subject, topic, link);
        subjectEdit.value = subject;
        topicEdit.value = topic;
        linkEdit.value = link;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `course.php?delete=${sno}`;

        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

<div class="container my-2">
  <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2020-2021 BookWeb, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
  </footer>
</div>

</html>