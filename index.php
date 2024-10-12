<?php
include("includes/header.php");
include("connection.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Forum</title>
</head>

<body>
 
  <!-- SLider Start -->

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
      <img src="img/banner-1.jpg" height="500px" class="d-block w-100" alt="image error">

      </div>
      <div class="carousel-item ">
      <img src="img/banner-2.jpg" height="500px" class="d-block w-100" alt="image error">

      </div>
      <div class="carousel-item">
      <img src="img/banner-3.jpg
      " height="500px" class="d-block w-100" alt="image error">

      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  </div>

  <!-- Card -->

  <div class="container">
    <h1 class="text-center m-3 mt-4"> <u> iDiscuss Categories </u></h1>
  <br><br>
    <div class="row">


      <!-- use loop to fetch All The categories From  Table  -->

      <?PHP
      $sql = "SELECT * FROM `categories` ";
      $result = mysqli_query($connection, $sql);
      while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['cat_id'];
        $cat = $row['cat_name'];
        $des = $row['cat_description'];
        echo '

  <div class="col-md-4 mb-3">
    <div class="card" style="width: 18rem;">
      <img src="img/card-'. $id .  '.jpg" height = "200px" class="card-img-top"  alt="NO Image Found">
      <div class="card-body">
        <h5 class="card-title"> <a href="threadlist.php?catid='. $id . '&page="> ' . $cat . ' </a></h5>
        <p class="card-text"> ' . substr($des, 0, 50) . '...</p>
        <a href="threadlist.php?catid=' . $id . '&page="  class="btn btn-primary">View Threads</a>
      </div>
    </div>

  </div>
        

';

      }
      ?>


    </div>

  </div>

  <?php
  
  include("includes/footer.php");

  ?>



  <!-- jQuery --> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>




</body>

</html>